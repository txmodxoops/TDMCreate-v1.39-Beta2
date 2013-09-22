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
 * @version         $Id: tables.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once 'header.php';
$op = TDMCreate_CleanVars( $_REQUEST, 'op', 'default', 'string' );
echo $adminMenu->addNavigation('tables.php');
switch ($op) {
	case 'save_table':
        if (isset($_REQUEST['table_id'])) {
           $obj =& $tablesHandler->get($_REQUEST['table_id']);
        } else {
           $obj =& $tablesHandler->create();
        }

		//Module Name
		$modules =& $modulesHandler->get($_REQUEST['table_mid']);
		$mod_name = $modules->getVar('mod_name');
		
		$obj->setVar('table_mid', $_REQUEST['table_mid']);
		
		if ( $_REQUEST['select'] ==  1 )
		{
			$obj->setVar('table_name', 'categories');
            $obj->setVar('table_category', 1);
			$obj->setVar('table_fieldname', 'cat');
			$obj->setVar('table_blocks', 0);
			$obj->setVar('table_admin', 1);
			$obj->setVar('table_user', 1);
			$obj->setVar('table_status', 0);
			$obj->setVar('table_waiting', 0);
			$obj->setVar('table_online', 0);
			$obj->setVar('table_search', 0);
			$obj->setVar('table_comments', 0);
			$obj->setVar('table_notifications', 0);
			$obj->setVar('table_permissions', 0);
			$obj->setVar('table_nbfields', 7);
			
			$table_fields = 'cat_id:int:8:unsigned:NOT NULL: :primary|cat_pid:int:5:unsigned:NOT NULL:0:unique|cat_title:varchar:255: :NOT NULL: :unique|cat_desc:text: : :NOT NULL: :|cat_image:varchar:255: :NOT NULL: :|cat_weight:int:5:unsigned:NOT NULL:0:|cat_color:varchar:10: :NULL: :';
			
			$table_parameters = 'XoopsFormCategory:0:0:0:0:0:1|XoopsFormText:1:1:0:1:0:1|XoopsFormTextArea:0:1:0:0:0:1|XoopsFormUploadImage:1:1:0:0:0:0|XoopsFormText:1:1:0:0:0:0|XoopsFormColorPicker:1:1:0:0:0:0|XoopsFormSelectUser:0:0:0:0:0:1|XoopsFormTextDateSelect:0:0:0:0:0:1|XoopsFormCheckBox:1:1:0:0:0:1';
		
			//Image
			include_once XOOPS_ROOT_PATH.'/class/uploader.php';
			
			if(is_dir($pathIcon32)){
			   $uploaddir = $pathIcon32;
			}else{
			   $uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/images/uploads/tables/";
			}
			
			$uploader = new XoopsMediaUploader($uploaddir, "gif|jpeg|pjpeg|png", 104857600, null, null);

			if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
				$extension = preg_replace( "/^.+\.([^.]+)$/sU" , "\\1" , $_FILES["attachedfile1"]['name']) ;
				$name_img = 'category.'.$extension;
				$uploader->setTargetFileName($name_img); 
				$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
				if (!$uploader->upload()) {
					$errors = $uploader->getErrors();
					redirect_header("javascript:history.go(-1)",3, $errors);
				} else {
					$obj->setVar('table_image', $uploader->getSavedFileName());
				}
			} else {
				$obj->setVar('table_image', $_REQUEST['table_image1']);
			}		
		} else {
				
			$obj->setVar('table_name', strtolower($_REQUEST['table_name']));
			$obj->setVar('table_fieldname', strtolower($_REQUEST['table_fieldname']));
			$obj->setVar('table_nbfields', $_REQUEST['table_nbfields']);
			$obj->setVar('table_blocks', $_REQUEST['table_blocks']);
			$obj->setVar('table_admin', $_REQUEST['table_admin']);
			$obj->setVar('table_user', $_REQUEST['table_user']);
			$obj->setVar('table_status', $_REQUEST['table_status']);
			$obj->setVar('table_waiting', $_REQUEST['table_waiting']);
			$obj->setVar('table_online', $_REQUEST['table_online']);
			$obj->setVar('table_search', $_REQUEST['table_search']);
			$obj->setVar('table_comments', $_REQUEST['table_comments']);
			$obj->setVar('table_notifications', $_REQUEST['table_notifications']);	
            $obj->setVar('table_permissions', $_REQUEST['table_permissions']);				
			
			$table_fields = '';
			$table_parameters = '';
			for($i=0; $i<$_REQUEST['table_nbfields']; $i++)
			{
				//Additions of parameters: text: on: off: ...
				if ( $i != 0 ) {
					$table_parameters .= ( !empty($_REQUEST['fields_param_elements'][$i]) ) ? "".$_REQUEST['fields_param_elements'][$i].":" : " :";					
					$table_parameters .= ( !empty($_REQUEST['fields_param_admin'][$i]) ) ? "1:" : "0:";
					$table_parameters .= ( !empty($_REQUEST['fields_param_user'][$i]) ) ? "1:" : "0:";
					$table_parameters .= ( !empty($_REQUEST['fields_param_blocks'][$i]) ) ? "1:" : "0:";
					$table_parameters .= ( $i == $_REQUEST['fields_param_main_field']) ? "1:" : "0:";
					$table_parameters .= ( !empty($_REQUEST['fields_param_search_field'][$i]) ) ? "1:" : "0:";
					$table_parameters .= ( !empty($_REQUEST['fields_param_required_field'][$i]) ) ? "1" : "0";
				}

				//Additions of fields: test: int: 4: ...
				$table_fields .= (!empty($_REQUEST['fields_name'][$i])) ? $_REQUEST['fields_name'][$i].":" : " :";
				$table_fields .= (!empty($_REQUEST['fields_type'][$i])) ? $_REQUEST['fields_type'][$i].":" : " :";
				$table_fields .= (!empty($_REQUEST['fields_value'][$i])) ? $_REQUEST['fields_value'][$i].":" : " :";
				$table_fields .= (!empty($_REQUEST['fields_attributes'][$i])) ? $_REQUEST['fields_attributes'][$i].":" : " :";
				$table_fields .= (!empty($_REQUEST['fields_null'][$i])) ? strtoupper($_REQUEST['fields_null'][$i]).":" : " :";
				$table_fields .= (!empty($_REQUEST['fields_default'][$i])) ? $_REQUEST['fields_default'][$i].":" : " :";
				$table_fields .= (!empty($_REQUEST['fields_index'][$i])) ? $_REQUEST['fields_index'][$i]."" : " ";
				
				// Break between fields and between the parameters
				if ( $i != $_REQUEST['table_nbfields'] - 1) {
					$table_fields .= '|';
					if ( $i != 0 )
						$table_parameters .= '|';
				} else {	
					if ( isset($_REQUEST['table_status']) ) {
					    if ( $_REQUEST['table_status'] == 1 ) {
							$table_fields .= '|'.strtolower($_REQUEST['table_fieldname']).'_status:int:10:unsigned:NOT NULL:0:';
							$table_parameters .= '|XoopsFormCheckBox:1:1:1:0:0:1';
						}
					} else {
						$table_fields .= '';
						$table_parameters .= '';
					}
					if ( isset($_REQUEST['table_waiting']) ) {
						if ( $_REQUEST['table_waiting'] == 1 ) {
							$table_fields .= '|'.strtolower($_REQUEST['table_fieldname']).'_waiting:int:10:unsigned:NOT NULL:0:';
							$table_parameters .= '|XoopsFormCheckBox:1:1:1:0:0:1';
						}
					} else {
						$table_fields .= '';
						$table_parameters .= '';
					}
					if ( isset($_REQUEST['table_online']) ) {
						if ( $_REQUEST['table_online'] == 1 ) {
							$table_fields .= '|'.strtolower($_REQUEST['table_fieldname']).'_online:tinyint:1: unsigned:NOT NULL:0:'; $table_parameters .= '|XoopsFormCheckBox:1:1:1:0:0:1';
						}
					} else {
						$table_fields .= '';
						$table_parameters .= '';
					}                   
				}
			}
		}		
		$obj->setVar('table_fields', $table_fields);
		$obj->setVar('table_parameters', $table_parameters);
    
		if ($tablesHandler->insert($obj)) 
		{
		   redirect_header('tables.php', 2, _AM_TDMCREATE_FORMOK);
		}
		
	break;
	
	case 'table_save_fields':	
		if (!$GLOBALS['xoopsSecurity']->check()) {
		   redirect_header('tables.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}

		if (isset($_REQUEST['table_id'])) {
		   $obj =& $tablesHandler->get($_REQUEST['table_id']);
		} else {
		   $obj =& $tablesHandler->create();
		}
		//Module Name
		$modules =& $modulesHandler->get($_REQUEST['table_mid']);
		$mod_name = $modules->getVar('mod_name');		
		
		//Image
		include_once XOOPS_ROOT_PATH.'/class/uploader.php';
		if(is_dir($pathIcon32)){
		   $uploaddir = $pathIcon32;
		}else{
		   $uploaddir = XOOPS_ROOT_PATH . '/modules/'.$xoopsModule->dirname().'/images/uploads/tables/';
		}			
		$uploader = new XoopsMediaUploader($uploaddir, 'gif|jpeg|pjpeg|png', 104857600, null, null);

		if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '\\1' , $_FILES['attachedfile']['name']);
			$name_img = $_REQUEST['table_name'].'.'.$extension;
			$uploader->setTargetFileName($name_img); 
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if (!$uploader->upload()) {
				$errors = $uploader->getErrors();
				redirect_header('javascript:history.go(-1)', 3, $errors);
			} else {
				$obj->setVar('table_image', $uploader->getSavedFileName());
			}
		} else {
			$obj->setVar('table_image', $_REQUEST['table_image']);
		}


        $oldname = $obj->getVar('table_fieldname');

		$obj->setVar('table_mid', strtolower($_POST['table_mid']));
		$obj->setVar('table_name', strtolower($_POST['table_name']));
		$obj->setVar('table_fieldname', strtolower($_POST['table_fieldname']));
		$obj->setVar('table_nbfields', $_POST['table_nbfields']);
		$obj->setVar('table_blocks', $_REQUEST['table_blocks']);
		$obj->setVar('table_admin', $_REQUEST['table_admin']);
		$obj->setVar('table_user', $_REQUEST['table_user']);
		$obj->setVar('table_status', $_REQUEST['table_status']);
		$obj->setVar('table_waiting', $_REQUEST['table_waiting']);
		$obj->setVar('table_online', $_REQUEST['table_online']);
		$obj->setVar('table_search', $_REQUEST['table_search']);
		$obj->setVar('table_comments', $_REQUEST['table_comments']);
		$obj->setVar('table_notifications', $_REQUEST['table_notifications']);	
        $obj->setVar('table_permissions', $_REQUEST['table_permissions']);			

        $table_fields = $obj->getVar('table_fields');
        $table_nbfields=$_REQUEST['table_nbfields'];

        $fields_total = explode('|', $table_fields);
      	$count_fields = count($fields_total);

        $newname = strtolower($_REQUEST['table_fieldname']);
		//echo $count_parameters;
		//fields
		for($i=0; $i<$count_fields; $i++)
		{
			$fields = explode(":", $fields_total[$i]);
			$fields[0] = $newname . substr($fields[0], stripos($fields[0], '_'));
			$newfields[$i] = implode(":", $fields);
		}

		$newTableFields=implode("|",$newfields);
        $obj->setVar('table_fields', $newTableFields);
			
		if ($tablesHandler->insert($obj)) {
			redirect_header('tables.php', 2, _AM_TDMCREATE_FORMOK);
		}	
	break;
	
	case "edit_table":
	    $table_id = TDMCreate_CleanVars( $_REQUEST, 'table_id', 0);
		$table_mid = TDMCreate_CleanVars( $_REQUEST, 'table_mid', 0);
		$obj =& $tablesHandler->get($table_id);
		$form = $obj->getFormTable(false, $table_mid);
	break;
	
	case "edit_fields":
		$obj =& $tablesHandler->get($_REQUEST['table_id']);
		$form = $obj->getFormEditFields(false, $_REQUEST['table_id']);
	break;
		
	case "delete_table":
		$obj =& $tablesHandler->get($_REQUEST['table_id']);
		if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
			if (!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('tables.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if ($tablesHandler->delete($obj)) {
				redirect_header('tables.php', 3, _AM_TDMCREATE_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array('ok' => 1, 'table_id' => $_REQUEST['table_id'], 'op' => 'delete_table'), $_SERVER['REQUEST_URI'], sprintf(_AM_TDMCREATE_FORMSUREDEL, $obj->getVar('table_name')));
		}
	break;
	
	case "table_fields":        
		$adminMenu->addItemButton(_AM_TDMCREATE_TABLES_LIST, 'tables.php?op=table_list', 'list');
        $adminMenu->addItemButton(_AM_TDMCREATE_TABLES_NEW, 'tables.php?op=table_fields', 'add');
        echo $adminMenu->renderButton();
        
		//fields existe deja ?
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('table_mid', $_REQUEST['table_mid']));
		$criteria->add(new Criteria('table_name', $_REQUEST['table_name']));
		$nb_tables1 = $tablesHandler->getCount($criteria);
	
		if ( $nb_tables1 < 1 )
		{
			if (!$GLOBALS['xoopsSecurity']->check()) {
			   redirect_header('tables.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if (isset($_REQUEST['table_id'])) {
			   $obj =& $tablesHandler->get($_REQUEST['table_id']);
			} else {
			   $obj =& $tablesHandler->create();
			}
			$table_blocks = (isset($_REQUEST['table_blocks'])) ? $_REQUEST['table_blocks'] : '0';
			$table_display_admin = (isset($_REQUEST['table_admin'])) ? $_REQUEST['table_admin'] : '0';
			$table_display_user = (isset($_REQUEST['table_user'])) ? $_REQUEST['table_user'] : '0';			
			$table_status = (isset($_REQUEST['table_status'])) ? $_REQUEST['table_status'] : '0';
			$table_waiting = (isset($_REQUEST['table_waiting'])) ? $_REQUEST['table_waiting'] : '0';
			$table_online = (isset($_REQUEST['table_online'])) ? $_REQUEST['table_online'] : '0';			
			$table_search = (isset($_REQUEST['table_search'])) ? $_REQUEST['table_search'] : '0';
			$table_comments = (isset($_REQUEST['table_comments'])) ? $_REQUEST['table_comments'] : '0';
			$table_notifications = (isset($_REQUEST['table_notifications'])) ? $_REQUEST['table_notifications'] : '0';
			$table_permissions = (isset($_REQUEST['table_permissions'])) ? $_REQUEST['table_permissions'] : '0';
			
			$select = (isset($_REQUEST['select'])) ? $_REQUEST['select'] : '0';
			
			//Image
			include_once XOOPS_ROOT_PATH.'/class/uploader.php';
			if(!is_dir($pathIcon32)){
			   $uploaddir = $pathIcon32;
			}else{
			   $uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/images/uploads/tables/";
			}
			$uploader = new XoopsMediaUploader($uploaddir, "gif|jpeg|pjpeg|png", 104857600, null, null);

			if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
				$extension = preg_replace( "/^.+\.([^.]+)$/sU" , "\\1" , $_FILES["attachedfile"]['name']);
				$name_img = $_REQUEST['table_fieldname'].'.'.$extension;
				$uploader->setTargetFileName($name_img); 
				$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
				if (!$uploader->upload()) {
					$errors = $uploader->getErrors();
					redirect_header("javascript:history.go(-1)",3, $errors);
				} else {
					$obj->setVar('table_image', $uploader->getSavedFileName());
				}
			} else {
				$obj->setVar('table_image', $_REQUEST['table_image']);
			}
				
			if ($tablesHandler->insert($obj)) {
				$table_id = $xoopsDB->getInsertId();
				$obj = $tablesHandler->get($table_id);
				$form = $obj->getFormFields(false, $table_id, intval($_REQUEST['table_mid']), strtolower($_REQUEST['table_name']), strtolower($_REQUEST['table_fieldname']), $table_blocks, $table_display_admin, $table_display_user, $table_status, $table_waiting, $table_online, $table_search, $table_comments, $table_notifications, $table_permissions, intval($_REQUEST['table_nbfields']), $select);
			}	
		} else {
			redirect_header('tables.php', 2, _AM_TDMCREATE_TABLES_EXIST);
		}
	break;
	
	case "create_table":		    
		$adminMenu->addItemButton(_AM_TDMCREATE_TABLES_NEW_CATEGORY, 'tables.php?op=create_category', 'add');
		$adminMenu->addItemButton(_AM_TDMCREATE_TABLES_LIST, 'tables.php?op=table_list', 'list');	
        echo $adminMenu->renderButton();

		$table_mid = TDMCreate_CleanVars( $_REQUEST, 'table_mid', 0);
		$obj =& $tablesHandler->create();
		$form = $obj->getFormTable(false, $table_mid);
	break;
	
	case "create_category":	       
        $adminMenu->addItemButton(_AM_TDMCREATE_TABLES_NEW, 'tables.php?op=create_table', 'add');
		$adminMenu->addItemButton(_AM_TDMCREATE_TABLES_LIST, 'tables.php?op=table_list', 'list');  
        echo $adminMenu->renderButton();
		
        $result = $xoopsDB->queryF("SELECT COUNT(*) FROM " . $xoopsDB->prefix("tdmcreate_tables")." WHERE table_name = 'categories'");
		list( $category ) = $xoopsDB->fetchRow($result);
        $obj =& $tablesHandler->get($_REQUEST['table_id']);
        if ( $category >= 0 ) {
		    $form = $obj->getFormCategory();
		}
	break;
	
	case "table_list":
	default:	           
        $adminMenu->addItemButton(_AM_TDMCREATE_TABLES_NEW, 'tables.php?op=create_table', 'add');
		$adminMenu->addItemButton(_AM_TDMCREATE_TABLES_NEW_CATEGORY, 'tables.php?op=create_category', 'add');
        echo $adminMenu->renderButton();
		
		$GLOBALS['xoTheme']->addStylesheet( 'modules/TDMCreate/css/style.css' );
		$GLOBALS['xoTheme']->addScript('modules/TDMCreate/js/functions.js');
        			
		// Remove unnecessary tables
		$sql = "SELECT table_id FROM ".$xoopsDB->prefix("tdmcreate_tables")." WHERE table_mid = 0";
		$result = $xoopsDB->queryF($sql);
		while ( $myrow = $xoopsDB->fetchArray($result) ) 
		{
			$sql_del = "DELETE FROM ".$xoopsDB->prefix("tdmcreate_tables")." WHERE table_id = ".$myrow['table_id']."";
			$xoopsDB->queryF($sql_del);
		}
		
	    $criteria = new CriteriaCompo();
        $criteria->setSort('mod_id');
        $criteria->setOrder('ASC');
		$mod_arr = $modulesHandler->getall($criteria);
		$numrows_modules = $modulesHandler->getCount();
		
        if ( $numrows_modules > 0 ) 
		{
			echo '<table width="100%" cellspacing="1" class="outer">';
			echo '<tr>';
			echo '<th class="center width1">'._AM_TDMCREATE_ID.'</th>';
			echo '<th class="center width10">'._AM_TDMCREATE_NAME.'</th>';
			echo '<th class="center width10">'._AM_TDMCREATE_IMAGE.'</th>';
			echo '<th class="center width10">'._AM_TDMCREATE_DISPLAY_ADMIN.'</th>';
			echo '<th class="center width10">'._AM_TDMCREATE_DISPLAY_USER.'</th>';
			echo '<th class="center width10">'._AM_TDMCREATE_BLOCKS.'</th>';
			echo '<th class="center width10">'._AM_TDMCREATE_NB_FIELDS.'</th>';
			echo '<th class="center width5">'._AM_TDMCREATE_FORMACTION.'</th>';			
			echo '</tr>';
			$class = 'odd';
            foreach (array_keys($mod_arr) as $i) 
			{                                  
				$mod_id = $mod_arr[$i]->getVar('mod_id');
				$mod_name = $mod_arr[$i]->getVar('mod_name');
				$mod_image = $mod_arr[$i]->getVar('mod_image');
				$mod_display_admin = ($mod_arr[$i]->getVar('mod_display_admin') == 1) ? _YES : _NO;
				$mod_display_user = ($mod_arr[$i]->getVar('mod_display_user') == 1) ? _YES : _NO; 					
				echo '<tr class="odd center toggleTables">';
				echo '<td class="width5"><b>'.$i.'</b><br /><img src="../images/icons/16/toggle.png" alt="Toggle" title="Toggle" /></td>';
				$nbsps = '&nbsp;&nbsp;&nbsp;';
				echo '<td class="left">'.$nbsps.'<img src="../images/icons/16/arrow.gif" alt="Arrow" />'.$nbsps.'<b>'.$mod_name.'</b></td>';
				echo '<td><img src="../images/uploads/modules/'.$mod_image.'" height="30px"></td>';
				echo '<td>'.$mod_display_admin.'</td>';
				echo '<td>'.$mod_display_user.'</td>';
				echo '<td>&#126;</td>';
				echo '<td>&#126;</td>';
				echo '<td>';
				echo '<a href="modules.php?op=edit&mod_id='.$mod_id.'"><img src="'. $pathIcon16 .'/edit.png" alt="'._EDIT.'" title="'._EDIT.'" /></a>&nbsp;<a href="modules.php?op=delete&mod_id='.$mod_id.'"><img src="'. $pathIcon16 .'/delete.png" alt="'._DELETE.'" title="'._DELETE.'" /></a>';
				echo '</td>';                    
				echo '</tr>';
				
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria('table_mid', $mod_id));
				$criteria->setSort('table_name');
				$criteria->setOrder('ASC');
				$table_arr = $tablesHandler->getall($criteria);
				$numrows_tables = $tablesHandler->getCount();
				if ( $numrows_tables != 0 )
				{
					foreach (array_keys($table_arr) as $i) 
					{												
						$table_name = $table_arr[$i]->getVar('table_name');
						$table_image = $table_arr[$i]->getVar('table_image');
						$table_blocks = $table_arr[$i]->getVar('table_blocks');						
						$table_admin = (($table_arr[$i]->getVar('table_admin') == 1) ? _YES : _NO);
						$table_user = (($table_arr[$i]->getVar('table_user') == 1) ? _YES : _NO);						
						$nb_fields = $table_arr[$i]->getVar('table_nbfields');
						$blocks = ($table_blocks == 1) ? _YES : _NO;
						echo '<tr class="even center toggleHidden">';
						echo '<td class="center">'.$i.'</b></a></td>';
						echo '<td class="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>- '.$table_name.'</b></a></td>';
						if(file_exists($image = $pathIcon32.'/'.$table_image)) {
							echo '<td><img src="'.$image.'" height="25px"></td>';
						} else {
							echo '<td><img src="../images/uploads/tables/'.$table_image.'" height="25px"></td>';
						}
						echo '<td>'.$table_admin.'</td>';
						echo '<td>'.$table_user.'</td>';
						echo '<td>'.$blocks.'</td>';
						echo '<td>'.$nb_fields.'</td>';
						echo '<td class="width6">';
						echo '<a href="tables.php?op=edit_table&table_id='.$i.'"><img src="'. $pathIcon16 .'/edit.png" alt="'._AM_TDMCREATE_FORMEDIT.'" title="'._AM_TDMCREATE_FORMEDIT.'"></a>&nbsp;<a href="tables.php?op=edit_fields&table_id='.$i.'"><img src="'. $pathIcon16 .'/inserttable.png" alt="'._AM_TDMCREATE_FORMFIELDS.'" title="'._AM_TDMCREATE_FORMFIELDS.'" /></a>&nbsp;<a href="tables.php?op=delete_table&table_id='.$i.'"><img src="'. $pathIcon16 .'/delete.png" alt="'._AM_TDMCREATE_FORMDEL.'" title="'._AM_TDMCREATE_FORMDEL.'"></a>';
						echo '</td>';        
						echo '</tr>';
					}
				}
            }
			echo '</table>';
		} else {
		    echo '<table width="100%" cellspacing="1" class="outer">';
			echo '<tr class="center">';
			echo '<th width="1%">'._AM_TDMCREATE_ID.'</th>';
			echo '<th width="10%">'._AM_TDMCREATE_NAME.'</th>';
			echo '<th width="10%">'._AM_TDMCREATE_IMAGE.'</th>';
			echo '<th width="15%">'._AM_TDMCREATE_DISPLAY_ADMIN.'</th>';
			echo '<th width="15%">'._AM_TDMCREATE_DISPLAY_USER.'</th>';
			echo '<th width="10%">'._AM_TDMCREATE_BLOCKS.'</th>';
			echo '<th width="10%">'._AM_TDMCREATE_NB_FIELDS.'</th>';
			echo '<th width="1%">'._AM_TDMCREATE_FORMACTION.'</th>';
			echo '<tr><td class="errorMsg" colspan="8">No modules</td></tr>';
			echo '</tr></table><br><br>';			
		}			
	break;
}
include 'footer.php';