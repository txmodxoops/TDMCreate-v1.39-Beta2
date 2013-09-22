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
 * @version         $Id: const_waiting.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH . '/modules/TDMCreate/include/functions_const.php';
function const_waiting($modules, $tables_arr) 
{
    $mod_name = $modules->getVar('mod_name');
	$file = 'waiting.plugin.php';
    $tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/include/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/include/'.$file;
    $text = '<?php'.const_header($modules, $file).'
function b_waiting_' . $mod_name . '()
{
	$db =& XoopsDatabaseFactory::getDatabaseConnection();
    $ret = array();
';
    foreach (array_keys($tables_arr) as $i) 
	{
		$table_name = $tables_arr[$i]->getVar('table_name');
		$table_fieldname = $tables_arr[$i]->getVar('table_fieldname');
        $text.= '
	// waiting mod_'. $table_name .'
	$block = array();
    $result = $db->query("SELECT COUNT(*) FROM ".$db->prefix(\'mod_'.$mod_name.'_'.$table_name.'\')." WHERE '.$table_fieldname.'_waiting = 1");
	if ( $result ) {
		$block[\'adminlink\'] = XOOPS_URL . "/modules/' . $mod_name . '/admin/' . $table_name . '.php?op=list_waiting";
		list($block[\'pendingnum\']) = $db->fetchRow($result);
		$block[\'lang_linkname\'] = _MB_' . strtoupper($mod_name) . '_' . strtoupper($table_name) . '_WAITING;
	}
	$ret[] = $block;
';
    }
    $text
        .= '
	return $ret;
};';
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_INCLUDES,
				_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_INCLUDES,
					_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	}
}