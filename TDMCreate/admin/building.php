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
 * @version         $Id: building.php 11084 2013-02-23 15:44:20Z timgno $
 */
include 'header.php';
$op = TDMCreate_CleanVars( $_REQUEST, 'op', 'default', 'string' );

if (isset($_REQUEST['mod_name'])) {
    $modules =& $modulesHandler->get($_REQUEST['mod_name']);
} else {
    $modules =& $modulesHandler;
}

$mod_name = strtolower($modules->getVar('mod_name'));
$mod_author_website_name = $modules->getVar('mod_author_website_name');
$mod_author_website_url = $modules->getVar('mod_author_website_url');
$mod_user = $modules->getVar('mod_user');
$mod_notifications = $modules->getVar('mod_notifications');
$mod_permissions = $modules->getVar('mod_permissions');

if (isset($_REQUEST['table_name'])) {
	$tables =& $tablesHandler->get($_REQUEST['table_name']);
} else {
    $tables =& $tablesHandler;	
}

//Name of tables
$criteria = new CriteriaCompo();
if (isset($_REQUEST['mod_name'])) {
    $criteria->add(new Criteria('table_mid', $_REQUEST['mod_name']));
} else {
    $criteria->add(new Criteria('table_mid'));
}

$nb_tables = $tablesHandler->getCount($criteria);
$tables_arr = $tablesHandler->getAll($criteria);

echo $adminMenu->addNavigation('building.php');
switch ($op) {
	case 'build':		
		// Effacer repertoire of nouveau module s'il existe
		TDMCreate_clearDir($modPath.'/modules/'.$mod_name);			
		// Debut
		TDMCreate_OpenTable(_AM_TDMCREATE_BUILDING_FILES, _AM_TDMCREATE_BUILDING_SUCCESS, _AM_TDMCREATE_BUILDING_FAILED);
		/************************************************/
		/*Structure*/
		/************************************************/	
        //Creation of architecture
		const_architecture($modules);			
		//Creation of changelog.txt
		const_changelog($modules);
						
		$result = $xoopsDB->queryF("SELECT COUNT(*) FROM " . $xoopsDB->prefix('mod_tdmcreate_tables') . " WHERE table_name = 'mod_".$mod_name."_categories'");
		list( $category ) = $xoopsDB->fetchRow($result);

		foreach (array_keys($tables_arr) as $i)
		{	
			// Variables
			$table_name = $tables_arr[$i]->getVar('table_name');			
			$table_fieldname = $tables_arr[$i]->getVar('table_fieldname');
            $table_category = $tables_arr[$i]->getVar('table_category');
			$table_fields = $tables_arr[$i]->getVar('table_fields');
			$table_parameters = $tables_arr[$i]->getVar('table_parameters');
			$table_image = $tables_arr[$i]->getVar('table_image');			
			$table_blocks = $tables_arr[$i]->getVar('table_blocks');
			$table_admin = $tables_arr[$i]->getVar('table_admin');
			$table_user = $tables_arr[$i]->getVar('table_user');
			$table_search = $tables_arr[$i]->getVar('table_search');
			$table_comments = $tables_arr[$i]->getVar('table_comments');			
			$table_notifications = $tables_arr[$i]->getVar('table_notifications');						
			$table_permissions = $tables_arr[$i]->getVar('table_permissions');
            $table_waiting = $tables_arr[$i]->getVar('table_waiting');

			// Fabrication
			// Copy of images tables			
			$table_image1 = $modPath . '/images/uploads/tables/' . $table_image;
			if (file_exists($table_image1)) {
				copy($table_image1, $modPath . '/modules/' . $mod_name . '/images/icons/32/' . $table_image);
			}
			// Creation of classes
			if ( $table_admin == 1 || $table_user == 1) {				
				const_class($modules, $table_name, $table_fieldname, $category, $table_fields, $table_parameters, $table_permissions, $category);
			}			
            // Creation of pages admin
			if ( $table_admin == 1 ) {				
				const_admin_pages($modules, $table_name, $table_fieldname, $table_fields, $table_parameters, $category);
			}
			// Creation of pages and templates user
			if ( $table_user == 1 && $table_name != null ) {
				const_user_pages($modules, $table_name, $table_fieldname, $table_fields, $table_parameters);							
				const_templates_pages($modules, $table_name, $table_fieldname, $table_fields);
			} 
			// Creation of search
			if ( $table_search == 1 ) {
				const_include_search($modules, $table_name, $table_fieldname, $table_fields, $table_parameters, $table_image);
			}			
			// Creation of notifications
			if ( $table_notifications == 1 ) {
                const_include_notifications($modules, $table_name, $table_fieldname, $table_fields, $table_parameters);
			}
			// Creation of the file mysql.sql
			const_sql($modules, $table_name, $table_fieldname, $category, $table_fields);		
			
			// Creation of blocks
			if ( $table_blocks == 1 ) {
				const_blocks($modules, $table_name, $table_fieldname, $table_fields, $table_parameters, $category);
				//Creation of template per blocks
				const_blocks_templates($modules, $table_name, $table_fieldname, $table_fields, $table_parameters);
			}
            // Creation of admin permissions.php
			if ( $table_permissions == 1) {
				const_admin_permissions($modules, $table_name, $table_fields, $table_parameters);
			}			
		}	
		$table_name = isset($table_name) ? $table_name : null;
		$table_comments = isset($table_comments) ? $table_comments : null;
		$table_waiting = isset($table_waiting) ? $table_waiting : null;
		$table_parameters = isset($table_parameters) ? $table_parameters : null;
		$table_user = isset($table_user) ? $table_user : null;
		$table_admin = isset($table_admin) ? $table_admin : null;
		$table_fields = isset($table_fields) ? $table_fields : null;
		$table_blocks = isset($table_blocks) ? $table_blocks : null;
		$table_image = isset($table_image) ? $table_image : null;
		$table_notifications = isset($table_notifications) ? $table_notifications : null;
		//Creation of architecture of more fields and data
		//const_architecture(null, null, $table_admin, $table_blocks, $table_admin, $table_blocks );	
		// Creation of comments
		if ( $table_comments == 1 ) {
			const_include_comments($modules, $table_name, $table_fieldname, $table_fields, $table_parameters);
		}
		
		if ( $table_waiting == 1 ) {
			// Creation of Waiting Plugin
			const_waiting($modules, $tables_arr);
		}
		// Creation of class helper & request
		if ( $table_name != '' ) {				
			const_class_helper($modules);
			const_class_request($modules);
		}
        // Creation of xoopsversion.php		
		const_xoopsversion($modules, $table_name, $table_fields, $table_parameters, $table_image, $tables_arr);
		// Creation of template index
		const_templates_index($modules);
		// Creation of template header
		const_templates_header($modules, $tables_arr);
		// Creation of template footer
		const_templates_footer($modules, $table_comments, $table_notifications);
		
		if ( $table_admin == 1 ) {	
			// Creation of template admin about
			const_templates_admin_about($modules);
			// Creation of template admin help
			const_templates_admin_help($modules);
		}
		// Include
		///////////////////////////////////////////////////////////////////////			
		// Configs
		const_include_common($modules, $mod_author_website_name, $mod_author_website_url);
		// Functions
		const_include_functions($modules);
		//Creation of file install per l'uploads
		const_include_install($modules, $tables_arr);
		// Language
		///////////////////////////////////////////////////////////////////////
		if ( $mod_user == 1 ) {
			//Creation of language main.php
			const_main_language($modules, $tables_arr);
		}
		// Creation of language modinfo.php
		const_modinfo_language($modules, $table_name, $table_image, $tables_arr, $mod_notifications);
		if ( $table_admin == 1 ) {	
			// Creation of language admin.php
			const_admin_language($modules, $tables_arr, $mod_permissions);
		}
		if ( $table_blocks == 1 ) {
			// Creation of language blocks.php
			const_blocks_language($modules, $tables_arr);	
        }			
		// Creation of language help/help.html
		const_help_language($modules); 
		///////////////////////////////////////////////////////////////////////
		//Creation of style.css
		const_css_style($modules);		
		/************************************************/
		/*Admin*/
		/************************************************/
		// Creation of admin header.php
		const_admin_header($modules, $table_name, $tables_arr);
		// Creation of admin index.php		
		const_admin_index($modules, $tables_arr);
		// Creation of admin footer.php
		const_admin_footer($modules);
		// Creation of admin menu.php
		const_admin_menu($modules, $tables_arr, $mod_permissions);
		// Creation of admin about.php
		const_admin_about($modules);        		
		/************************************************/
		/*User*/
		/************************************************/
		if ( $mod_user == 1 ) {
			const_user_header($modules);
			const_user_index($modules);
		}
		TDMCreate_CloseTable();
	break;
	
	case 'default':
	default:	
		include_once(XOOPS_ROOT_PATH . '/class/xoopsformloader.php');
		$action = $_SERVER['REQUEST_URI'];

        $form = new XoopsThemeForm(_AM_TDMCREATE_ADMIN_CONST, 'buildform', $action, 'post', true);

        $mod_select = new XoopsFormSelect(_AM_TDMCREATE_CONST_MODULES, 'mod_name', 'mod_name');
        $mod_select->addOptionArray($modulesHandler->getList());
        $form->addElement($mod_select, true);

        $form->addElement(new XoopsFormHidden('op', 'build'));
        $form->addElement(new XoopsFormButton(_REQUIRED.' <span class="red bold">*</span>', 'submit', _SUBMIT, 'submit'));
        $form->display();
	break;
}
include 'footer.php';