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
 * @version         $Id: const_admin_menu.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_admin_menu($modules, $tables_arr, $table_permissions)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_MI_'.strtoupper($mod_name).'_ADMENU';
	$file = 'menu.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/admin/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/admin/'.$file;
	$menu = 1;
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\n\$dirname = basename( dirname( dirname( __FILE__ ) ) ) ;
\$module_handler =& xoops_gethandler('module');
\$xoopsModule =& XoopsModule::getByDirname(\$dirname);
\$moduleInfo =& \$module_handler->get(\$xoopsModule->getVar('mid'));
\$pathIcon32 = \$moduleInfo->getInfo('sysicons32');
\$adminmenu = array(); 
\$i = 1;
\$adminmenu[\$i]['title'] = {$language}{$menu};
\$adminmenu[\$i]['link'] = 'admin/index.php';
\$adminmenu[\$i]['icon'] = \$pathIcon32.'/home.png';
\$i++;
EOT;
    $menu++;
	foreach (array_keys($tables_arr) as $i)
	{		
		if ( $tables_arr[$i]->getVar('table_admin') == 1 ) 
		{ 
$text .= <<<EOT
\n\$adminmenu[\$i]['title'] = {$language}{$menu};
\$adminmenu[\$i]['link'] = 'admin/{$tables_arr[$i]->getVar('table_name')}.php';
\$adminmenu[\$i]['icon'] = \$pathIcon32.'/{$tables_arr[$i]->getVar('table_image')}';
\$i++;
EOT;
		$menu++;
		}
	}
	$menu--;
    //$menu_id = $menu;
//unset( $menu );
if( $table_permissions == 1 ) {
    $menu++;
$text .= <<<EOT
\n\$adminmenu[\$i]['title'] = {$language}{$menu};
\$adminmenu[\$i]['link'] = 'admin/permissions.php';
\$adminmenu[\$i]['icon'] = \$pathIcon32.'/permissions.png';
\$i++;
EOT;
}
$menu++;
$text .= <<<EOT
\n\$adminmenu[\$i]['title'] = {$language}{$menu};
\$adminmenu[\$i]['link']  = 'admin/about.php';
\$adminmenu[\$i]['icon'] = \$pathIcon32.'/about.png';
unset( \$i );
EOT;
unset( $menu );
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_ADMINS,
				_AM_TDMCREATE_CONST_NOTOK_ADMINS, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_ADMINS,
					_AM_TDMCREATE_CONST_NOTOK_ADMINS, $file);
	}
}