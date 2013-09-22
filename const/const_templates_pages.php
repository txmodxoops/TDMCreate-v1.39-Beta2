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
 * @version         $Id: const_templates_pages.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_templates_pages($modules, $table_name, $table_fieldname, $table_fields)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_MA_'.strtoupper($mod_name).'_';
	$file = $mod_name.'_'.$table_name.'.html';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/templates/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/templates/'.$file;
	//fields
	$fields = explode('|', $table_fields);
	$nb_fields = count($fields);
	
	$text = '<{include file="db:'.$mod_name.'_header.html"}>';
	if($table_name != null)
	{
		$text .= '
<div class="outer">
	<table class="'.$mod_name.'" cellpadding="0" cellspacing="0" width="100%">
		<tr class="head">
		';
		for ($i = 0; $i < $nb_fields; $i++)
		{
			$structure_fields = explode(':', $fields[$i]);	
$text .= '  	<th class="fields"><{$smarty.const.'.$language.strtoupper($structure_fields[0]).'}></th>
	';
		}
$text .= '</tr>
		<{foreach item='.$table_fieldname.' from=$'.$table_name.'}>	
            <tr class="<{cycle values=\'odd, even\'}>">		
';
		for ($i = 0; $i < $nb_fields; $i++)
		{
			$structure_fields = explode(':', $fields[$i]);	
$text .= '  	<td class="fields"><{$'.$table_fieldname.'.'.$structure_fields[0].'}></td>
	';
		}
$text .= '	</tr>
		<{/foreach}>
	</table>
</div>';
	} else {
$text .= '<div class="outer">
    <div class="center">None</div>
    <br />
</div>';
	}
$text .= '
<{include file="db:'.$mod_name.'_footer.html"}>
';
	createFile(	$tdmcreate_path, $text,
			_AM_TDMCREATE_CONST_OK_TEMPLATES,
			_AM_TDMCREATE_CONST_NOTOK_TEMPLATES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_TEMPLATES,
					_AM_TDMCREATE_CONST_NOTOK_TEMPLATES, $file);
	}
}