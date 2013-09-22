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
 * @version         $Id: includes.php 11084 2013-02-23 15:44:20Z timgno $
 */
include '../../../include/cp_header.php'; 
include_once("../include/functions.php");

$modPath = XOOPS_ROOT_PATH.'/modules/TDMCreate';
$cPath = $modPath.'/const';

include_once $cPath.'/const_architecture.php';
include_once $cPath.'/const_xoopsversion.php';
include_once $cPath.'/const_changelog.php';
include_once $cPath.'/const_include_search.php';
include_once $cPath.'/const_include_comments.php';
include_once $cPath.'/const_include_notifications.php';
include_once $cPath.'/const_include_common.php';
include_once $cPath.'/const_include_functions.php';
include_once $cPath.'/const_include_install.php';
include_once $cPath.'/const_waiting.php';
include_once $cPath.'/const_css_style.php';
include_once $cPath.'/const_sql.php';
include_once $cPath.'/const_blocks.php';
include_once $cPath.'/const_blocks_templates.php';
include_once $cPath.'/const_class.php';
include_once $cPath.'/const_class_helper.php';
include_once $cPath.'/const_class_request.php';
include_once $cPath.'/const_admin_header.php';
include_once $cPath.'/const_admin_footer.php';
include_once $cPath.'/const_admin_menu.php';
include_once $cPath.'/const_admin_index.php';
include_once $cPath.'/const_admin_pages.php';
include_once $cPath.'/const_admin_about.php';
include_once $cPath.'/const_admin_permissions.php';
include_once $cPath.'/const_admin_language.php';
include_once $cPath.'/const_modinfo_language.php';
include_once $cPath.'/const_help_language.php';
include_once $cPath.'/const_blocks_language.php';
include_once $cPath.'/const_main_language.php';
include_once $cPath.'/const_user_header.php';
include_once $cPath.'/const_user_index.php';
include_once $cPath.'/const_user_pages.php';
include_once $cPath.'/const_templates_header.php';
include_once $cPath.'/const_templates_index.php';
include_once $cPath.'/const_templates_pages.php';
include_once $cPath.'/const_templates_footer.php';
include_once $cPath.'/const_templates_admin_about.php';
include_once $cPath.'/const_templates_admin_help.php';