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
 * @version         $Id: const_blocks_language.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_blocks_language($modules, $tables_arr)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_MB_'.strtoupper($mod_name).'_';
	$file = 'blocks.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/language/'.$GLOBALS['xoopsConfig']['language'].'/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/language/'.$GLOBALS['xoopsConfig']['language'].'/'.$file;	
	$text = '<?php'.const_header($modules, $file);
	$text .= <<<EOT
\n// Main
define('{$language}DISPLAY', "How Many Tables to Display");
define('{$language}TITLELENGTH', "Title Length");
define('{$language}CATTODISPLAY', "Categories to Display");
define('{$language}ALLCAT', "All Categories");
EOT;
	foreach (array_keys($tables_arr) as $i) 
	{
		$table_name = $tables_arr[$i]->getVar('table_name');
		$table_fieldname = $tables_arr[$i]->getVar('table_fieldname');
		$fields_total = explode('|', $tables_arr[$i]->getVar('table_fields'));
		$nb_fields = count($fields_total);
		$nb_caracteres = strlen($table_fieldname);
		$table_blocks = $tables_arr[$i]->getVar('table_blocks');
		$language1 = $language.strtoupper($table_fieldname);

		//Recuperation des noms des tables
		for($j = 0; $j < $nb_fields; $j++)
		{	
			//Nom des fields
			$fields1 = explode(':', $fields_total[$j]);
			$fields[$j] = $fields1[0];
			$fields_final[$j] = substr($fields1[0], $nb_caracteres);
			$lng_fileds = $language1.strtoupper($fields_final[$j]);
		    $ucf_table_field = $table_name.str_replace('_', ' ', ucfirst($fields_final[$j]));
			$text .= <<<EOT
\ndefine('{$lng_fileds}', "{$ucf_table_field}");
EOT;
		}	
	}
	
	createFile(	$tdmcreate_path, $text,
			_AM_TDMCREATE_CONST_OK_LANGUAGES,
			_AM_TDMCREATE_CONST_NOTOK_LANGUAGES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_LANGUAGES,
					_AM_TDMCREATE_CONST_NOTOK_LANGUAGES, $file);
	}
}