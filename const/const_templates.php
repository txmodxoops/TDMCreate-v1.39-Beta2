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
 * @version         $Id: const_templates.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_templates($modules, $tables_name, $tables_fields, $tables_parameters)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_MD_'.strtoupper($mod_name).'_';
	$file = $mod_name.'_index.html';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/templates/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/templates/'.$file;
	$text = '
<{if $adv != \'\'}>
<div class="center"><{$adv}></div>
<{/if}>
<span class="left"><{$smarty.const.'.$language.'TITLE}></span>&#58;&#160;
<span class="left"><{$smarty.const.'.$language.'DESC}></span><br />
<div class="outer">
<{foreachq item='.$tables_name.' from='.$tables_name.'s}>
    <div class = "<{cycle values = "even,odd"}>">';
  //fields
   $fields = explode("|", $tables_fields);
   $nb_fields = count($fields);

//parameters
$parameters = explode("|", $tables_parameters);
$nb_parameters = count($parameters);

$j=0;
$structure_parameters[3] = 0;
for ($i=0; $i<$nb_fields; $i++)
{
	$structure_fields = explode(":", $fields[$i]);
	if ( $i != 0 ) {
		$structure_parameters = explode(":", $parameters[$j]);
		$j++;
	}
	if( $structure_parameters[3] == 1 || $i == 0) {
		$text .= '<{$'.$tables_name.'.'.$structure_fields[0].'}>;
	';
	}
}
	$text .= '
    </div>
    </br />
<{/foreach}>
</div>
<div class="left">&nbsp;&nbsp;<{$copyright}></div>
<{if $xoops_isadmin}>
   <div class="center" style="height: 50px;"><{$smarty.const.'.$language.'ADMIN}></div>
<{/if}>
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