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
 * @version         $Id: const_admin_language.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_admin_language($modules, $tables_arr, $table_permissions)
{
    $mod_name = $modules->getVar('mod_name');
	$language = '_AM_'.strtoupper($mod_name).'_';
	$language1 = '_AM_'.strtoupper($mod_name).'_THEREARE_';	
	$file = 'admin.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/language/'.xoops_getConfigOption('language').'/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/language/'.xoops_getConfigOption('language').'/'.$file;	
	$text = '<?php'.const_header($modules, $file);
	$ucf_mod_name = ucfirst($mod_name);
$text .= <<<EOT
\n//Index
define('{$language}STATISTICS', "{$ucf_mod_name} statistics");
EOT;
foreach (array_keys($tables_arr) as $i)
{	
    $table_name = $tables_arr[$i]->getVar('table_name');
	$table_name_nohs = str_replace('_', ' ', ucfirst($table_name));
	$stu_table_name = strtoupper($table_name);
	$text .= <<<EOT
\ndefine('{$language1}{$stu_table_name}', "There are <span class='bold'>%s</span> {$table_name_nohs} in the database");
EOT;
if(isset($_REQUEST['table_online'])) {
$text .= <<<EOT
\ndefine('{$language1}{$stu_table_name}ONLINE', "There are <span class='bold'>%s</span> {$table_name_nohs} online in the database");
EOT;

}
if(isset($_REQUEST['table_waiting'])) {
$text .= <<<EOT
\ndefine('{$language1}{$stu_table_name}WAITING', "There are <span class='bold'>%s</span> {$table_name_nohs} waiting in the database");
EOT;
 
}
}
$text .= <<<EOT
\n//Buttons
EOT;
foreach (array_keys($tables_arr) as $i)
{
    $table_name = $tables_arr[$i]->getVar('table_name');
	$table_fieldname = $tables_arr[$i]->getVar('table_fieldname');
	$table_name_nohs = str_replace('_', ' ', $table_name);
	$stu_table_name = strtoupper($table_name);
$text .= <<<EOT
\ndefine('{$language}ADD_{$stu_table_name}', "Add new {$table_name_nohs}");
define('{$language}{$stu_table_name}_LIST', "List of {$table_name_nohs}");
EOT;
if(isset($_REQUEST['table_waiting'])) 
{
$text .= <<<EOT
\ndefine('{$language}{$stu_table_name}_WAITING', "Waiting {$table_name_nohs}");
EOT;
}
}
$text .= <<<EOT
\n//General
define('{$language}FORMOK', "Registered successfull");
define('{$language}FORMDELOK', "Deleted successfull");
define('{$language}FORMSUREDEL', "Are you sure to Delete: <span class='bold red'>%s</span></b>");
define('{$language}FORMSURERENEW', "Are you sure to Renew: <span class='bold red'>%s</span></b>");
define('{$language}FORMUPLOAD', "Upload");
define('{$language}FORMIMAGE_PATH', "File presents in %s");
define('{$language}FORMACTION', "Action");
EOT;
$verif = true;
foreach (array_keys($tables_arr) as $i) 
{
	$table_fieldname = $tables_arr[$i]->getVar('table_fieldname');
	$fields_total = explode('|', $tables_arr[$i]->getVar('table_fields'));
	$nb_fields = count($fields_total);
	$nb_caracteres = strlen($table_fieldname);
	$lng_prefix = $language.strtoupper($table_fieldname);

	$table_name = str_replace('_', ' ', $tables_arr[$i]->getVar('table_name'));
	$UcTable_name = UcFirstAndToLower($table_name);
	//Recuperation des noms des tables
	$text .= <<<EOT
\n// {$UcTable_name}
EOT;
	for($j=0; $j<$nb_fields; $j++)
	{	
		//Nom des fields
		$fields1 = explode(':', $fields_total[$j]);
		$fields[$j] = $fields1[0];
		$fields_final[$j] = substr($fields1[0], $nb_caracteres);
		$stl_table_name = strtolower($table_name);
		if ( $verif == true )
		{
$text .= <<<EOT
\ndefine('{$lng_prefix}_ADD', "Add a {$stl_table_name}");
define('{$lng_prefix}_EDIT', "Edit {$stl_table_name}");
define('{$lng_prefix}_DELETE', "Delete {$stl_table_name}");
EOT;
		}
		$verif = false;
		$ucf_fields = ucfirst($table_fieldname.str_replace("_", " ", $fields_final[$j]));
		$lng_stu_fields_final = $lng_prefix.strtoupper($fields_final[$j]);
$text .= <<<EOT
\ndefine('{$lng_stu_fields_final}', "{$ucf_fields}");
EOT;
	}
	$verif = true;
	$text .= <<<EOT
EOT;
}
$text .= <<<EOT
//Blocks.php
EOT;
foreach (array_keys($tables_arr) as $i)
{
    $table_name = str_replace('_', ' ', ucfirst($tables_arr[$i]->getVar('table_name')));
	$table_fieldname = str_replace('_', ' ', ucfirst($tables_arr[$i]->getVar('table_fieldname')));
	$lng_prefix = $language.strtoupper($table_name).'_';
$text .= <<<EOT
\ndefine('{$lng_prefix}BLOCK', "{$table_name} block");
EOT;
}  
if( $table_permissions == 1 ) {
$text .= <<<EOT
\n//Permissions
define('{$language}PERMISSIONS_GLOBAL', "Global permissions");
define('{$language}PERMISSIONS_GLOBAL_DESC', "Only users in the group that you select may global this");
define('{$language}PERMISSIONS_GLOBAL_4', "Rate from user");
define('{$language}PERMISSIONS_GLOBAL_8', "Submit from user side");
define('{$language}PERMISSIONS_GLOBAL_16', "Auto approve");
define('{$language}PERMISSIONS_APPROVE', "Permissions to approve");
define('{$language}PERMISSIONS_APPROVE_DESC', "Only users in the group that you select may approve this");
define('{$language}PERMISSIONS_VIEW', "Permissions to view");
define('{$language}PERMISSIONS_VIEW_DESC', "Only users in the group that you select may view this");
define('{$language}PERMISSIONS_SUBMIT', "Permissions to submit");
define('{$language}PERMISSIONS_SUBMIT_DESC', "Only users in the group that you select may submit this");
define('{$language}PERMISSIONS_NOPERMSSET', "Permission cannot be set: No {$table_name} created yet! Please create a {$table_fieldname} first.");
EOT;
}
$text .= <<<EOT
\n//Error NoFrameworks
define('_AM_ERROR_NOFRAMEWORKS', "Error: You don&#39;t use the Frameworks \"admin module\". Please install this Frameworks");
define('{$language}MAINTAINEDBY', "is maintained by the");
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