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
 * @version         $Id: const_admin_pages.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_admin_pages($modules, $table_name, $table_fieldname, $table_fields, $table_parameters, $table_category)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_AM_'.strtoupper($mod_name);
	$language_manager = $language.'_'.strtoupper($table_fieldname);	
	$stl_mod_name = strtolower($mod_name);
	$stu_mod_name = strtoupper($mod_name);
	$stu_table_name = strtoupper($table_name);
	$file = $table_name.'.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/admin/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/admin/'.$file;
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\ninclude_once 'header.php';
//It recovered the value of argument op in URL$
\$op = {$mod_name}_CleanVars(\$_REQUEST, 'op', 'list', 'string');
EOT;
if(isset($_REQUEST['table_waiting'])) {
$text .= <<<EOT
\n// the number of loading not validated
\$criteria = new CriteriaCompo();
\$criteria->add(new Criteria('{$table_fieldname}_waiting', 0));
\${$table_fieldname}_waiting = \${$table_name}Handler->getCount(\$criteria);
EOT;
}
//fields
$fields_total = explode('|', $table_fields);
$nb_fields = count($fields_total);

//parameters
$parameters_total = explode('|', $table_parameters);

//Recuperation des noms des tables
for($i=0; $i<$nb_fields; $i++)
{
	//Nom des fields
	$fields1 = explode(':', $fields_total[$i]);
	$fields[$i] = $fields1[0];
	//Afficher dans l'admin
	if( $i == 0 ) {
		$fpa[$i] = '0';
	} else {
		$param = explode(':', $parameters_total[$i-1]);
		$fpt[$i] = $param[0]; // fpt = fields parameters type			
		$fpa[$i] = $param[2]; // fpa = fields parameters admin
		$fprf[$i] = $param[6]; // fprf = fields parameters required field
		if ( $param[4] == 1 ) {
			$fpmf = $fields[0]; // fpmf = fields parameters main field
		}
	}	
}

$field_id = $fields[0];
$field_name = $fields[1];

$text .= <<<EOT
\n\necho \$adminMenu->addNavigation('{$table_name}.php');
switch (\$op) 
{   
    case 'list': 
    default:  
		\$adminMenu->addItemButton({$language}_ADD_{$stu_table_name}, '{$table_name}.php?op=new', 'add');
		echo \$adminMenu->renderButton();
		\$criteria = new CriteriaCompo();
		\$criteria->setSort('{$field_id} ASC, {$fpmf}');
		\$criteria->setOrder('ASC');
		\$numrows = \${$table_name}Handler->getCount();
		\${$table_name}_arr = \${$table_name}Handler->getAll(\$criteria);
EOT;
	$fcn = const_show_fields_parameters($mod_name, $table_name, $table_fieldname, $field_id, $nb_fields, $fields, $fpa, $fpt, $language, '', 0);
	if ( $table_category != 1 )
	{
$text .= <<<EOT
		\n\t\t// Table view
		if (\$numrows>0) 
		{			
			echo "<table width='100%' cellspacing='1' class='outer'>
					<tr>
EOT;
					$text .= $fcn;
$text .= <<<EOT
\n\t\t\t\t\t<th class='center width5'>".{$language}_FORMACTION."</th>
					</tr>";
					
			\$class = "odd";
			
			foreach (array_keys(\${$table_name}_arr) as \$i)
			{	
				echo "<tr class='".\$class."'>";
				\$class = (\$class == "even") ? "odd" : "even";\n
EOT;
				$fields_data = const_show_fields_parameters($mod_name, $table_name, $table_fieldname, $field_id, $nb_fields, $fields, $fpa, $fpt, $language, '', 1);
				
				$text .= $fields_data;
$text .= <<<EOT
				\n\t\t\t\t\techo "<td class='center width5'>
					<a href='{$table_name}.php?op=edit&{$field_id}=".\$i."'><img src=".\$sysPathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
					<a href='{$table_name}.php?op=delete&{$field_id}=".\$i."'><img src=".\$sysPathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
					</td>";
				echo "</tr>";
			}
			echo "</table><br /><br />";
		} else {
            echo "<table width='100%' cellspacing='1' class='outer'>
					<tr>
EOT;
					$text .= $fcn;
$text .= <<<EOT
						\n\t\t\t\t\t<th class='center width5'>".{$language}_FORMACTION."</th>
					</tr><tr><td class='errorMsg' colspan='{$nb_fields}'>There are no {$table_name}</td></tr>";
			echo "</table><br /><br />";
        }		
EOT;
	} else {
		$text .= <<<EOT
		\n\t\t// Display function that allows children categories
		function {$mod_name}_children(\$cat_id = 0, \${$table_name}_arr, \$prefix = "", \$order = "", &\$class)
		{   
			global \$pathIcon16;
			\$categoriesHandler =& xoops_getModuleHandler("{$mod_name}_categories", "{$mod_name}");
			\$icon = \$prefix."<img src='".'.strtoupper(\$mod_name).'_URL."/images/icons/16/arrow.gif'>";
			foreach (array_keys(\$categories_arr) as \$i)
			{
				\$cat_id = \$categories_arr[\$i]->getVar('cat_id');
				\$cat_image = \$categories_arr[\$i]->getVar('cat_image');
				\$cat_title = \$categories_arr[\$i]->getVar('cat_title');
				\$cat_weight = \$categories_arr[\$i]->getVar('cat_weight');
				echo "<tr class='".\$class."'>";\n
EOT;
				$text .= const_show_fields_parameters($mod_name, $table_name, $table_fieldname, $field_id, $nb_fields, $fields, $fpa, $fpt, $language, '', 1);
$text .= <<<EOT
				\n\t\t\t\t\techo "<td class='center width5'>
						<a href='{$table_name}.php?op=edit&{$field_id}=".\$i"'><img src=".\$sysPathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
						<a href='{$table_name}.php?op=delete&{$field_id}=".\$i"'><img src=".\$sysPathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
					  </td>                 
					</tr>";
				\$class = (\$class == "even") ? "odd" : "even";
				\$criteria = new CriteriaCompo();
				\$criteria->add(new Criteria("{$table_fieldname}_pid", \${$table_name}_arr[\$i]->getVar('{$table_fieldname}_id')));
				\$criteria->setSort('{$table_fieldname}_title');
				\$criteria->setOrder("ASC");
				\$category_pid = \${$table_name}Handler->getall(\$criteria);
				\$num_pid = \${$table_name}Handler->getCount();
				if ( \$num_pid != 0 )
				{
					{$mod_name}_children(\$cat_id, \$category_pid, \$icon, \$order, \$class);
				}
			}
		}

		// Table view
		if (\$numrows>0) 
		{
			echo "<table width='100%' cellspacing='1' class='outer'>
					<tr>
EOT;
						$fcn = const_show_fields_parameters($mod_name, $table_name, $table_fieldname, $field_id, $nb_fields, $fields, $fpa, $fpt, $language, '', 0);
						$text .= $fcn;
$text .= <<<EOT
						\n\t\t\t\t\t<th class='center width5'>".{$language}_FORMACTION."</th>		
					</tr>";
			\$class = "odd";
			\$icon = "<img src='".{$stu_mod_name}_URL."/images/icons/16/arrow.gif'>";
			foreach (array_keys(\${$table_name}_arr) as \$i)
			{               
				if ( \${$table_name}_arr[\$i]->getVar('{$table_fieldname}_pid') == 0 )
				{                    
					\$cat_id = \${$table_name}_arr[\$i]->getVar('{$table_fieldname}_id');
					\$category_image = \${$table_name}_arr[\$i]->getVar('{$table_fieldname}_image');
					\$category_title = \${$table_name}_arr[\$i]->getVar('{$table_fieldname}_title');
					\$category_weight = \${$table_name}_arr[\$i]->getVar('{$table_fieldname}_weight');
					echo "<tr class='".\$class."'>";\n
EOT;
					$fields_data = const_show_fields_parameters($mod_name, $table_name, $table_fieldname, $field_id, $nb_fields, $fields, $fpa, $fpt, $language, 1, 1);
				
					$text .= $fields_data;
$text .= <<<EOT
					\n\t\t\t\t\techo "<td class='center width5'>
							<a href='{$table_name}.php?op=edit&{$field_id}=".\$i"'><img src=".\$sysPathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
							<a href='{$table_name}.php?op=delete&{$field_id}=".\$i"'><img src=".\$sysPathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
						</td>                 
					</tr>";
					\$class = (\$class == "even") ? "odd" : "even";
					\$criteria = new CriteriaCompo();
					\$criteria->add(new Criteria("{$table_fieldname}_pid", \$cat_id));
					\$criteria->setSort("{$table_fieldname}_title");
					\$criteria->setOrder("ASC");
					\$category_pid = \${$table_name}Handler->getall(\$criteria);
					\$num_pid = \${$table_name}Handler->getCount();
					
					if ( \$num_pid != 0)
					{
						{$mod_name}_children(\$cat_id, \$category_pid, \$icon, '{$table_fieldname}_title', \$class);
					}
				}
			}
			echo "</table><br /><br />";
		} else {
            echo "<table width='100%' cellspacing='1' class='outer'>
					<tr>
EOT;
					$fcn = const_show_fields_parameters($mod_name, $table_name, $table_fieldname, $field_id, $nb_fields, $fields, $fpa, $fpt, $language, '', 0);
					$text .= $fcn;
$text .= <<<EOT
						\n\t\t\t\t\t<th class='center width5'>".{$language}_FORMACTION."</th>
					</tr>
					<tr><td class='errorMsg' colspan='{$nb_fields}'>There are no {$table_name}</td></tr>";
			echo "</table><br /><br />";
        }
EOT;
		}
		$text .= <<<EOT
    \n\tbreak;

    case 'new':          
        \$adminMenu->addItemButton({$language}_{$stu_table_name}_LIST, '{$table_name}.php', 'list');
        echo \$adminMenu->renderButton();

        \$obj =& \${$table_name}Handler->create();
        \$form = \$obj->getForm();
		\$form->display();
    break;	
	
	case 'save':
		if ( !\$GLOBALS['xoopsSecurity']->check() ) {
           redirect_header('{$table_name}.php', 3, implode(',', \$GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset(\$_REQUEST['{$field_id}'])) {
           \$obj =& \${$table_name}Handler->get(\$_REQUEST['{$field_id}']);
        } else {
           \$obj =& \${$table_name}Handler->create();
        }		
EOT;
		$text .= const_show_fields_parameters($mod_name, $table_name, $table_fieldname, $field_id, $nb_fields, $fields, $fpa, $fpt, $language, '', 2);
		
$text .= <<<EOT
        \n\t\tif (\${$table_name}Handler->insert(\$obj)) {
           redirect_header('{$table_name}.php?op=list', 2, {$language}_FORMOK);
        }

        echo \$obj->getHtmlErrors();
        \$form =& \$obj->getForm();
		\$form->display();
	break;
	
	case 'edit':
        \$adminMenu->addItemButton({$language}_ADD_{$stu_table_name}, '{$table_name}.php?op=new', 'add');
		\$adminMenu->addItemButton({$language}_{$stu_table_name}_LIST, '{$table_name}.php', 'list');
        echo \$adminMenu->renderButton();
		\$obj = \${$table_name}Handler->get(\$_REQUEST['{$field_id}']);
		\$form = \$obj->getForm();
		\$form->display();
	break;
	
	case 'delete':
		\$obj =& \${$table_name}Handler->get(\$_REQUEST['{$field_id}']);
		if (isset(\$_REQUEST['ok']) && \$_REQUEST['ok'] == 1) {
			if ( !\$GLOBALS['xoopsSecurity']->check() ) {
				redirect_header('{$table_name}.php', 3, implode(', ', \$GLOBALS['xoopsSecurity']->getErrors()));
			}
			if (\${$table_name}Handler->delete(\$obj)) {
				redirect_header('{$table_name}.php', 3, {$language}_FORMDELOK);
			} else {
				echo \$obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array('ok' => 1, '{$field_id}' => \$_REQUEST['{$field_id}'], 'op' => 'delete'), \$_SERVER['REQUEST_URI'], sprintf({$language}_FORMSUREDEL, \$obj->getVar('{$fpmf}')));
		}
	break;
EOT;
	if(isset($_REQUEST['table_online']) == 1) {
$text .= <<<EOT
	\ncase 'update_online':		
		if (isset(\$_REQUEST['{$field_id}'])) {
			\$obj =& \${$table_name}Handler->get(\$_REQUEST['{$field_id}']);
		} 
		\$obj->setVar('{$table_fieldname}_online', \$_REQUEST['{$table_fieldname}_online']);
		if (\${$table_name}Handler->insert(\$obj)) {
			redirect_header('{$table_name}.php', 3, {$language}_FORMOK);
		}
		echo \$obj->getHtmlErrors();	
	break;
EOT;
}
$text .= <<<EOT
\n}
include_once 'footer.php';
EOT;
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_ADMINS,
				_AM_TDMCREATE_CONST_NOTOK_ADMINS, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_ADMINS,
					_AM_TDMCREATE_CONST_NOTOK_ADMINS, $file);
	}
}