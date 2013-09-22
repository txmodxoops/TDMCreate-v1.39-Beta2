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
 * @version         $Id: const_class.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_class($modules, $table_name, $table_fieldname, $table_category, $table_fields, $table_parameters, $table_permissions, $category)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_AM_'.strtoupper($mod_name).'_';
	$file = $table_name. '.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/class/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/class/'.$file;
	$constructor = const_fields($mod_name, $table_name, $table_fieldname, $table_category, $table_fields, $language, 0, 0, 0, 0);
	//fields
	$fields_total = explode('|', $table_fields);
	$nb_fields = count($fields_total);
	//print_r($fields_total);
	//parameters
	$parameters_total = explode('|', $table_parameters);

	//Recuperation des parameters affichage dans le formulaire
	for($i=0; $i<$nb_fields; $i++)
	{
		$fields = explode(':', $fields_total[$i]);
		//$fields[$i] = $fields1[0];
		//Afficher dans les elements du formulaire et choisir le type
		if( $i == 0 ) {
			$fpe[$i] = '0';
			$fpdf[$i] = '0';
			$fpif = $fields[0]; // fpif = fields parameters auto_increment field
		} else {
			$param = explode(':', $parameters_total[$i-1]);
			//print_r($param);
			$fpdf[$i] = $param[3]; // fpdf = fields parameters display form
			$fpe[$i] = $param[0]; // fpe = fields parameters elements				
			$fprf[$i] = $param[6]; // fprf = fields parameters required field
			if ( $param[4] == 1 ) {
				$fpmf = $fields[0]; // fpmf = fields parameters main field
			}
		}
	}	
	//$field_id = $fields[0];
	//$field_name = $fields[1];
	
	$form = const_fields($mod_name, $table_name, $table_fieldname, $table_category, $table_fields, $language, $fpdf, $fpe, $fprf, 1);
    $ucf_mod_name_table_name = ucfirst($mod_name).ucfirst($table_name);
	$lang_add = $language.strtoupper($table_fieldname).'_ADD';
	$lang_edit = $language.strtoupper($table_fieldname).'_EDIT';	
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\ndefined('XOOPS_ROOT_PATH') or die("Restricted access");

class {$ucf_mod_name_table_name} extends XoopsObject
{ 
	/*
	 * Constructor
	 *
	 * @param null
	 */
	function __construct()
	{
		\$this->XoopsObject();
EOT;
	$text .= $constructor;	
$text .= <<<EOT
\n\t}
	
    /*
	 * Get form
	 *
	 * @param mixed \$action
	 */
	function getForm(\$action = false)
	{
		global \$xoopsDB, \$xoopsModuleConfig;
	
		if (\$action === false) {
			\$action = \$_SERVER['REQUEST_URI'];
		}
	
		\$title = \$this->isNew() ? sprintf({$lang_add}) : sprintf({$lang_edit});

		include_once(XOOPS_ROOT_PATH.'/class/xoopsformloader.php');

		\$form = new XoopsThemeForm(\$title, 'form', \$action, 'post', true);
		\$form->setExtra('enctype="multipart/form-data"');\n
		
EOT;
		
	$text .= $form;
	
	if( $modules->getVar('mod_permissions') == 1 && $table_permissions == 1) {
		
		$up_mod_name = strtoupper($mod_name);
		$perm_approve = '_AM_'.$up_mod_name.'_PERMISSIONS_APPROVE';
		$perm_submit = '_AM_'.$up_mod_name.'_PERMISSIONS_SUBMIT';
		$perm_view = '_AM_'.$up_mod_name.'_PERMISSIONS_VIEW';
			
$text .= <<<EOT
		\n\t\t//permissions
		\$member_handler = & xoops_gethandler ( 'member' );
		\$group_list = &\$member_handler->getGroupList();
		\$gperm_handler = &xoops_gethandler ( 'groupperm' );
		\$full_list = array_keys ( \$group_list );
		global \$xoopsModule;
		if (! \$this->isNew ()) {
			\$groups_ids_approve = \$gperm_handler->getGroupIds ( '{$mod_name}_approve', \$this->getVar ( '{$fpif}' ), \$xoopsModule->getVar ( 'mid' ) );
			\$groups_ids_submit = \$gperm_handler->getGroupIds ( '{$mod_name}_submit', \$this->getVar ( '{$fpif}' ), \$xoopsModule->getVar ( 'mid' ) );
			\$groups_ids_view = \$gperm_handler->getGroupIds ( '{$mod_name}_view', \$this->getVar ( '{$fpif}' ), \$xoopsModule->getVar ( 'mid' ) );
			\$groups_ids_approve = array_values ( \$groups_ids_approve );
			\$groups_can_approve_checkbox = new XoopsFormCheckBox ( {$perm_approve}, 'groups_approve[]', \$groups_ids_approve );
			\$groups_ids_submit = array_values ( \$groups_ids_submit );
			\$groups_can_submit_checkbox = new XoopsFormCheckBox ( {$perm_submit}, 'groups_submit[]', \$groups_ids_submit );	
			\$groups_ids_view = array_values ( \$groups_ids_view );
			\$groups_can_view_checkbox = new XoopsFormCheckBox ( {$perm_view}, 'groups_view[]', \$groups_ids_view );			
		} else {
			\$groups_can_approve_checkbox = new XoopsFormCheckBox ( {$perm_approve}, 'groups_approve[]', \$full_list );
			\$groups_can_submit_checkbox = new XoopsFormCheckBox ( {$perm_submit}, 'groups_submit[]', \$full_list );		
			\$groups_can_view_checkbox = new XoopsFormCheckBox ( {$perm_view}, 'groups_view[]', \$full_list );
		}
		
		// For approve
		\$groups_can_approve_checkbox->addOptionArray ( \$group_list );
		\$form->addElement ( \$groups_can_approve_checkbox );
		// For submit
		\$groups_can_submit_checkbox->addOptionArray ( \$group_list );
		\$form->addElement ( \$groups_can_submit_checkbox );		
		// For view
		\$groups_can_view_checkbox->addOptionArray ( \$group_list );
		\$form->addElement ( \$groups_can_view_checkbox );	
EOT;
	}		
$text .= <<<EOT
		\n\t\t\$form->addElement(new XoopsFormHidden('op', 'save'));
		\$form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
		return \$form;
	}
}\n\n
EOT;
$ucf_mod_table_handler = ucfirst($mod_name).ucfirst($table_name);
$text .= <<<EOT
class {$ucf_mod_table_handler}Handler extends XoopsPersistableObjectHandler 
{
	/*
	 * Constructor
	 *
	 * @param string \$db
	 */
	function __construct(&\$db) 
	{
		parent::__construct(\$db, 'mod_{$mod_name}_{$table_name}', '{$mod_name}{$table_name}', '{$fpif}', '{$fpmf}');
	}
}
EOT;

	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_CLASSES,
				_AM_TDMCREATE_CONST_NOTOK_CLASSES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_CLASSES,
					_AM_TDMCREATE_CONST_NOTOK_CLASSES, $file);
	}
}