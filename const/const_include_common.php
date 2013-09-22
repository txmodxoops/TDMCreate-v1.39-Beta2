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
 * @version         $Id: const_include_configs.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_include_common($modules, $mod_a_w_name, $mod_a_w_url)
{
    $mod_name = $modules->getVar('mod_name');
    $stu_mn = strtoupper($mod_name); 
	$stl_mn = strtolower($mod_name);
	$file = 'common.php'; 
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/include/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/include/'.$file;
	$awn = str_replace(" ", "", strtolower($mod_a_w_name));
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
if( ! defined( "XOOPS_ROOT_PATH" ) ) exit ;
if (!defined('{$stu_mn}_MODULE_PATH')) {
	define('{$stu_mn}_DIRNAME', '{$stl_mn}');
	define('{$stu_mn}_PATH', XOOPS_ROOT_PATH.'/modules/'.{$stu_mn}_DIRNAME);
	define('{$stu_mn}_URL', XOOPS_URL.'/modules/'.{$stu_mn}_DIRNAME);	
	define('{$stu_mn}_UPLOAD_PATH', XOOPS_UPLOAD_PATH.'/'.{$stu_mn}_DIRNAME);
	define('{$stu_mn}_UPLOAD_URL', XOOPS_UPLOAD_URL.'/'.{$stu_mn}_DIRNAME);
	define('{$stu_mn}_IMAGE_PATH', {$stu_mn}_PATH.'/images');
	define('{$stu_mn}_IMAGE_URL', {$stu_mn}_URL.'/images/');
	define('{$stu_mn}_ADMIN', {$stu_mn}_URL . '/admin/index.php');
	\$local_logo = {$stu_mn}_IMAGE_URL . '/{$awn}_logo.png';
	if(is_dir({$stu_mn}_IMAGE_PATH) && file_exists(\$local_logo)) {
		\$logo = \$local_logo;
	} else {
		\$pathIcon32 = \$xoopsModule->getInfo('icons32');
		\$logo = \$pathIcon32.'/xoopsmicrobutton.gif';
	}
	define('{$stu_mn}_AUTHOR_LOGOIMG', \$logo);
}
// module information
\$copyright = "<a href='{$mod_a_w_url}' title='{$mod_a_w_name}' target='_blank'>
                     <img src='".{$stu_mn}_AUTHOR_LOGOIMG."' alt='{$mod_a_w_name}' /></a>";
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