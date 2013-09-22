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
 * @version         $Id: const_sql.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_sql($modules, $table_name, $table_fieldname, $table_category, $table_fields)
{
	$mod_name = $modules->getVar('mod_name');
	$file = 'mysql.sql';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/sql/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/sql/'.$file;
	$text = const_fields($mod_name, $table_name, $table_fieldname, $table_category, $table_fields, '', 0, 0, 0, 2);
	createFile(	$tdmcreate_path, $text,
			_AM_TDMCREATE_CONST_OK_SQL,
			_AM_TDMCREATE_CONST_NOTOK_SQL, $file, 'even', 'a+');
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_SQL,
					_AM_TDMCREATE_CONST_NOTOK_SQL, $file, 'even', 'a+');
	}
}