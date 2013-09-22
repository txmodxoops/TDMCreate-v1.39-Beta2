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
 * @version         $Id: const_blocks_templates.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_blocks_templates($modules, $table_name, $table_fieldname, $table_fields, $table_parameters)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_MB_'.strtoupper($mod_name).'_';
	$file = $table_name.'_block.html';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/templates/blocks/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/templates/blocks/'.$file;
	//fields
	$fields = explode('|', $table_fields);
	$nb_fields = count($fields);

	//parameters
	$parameters = explode('|', $table_parameters);
	$nb_parameters = count($parameters);

	$text = <<<EOT
<table class="outer">
	<tr class="head">
EOT;
	for ($i = 0; $i < $nb_fields; $i++)
	{
		$structure_fields = explode(':', $fields[$i]);
		$lng_strct_fields = $language.strtoupper($structure_fields[0]);
$text .= <<<EOT
\n\t\t<th><{\$smarty.const.{$lng_strct_fields}}></th>
EOT;
		}
$text .= <<<EOT
\n\t</tr>
	<{foreachq item={$table_fieldname} from=\${$table_fieldname}}>
		<tr class = "<{cycle values = 'even,odd'}>">
			<td>
EOT;
		for ($i = 0; $i < $nb_fields; $i++)
		{
			$structure_fields = explode(':', $fields[$i]);
			$table_fn = $table_fieldname.'.'.strip_tags($structure_fields[0]);
$text .= <<<EOT
\n\t\t\t<{\${$table_fn}}>
EOT;
		}
$text .= <<<EOT
\n\t\t\t</td>
		</tr>
	<{/foreach}>
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