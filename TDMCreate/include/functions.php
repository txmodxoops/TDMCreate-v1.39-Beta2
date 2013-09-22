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
 * @version         $Id: functions.php 11084 2013-02-23 15:44:20Z timgno $
 */
if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

function TDMCreate_CleanVars( &$global, $key, $default = '', $type = 'int' ) {
    switch ( $type ) {
        case 'string':
            $ret = ( isset( $global[$key] ) ) ? filter_var( $global[$key], FILTER_SANITIZE_MAGIC_QUOTES ) : $default;
            break;
        case 'int': default:
            $ret = ( isset( $global[$key] ) ) ? filter_var( $global[$key], FILTER_SANITIZE_NUMBER_INT ) : $default;
            break;
    }
    if ( $ret === false ) {
        return $default;
    }
    return $ret;
}

function TDMCreate_clearDir($folder) {
	$opening=@opendir($folder);
	if (!$opening) return;
	while($file=readdir($opening)) {
		if ($file == '.' || $file == '..') continue;
			if (is_dir($folder."/".$file)) {
				$r=TDMCreate_clearDir($folder."/".$file);
				if (!$r) return false;
			}
			else {
				$r=@unlink($folder."/".$file);
				if (!$r) return false;
			}
	}
closedir($opening);
$r=@rmdir($folder);
if (!$r) return false;
	return true;
}

function TDMCreate_OpenTable($file, $_ok, $_notok) {
    echo '<table class="outer"><tr><th width="70%">'.$file.'</th><th width="15%">'.$_ok.'</th><th  width="15%">'.$_notok.'</th></tr>';
}

function TDMCreate_CloseTable() {
    echo '</table><br />';
}
?>