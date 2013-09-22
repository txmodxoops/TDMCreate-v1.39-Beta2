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
 * @version         $Id: const_templates_header.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_templates_header($modules, $tables_arr)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_MA_'.strtoupper($mod_name).'_';
	$file = $mod_name.'_header.html';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/templates/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/templates/'.$file;
	$stl_mod_name = strtolower($mod_name);
	$text = <<<EOT
<div class="header">
<span class="left"><b><{\$smarty.const.{$language}TITLE}></b>&#58;&#160;</span>
<span class="left"><{\$smarty.const.{$language}DESC}></span><br />
</div>
<div class="head">
	<{if \$adv != ''}>
		<div class="center"><{\$adv}></div>
	<{/if}>
</div>
<table class="outer {$stl_mod_name}" cellspacing="2" cellpadding="2">
    <thead>
          <tr class="center" colspan="2">
	      <th><{\$smarty.const.{$language}TITLE}>  -  <{\$smarty.const.{$language}DESC}></th>
          </tr>  
    </thead>
    <tbody>
        <tr class="center">
            <td class="center bold pad5">
                <ul class="menu center fields">
				<li><a href="<{\${$stl_mod_name}_url}>"><{\$smarty.const.{$language}INDEX}></a></li>\n
EOT;

foreach (array_keys($tables_arr) as $i)
{	
	$table_name = $tables_arr[$i]->getVar('table_name');
	$stu_table_name = strtoupper($table_name);
$text .= <<<EOT
\n\t\t\t<li> | </li>
\n\t\t\t<li><a href="<{\${$stl_mod_name}_url}>/{$table_name}.php"><{\$smarty.const.{$language}{$stu_table_name}}></a></li>					
EOT;
}					 
$text .= <<<EOT
				</ul>
            </td>
        </tr>
        <{if \$adv != ''}>
        <tr class="center"><td class="center bold pad5"><{\$adv}></td></tr>
        <{else}>
        <tr class="center"><td class="center bold pad5">&nbsp;</td></tr>
        <{/if}>
    </tbody>
</table>
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