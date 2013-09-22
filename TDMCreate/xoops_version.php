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
 * @since           2.5.4
 * @author          Txmod Xoops http://www.txmodxoops.org
 * @version         $Id: xoops_version.php 11084 2013-02-23 15:44:20Z timgno $
 */
if (!defined('XOOPS_ROOT_PATH')){ exit(); }
$dirname = basename( dirname( __FILE__ ) ) ;

$modversion['name'] = "{$dirname}";
$modversion['version'] = 1.39;
$modversion['description'] = _MI_TDMCREATE_DESC;
$modversion['author'] = 'Xoops TDM';
$modversion['author_website_url'] = "http://www.xoops.org/";
$modversion['author_website_name'] = "Xoops Team Developers Module";
$modversion['credits'] = "Mamba(Xoops), Timgno(Txmod Xoops)";
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0 or later';
$modversion['license_url'] = "www.gnu.org/licenses/gpl-2.0.html/";
$modversion['release_info'] = "README";
$modversion['release_file'] = XOOPS_URL."/modules/{$dirname}/docs/readme.txt";
$modversion['manual'] = "MANUAL";
$modversion['manual_file'] = XOOPS_URL."/modules/{$dirname}/docs/manual.txt";
$modversion['image'] = "images/tdmcreate_slogo.png";
$modversion['dirname'] = "{$dirname}";

$modversion['dirmoduleadmin'] = '/Frameworks/moduleclasses/moduleadmin';
$modversion['icons16'] = '../../Frameworks/moduleclasses/icons/16';
$modversion['icons32'] = '../../Frameworks/moduleclasses/icons/32';

$modversion['targetdir'] = XOOPS_ROOT_PATH . "/modules/{$dirname}/modules/";

$modversion['release_date'] = '2013/09/21';
$modversion['module_website_url'] = "http://www.xoops.org/";
$modversion['module_website_name'] = "XOOPS";
$modversion['module_status'] = "Beta 2";

$modversion['min_php'] = "5.3";
$modversion['min_xoops'] = "2.5.6";

$modversion['min_admin'] =  "1.1";
$modversion['min_db'] = array('mysql' => '5.0.7', 'mysqli' => '5.0.7');
//about
$modversion['demo_site_url'] = "http://www.xoops.org/";
$modversion['demo_site_name'] = "TDM";
$modversion['forum_site_url'] = "http://xoops.org/modules/newbb/viewtopic.php?post_id=352671";
$modversion['forum_site_name'] = "TDMCreate - testers needed";
$modversion['module_website_name'] = "Xoops TDM";
// Admin things
$modversion['system_menu'] = 1;
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";
// Mysql file
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
// Tables

$modversion['tables'][0] = "mod_tdmcreate_modules";
$modversion['tables'][1] = "mod_tdmcreate_tables";

// Scripts to run upon installation or update
$modversion['onInstall'] = "include/install.php";
//$modversion['onUpdate'] = "include/update.php";
// Menu
$modversion['hasMain'] = 0;
// Templates admin
$modversion['templates'][] = array( 'file' => 'help.html', 'description' => '', 'type' => 'admin' );

// Config
$i = 1;
$modversion['config'][$i]['name'] = "break" . $i;
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_BREAK_GENERAL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "line_break";
$modversion['config'][$i]['valuetype'] = "textbox";
$modversion['config'][$i]['default'] = 'head';
$i++;
$modversion['config'][$i]['name'] = "tdmcreate_editor"; 
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_EDITOR"; 
$modversion['config'][$i]['description'] = "_MI_TDMCREATE_EDITOR_DESC"; 
$modversion['config'][$i]['formtype'] = "select"; 
$modversion['config'][$i]['valuetype'] = "text"; 
$modversion['config'][$i]['default'] = 'dhtml';
xoops_load('xoopseditorhandler');
$editor_handler = XoopsEditorHandler::getInstance();
$modversion['config'][$i]['options'] = array_flip($editor_handler->getList());
$i++;
//Uploads : mimetypes
$modversion['config'][$i]['name'] = "mimetypes";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MIMETYPES";
$modversion['config'][$i]['description'] = "_MI_TDMCREATE_MIMETYPES_DESC";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'gif|jpeg|pjpeg|png';
$i++;
//Uploads : maxsize
$modversion['config'][$i]['name'] = "maxsize";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MAXSIZE";
$modversion['config'][$i]['description'] = "_MI_TDMCREATE_MAXSIZE_DESC";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "int";
$modversion['config'][$i]['default'] = '5000000';
$i++;
$modversion['config'][$i]['name'] = "mod_adminpager";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULES_ADMINPAGER";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "int";
$modversion['config'][$i]['default'] = 10;
$i++;
$modversion['config'][$i]['name'] = "tab_adminpager";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_TABLES_ADMINPAGER";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "int";
$modversion['config'][$i]['default'] = 10;
$i++;
$modversion['config'][$i]['name'] = "break" . $i;
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_BREAK_REQUIRED";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "line_break";
$modversion['config'][$i]['valuetype'] = "textbox";
$modversion['config'][$i]['default'] = 'head';
$i++;
$modversion['config'][$i]['name'] = "name";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_NAME";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'My Module';
$i++;
$modversion['config'][$i]['name'] = "version";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_VERSION";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = '1.0';
$i++;
$modversion['config'][$i]['name'] = "since";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_SINCE";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = '1.0.0';

$i++;
$modversion['config'][$i]['name'] = "min_php";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_MIN_PHP";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = '5.3';
$i++;
$modversion['config'][$i]['name'] = "min_xoops";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_MIN_XOOPS";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = '2.5.6';

$i++;
$modversion['config'][$i]['name'] = "min_admin";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_MIN_ADMIN";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = '1.1';
$i++;
$modversion['config'][$i]['name'] = "min_mysql";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_MIN_MYSQL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = '5.0.7';
$i++;
$modversion['config'][$i]['name'] = "description";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_DESCRIPTION";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textarea";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'This module is for doing following...';
$i++;
$modversion['config'][$i]['name'] = "author";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_AUTHOR";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'XOOPS Development Team';
$i++;
$modversion['config'][$i]['name'] = "display_admin";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_DISPLAY_ADMIN_SIDE";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "yesno";
$modversion['config'][$i]['valuetype'] = "int";
$modversion['config'][$i]['default'] = 1;
$i++;
$modversion['config'][$i]['name'] = "display_user";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_DISPLAY_USER_SIDE";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "yesno";
$modversion['config'][$i]['valuetype'] = "int";
$modversion['config'][$i]['default'] = 1;
$i++;
$modversion['config'][$i]['name'] = "active_search";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_ACTIVE_SEARCH";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "yesno";
$modversion['config'][$i]['valuetype'] = "int";
$modversion['config'][$i]['default'] = 0;
$i++;
$modversion['config'][$i]['name'] = "active_comments";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_ACTIVE_COMMENTS";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "yesno";
$modversion['config'][$i]['valuetype'] = "int";
$modversion['config'][$i]['default'] = 0;
$i++;
$modversion['config'][$i]['name'] = "active_notifications";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_ACTIVE_NOTIFICATIONS";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "yesno";
$modversion['config'][$i]['valuetype'] = "int";
$modversion['config'][$i]['default'] = 0;
$i++;
$modversion['config'][$i]['name'] = "active_permissions";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_ACTIVE_PERMISSIONS";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "yesno";
$modversion['config'][$i]['valuetype'] = "int";
$modversion['config'][$i]['default'] = 0;
$i++;
$modversion['config'][$i]['name'] = "inroot_install";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_INROOT_INSTALL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "yesno";
$modversion['config'][$i]['valuetype'] = "int";
$modversion['config'][$i]['default'] = 0;
$i++;
$modversion['config'][$i]['name'] = "break" . $i;
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_BREAK_OPTIONAL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "line_break";
$modversion['config'][$i]['valuetype'] = "textbox";
$modversion['config'][$i]['default'] = 'head';
$i++;
$modversion['config'][$i]['name'] = "author_email";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_AUTHOR_EMAIL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'name@site.com';
$i++;
$modversion['config'][$i]['name'] = "author_website_url";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_AUTHOR_WEBSITE_URL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'http://xoops.org';
$i++;
$modversion['config'][$i]['name'] = "author_website_name";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_AUTHOR_WEBSITE_NAME";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'XOOPS Project';
$i++;
$modversion['config'][$i]['name'] = "credits";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_CREDITS";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'XOOPS Development Team';
$i++;
$modversion['config'][$i]['name'] = "license";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_LICENSE";
$modversion['config'][$i]['description'] = " ";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = "GPL 2.0 or later";
$i++;
$modversion['config'][$i]['name'] = "license_url";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_LICENSE_URL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'http://www.fsf.org/copyleft/gpl.html';
$i++;
$modversion['config'][$i]['name'] = "release_info";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_RELEASE_INFO";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'release_info';
$i++;
$modversion['config'][$i]['name'] = "release_file";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_RELEASE_FILE";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'release_info file';
$i++;
$modversion['config'][$i]['name'] = "manual";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_MANUAL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'Installation.txt';
$i++;
$modversion['config'][$i]['name'] = "manual_file";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_MODULE_MANUAL_FILE";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'link to manual file';
$i++;
$modversion['config'][$i]['name'] = "demo_site_url";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_DEMO_SITE_URL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'http://www.xoops.org';
$i++;
$modversion['config'][$i]['name'] = "demo_site_name";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_DEMO_SITE_NAME";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'XOOPS Demo Site';
$i++;
$modversion['config'][$i]['name'] = "support_url";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_SUPPORT_URL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'http://xoops.org/modules/newbb';
$i++;
$modversion['config'][$i]['name'] = "support_name";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_SUPPORT_NAME";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'Support Forum';
$i++;
$modversion['config'][$i]['name'] = "website_url";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_WEBSITE_URL";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'www.xoops.org';
$i++;
$modversion['config'][$i]['name'] = "website_name";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_WEBSITE_NAME";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'XOOPS Project';
$i++;
$modversion['config'][$i]['name'] = "release_date";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_RELEASE_DATE";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = date('Y/m/d');
$i++;
$modversion['config'][$i]['name'] = "status";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_STATUS";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = 'Beta 1';
$i++;
$modversion['config'][$i]['name'] = "donations";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_PAYPAL_BUTTON";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = '6KJ7RW5DR3VTJ';
$i++;
$modversion['config'][$i]['name'] = "subversion";
$modversion['config'][$i]['title'] = "_MI_TDMCREATE_SUBVERSION";
$modversion['config'][$i]['description'] = "";
$modversion['config'][$i]['formtype'] = "textbox";
$modversion['config'][$i]['valuetype'] = "text";
$modversion['config'][$i]['default'] = '12100';
unset($i);
