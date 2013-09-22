<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * tdmcreate module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         tdmcreate
 * @since           2.5.0
 * @author          Txmod Xoops http://www.txmodxoops.org
 * @version         $Id: const_include_notification.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_include_notifications($modules, $table_name, $table_fieldname, $table_fields, $table_parameters)
{
	$mod_name = $modules->getVar('mod_name');
	$file = 'notification.inc.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/include/'.$file;
	$root_path = XOOPS_URL.'/modules/{$mod_name}/include/'.$file;
	
	//fields
	$fields_total = explode('|', $table_fields);
	$nb_fields = count($fields_total);
	//print_r($fields_total);
	//parameters
	$parameters_total = explode('|', $table_parameters);
	$k = 0;
	//Recuperation des parameters affichage dans le formulaire
	for($j=0; $j<$nb_fields; $j++)
	{
		$fields = explode(':', $fields_total[$j]);
		$field[$j] = $fields[0];
		//Afficher dans les elements du formulaire et choisir le type
		if( $j == 0 ) {
		    $fpsf[$k] = $fields[0];
			$fpmf = '0';
		} else {
			$parameters1 = explode(':', $parameters_total[$j-1]);
			if ( $parameters1[5] == 1 )
			{
				$fpsf[$k] = $fields[0];
				$k++;
			}
			if ( $parameters1[4] == 1 ) {
				$fpmf = $fields[0];
			}
		}
	}
	
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\n// comment callback functions
function {$mod_name}_notify_iteminfo(\$category, \$item_id)
{
	global \$xoopsModule, \$xoopsModuleConfig, \$xoopsConfig;

	if (empty(\$xoopsModule) || \$xoopsModule->getVar('dirname') != '{$mod_name}')
	{
		\$module_handler =& xoops_gethandler('module');
		\$module =& \$module_handler->getByDirname('{$mod_name}');
		\$config_handler =& xoops_gethandler('config');
		\$config =& \$config_handler->getConfigsByCat(0, \$module->getVar('mid'));
	} else {
		\$module =& \$xoopsModule;
		\$config =& \$xoopsModuleConfig;
	}

	xoops_loadLanguage('main', '{$mod_name}');

	if (\$category=='global')
	{
		\$item['name'] = '';
		\$item['url'] = '';
		return \$item;
	}

	global \$xoopsDB;
	if (\$category=='category')
	{
		// Assume we have a valid category id
		\$sql = 'SELECT {$fpmf} FROM ' . \$xoopsDB->prefix('{$mod_name}_{$table_name}') . ' WHERE {$field[1]} = '. \$item_id;
		\$result = \$xoopsDB->query(\$sql); // TODO: error check
		\$result_array = \$xoopsDB->fetchArray(\$result);
		\$item['name'] = \$result_array['{$fpmf}'];
		\$item['url'] = XOOPS_URL . '/modules/' . \$module->getVar('dirname') . '/{$table_name}.php?{$field[1]}=' . \$item_id;
		return \$item;
	}

	if (\$category=='{$table_fieldname}')
	{
		// Assume we have a valid link id
		\$sql = 'SELECT {$field[1]}, {$fpmf} FROM '.\$xoopsDB->prefix('{$table_name}') . ' WHERE {$field[0]} = ' . \$item_id;
		\$result = \$xoopsDB->query(\$sql); // TODO: error check
		\$result_array = \$xoopsDB->fetchArray(\$result);
		\$item['name'] = \$result_array['title'];
		\$item['url'] = XOOPS_URL . '/modules/' . \$module->getVar('dirname') . '/{$table_name}.php?{$field[1]}=' . \$result_array['{$field[1]}'] . '&amp;{$field[0]}=' . \$item_id;
		return \$item;
	}
}
EOT;
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_INCLUDES,
				_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_INCLUDES,
					_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	}
}