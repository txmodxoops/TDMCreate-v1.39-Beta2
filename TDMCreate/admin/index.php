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
 * @version         $Id: index.php 11084 2013-02-23 15:44:20Z timgno $
 */
include 'header.php';
    $criteria = new CriteriaCompo();
	$count_modules = $modulesHandler->getCount($criteria);
	$count_tables = $tablesHandler->getCount($criteria);

$adminMenu->addInfoBox(_AM_TDMCREATE_ADMIN_NUMMODULES) ;
$adminMenu->addInfoBoxLine(_AM_TDMCREATE_ADMIN_NUMMODULES, '<label>' ._AM_TDMCREATE_THEREARE_NUMMODULES. '</label>', $count_modules, 'Green') ;
$adminMenu->addInfoBoxLine(_AM_TDMCREATE_ADMIN_NUMMODULES, '<label>' ._AM_TDMCREATE_THEREARE_NUMTABLES. '</label>', $count_tables, 'Orange');

    echo $adminMenu->addNavigation('index.php');
    echo $adminMenu->renderIndex();
include 'footer.php';