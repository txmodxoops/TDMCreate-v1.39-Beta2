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
 * @version         $Id: const_user_index.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_user_index($modules)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_MA_'.strtoupper($mod_name);
	$file = 'index.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/'.$file;
	$stu_mod_name = strtoupper($mod_name);
	$stl_mod_name = strtolower($mod_name);
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\ninclude_once 'header.php';
\$xoopsOption['template_main'] = '{$stl_mod_name}_index.html';
include_once XOOPS_ROOT_PATH.'/header.php';
// Define Stylesheet
\$xoTheme->addStylesheet( \$style );
// keywords
{$stl_mod_name}_meta_keywords(xoops_getModuleOption('keywords', \$dirname));
// description
{$stl_mod_name}_meta_description({$language}_DESC);
//
\$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', {$stu_mod_name}_URL.'/index.php'); 
\$GLOBALS['xoopsTpl']->assign('{$stl_mod_name}_url', {$stu_mod_name}_URL);
\$GLOBALS['xoopsTpl']->assign('adv', xoops_getModuleOption('advertise', \$dirname));
//
\$GLOBALS['xoopsTpl']->assign('bookmarks', xoops_getModuleOption('bookmarks', \$dirname));
\$GLOBALS['xoopsTpl']->assign('fbcomments', xoops_getModuleOption('fbcomments', \$dirname)); 
//
\$GLOBALS['xoopsTpl']->assign('admin', {$stu_mod_name}_ADMIN);
\$GLOBALS['xoopsTpl']->assign('copyright', \$copyright);
//
include_once XOOPS_ROOT_PATH.'/footer.php';	
EOT;
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_ROOTS,
				_AM_TDMCREATE_CONST_NOTOK_ROOTS, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_ROOTS,
					_AM_TDMCREATE_CONST_NOTOK_ROOTS, $file);
	}
}