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
 * @version         $Id: const_include_comments_functions.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_include_functions_comments($modules, $table_name)
{
	$mod_name = $modules->getVar('mod_name');
	$file = 'functions_comments.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/include/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/include/'.$file;
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\n// comment callback functions
function {$mod_name}_comments_update(\$link_id, \$total_num)
{
	\$commentsHandler = xoops_gethandler('comments');
	\$criteria = CriteriaCompo();
	\$criteria->add(new Criteria('comments', \$total_num), 'SET');
	\$criteria->add(new Criteria('aid', \$link_id), 'WHERE');
	\$commentsHandler->updateAll(\$criteria);
}

function {$mod_name}_comments_approve(&\$comment)
{
    // notification mail here
}
EOT;
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_INCLUDES,
				_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_INCLUDES,
					_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	}
}