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
 * @version         $Id: menu.php 11084 2013-02-23 15:44:20Z timgno $
 */
$module_handler =& xoops_gethandler('module');
$xoopsModule =& XoopsModule::getByDirname('TDMCreate');
$moduleInfo =& $module_handler->get($xoopsModule->getVar('mid'));
$pathIcon32 = $moduleInfo->getInfo('icons32');
$adminmenu = array();
$i = 1;
$adminmenu[$i]["title"] = _MI_TDMCREATE_ADMIN_INDEX;
$adminmenu[$i]["link"] = 'admin/index.php';
$adminmenu[$i]["icon"] = $pathIcon32.'/home.png';
$i++;
$adminmenu[$i]["title"] = _MI_TDMCREATE_ADMIN_MODULES;
$adminmenu[$i]["link"] = 'admin/modules.php';
$adminmenu[$i]["icon"] = 'images/icons/32/addmodule.png';
$i++;
$adminmenu[$i]["title"] = _MI_TDMCREATE_ADMIN_TABLES;
$adminmenu[$i]["link"] = 'admin/tables.php';
$adminmenu[$i]["icon"] = 'images/icons/32/addtable.png';
$i++;
$adminmenu[$i]["title"] = _MI_TDMCREATE_ADMIN_CONST;
$adminmenu[$i]["link"] = 'admin/building.php';
$adminmenu[$i]["icon"] = 'images/icons/32/builder.png';
$i++;
$adminmenu[$i]["title"] = _MI_TDMCREATE_ADMIN_ABOUT;
$adminmenu[$i]["link"] = 'admin/about.php';
$adminmenu[$i]["icon"] = $pathIcon32.'/about.png';
unset($i);