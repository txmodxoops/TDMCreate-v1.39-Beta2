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
 * @version         $Id: const_admin_help.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_admin_help($modules)
{
	$file = 'help.php';
	$path_file = TDM_CREATE_MURL.'/'.$modules->getVar('mod_name').'/admin/'.$file;
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\ninclude 'admin_header.php';
xoops_loadLanguage('help', \$xoopsModule->getVar('dirname', 'e'));
\$xoopsTpl->display('db:admin/' . \$xoopsModule->getVar("dirname") . '_admin_help.html');
include 'footer.php';
EOT;
createFile($path_file, $text,
          _AM_TDMCREATE_CONST_OK_ADMINS,
          _AM_TDMCREATE_CONST_NOTOK_ADMINS, $file);
}