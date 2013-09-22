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
 * @version         $Id: const_templates_footer.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_templates_footer($modules)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_MA_'.strtoupper($mod_name).'_';
	$file = $mod_name.'_footer.html';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/templates/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/templates/'.$file;
	$text = <<<EOT
<{if \$bookmarks != 0}>
<{include file="db:system_bookmarks.html"}>
<{/if}>
\n<{if \$fbcomments != 0}>
<{include file="db:system_fbcomments.html"}>
<{/if}>
\n<div class="left"><{\$copyright}></div>
EOT;
if(isset($_REQUEST['table_name']) != null){
  $text .= <<<EOT
\n<{if \$pagenav != ''}>
	<div class="right"><{\$pagenav}></div>
<{/if}>
<br />
EOT;
}
$text .= <<<EOT
\n<{if \$xoops_isadmin}>
   <div class="center bold"><a href="<{\$admin}>"><{\$smarty.const.{$language}ADMIN}></a></div>
<{/if}>
EOT;
if ( $modules->getVar('mod_comments') != 0 ) {
$text .= <<<EOT
\n<div class="pad2 marg2">
	<{if \$comment_mode == "flat"}>
		<{include file="db:system_comments_flat.html"}>
	<{elseif \$comment_mode == "thread"}>
		<{include file="db:system_comments_thread.html"}>
	<{elseif \$comment_mode == "nest"}>
		<{include file="db:system_comments_nest.html"}>
	<{/if}>
</div>
EOT;
}
if ( $modules->getVar('mod_notifications') != 0 ) {
$text .= <<<EOT
\n<{include file='db:system_notification_select.html'}>
EOT;
}
	createFile(	$tdmcreate_path, $text,
			_AM_TDMCREATE_CONST_OK_TEMPLATES,
			_AM_TDMCREATE_CONST_NOTOK_TEMPLATES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_TEMPLATES,
					_AM_TDMCREATE_CONST_NOTOK_TEMPLATES, $file);
	}
}