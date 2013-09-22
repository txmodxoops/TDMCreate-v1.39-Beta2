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
 * @version         $Id: functions_const.php 11084 2013-02-23 15:44:20Z timgno $
 */
if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

define('TDM_CREATE_URL', XOOPS_ROOT_PATH . '/modules/TDMCreate');
define('TDM_CREATE_MURL', TDM_CREATE_URL . '/modules');

include_once TDM_CREATE_URL.'/const/const_header.php';

function const_fields($mod_name, $table_name, $table_fieldname, $table_category, $table_fields, $lng, $fpdf = 0, $fpe = 0, $fprf = 0, $option = 0)
{
	// fpdf = fields_param_display_form 
	$text = '';
	// Counts the number of fields
	$fields = explode("|", $table_fields);
	$nb_fields = count($fields);
	// Retrieve the data	
	if ( $option == 0 )
	{
		// Creation of the constructor
		for ($i = 0; $i < $nb_fields; $i++)
		{
			$struct = explode(":", $fields[$i]);
			if ( $struct[1] == 'int' || $struct[1] == 'tinyint' || $struct[1] == 'mediumint' || $struct[1] == 'smallint' ) {
				$text .= '
		$this->initVar(\''.$struct[0].'\', XOBJ_DTYPE_INT);';
			} elseif ( $struct[1] == 'char' || $struct[1] == 'varchar' ) {
				$text .= '
		$this->initVar(\''.$struct[0].'\', XOBJ_DTYPE_TXTBOX);';
			} elseif ( $struct[1] == 'text' || $struct[1] == 'tinytext' || $struct[1] == 'mediumtext' || $struct[1] == 'longtext' ) {
				$text .= '
		$this->initVar(\''.$struct[0].'\', XOBJ_DTYPE_TXTAREA);';
			} elseif ( $struct[1] == 'float' ) {
				$text .= '
		$this->initVar(\''.$struct[0].'\', XOBJ_DTYPE_FLOAT);';
			} elseif ( $struct[1] == 'decimal' || $struct[1] == 'double' ) {
				$text .= '
		$this->initVar(\''.$struct[0].'\', XOBJ_DTYPE_DECIMAL);';
			} elseif ( $struct[1] == 'enum' ) {
				$text .= '
		$this->initVar(\''.$struct[0].'\', XOBJ_DTYPE_ENUM);';
			} elseif ( $struct[1] == 'email' ) {
				$text .= '
		$this->initVar(\''.$struct[0].'\', XOBJ_DTYPE_EMAIL);';
			} elseif ( $struct[1] == 'url' ) {
				$text .= '
		$this->initVar(\''.$struct[0].'\', XOBJ_DTYPE_URL);';
			} elseif ( $struct[1] == 'date' || $struct[1] == 'datetime' || $struct[1] == 'timestamp' || $struct[1] == 'time' || $struct[1] == 'year' ) {
				$text .= '
		$this->initVar(\''.$struct[0].'\', XOBJ_DTYPE_LTIME);';
			}/* elseif ( $struct[1] == 'other' ) {
			    $text .= ' 
				$this->initVar(\''.$struct[0].'\', XOBJ_DTYPE_OTHER, '.$struct[2].', false);';
			}*/
		}
	} else if ( $option == 1 ) {
		// Creation form
		for ($i=0; $i<$nb_fields; $i++)
		{
			if ( $i != 0 ) {
				$struct = explode(':', $fields[$i]);
				$lng_form = $lng.strtoupper($struct[0]);				
				$text .= form_elements($i, $mod_name, $table_name, $table_fieldname, $table_category, $fpe, $fprf, $lng_form, $struct[0]);	
			}
		}
	} else if ( $option == 2 ) {
		// Creation of file mysql.sql
		$text .= '
		
#
# Structure table for `mod_'.$mod_name.'_'.strtolower($table_name).'` '.$nb_fields.'
#
		
CREATE TABLE  `mod_'.$mod_name.'_'.strtolower($table_name).'` (
';
		$j = 0;
		for ($i=0; $i < $nb_fields; $i++)
		{
			$struct = explode(':', $fields[$i]);
//            echo "--- START ----------------- STRUCTURE -------------------------------------</br>";
//            var_dump($struct);
			//Debut
			if ( $struct[0] != ' ' )
			{
				//If as text, (not value)
                if ( $struct[1] == 'text' || $struct[1] == 'date' || $struct[1] == 'timestamp' ) {			
				    $type = $struct[1];
			    } else {
				    $type = $struct[1].' ('.$struct[2].')';
			    }			
                //If as empty is default not string(not value), if as text not default, if as numeric default is 0 or 0.0000
                //echo $struct[5]." struct[5] --------------- </br>";
				if ( $struct[5] =='' ) {
					$default = "default ''";
                    //echo " default 1 </br>";
				} elseif ( $struct[1] == 'text' || $struct[1] == 'tinytext' || $struct[1] == 'mediumtext' || $struct[1] == 'longtext' ) { 
				    $default = "";
                  //  echo " default 2 </br>";
				} elseif ( $struct[1] == 'int' || $struct[1] == 'tinyint' || $struct[1] == 'mediumint' || $struct[1] == 'smallint') {
					$default = "default '0'";
                    //echo " default 3 </br>";
				} elseif ( $struct[1] == 'decimal' || $struct[1] == 'double' || $struct[1] == 'float' ) {
					$default = "default '0.0000'";
                   // echo " default 4 </br>";
				} elseif ( $struct[1] == 'date' ) {
                   // echo " default 5 </br>";
					$default = "default '0000-00-00'";
				} elseif ( $struct[1] == 'datetime' || $struct[1] == 'timestamp') {
					$default = "default '0000-00-00 00:00:00'";
                    //echo " default 6 </br>";
				} elseif ( $struct[1] == 'time' ) {
					$default = "default '00:00:00'";
                   // echo " default 7 </br>";
				} elseif ( $struct[1] == 'year' ) {
					$default = "default '0000'";
                    //echo " default 8 </br>";
				} elseif ( $struct[1] == 'other' ) {
					$default = "default '".$struct[5]."'";
                    //echo " default 9 </br>";
				} else {
					$default = "default ''";
                    //echo " default 10 </br>";
				}

//				echo $default." Default  </br>";
//                echo $struct[0]." struct[0] </br>";
//                echo $struct[6]." struct[6] </br>";

				if ( $i == 0 ) {
					$comma[$j] = 'PRIMARY KEY (`'.$struct[0].'`)';
					$j++;
					$text .= '`'.$struct[0].'` '.$type.' '.$struct[3].' '.$struct[4].'  auto_increment,
';
				} else {
					if ( $struct[6] == 'unique' || $struct[6] ==  'index' || $struct[6] ==  'fulltext')
					{
						if ( $struct[6] == 'unique' ) {
							$text .= '`'.$struct[0].'` '.$type.' '.$struct[3].' '.$struct[4].' '.$default.',
';
							$comma[$j] = 'KEY `'.$struct[0].'` (`'.$struct[0].'`)';
						} else if ( $struct[6] == 'index' ) {
							$text .= '`'.$struct[0].'` '.$type.' '.$struct[3].' '.$struct[4].' '.$default.',
';
							$comma[$j] = 'INDEX (`'.$struct[0].'`)';
						} else if ( $struct[6] == 'fulltext' ) {
							$text .= '`'.$struct[0].'` '.$type.' '.$struct[3].' '.$struct[4].' '.$default.',
';
							$comma[$j] = 'FULLTEXT KEY `'.$struct[0].'` (`'.$struct[0].'`)';	
						}
						$j++;
					} else {
						$text .= '`'.$struct[0].'` '.$type.' '.$struct[3].' '.$struct[4].' '.$default.',
';
					}
				}
			}
//            echo $i."--- i -------</br>";
//            echo $j."--- j -------</br>";
//            var_dump($comma);
//            echo $comma[$i]."comma[i] </br>";
//            echo $text."</br>";
		}		
		//Problem comma
		$key = '';
		for ($i=0; $i < $j; $i++)
		{
			if ( $i != $j - 1 ) {
				$key .= ''.$comma[$i].',
';
			} else {
				$key .= ''.$comma[$i].'
';
			}
		}
       // echo $key."================= KEY ========================= </br>";
		$text .= $key;
		$text .= ') ENGINE=MyISAM;';
	}
	return $text;
}

//
function const_show_fields_parameters($mod_name, $table_name, $table_fieldname, $fields_id, $nb_fields, $fields, $fpda, $fields_param_type, $lng, $prefix = '',  $option = 0)
{	
	$text = '';
	
	if ( $option == 0 ) {
		// Name column of the table
		for($i = 0; $i < $nb_fields; $i++)
		{
			if ( $i != 0 ) {
				if ( $fpda[$i] == 1 ) { // fpda = fields param display admin
					$text .= '
						<th class=\'center\'>".'.$lng.'_'.strtoupper($fields[$i]).'."</th>';
				}
			}
		}
	} elseif ( $option == 1 ) {
	//Données du tableau
		for($i=0; $i<$nb_fields; $i++)
		{
			if ( $fpda[$i] == 1 ) {
				if ( $i == $nb_fields )//  - 1
				{
				    if(isset($_REQUEST['table_online']) == 1) {
					$text .= '
					$online = $'.$table_name.'_arr[$i]->getVar("'.$fields[$i].'");
					if( $online == 1 ) {						
						echo "<td class=\'center\'><a href=\'./'.$table_name.'.php?op=update_online&'.$fields_id.'=".$'.$table_name.'_arr[$i]->getVar("'.$fields_id.'")."&'.$table_fieldname.'_online=0\'><img src=".$pathIcon16."/on.png border=\'0\' alt=\'"._ON."\' title=\'"._ON."\'></a></td>";
					} else {
						echo "<td class=\'center\'><a href=\'./'.$table_name.'.php?op=update_online&'.$fields_id.'=".$'.$table_name.'_arr[$i]->getVar("'.$fields_id.'")."&'.$table_fieldname.'_online=1\'><img src=".$pathIcon16."/off.png border=\'0\' alt=\'"._OFF."\' title=\'"._OFF."\'></a></td>";
					}'; }
				} else if ( $fields[$i] == $table_fieldname.'_title' ) {
					if ( $prefix != '' ) {
						$text .= 'echo "<td class=\'left\'>&nbsp;".$prefix."&nbsp;".$'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\')."</td>";
					';
					} else {
						$text .= 'echo "<td class=\'left\'><img src=\'".'.strtoupper($mod_name).'_URL."/images/icons/16/arrow.gif\'>&nbsp;".$'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\')."</td>";
					';
					}
					
				} else if ( $fields_param_type[$i] == 'XoopsFormUploadImage' ) {
					$text .= '$'.$table_fieldname.'_image = $'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\');
					if(file_exists($image = XOOPS_UPLOAD_URL."/'.$mod_name.'/images/'.$table_name.'/".$'.$table_fieldname.'_image)) {
						echo "<td class=\'center\'><img src=\'".$image."\' height=\'30px\' alt=\''.$fields[$i].'\'></td>";
					} else {
						echo "<td class=\'center\'><img src=\'../images/'.$table_name.'/".$'.$table_fieldname.'_image."\' height=\'30px\' alt=\''.$fields[$i].'\'></td>";
					}					
				';
				} else if ( $fields_param_type[$i] == 'XoopsFormUploadFile' )
				{
					$text .= 'echo "<td class=\'center\'>".$'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\')."</td>";
				';
				} else if ( $fields_param_type[$i] == 'XoopsFormColorPicker' )
				{
					$text .= 'echo "<td class=\'center\'><span style=\'background-color:".$'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\')."\'>&nbsp;&nbsp;&nbsp;</span> -> ".$'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\')."</td>";
				';
				} else if ( $fields_param_type[$i] == 'XoopsFormTextDateSelect' )
				{
					$text .= 'echo "<td class=\'center\'>".formatTimeStamp($'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\'),"S")."</td>";
				';
				} else if ( $fields_param_type[$i] == 'XoopsFormCategory' )
				{
					$text .= '$'.$table_fieldname.'1 = $categoriesHandler->get($'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\'));
					$'.$table_fieldname.'_categories1 = $'.$table_fieldname.'1->getVar(\''.$table_fieldname.'_title\');
					echo "<td class=\'center\'>".$'.$table_fieldname.'_categories1."</td>";
				';
				} else if ( $fields_param_type[$i] == 'XoopsFormSelectUser' )
				{
					$text .= 'echo "<td class=\'center\'>".XoopsUser::getUnameFromId($'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\'),"S")."</td>";
				';
				} else if ( $fields_param_type[$i] == 'XoopsFormText' || $fields_param_type[$i] == 'XoopsFormDhtmlTextArea' || $fields_param_type[$i] == 'XoopsFormTextArea' ) {
					$text .= 'echo "<td class=\'center\'>".strip_tags($'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\'))."</td>";
				';
				} else if ( $fields_param_type[$i] == 'XoopsFormCheckBox' || $fields_param_type[$i] == 'XoopsFormRadioYN' ) {
					$text .= 'echo "<td class=\'center\'>".( ($'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\') == 1 ) ? _YES : _NO)."</td>";
				';
				} else {
					$data = explode("-", $fields_param_type[$i]);
					// Handler select table
					$tablesHandler =& xoops_getModuleHandler('tables', 'TDMCreate');
					$criteria = new CriteriaCompo();
					$criteria->add(new Criteria('table_name', $data[1]));
					$tables_select_arr = $tablesHandler->getall($criteria);

					foreach (array_keys($tables_select_arr) as $k) 
					{
						$tables_select_fields = $tables_select_arr[$k]->getVar('table_fields');
						$tables_select_parameters = $tables_select_arr[$k]->getVar('table_parameters');
						
						// Fields
						$fields_total_select = explode("|", $tables_select_fields);
						$nb_fields_select = count($fields_total_select);
						
						// Parameters
						$parameters_total_select = explode("|", $tables_select_parameters);
						
						// Recovery fields names
						for($l = 0; $l < $nb_fields_select; $l++)
						{
							// Fields names
							$fields_select1 = explode(":", $fields_total_select[$l]);
							$fields_select[$l] = $fields_select1[0];
							// Show in admin
							if( $l != 0 ) {
								$parameters_select = explode(":", $parameters_total_select[$l-1]);
								if ( $parameters_select[4] == 1 ) {
									$fields_param_main_field = $fields_select1[0];									
								}
							}	
						}

						$text .= '
				$'.$data[1].' =& $'.$data[1].'Handler->get($'.$table_name.'_arr[$i]->getVar(\''.$fields[$i].'\'));
				$'.$table_name.'_'.$data[1].' = $'.$data[1].'->getVar(\''.$fields_param_main_field.'\');
				echo "<td class=\'center\'>".$'.$table_name.'_'.$data[1].'."</td>";
				';
					}
					
				}
			}
		}
	} elseif ( $option == 2 ) {
	    $text .= '// Form save fields';
		for($i=0; $i < $nb_fields; $i++)
		{
			if ( $i != 0 ) 
			{
				if ( $fields_param_type[$i] == 'XoopsFormTextDateSelect' )
				{
					$text .= '
		$obj->setVar(\''.$fields[$i].'\', strtotime($_REQUEST[\''.$fields[$i].'\']));';	
				} else if ( $fields_param_type[$i] == 'XoopsFormCheckBox' || $fields_param_type[$i] == 'XoopsFormRadioYN' ) {
					$text .= '
		$obj->setVar(\''.$fields[$i].'\', (($_REQUEST[\''.$fields[$i].'\'] == 1) ? \'1\' : \'0\'));';
				} else if ( $fields_param_type[$i] == 'XoopsFormUploadImage' ) {
				$text .= '
		
		include_once XOOPS_ROOT_PATH.\'/class/uploader.php\';
		$uploaddir = XOOPS_UPLOAD_PATH.\'/'.$mod_name.'/images/'.$table_name.'/\';
		$uploader = new XoopsMediaUploader($uploaddir, xoops_getModuleOption(\'mimetypes\', \''.$mod_name.'\'),
												       xoops_getModuleOption(\'maxsize\', \''.$mod_name.'\'), null, null);
		if ($uploader->fetchMedia($_POST[\'xoops_upload_file\'][0])) {
			$uploader->setPrefix(\''.$fields[$i].'_\');
			$uploader->fetchMedia($_POST[\'xoops_upload_file\'][0]);
			if (!$uploader->upload()) {
				$errors = $uploader->getErrors();
				redirect_header(\'javascript:history.go(-1)\', 3, $errors);
			} else {
				$obj->setVar(\''.$fields[$i].'\', $uploader->getSavedFileName());
			}
		} else {
			$obj->setVar(\''.$fields[$i].'\', $_REQUEST[\''.$fields[$i].'\']);
		}
		';
		} else if ( $fields_param_type[$i] == 'XoopsFormUploadFile' ) {
			$text .= '
		include_once XOOPS_ROOT_PATH.\'/class/uploader.php\';
		$uploaddir = XOOPS_UPLOAD_PATH.\'/'.$mod_name.'/files/'.$table_name.'/\';
		$uploader = new XoopsMediaUploader($uploaddir, xoops_getModuleOption(\'mimetypes\', \''.$mod_name.'\'),
												       xoops_getModuleOption(\'maxsize\', \''.$mod_name.'\'), null, null);
		if ($uploader->fetchMedia($_POST[\'xoops_upload_file\'][0])) {
			$uploader->setPrefix(\''.$fields[$i].'_\') ;
			$uploader->fetchMedia($_POST[\'xoops_upload_file\'][0]);
			if (!$uploader->upload()) {
				$errors = $uploader->getErrors();
				redirect_header(\'javascript:history.go(-1)\', 3, $errors);
			} else {
				$obj->setVar("'.$fields[$i].'", $uploader->getSavedFileName());
			}
		}
		';
				} else {
					$text .= '
		$obj->setVar(\''.$fields[$i].'\', $_REQUEST[\''.$fields[$i].'\']);';	
				}
			}
		}		
	}
	return $text;
}

function form_elements($i, $mod_name, $table_name, $table_fieldname, $table_category, $fpe, $fprf, $lng_form, $struct0)
{
	$lng = '_AM_'.strtoupper($mod_name).'_';
	$required_field = ( $fprf[$i] == 1) ? 'true' : 'false';
	$text = '';
	switch ($fpe[$i])
	{	
		case "0":
		break;
		
		case "XoopsFormText":
			$text .= '// '.ucfirst($struct0).'	
		$form->addElement(new XoopsFormText('.$lng_form.', \''.$struct0.'\', 50, 255, $this->getVar(\''.$struct0.'\')), '.$required_field.');
		';
		break;
		
		case "XoopsFormTextArea":
			$text .= '// '.ucfirst($struct0).'
		$form->addElement(new XoopsFormTextArea('.$lng_form.', \''.$struct0.'\', $this->getVar(\''.$struct0.'\'), 4, 47), '.$required_field.');
		';
		break;
		
		case "XoopsFormDhtmlTextArea":
			$text .= '// '.ucfirst($struct0).'
		$editor_configs = array();
		$editor_configs[\'name\'] = \''.$struct0.'\';
		$editor_configs[\'value\'] = $this->getVar(\''.$struct0.'\', \'e\');
		$editor_configs[\'rows\'] = 5;
		$editor_configs[\'cols\'] = 40;
		$editor_configs[\'width\'] = \'100%\';
		$editor_configs[\'height\'] = \'400px\';
		$editor_configs[\'editor\'] = xoops_getModuleOption(\''.$mod_name.'_editor\', \''.$mod_name.'\');			
		$form->addElement( new XoopsFormEditor('.$lng_form.', \''.$struct0.'\', $editor_configs), true );
		';
		break;
		
		case "XoopsFormCheckBox":
		$text .= '// '.ucfirst($struct0).'
		$'.$struct0.' = $this->isNew() ? 0 : $this->getVar(\''.$struct0.'\');
		$check_'.$struct0.' = new XoopsFormCheckBox('.$lng_form.', \''.$struct0.'\', $'.$struct0.');
		$check_'.$struct0.'->addOption(1, " ");
		$form->addElement($check_'.$struct0.');
		';
		break;
		
		case "XoopsFormHidden":
			$text .= '// '.ucfirst($struct0).'
		$form->addElement(new XoopsFormHidden(\''.$struct0.'\', $this->getVar(\''.$struct0.'\')));
		';
		break;
		
		case "XoopsFormUploadImage":
			$text .= '// '.ucfirst($struct0).'
		$'.$struct0.' = $this->getVar(\''.$struct0.'\') ? $this->getVar(\''.$struct0.'\') : \'blank.gif\';
	
		$uploadir = \'/uploads/'.$mod_name.'/images/'.$table_name.'\';
		$imgtray = new XoopsFormElementTray('.$lng_form.',\'<br />\');
		$imgpath = sprintf('.$lng.'FORMIMAGE_PATH, $uploadir);
		$imageselect = new XoopsFormSelect($imgpath, \''.$struct0.'\', $'.$struct0.');
		$image_array = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . $uploadir );
		foreach( $image_array as $image ) {
			$imageselect->addOption("{$image}", $image);
		}
		$imageselect->setExtra( "onchange=\'showImgSelected(\"image_'.$struct0.'\", \"'.$struct0.'\", \"".$uploadir."\", \"\", \"".XOOPS_URL."\")\'" );
		$imgtray->addElement($imageselect);
		$imgtray->addElement( new XoopsFormLabel( \'\', "<br /><img src=\'".XOOPS_URL."/".$uploadir."/".$'.$struct0.'."\' name=\'image_'.$struct0.'\' id=\'image_'.$struct0.'\' alt=\'\' />" ) );		
		$fileseltray = new XoopsFormElementTray(\'\',\'<br />\');
		$fileseltray->addElement(new XoopsFormFile('.$lng.'FORMUPLOAD , \''.$struct0.'\', xoops_getModuleOption(\'maxsize\')));
		$fileseltray->addElement(new XoopsFormLabel(\'\'));
		$imgtray->addElement($fileseltray);
		$form->addElement($imgtray);
		';
		break;
		
		case "XoopsFormUploadFile":
			$text .= '// '.ucfirst($struct0).'
		$form->addElement(new XoopsFormFile('.$lng_form.', \''.$struct0.'\', $xoopsModuleConfig[\'maxsize\']), '.$required_field.');	
		';
		break;
		
		case "XoopsFormColorPicker":
			$text .= '// '.ucfirst($struct0).'
		$form->addElement(new XoopsFormColorPicker('.$lng_form.', \''.$struct0.'\', $this->getVar(\''.$struct0.'\')), '.$required_field.');
		';
		break;
		
		case "XoopsFormSelectUser":
			$text .= '// '.ucfirst($struct0).'
		$form->addElement(new XoopsFormSelectUser('.$lng_form.', \''.$struct0.'\', false, $this->getVar(\''.$struct0.'\'), 1, false), '.$required_field.');
		';
		break;
		
		case "XoopsFormCategory":		
			$text .= '// '.ucfirst($struct0).'				
		include_once(XOOPS_ROOT_PATH . \'/class/tree.php\');				
		$categoriesHandler = xoops_getModuleHandler(\'categories\', \''.$mod_name.'\' );
		$criteria = new CriteriaCompo();
		$categories = $categoriesHandler->getObjects( $criteria );
		if($categories) {
			$categories_tree = new XoopsObjectTree( $categories, \'cat_id\', \'cat_pid\' );
			$cat_pid = $categories_tree->makeSelBox( \'cat_pid\', \'cat_title\',\'--\', $this->getVar(\'cat_pid\', \'e\' ), true );
			$form->addElement( new XoopsFormLabel ( '.$lng_form.', $cat_pid ) );
		}
		';	
		break;
		
		case "XoopsFormRadioYN":
			$text .= '// '.ucfirst($struct0).' 
		$'.$struct0.' = $this->isNew() ? 0 : $this->getVar(\''.$struct0.'\');
		$form->addElement(new XoopsFormRadioYN('.$lng_form.', \''.$struct0.'\', $'.$struct0.'), '.$required_field.');
		';
		break;
		
		case "XoopsFormTextDateSelect":
			$text .= '// '.ucfirst($struct0).'
		$form->addElement(new XoopsFormTextDateSelect('.$lng_form.', \''.$struct0.'\', \'\', $this->getVar(\''.$struct0.'\')));
		';
		break;
		
		case "default":
		default:
			$data = explode('-', $fpe[$i]);        		
		$text .= '// '.ucfirst($struct0).'
		$'.$data[1].'Handler =& xoops_getModuleHandler(\''.$data[1].'\', \''.$mod_name.'\');				
		$'.$data[1].'_id_select = new XoopsFormSelect('.$lng_form.', \''.$struct0.'\', $this->getVar(\''.$struct0.'\'));
		$'.$data[1].'_id_select->addOptionArray($'.$data[1].'Handler->getList());
		$form->addElement($'.$data[1].'_id_select, true);
		';
		break;
	}
	return $text;
}

function search_field($fields_param_search_field, $options)
{
	$nb_fields_param_search_field = count($fields_param_search_field);
	$sql = '(';
	for($l=0; $l<$nb_fields_param_search_field; $l++)
	{
		if ( $l != $nb_fields_param_search_field - 1 ) {
			$sql .= ''.$fields_param_search_field[$l].' LIKE \'%$queryarray['.$options.']%\' OR ';
		} else {
			$sql .= ''.$fields_param_search_field[$l].' LIKE \'%$queryarray[0]%\'';
		}
	}
	$sql .= ')';
	return $sql;
}	

function UcFirstAndToLower($str)
{
	 return ucfirst(strtolower(trim($str)));
}

function createFile($path, $text, $lng_ok, $lng_notok, $file, $class = 'even', $mode = 'w+')
{
    global $pathIcon16;
    //Integration du contenu du file
	$handle = fopen($path , $mode);
	echo '<tr class="'.$class.'">';
	if (is_writable($path))
	{
		if (fwrite($handle, $text) === false) {
		 echo '<td style="padding-left: 30px;">'.sprintf($lng_notok, $file).'</td>
				<td>&nbsp;</td>
	            <td class="center"><img src='. $pathIcon16 .'/off.png></td>';
			exit;
		}
		echo '<td style="padding-left: 30px;">'.sprintf($lng_ok, $file).'</td>
				<td class="center"><img src='. $pathIcon16 .'/on.png></td>
				<td>&nbsp;</td>';	   
		fclose($handle);   
	} else {
		echo '<td style="padding-left: 30px;">'.sprintf($lng_notok, $file).'</td>
              <td>&nbsp;</td>
			  <td class="center"><img src='. $pathIcon16 .'/off.png></td>';
	}
    echo '</tr>';		
}