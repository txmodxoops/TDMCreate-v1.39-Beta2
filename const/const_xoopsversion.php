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
 * @version         $Id: const_xoopsversion.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_xoopsversion($modules, $tbl_name, $table_fields, $table_parameters, $table_image, $tables_arr)
{
	$mod_name = $modules->getVar('mod_name');
	$stl_mod_name = strtolower($mod_name);
	$language = '_MI_'.strtoupper($mod_name);
	$file = 'xoops_version.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/'.$file;
	$date = date('Y/m/d');
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\nif (!defined('XOOPS_ROOT_PATH')){ exit(); }

\$dirname = basename( dirname( __FILE__ ) ) ;

\$modversion = array(
    'name' => {$language}_NAME,
	'version' => {$modules->getVar('mod_version')},
	'description' => {$language}_DESC,
	'author' => "{$modules->getVar('mod_author')}",
	'author_mail' => "{$modules->getVar('mod_author_mail')}",
	'author_website_url' => "{$modules->getVar('mod_author_website_url')}",
	'author_website_name' => "{$modules->getVar('mod_author_website_name')}",
	'credits' => "{$modules->getVar('mod_credits')}",
	'license' => "{$modules->getVar('mod_license')}",
	'help' => "page=help",
	'license' => "GNU GPL 2.0",
	'license_url' => "www.gnu.org/licenses/gpl-2.0.html/",

	'release_info' => "{$modules->getVar('mod_release_info')}",
	'release_file' => XOOPS_URL."/modules/{\$dirname}/docs/{$modules->getVar('mod_release_file')}",
	'release_date' => "{$date}",

	'manual' => "{$modules->getVar('mod_manual')}",
	'manual_file' => XOOPS_URL."/modules/{\$dirname}/docs/{$modules->getVar('mod_manual_file')}",
	'min_php' => "{$modules->getVar('mod_min_php')}",
	'min_xoops' => "{$modules->getVar('mod_min_xoops')}",
	'min_admin' => "{$modules->getVar('mod_min_admin')}",
	'min_db' => array('mysql' => '{$modules->getVar('mod_min_mysql')}', 'mysqli' => '{$modules->getVar('mod_min_mysql')}'),
	'image' => "images/{$modules->getVar('mod_image')}",
	'dirname' => "{\$dirname}",
    //Frameworks
	'dirmoduleadmin' => "Frameworks/moduleclasses/moduleadmin",
    'sysicons16' => "../../Frameworks/moduleclasses/icons/16",
	'sysicons32' => "../../Frameworks/moduleclasses/icons/32",
	'modicons16' => 'images/icons/16',
	'modicons32' => 'images/icons/32',
	//About
	'demo_site_url' => "{$modules->getVar('mod_demo_site_url')}",
	'demo_site_name' => "{$modules->getVar('mod_demo_site_name')}",
	'support_url' => "{$modules->getVar('mod_support_url')}",
	'support_name' => "{$modules->getVar('mod_support_name')}",
	'module_website_url' => "{$modules->getVar('mod_website_url')}",
	'module_website_name' => "{$modules->getVar('mod_website_name')}",
	'release' => "{$modules->getVar('mod_release')}",
	'module_status' => "{$modules->getVar('mod_status')}",\n
EOT;

if ( $modules->getVar('mod_admin') == 1 ) {
$text .= <<<EOT
    // Admin system menu
	'system_menu' => 1,
	// Admin things
	'hasAdmin' => 1,	
	'adminindex' => "admin/index.php",
	'adminmenu' => "admin/menu.php",\n
EOT;
} else {
$text .= <<<EOT
    // Admin system menu
	'system_menu' => 0,	
	// Admin things
	'hasAdmin' => 0, \n
EOT;
}
if ( $modules->getVar('mod_user') == 1 ) {
$text .= <<<EOT
    // Menu
	'hasMain' => 1,
	// Scripts to run upon installation or update
	'onInstall' => "include/install.php",
	'onUpdate' => "include/update.php"	
);
EOT;
} else {
$text .= <<<EOT
    // Menu
	'hasMain' => 0		
);
EOT;
}
$j = 1;
if ( $tbl_name != '' ) {
$text .= <<<EOT
\n\n// Mysql file
\$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
// Tables
EOT;
    foreach (array_keys($tables_arr) as $i)
    {
		$text .= <<<EOT
\n\$modversion['tables'][{$j}] = "mod_{$stl_mod_name}_{$tables_arr[$i]->getVar('table_name')}";
EOT;
$j++;
	}  
	unset($j);
}
if ( $modules->getVar('mod_search') == 1 ) {
$text .= <<<EOT
\n//Search
\$modversion['hasSearch'] = 1;
\$modversion['search']['file'] = "include/search.inc.php";
\$modversion['search']['func'] = "{$stl_mod_name}_search";
EOT;
} 

if ( $modules->getVar('mod_comments') == 1 ) {
$text .= <<<EOT
\n// Comments
\$modversion['comments']['pageName'] = "comments.php";
\$modversion['comments']['itemName'] = "com_id";
// Comment callback functions
\$modversion['comments']['callbackFile'] = "include/comment_functions.php";
\$modversion['comments']['callback']['approve'] = "{$stl_mod_name}_com_approve";
\$modversion['comments']['callback']['update'] = "{$stl_mod_name}_com_update";
EOT;
}

$text .=<<<EOT
\n// Templates
\$modversion['templates'][] = array('file' => '{$stl_mod_name}_header.html', 'description' => '');
\$modversion['templates'][] = array('file' => '{$stl_mod_name}_index.html', 'description' => '');
EOT;
foreach (array_keys($tables_arr) as $i)
{	
	$table_name = $tables_arr[$i]->getVar('table_name');
$text .= <<<EOT
\n\$modversion['templates'][] = array('file' => '{$stl_mod_name}_{$table_name}.html', 'description' => '');
EOT;
}
$text .= <<<EOT
\n\$modversion['templates'][] = array('file' => '{$stl_mod_name}_footer.html', 'description' => '');
EOT;
$text .= <<<EOT
\n\n//Blocks
EOT;
$keywords = array();
foreach (array_keys($tables_arr) as $i) {
	$table_name = $tables_arr[$i]->getVar('table_name');
	$table_blocks = $tables_arr[$i]->getVar('table_blocks');		
	$table_fieldname = $tables_arr[$i]->getVar('table_fieldname');
	if ($table_blocks == 1) {            
		$language1 = $language . '_' . strtoupper($table_name);
		$text .= <<<EOT
\n\$modversion['blocks'][] = array(
	'file' => "{$table_name}.php",
	'name' => {$language1}_BLOCK,
	'description' => "",
	'show_func' => "b_{$stl_mod_name}_{$table_name}_show",
	'edit_func' => "b_{$stl_mod_name}_{$table_name}_edit",
	'options' => "{$table_fieldname}|5|25|0",
	'template' => "{$table_name}_block.html");\n
EOT;
	$keywords[] = $table_name;            
	}
}
$text .= <<<EOT
\n// Config
xoops_load('xoopseditorhandler');
\$editor_handler = XoopsEditorHandler::getInstance();
\$modversion['config'][] = array(
    'name' => "{$stl_mod_name}_editor",
    'title' => "{$language}_EDITOR",
    'description' => "{$language}_EDITOR_DESC",
    'formtype' => "select",
    'valuetype' => "text",
    'options' => array_flip(\$editor_handler->getList()),
    'default' => "dhtml");
EOT;
if ( $modules->getVar('mod_permissions') == 1 ) {
$text .= <<<EOT
\n\n// Get groups
\$member_handler =& xoops_gethandler('member');
\$xoopsgroups = \$member_handler->getGroupList();
foreach (\$xoopsgroups as \$key => \$group) {
    \$groups[\$group] = \$key;
}
\$modversion['config'][] = array(
    'name' => "groups",
    'title' => "{$language}_GROUPS",
    'description' => "{$language}_GROUPS_DESC",
    'formtype' => "select_multi",
    'valuetype' => "array",
    'options' => \$groups,
    'default' => \$groups);
    
// Get Admin groups
\$criteria = new CriteriaCompo ();
\$criteria->add ( new Criteria ( 'group_type', 'Admin' ) );
\$member_handler =& xoops_gethandler('member');
\$admin_xoopsgroups = \$member_handler->getGroupList(\$criteria);
foreach (\$admin_xoopsgroups as \$key => \$admin_group) {
    \$admin_groups[\$admin_group] = \$key;
}
\$modversion['config'][] = array(
    'name' => "admin_groups",
    'title' => "{$language}_ADMINGROUPS",
    'description' => "{$language}_ADMINGROUPS_DESC",
    'formtype' => "select_multi",
    'valuetype' => "array",
    'options' => \$admin_groups,
    'default' => \$admin_groups);	
EOT;
}
$text .= <<<EOT
\n\n\$modversion['config'][] = array(
    'name' => "keywords",
    'title' => "{$language}_KEYWORDS",
    'description' => "{$language}_KEYWORDS_DESC",
    'formtype' => "textbox",
    'valuetype' => "text",
    'default' => "{$stl_mod_name}, 
EOT;
	$text .= implode(', ', $keywords);
$text .= <<<EOT
");\n
EOT;
unset($keywords);
if ( $table_image != '' )
{
$text .= <<<EOT
\n//Uploads : maxsize of image
\$modversion['config'][] = array(
    'name' => "maxsize",
    'title' => "{$language}_MAXSIZE",
    'description' => "{$language}_MAXSIZE_DESC",
    'formtype' => "textbox",
    'valuetype' => "int",
	'default' => 5000000);

//Uploads : mimetypes of image
\$modversion['config'][] = array(
    'name' => "mimetypes",
    'title' => "{$language}_MIMETYPES",
    'description' => "{$language}_MIMETYPES_DESC",
    'formtype' => "select_multi",
    'valuetype' => "array",
	'default' => array("image/gif", "image/jpeg", "image/png"),
    'options' => array("bmp" => "image/bmp","gif" => "image/gif","pjpeg" => "image/pjpeg",
                       "jpeg" => "image/jpeg","jpg" => "image/jpg","jpe" => "image/jpe",
					   "png" => "image/png"));
EOT;
}
if ( $tbl_name != '' ) {
$text .= <<<EOT
\n\n\$modversion['config'][] = array(
    'name' => "adminpager",
    'title' => "{$language}_ADMINPAGER",
    'description' => "{$language}_ADMINPAGER_DESC",
    'formtype' => "textbox",
    'valuetype' => "int",
	'default' => 10);

\$modversion['config'][] = array(
    'name' => "userpager",
    'title' => "{$language}_USERPAGER",
    'description' => "{$language}_USERPAGER_DESC",
    'formtype' => "textbox",
    'valuetype' => "int",
	'default' => 10);
EOT;
}
$text .= <<<EOT
\n\n\$modversion['config'][] = array(
    'name' => "advertise",
    'title' => "{$language}_ADVERTISE",
    'description' => "{$language}_ADVERTISE_DESC",
    'formtype' => "textarea",
    'valuetype' => "text",
	'default' => "");
 
\$modversion['config'][] = array(
    'name' => "bookmarks",
    'title' => "{$language}_BOOKMARKS",
    'description' => "{$language}_BOOKMARKS_DESC",
    'formtype' => "yesno",
    'valuetype' => "int",
	'default' => 0);

\$modversion['config'][] = array(
    'name' => "fbcomments",
    'title' => "{$language}_FBCOMMENTS",
    'description' => "{$language}_FBCOMMENTS_DESC",
    'formtype' => "yesno",
    'valuetype' => "int",
	'default' => 0); 
EOT;
if ( $modules->getVar('mod_notifications') == 1 ) {
$text .= <<<EOT
\n\n// Notifications {$stl_mod_name}
\$modversion['hasNotification'] = 1;
\$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
\$modversion['notification']['lookup_func'] = '{$stl_mod_name}_notify_iteminfo';

\$modversion['notification']['category'][] = array(
	'name' => "global", 
	'title' => {$language}_GLOBAL_NOTIFY,
	'description' => {$language}_GLOBAL_NOTIFY_DESC,
	'subscribe_from' => array('index.php', 'viewcat.php', 'singlefile.php'));

\$modversion['notification']['category'][] = array( 
	'name' => "category",
	'title' => {$language}_CATEGORY_NOTIFY,
	'description' => {$language}_CATEGORY_NOTIFY_DESC,
	'subscribe_from' => array('viewcat.php', 'singlefile.php'),
	'item_name' => "cid",
	'allow_bookmark' => 1);

\$modversion['notification']['category'][] = array( 
	'name' => "file",
	'title' => {$language}_FILE_NOTIFY,
	'description' => {$language}_FILE_NOTIFY_DESC,
	'subscribe_from' => "singlefile.php",
	'item_name' => "lid",
	'allow_bookmark' => 1);

\$modversion['notification']['event'][] = array( 
	'name' => "new_category",
	'category' => "global",
	'title' => {$language}_GLOBAL_NEWCATEGORY_NOTIFY,
	'caption' => {$language}_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION,
	'description' => {$language}_GLOBAL_NEWCATEGORY_NOTIFY_DESC,
	'mail_template' => "global_newcategory_notify",
	'mail_subject' => {$language}_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT);

\$modversion['notification']['event'][] = array( 
	'name' => "file_modify",
	'category' => "global",
	'admin_only' => 1,
	'title' => {$language}_GLOBAL_FILEMODIFY_NOTIFY,
	'caption' => {$language}_GLOBAL_FILEMODIFY_NOTIFY_CAPTION,
	'description' => {$language}_GLOBAL_FILEMODIFY_NOTIFY_DESC,
	'mail_template' => "global_filemodify_notify",
	'mail_subject' => {$language}_GLOBAL_FILEMODIFY_NOTIFY_SUBJECT);

\$modversion['notification']['event'][] = array( 
	'name' => "file_broken",
	'category' => "global",
	'admin_only' => 1,
	'title' => {$language}_GLOBAL_FILEBROKEN_NOTIFY,
	'caption' => {$language}_GLOBAL_FILEBROKEN_NOTIFY_CAPTION,
	'description' => {$language}_GLOBAL_FILEBROKEN_NOTIFY_DESC,
	'mail_template' => "global_filebroken_notify",
	'mail_subject' => {$language}_GLOBAL_FILEBROKEN_NOTIFY_SUBJECT);

\$modversion['notification']['event'][] = array( 
	'name' => "file_submit",
	'category' => "global",
	'admin_only' => 1,
	'title' => {$language}_GLOBAL_FILESUBMIT_NOTIFY,
	'caption' => {$language}_GLOBAL_FILESUBMIT_NOTIFY_CAPTION,
	'description' => {$language}_GLOBAL_FILESUBMIT_NOTIFY_DESC,
	'mail_template' => "global_filesubmit_notify",
	'mail_subject' => {$language}_GLOBAL_FILESUBMIT_NOTIFY_SUBJECT);

\$modversion['notification']['event'][] = array( 
	'name' => "new_file",
	'category' => "global",
	'title' => {$language}_GLOBAL_NEWFILE_NOTIFY,
	'caption' => {$language}_GLOBAL_NEWFILE_NOTIFY_CAPTION,
	'description' => {$language}_GLOBAL_NEWFILE_NOTIFY_DESC,
	'mail_template' => "global_newfile_notify",
	'mail_subject' => {$language}_GLOBAL_NEWFILE_NOTIFY_SUBJECT);

\$modversion['notification']['event'][] = array( 
	'name' => "file_submit",
	'category' => "category",
	'admin_only' => 1,
	'title' => {$language}_CATEGORY_FILESUBMIT_NOTIFY,
	'caption' => {$language}_CATEGORY_FILESUBMIT_NOTIFY_CAPTION,
	'description' => {$language}_CATEGORY_FILESUBMIT_NOTIFY_DESC,
	'mail_template' => "category_filesubmit_notify",
	'mail_subject' => {$language}_CATEGORY_FILESUBMIT_NOTIFY_SUBJECT);

\$modversion['notification']['event'][] = array( 
	'name' => "new_file",
	'category' => "category",
	'title' => {$language}_CATEGORY_NEWFILE_NOTIFY,
	'caption' => {$language}_CATEGORY_NEWFILE_NOTIFY_CAPTION,
	'description' => {$language}_CATEGORY_NEWFILE_NOTIFY_DESC,
	'mail_template' => "category_newfile_notify",
	'mail_subject' => {$language}_CATEGORY_NEWFILE_NOTIFY_SUBJECT);

\$modversion['notification']['event'][] = array( 
	'name' => "approve",
	'category' => "file",
	'admin_only' => 1,
	'title' => {$language}_FILE_APPROVE_NOTIFY,
	'caption' => {$language}_FILE_APPROVE_NOTIFY_CAPTION,
	'description' => {$language}_FILE_APPROVE_NOTIFY_DESC,
	'mail_template' => "file_approve_notify",
	'mail_subject' => {$language}_FILE_APPROVE_NOTIFY_SUBJECT);
EOT;
}
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_ROOTS,
				_AM_TDMCREATE_CONST_NOTOK_ROOTS, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_ROOTS,
					_AM_TDMCREATE_CONST_NOTOK_ROOTS, $file);
	}
}