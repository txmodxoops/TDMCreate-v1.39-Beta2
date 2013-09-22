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
 * @version         $Id: const_blocks.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_blocks($modules, $table_name, $table_fieldname, $table_fields, $table_parameters, $table_category)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_MB_'.strtoupper($mod_name);
	$mod_name_lowercase = strtolower($mod_name);
	$file = $table_name.'.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/blocks/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/blocks/'.$file;
	$constructor = const_fields($mod_name, $table_name, $table_fieldname, $table_category, $table_fields, $table_fieldname, 0, 0, 0, 0);
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\ninclude_once XOOPS_ROOT_PATH.'/modules/{$mod_name}/include/functions.php';	
function b_{$mod_name_lowercase}_{$table_name}_show(\$options) 
{
	include_once XOOPS_ROOT_PATH.'/modules/{$mod_name}/class/{$table_name}.php';
	\$myts =& MyTextSanitizer::getInstance();

	\${$table_fieldname} = array();
	\$type_block = \$options[0];
	\$nb_{$table_name} = \$options[1];
	\$lenght_title = \$options[2];

	\${$table_name}Handler =& xoops_getModuleHandler('{$table_name}', '{$mod_name}');
	\$criteria = new CriteriaCompo();
	array_shift(\$options);
	array_shift(\$options);
	array_shift(\$options);	
EOT;
	if ( $table_category == 1 ) {
$text .= <<<EOT
	\n\tif (!(count(\$options) == 1 && \$options[0] == 0)) {
		\$criteria->add(new Criteria('{$table_fieldname}_category', {$mod_name}_block_addCatSelect(\$options), 'IN'));
	}
EOT;
	}	
	//fields
	$fields = explode('|', $table_fields);
	$nb_fields = count($fields);
	//print_r($fields_total);
	//parameters
	$parameters_total = explode('|', $table_parameters);

	for ($i = 0; $i < $nb_fields; $i++)
	{	
	    $field = explode(':', $fields[$i]);
		if( $i == 0 ) {		
			$fpif = $field[0]; // fpif = fields parameters auto_increment field
			$fpbf = '0'; // fpdf = fields parameters display form
		} else {
			$param = explode(':', $parameters_total[$i-1]);
			$fpbf[$i] = $param[3]; // fpdf = fields parameters display form
			if ( $param[4] == 1 ) {
				$fpmf = $field[0]; // fpmf = fields parameters main field
			}
		}	
	}
	
$text .= <<<EOT
	\n\tif (\$type_block) 
	{
		\$criteria->add(new Criteria('{$fpif}', 0, '!='));
		\$criteria->setSort('{$fpif}');
		\$criteria->setOrder('ASC');
	}

	\$criteria->setLimit(\$nb_{$table_name});
	\${$table_name}_arr = \${$table_name}Handler->getAll(\$criteria);
	foreach (array_keys(\${$table_name}_arr) as \$i) 
	{
EOT;
	for ($i = 0; $i < $nb_fields; $i++)
	{	    
		$structure_fields = explode(':', $fields[$i]);
		if( $fpbf[$i] == 1 ) {
		$text .= <<<EOT
\n\t\t\${$table_fieldname}['{$structure_fields[0]}'] = \${$table_name}_arr[\$i]->getVar('{$structure_fields[0]}');
EOT;
        }
	}
$text .= <<<EOT
	\n\t}
	return \${$table_fieldname};
}

function b_{$mod_name_lowercase}_{$table_name}_edit(\$options) 
{
EOT;
	
if ( $table_category == 1 ) {
$text .=<<<EOT
	\ninclude_once XOOPS_ROOT_PATH.'/modules/{$mod_name}/class/category.php';
	
	\$categoryHandler =& xoops_getModuleHandler('category', "{$mod_name}");
	\$criteria = new CriteriaCompo();
	\$criteria->setSort("{$fpmf}");
	\$criteria->setOrder("ASC");
	\${$table_name}_arr = \$categoryHandler->getall(\$criteria);
EOT;
}
$text .= <<<EOT
    \ninclude_once XOOPS_ROOT_PATH.'/modules/{$mod_name}/class/{$table_name}.php';

	\$form = {$language}_DISPLAY;
	\$form .= "<input type='hidden' name='options[0]' value='".\$options[0]."' />";
	\$form .= "<input name='options[1]' size='5' maxlength='255' value='".\$options[1]."' type='text' />&nbsp;<br />";
	\$form .= {$language}_TITLELENGTH." : <input name='options[2]' size='5' maxlength='255' value='".\$options[2]."' type='text' /><br /><br />";
	\${$table_name}Handler =& xoops_getModuleHandler('{$table_name}', '{$mod_name}');
	\$criteria = new CriteriaCompo();
	array_shift(\$options);
	array_shift(\$options);
	array_shift(\$options);
	\$criteria->add(new Criteria('{$fpif}', 0, '!='));
	\$criteria->setSort('{$fpif}');
	\$criteria->setOrder('ASC');
	\${$table_name}_arr = \${$table_name}Handler->getAll(\$criteria);
	\$form .= {$language}_CATTODISPLAY."<br /><select name='options[]' multiple='multiple' size='5'>";
	\$form .= "<option value='0' " . (array_search(0, \$options) === false ? "" : "selected='selected'") . ">" .{$language}_ALLCAT . "</option>";
	foreach (array_keys(\${$table_name}_arr) as \$i) {
		\${$fpif} = \${$table_name}_arr[\$i]->getVar('{$fpif}');
		\$form .= "<option value='" . \${$fpif} . "' " . (array_search(\${$fpif}, \$options) === false ? "" : "selected='selected'") . ">".\${$table_name}_arr[\$i]->getVar('{$fpmf}')."</option>";
	}
	\$form .= "</select>";
	return \$form;
}	
EOT;
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_BLOCKS,
				_AM_TDMCREATE_CONST_NOTOK_BLOCKS, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_BLOCKS,
					_AM_TDMCREATE_CONST_NOTOK_BLOCKS, $file);
	}
}