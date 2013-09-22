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
 * @version         $Id: const_admin_header.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_admin_header($modules, $table_name, $tables_arr)
{
	$mod_name = $modules->getVar('mod_name');
	$file = 'header.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/admin/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/admin/'.$file;
	$ucfmod_name = ucfirst($mod_name);
	$text = '<?php'.const_header($modules, $file).
<<<EOT
\nrequire_once dirname(dirname(dirname(dirname(__FILE__)))). '/include/cp_header.php';
\$thisPath = dirname(dirname(__FILE__));
include_once \$thisPath.'/include/common.php';
include_once \$thisPath.'/include/functions.php';
EOT;
if ( $table_name != '' ) {
$text .= <<<EOT
\ninclude_once \$thisPath.'/class/helper.php';
// Get instance
\${$ucfmod_name} = {$ucfmod_name}::getInstance();
EOT;
}	
$text .= <<<EOT
\n\n\$thisModule = \$GLOBALS['xoopsModule']->getVar('dirname');

\$sysPathIcon16 = '../' . \$xoopsModule->getInfo('sysicons16');
\$sysPathIcon32 = '../' . \$xoopsModule->getInfo('sysicons32');
\$pathModuleAdmin = \$GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');

\$modPathIcon16 = \$xoopsModule->getInfo('modicons16');
\$modPathIcon32 = \$xoopsModule->getInfo('modicons32');

EOT;
foreach (array_keys($tables_arr) as $i)
{
	$table_name = $tables_arr[$i]->getVar('table_name');
$text .= '$'.$table_name.'Handler =& xoops_getModuleHandler(\''.$table_name. '\', $thisModule);'.PHP_EOL;
}
$text .=<<<EOT
\n\n\$myts =& MyTextSanitizer::getInstance();
if (!isset(\$xoopsTpl) || !is_object(\$xoopsTpl)) {
	include_once(XOOPS_ROOT_PATH."/class/template.php");
	\$xoopsTpl = new XoopsTpl();
}
// System icons path
\$xoopsTpl->assign('sysPathIcon16', \$sysPathIcon16);
\$xoopsTpl->assign('sysPathIcon32', \$sysPathIcon32);
// Local icons path
\$xoopsTpl->assign('modPathIcon16', \$modPathIcon16);
\$xoopsTpl->assign('modPathIcon32', \$modPathIcon32);

//Load languages
xoops_loadLanguage('admin', \$thisModule);
xoops_loadLanguage('modinfo', \$thisModule);
xoops_loadLanguage('main', \$thisModule);
// Local admin menu class
if ( file_exists(\$GLOBALS['xoops']->path(\$pathModuleAdmin.'/moduleadmin.php'))){
	include_once \$GLOBALS['xoops']->path(\$pathModuleAdmin.'/moduleadmin.php');
}else{
	redirect_header("../../../admin.php", 5, _AM_MODULEADMIN_MISSING, false);
}
xoops_cp_header();
\$adminMenu = new ModuleAdmin();	
EOT;
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_ADMINS,
				_AM_TDMCREATE_CONST_NOTOK_ADMINS, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_ADMINS,
					_AM_TDMCREATE_CONST_NOTOK_ADMINS, $file);
	}
}