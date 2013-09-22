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
 * @version         $Id: const_templates_index.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_templates_index($modules)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_MA_'.strtoupper($mod_name).'_';
	$file = $mod_name.'_index.html';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/templates/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/templates/'.$file;
	$stl_mod_name = strtolower($mod_name);
	$text = <<<EOT
<{include file="db:{$stl_mod_name}_header.html"}>
<table class="outer {$stl_mod_name}" cellspacing="0" cellpadding="0">
    <tbody>
      <tr class="left">
         <td class="pad5"><{\$smarty.const.{$language}INDEX_DESC}></td>
      </tr>
    </tbody>
</table>
<{include file="db:{$stl_mod_name}_footer.html"}>
EOT;
	createFile(	$tdmcreate_path, $text,
			_AM_TDMCREATE_CONST_OK_TEMPLATES,
			_AM_TDMCREATE_CONST_NOTOK_TEMPLATES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_TEMPLATES,
					_AM_TDMCREATE_CONST_NOTOK_TEMPLATES, $file);
	}
}