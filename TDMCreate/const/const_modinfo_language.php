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
 * @version         $Id: const_modinfo_language.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_modinfo_language($modules, $table_name, $table_image, $tables_arr, $table_notifications)
{
	$mod_name = $modules->getVar('mod_name');
	$prefix = '_MI_'.strtoupper($mod_name).'_';	
	$file = 'modinfo.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/language/'.xoops_getConfigOption('language').'/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/language/'.xoops_getConfigOption('language').'/'.$file;	
    $menu = 1;
	$mod_name = ucfirst( $mod_name );
	$description = ucfirst( $modules->getVar('mod_description') );
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\n// Admin
define('{$prefix}NAME', "{$mod_name}");
define('{$prefix}DESC', "{$description}");
//Menu
define('{$prefix}ADMENU{$menu}', "Home");
EOT;
foreach (array_keys($tables_arr) as $i) 
{   
    $menu++;
	$table_name = str_replace('_', ' ', $tables_arr[$i]->getVar('table_name'));
	$table_name = ucfirst($table_name);
    $text .= <<<EOT
\ndefine('{$prefix}ADMENU{$menu}', "{$table_name}");
EOT;
}
if ( $modules->getVar('mod_permissions') == 1 ) {
    $menu++;
    $text .= <<<EOT
\ndefine('{$prefix}ADMENU{$menu}', "Permissions");
EOT;
}
$menu++;
$text .= <<<EOT
\ndefine('{$prefix}ADMENU{$menu}', "About");
EOT;
unset( $menu );
$text .= <<<EOT
\n//Blocks
EOT;
foreach (array_keys($tables_arr) as $i) 
{	
    $table_name = $tables_arr[$i]->getVar('table_name');
	$prefix1 = $prefix.strtoupper($table_name).'';
	$table_name = str_replace("_", " ", ucfirst($table_name));
	if ( $tables_arr[$i]->getVar('table_blocks') == 1 ) {
	$text .= <<<EOT
\ndefine('{$prefix1}_BLOCK', "{$table_name} block");
EOT;
	}
}
$text .= <<<EOT
\n//Config
define('{$prefix}EDITOR', "Editor");
define('{$prefix}EDITOR_DESC', "Select the Editor to use");
define('{$prefix}KEYWORDS', "Keywords");
define('{$prefix}KEYWORDS_DESC', "Insert here the keywords (separate by comma)");
EOT;
if ( $table_name != '' ) {
$text .= <<<EOT
\ndefine('{$prefix}ADMINPAGER', "Admin pager");
define('{$prefix}ADMINPAGER_DESC', "Admin per page list");
define('{$prefix}USERPAGER', "User pager");
define('{$prefix}USERPAGER_DESC', "User per page list");
EOT;
}
if ( $table_image != '' ) 
{
	$text .= <<<EOT
\ndefine('{$prefix}MAXSIZE', "Max size");
define('{$prefix}MAXSIZE_DESC', "Set a number of max size uploads file in byte");
define('{$prefix}MIMETYPES', "Mime Types");
define('{$prefix}MIMETYPES_DESC', "Set the mime types selected");
EOT;
}
$text .= <<<EOT
\ndefine('{$prefix}IDPAYPAL', "Paypal ID");
define('{$prefix}IDPAYPAL_DESC', "Insert here your PayPal ID for donactions.");
define('{$prefix}ADVERTISE', "Advertisement Code");
define('{$prefix}ADVERTISE_DESC', "Insert here the advertisement code");
define('{$prefix}BOOKMARKS', "Social Bookmarks");
define('{$prefix}BOOKMARKS_DESC', "Show Social Bookmarks in the form");
define('{$prefix}FBCOMMENTS', "Facebook comments");
define('{$prefix}FBCOMMENTS_DESC', "Allow Facebook comments in the form");
EOT;
if ( $table_notifications == 1 ) 
{
$text .= <<<EOT
\n// Notifications
define('{$prefix}GLOBAL_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}CATEGORY_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}CATEGORY_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}FILE_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}FILE_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_NEWCATEGORY_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_NEWCATEGORY_NOTIFY_CAPTION', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_NEWCATEGORY_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILEMODIFY_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILEMODIFY_NOTIFY_CAPTION', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILEMODIFY_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILEMODIFY_NOTIFY_SUBJECT', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILEBROKEN_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILEBROKEN_NOTIFY_CAPTION', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILEBROKEN_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILEBROKEN_NOTIFY_SUBJECT', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILESUBMIT_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILESUBMIT_NOTIFY_CAPTION', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILESUBMIT_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_FILESUBMIT_NOTIFY_SUBJECT', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_NEWFILE_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_NEWFILE_NOTIFY_CAPTION', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_NEWFILE_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}GLOBAL_NEWFILE_NOTIFY_SUBJECT', "Allow Facebook comments in the form");
define('{$prefix}CATEGORY_FILESUBMIT_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}CATEGORY_FILESUBMIT_NOTIFY_CAPTION', "Allow Facebook comments in the form");
define('{$prefix}CATEGORY_FILESUBMIT_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}CATEGORY_FILESUBMIT_NOTIFY_SUBJECT', "Allow Facebook comments in the form");
define('{$prefix}CATEGORY_NEWFILE_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}CATEGORY_NEWFILE_NOTIFY_CAPTION', "Allow Facebook comments in the form");
define('{$prefix}CATEGORY_NEWFILE_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}CATEGORY_NEWFILE_NOTIFY_SUBJECT', "Allow Facebook comments in the form");
define('{$prefix}FILE_APPROVE_NOTIFY', "Allow Facebook comments in the form");
define('{$prefix}FILE_APPROVE_NOTIFY_CAPTION', "Allow Facebook comments in the form");
define('{$prefix}FILE_APPROVE_NOTIFY_DESC', "Allow Facebook comments in the form");
define('{$prefix}FILE_APPROVE_NOTIFY_SUBJECT', "Allow Facebook comments in the form");
EOT;
}	
if ( $modules->getVar('mod_permissions') == 1 ) {
$text .= <<<EOT
\n// Permissions Groups
define('{$prefix}GROUPS', "Groups access");
define('{$prefix}GROUPS_DESC', "Select general access permission for groups.");
define('{$prefix}ADMINGROUPS', "Admin Group Permissions");
define('{$prefix}ADMINGROUPS_DESC', "Which groups have access to tools and permissions page");
EOT;
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