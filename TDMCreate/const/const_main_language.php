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
 * @version         $Id: const_main_language.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_main_language($modules, $tables_arr)
{
    $mod_name = $modules->getVar('mod_name');
    $mod_desc = $modules->getVar('mod_description');	
	$language = '_MA_'.strtoupper($mod_name);	
	$file = 'main.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/language/'.xoops_getConfigOption('language').'/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/language/'.xoops_getConfigOption('language').'/'.$file;
	$ucf_mod_name = ucfirst($mod_name);
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\n// Main
define('{$language}_INDEX', "Home");
define('{$language}_TITLE', "{$ucf_mod_name}");
define('{$language}_DESC', "{$mod_desc}");
define('{$language}_INDEX_DESC', "{$mod_desc}");
EOT;
foreach (array_keys($tables_arr) as $i) 
{
	$table_name = $tables_arr[$i]->getVar('table_name');
	$table_fieldname = $tables_arr[$i]->getVar('table_fieldname');
	$fields_total = explode('|', $tables_arr[$i]->getVar('table_fields'));
	$nb_fields = count($fields_total);
	$nb_caracteres = strlen($table_fieldname);
	$table_blocks = $tables_arr[$i]->getVar('table_blocks');
	$lng_stu_table_name = $language.'_'.strtoupper($table_name);
	$ucf_table_name = UcFirstAndToLower($table_name);
$text .= <<<EOT
\n\ndefine('{$lng_stu_table_name}', "{$ucf_table_name}");
define('{$lng_stu_table_name}_DESC', "{$ucf_table_name} description");
EOT;
	//Recuperation des noms des tables
	for($j = 0; $j < $nb_fields; $j++)
	{	
		//Nom des fields
		$fields1 = explode(':', $fields_total[$j]);
		$fields[$j] = $fields1[0];
		$fields_final[$j] = substr($fields1[0], $nb_caracteres);
	    $lng_stu_fields = $language.'_'.strtoupper($table_fieldname).strtoupper($fields_final[$j]);
		$ucf_fields = ucfirst($table_fieldname.str_replace("_", " ", $fields_final[$j]));
$text .= <<<EOT
\ndefine('{$lng_stu_fields}', "{$ucf_fields}");
EOT;
	}	
}
$text .= <<<EOT
\n\ndefine('{$language}_ADMIN', "Admin");
EOT;
	createFile(	$tdmcreate_path, $text,
			_AM_TDMCREATE_CONST_OK_LANGUAGES,
			_AM_TDMCREATE_CONST_NOTOK_LANGUAGES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_LANGUAGES,
					_AM_TDMCREATE_CONST_NOTOK_LANGUAGES, $file);
	}
}