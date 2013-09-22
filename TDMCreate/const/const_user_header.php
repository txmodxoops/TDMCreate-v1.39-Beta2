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
 * @version         $Id: const_user_header.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_user_header($modules) 
{
	$mod_name = $modules->getVar('mod_name');
	$file = 'header.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/'.$file;
	$stu_mod_name = strtoupper($mod_name);
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\nrequire_once dirname(dirname(dirname(__FILE__))) . '/mainfile.php';
\$dirname = \$GLOBALS['xoopsModule']->getVar('dirname');
\$pathname = XOOPS_ROOT_PATH. '/modules/'.\$dirname;
include_once \$pathname . '/include/common.php';
include_once \$pathname . '/include/functions.php';
\$myts =& MyTextSanitizer::getInstance(); 
\$style = {$stu_mod_name}_URL . '/css/style.css';
if(file_exists(\$style)) { return true; }

xoops_loadLanguage('modinfo', \$dirname);
xoops_loadLanguage('main', \$dirname);
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