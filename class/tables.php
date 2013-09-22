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
if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class TDMCreateTables extends XoopsObject
{ 
	//Constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar('table_id',XOBJ_DTYPE_INT,null,false,5);
		$this->initVar('table_mid',XOBJ_DTYPE_INT,null,false, 5);
		$this->initVar('table_category',XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar('table_name',XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar('table_fieldname',XOBJ_DTYPE_TXTBOX,null,false);        
		$this->initVar('table_image',XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar('table_nbfields',XOBJ_DTYPE_INT,null,false);
		$this->initVar('table_fields',XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar('table_parameters',XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar('table_blocks',XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar('table_admin',XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar('table_user',XOBJ_DTYPE_INT,null,false, 1);	
		$this->initVar('table_status',XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar('table_waiting',XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar('table_online',XOBJ_DTYPE_INT,null,false, 1);	
		$this->initVar('table_search',XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar('table_comments',XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar('table_notifications',XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar('table_permissions',XOBJ_DTYPE_INT,null,false, 1);
	}	

	//Formulaire de saisi de fields
    function getFormFields($action = false, $table_id, $table_mid, $table_name, $table_fieldname, $table_blocks, $table_admin, $table_user, $table_status, $table_waiting, $table_online, $table_search, $table_comments, $table_notifications, $table_permissions, $table_nbfields, $select)
    {
		global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
        if ($action === false) {
            $action = XOOPS_URL.'/modules/TDMCreate/admin/tables.php';
        }
		$class = 'even';
        $title = $this->isNew() ? sprintf(_AM_TDMCREATE_TABLES_FIELDS_ADD) : sprintf(_AM_TDMCREATE_TABLES_FIELDS_EDIT);

        $table_actions = $table_mid.'&table_id='.$table_id.'&table_name='.$table_name.'&table_fieldname='.$table_fieldname.'&table_blocks='.$table_blocks.'&table_admin='.$table_admin.'&table_user='.$table_user.'&table_status='.$table_status.'&table_waiting='.$table_waiting.'&table_online='.$table_online.'&table_search='.$table_search.'&table_comments='.$table_comments.'&table_notifications='.$table_notifications.'&table_permissions='.$table_permissions.'&table_nbfields='.$table_nbfields.'&select='.$select;

        echo "<FORM Method='POST' Action='".$action."?op=save_table&table_mid=".$table_actions."'>
				<table border='0'  width='100%' cellspacing='1' class='outer'>
					<tr>
						<td colspan='8' class='head' align='center'>".$title."</td>
					</tr>
					<tr class='head'>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_NAME."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_TYPE."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_VALUE."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_ATTRIBUTES."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_NULL."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_DEFAULT."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_INDEX."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_MORE."</td>
					</tr>";
					for($i=0; $i<$table_nbfields ; $i++)
					{
						$table_id = ( $i == 0 ) ? strtolower($table_fieldname).'_id' : strtolower($table_fieldname).'_';
						$table_primary = ( $i == 0 ) ? "checked" : "";
						$table_value = ( $i == 0 ) ? "8" : "";
						
						$class = ($class == 'even') ? 'odd' : 'even';
						echo "<tr class=".$class.">
								<td align='center'><INPUT type='text' size='10' value='".$table_id."' name='fields_name[".$i."]'></td>
								<td align='center'><SELECT name='fields_type[".$i."]'>
										<OPTION VALUE='int'>INT</OPTION>
										<OPTION VALUE='tinyint'>TINYINT</OPTION>
										<OPTION VALUE='mediumint'>MEDIUMINT</OPTION>
										<OPTION VALUE='smallint'>SMALLINT</OPTION>
										<OPTION VALUE='float'>FLOAT</OPTION>
										<OPTION VALUE='double'>DOUBLE</OPTION>
										<OPTION VALUE='decimal'>DECIMAL</OPTION>										
										<OPTION VALUE='set'>SET</OPTION>
                                        <OPTION VALUE='enum'>ENUM</OPTION>										
										<OPTION VALUE='email'>EMAIL</OPTION>
										<OPTION VALUE='url'>URL</OPTION>										
										<OPTION VALUE='char'>CHAR</OPTION>																	
										<OPTION VALUE='varchar'>VARCHAR</OPTION>
										<OPTION VALUE='text'>TEXT</OPTION>
										<OPTION VALUE='tinytext'>TINYTEXT</OPTION>
										<OPTION VALUE='mediumtext'>MEDIUMTEXT</OPTION>
										<OPTION VALUE='longtext'>LONGTEXT</OPTION>
										<OPTION VALUE='date'>DATE</OPTION>
										<OPTION VALUE='datetime'>DATETIME</OPTION>
										<OPTION VALUE='timestamp'>TIMESTAMP</OPTION>
										<OPTION VALUE='time'>TIME</OPTION>
										<OPTION VALUE='year'>YEAR</OPTION>
									</SELECT></td>
								<td align='center'><INPUT type='text' size='2' name='fields_value[".$i."]' value='".$table_value."'></td>
								<td align='center'><SELECT name='fields_attributes[".$i."]'>
										<OPTION VALUE=''></OPTION>
										<OPTION VALUE='unsigned'>UNSIGNED</OPTION>
										<OPTION VALUE='ON UPDATE CURRENT_TIMESTAMP'>on update CURRENT_TIMESTAMP</OPTION>
									</SELECT></td>
								<td align='center'><SELECT name='fields_null[".$i."]'>
										<OPTION VALUE='not null'>NOT NULL</OPTION>
										<OPTION VALUE='null'>NULL</OPTION>
									</SELECT></td>
								<td align='center'><INPUT type='text' size='2' name='fields_default[".$i."]'></td>
								<td align='center'><SELECT name='fields_index[".$i."]'>
										<OPTION VALUE=''></OPTION>
										<OPTION VALUE='primary'>PRIMARY</OPTION>
										<OPTION VALUE='unique'>UNIQUE</OPTION>
										<OPTION VALUE='index'>INDEX</OPTION>
										<OPTION VALUE='fulltext'>FULLTEXT</OPTION>
									</SELECT></td>
								<td align='center'>";
								if ( $i != 0 ) {
									echo "<table border='0' style='border-color:#666666'; width='100%' cellspacing='1' class='outer'>
											<tr>
												<td align='left' class='head' width='95%'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_ELEMENTS."</td>
												<td align='right' class='even' width='5%'>
													<SELECT name='fields_param_elements[".$i."]'>
														<OPTION VALUE='XoopsFormText'>Text</OPTION>
														<OPTION VALUE='XoopsFormTextArea'>TextArea</OPTION>
														<OPTION VALUE='XoopsFormDhtmlTextArea'>DhtmlTextArea</OPTION>
														<OPTION VALUE='XoopsFormCheckBox'>CheckBox</OPTION>
														<OPTION VALUE='XoopsFormRadioYN'>RadioYN</OPTION>
														<OPTION VALUE='XoopsFormSelectUser'>SelectUser</OPTION>
														<OPTION VALUE='XoopsFormColorPicker'>ColorPicker</OPTION>
														<OPTION VALUE='XoopsFormUploadImage'>UploadImage</OPTION>
														<OPTION VALUE='XoopsFormUploadFile'>UploadFile</OPTION>
														<OPTION VALUE='XoopsFormTextDateSelect'>TextDateSelect</OPTION>";
														$tablesHandler =& xoops_getModuleHandler('tables', 'TDMCreate');
														$criteria = new CriteriaCompo();
														$criteria->add(new Criteria('table_mid', $table_mid));
														$criteria->setSort('table_name');
														$criteria->setOrder('ASC');
														$table_arr1 = $tablesHandler->getAll($criteria);
														
														foreach (array_keys($table_arr1) as $j) 
														{                                  
															$table_name1 = $table_arr1[$j]->getVar('table_name');
															if ( $table_name1 != 'categories' ) {
																if ( $table_name1 != $table_name )
																{
																	echo "<OPTION VALUE='XoopsFormTables-".$table_name1."'>Table : ".$table_name1."</OPTION>";
																}
															} else {
																echo "<OPTION VALUE='XoopsFormCategory'>Table : categories</OPTION>";
															}	
														}														
													echo "
													</SELECT>
												</td>											
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_DISPLAY_ADMIN."</td>
												<td align='right' class='even'><INPUT type='checkbox' size='4' name='fields_param_admin[".$i."]' checked></td>
											</tr>
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_DISPLAY_USER."</td>
												<td align='right' class='even'><INPUT type='checkbox' size='4' name='fields_param_user[".$i."]' checked></td>
											</tr>
											";
											//Afficher la case blocks
											if ( $table_blocks == 1 ) 
											{
												//Pour l'affichage dans les blocks
												$checked_blocks = ( $i == 1 || $i == 2 ) ? "checked" : "";
												echo "<tr>
														<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_BLOC."</td>
														<td align='right' class='even'><INPUT type='checkbox' size='4' name='fields_param_blocks[".$i."]' ".$checked_blocks."></td>
													  </tr>";
											}
											$checked_main_field = ( $i == 1 ) ? "checked" : "";
											echo "
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_MAIN_FIELD."</td>
												<td align='right' class='even'><INPUT type='radio'  value='".$i."' name='fields_param_main_field' ".$checked_main_field."></td>
											</tr>";
											
											//Afficher la case blocks
											if ( $table_blocks == 1 ) 
											{
												echo "
												<tr>
													<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_SEARCH."</td>
													<td align='right' class='even'><INPUT type='checkbox' size='4' name='fields_param_search_field[".$i."]' checked></td>
												</tr>";
											}
											echo "
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_REQUIRED."</td>
												<td align='right' class='even'><INPUT type='checkbox' size='4' name='fields_param_required_field[".$i."]' checked></td>
											</tr>											
										</table>";
								}
						echo "</td></tr>";
					}
			  echo "<tr>
						<td colspan='8' class='head' align='right'><input type='submit' value="._AM_TDMCREATE_ADMIN_SUBMIT."></td>
					</tr>";
		  echo "</table>
			  </FORM>";
	}
	
	//Form to Edit Fields
    function getFormEditFields($action = false, $table_id)
    {
		global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
        if ($action === false) {
            $action = XOOPS_URL.'/modules/TDMCreate/admin/tables.php';
        }
		$class = 'even';
        $title = $this->isNew() ? sprintf(_AM_TDMCREATE_TABLES_FIELDS_ADD) : sprintf(_AM_TDMCREATE_TABLES_FIELDS_EDIT);
		//Donnees
		//$table_id = $this->getVar('table_id');
		$table_mid = $this->getVar('table_mid');
		$table_name = $this->getVar('table_name');
		$table_fieldname = $this->getVar('table_fieldname');
        $table_category = $this->getVar('table_category');
		$table_image = $this->getVar('table_image');
		$table_nbfields = $this->getVar('table_nbfields');
		$table_fields = $this->getVar('table_fields');
		$table_parameters = $this->getVar('table_parameters');
		$table_blocks = $this->getVar('table_blocks');
		$table_admin = $this->getVar('table_admin');
		$table_user = $this->getVar('table_user');
        $table_status = $this->getVar('table_status');
        $table_waiting = $this->getVar('table_waiting');
        $table_online = $this->getVar('table_online');		
		$table_search = $this->getVar('table_search');
		$table_comments = $this->getVar('table_comments');
		$table_notifications = $this->getVar('table_notifications');
		$table_permissions = $this->getVar('table_permissions');
		$select = 0;
		
		$fields_total = explode("|", $table_fields);
		$count_fields = count($fields_total);
				
		$parameters_total = explode("|", $table_parameters);
		$count_parameters = count($parameters_total);
		
		//echo $count_parameters;
		//fields
		for($i=0; $i<$table_nbfields; $i++)
		{
			if ( $i >= $count_fields ) {
				$fields_name[$i] = '';
				$fields_type[$i] = '';
				$fields_value[$i] = '';
				$fields_attributes[$i] = '';
				$fields_null[$i] = '';
				$fields_default[$i] = '';
				$fields_index[$i] = '';
			} else {
				$fields = explode(":", $fields_total[$i]);
			
				$fields_name[$i] = $fields[0];
				$fields_type[$i] = $fields[1];
				$fields_value[$i] = $fields[2];
				$fields_attributes[$i] = $fields[3];
				$fields_null[$i] = $fields[4];
				$fields_default[$i] = $fields[5];
				$fields_index[$i] = $fields[6];
			}
		}
		//parameters
		for($i=0; $i<$table_nbfields; $i++)
		{
			if ( $i == 0 || $i > $count_parameters) {
				$param_elements[$i] = '0';				
				$param_display_admin[$i] = '0';
				$param_display_user[$i] = '0';
				$param_display_blocks[$i] = '0';
			} else {
				$parameters = explode(":", $parameters_total[$i-1]);
				$param_elements[$i] = $parameters[0];				
				$param_display_admin[$i] = $parameters[1];
				$param_display_user[$i] = $parameters[2];
				$param_display_blocks[$i] = $parameters[3];
				$param_display_main_field[$i] = $parameters[4];
				$fields_param_search_field[$i] = $parameters[5];
				$fields_param_required_field[$i] = $parameters[6];
			}
		}
        $table_action = $table_mid.'&table_id='.$table_id.'&table_name='.$table_name.'&table_fieldname='.$table_fieldname.'&table_blocks='.$table_blocks.'&table_display_admin='.$table_admin.'&table_display_user='.$table_user.'&table_status='.$table_status.'&table_waiting='.$table_waiting.'&table_online='.$table_online.'&table_search='.$table_search.'&table_comments='.$table_comments.'&table_notifications='.$table_notifications.'&table_permissions='.$table_permissions.'&table_nbfields='.$table_nbfields.'&select='.$select;

        echo "<FORM Method='POST' Action='".$action."?op=save_table&table_mid=".$table_action."'>
				<table border='0'  width='100%' cellspacing='1' class='outer'>
					<tr>
						<td colspan='8' class='head' align='center'>".$title."</td>
					</tr>
					<tr class='head'>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_NAME."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_TYPE."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_VALUE."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_ATTRIBUTES."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_NULL."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_DEFAULT."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_INDEX."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_FIELDS_MORE."</td>
					</tr>";
					for($i=0; $i<$table_nbfields ; $i++)
					{						
						$class = ($class == 'even') ? 'odd' : 'even';
						echo "<tr class=".$class.">
								<td align='center'><INPUT type='text' size='9' value='".$fields_name[$i]."' name='fields_name[".$i."]'></td>
								<td align='center'><SELECT name='fields_type[".$i."]'>";
									if ( $fields_type[$i] == 'int' ) {
										echo "<OPTION VALUE='int' selected>INT</OPTION>";
									} else {
										echo "<OPTION VALUE='int'>INT</OPTION>";
									}
									if ( $fields_type[$i] == 'tinyint' ) {
										echo "<OPTION VALUE='tinyint' selected>TINYINT</OPTION>";
									} else {
										echo "<OPTION VALUE='tinyint'>TINYINT</OPTION>";
									}
									if ( $fields_type[$i] == 'mediumint' ) {
										echo "<OPTION VALUE='mediumint' selected>MEDIUMINT</OPTION>";
									} else {
										echo "<OPTION VALUE='mediumint'>MEDIUMINT</OPTION>";
									}
									if ( $fields_type[$i] == 'smallint' ) {
										echo "<OPTION VALUE='smallint' selected>SMALLINT</OPTION>";
									} else {
										echo "<OPTION VALUE='smallint'>SMALLINT</OPTION>";
									}
									if ( $fields_type[$i] == 'float' ) {
										echo "<OPTION VALUE='float' selected>FLOAT</OPTION>";
									} else {
										echo "<OPTION VALUE='float'>FLOAT</OPTION>";
									}
									if ( $fields_type[$i] == 'double' ) {
										echo "<OPTION VALUE='double' selected>DOUBLE</OPTION>";
									} else {
										echo "<OPTION VALUE='double'>DOUBLE</OPTION>";
									}
									if ( $fields_type[$i] == 'decimal' ) {
										echo "<OPTION VALUE='decimal' selected>DECIMAL</OPTION>";
									} else {
										echo "<OPTION VALUE='decimal'>DECIMAL</OPTION>";
									}
									if ( $fields_type[$i] == 'set' ) {
										echo "<OPTION VALUE='set' selected>SET</OPTION>";
									} else {
										echo "<OPTION VALUE='set'>SET</OPTION>";
									}
									if ( $fields_type[$i] == 'enum' ) {
										echo "<OPTION VALUE='enum' selected>ENUM</OPTION>";
									} else {
										echo "<OPTION VALUE='enum'>ENUM</OPTION>";
									}
									if ( $fields_type[$i] == 'email' ) {
										echo "<OPTION VALUE='email' selected>EMAIL</OPTION>";
									} else {
										echo "<OPTION VALUE='email'>EMAIL</OPTION>";
									}
									if ( $fields_type[$i] == 'url' ) {
										echo "<OPTION VALUE='url' selected>URL</OPTION>";
									} else {
										echo "<OPTION VALUE='url'>URL</OPTION>";
									}
									if ( $fields_type[$i] == 'char' ) {
										echo "<OPTION VALUE='char' selected>CHAR</OPTION>";
									} else {
										echo "<OPTION VALUE='char'>CHAR</OPTION>";
									}
									if ( $fields_type[$i] == 'varchar' ) {
										echo "<OPTION VALUE='varchar' selected>VARCHAR</OPTION>";
									} else {
										echo "<OPTION VALUE='varchar'>VARCHAR</OPTION>";
									}
									if ( $fields_type[$i] == 'text' ) {
										echo "<OPTION VALUE='text' selected>TEXT</OPTION>";
									} else {
										echo "<OPTION VALUE='text'>TEXT</OPTION>";
									}
									if ( $fields_type[$i] == 'tinytext' ) {
										echo "<OPTION VALUE='tinytext' selected>TINYTEXT</OPTION>";
									} else {
										echo "<OPTION VALUE='tinytext'>TINYTEXT</OPTION>";
									}
									if ( $fields_type[$i] == 'mediumtext' ) {
										echo "<OPTION VALUE='mediumtext' selected>MEDIUMTEXT</OPTION>";
									} else {
										echo "<OPTION VALUE='mediumtext'>MEDIUMTEXT</OPTION>";
									}
									if ( $fields_type[$i] == 'longtext' ) {
										echo "<OPTION VALUE='longtext' selected>LONGTEXT</OPTION>";
									} else {
										echo "<OPTION VALUE='longtext'>LONGTEXT</OPTION>";
									}
									if ( $fields_type[$i] == 'date' ) {
										echo "<OPTION VALUE='date' selected>DATE</OPTION>";
									} else {
										echo "<OPTION VALUE='date'>DATE</OPTION>";
									}
									if ( $fields_type[$i] == 'datetime' ) {
										echo "<OPTION VALUE='datetime' selected>DATETIME</OPTION>";
									} else {
										echo "<OPTION VALUE='datetime'>DATETIME</OPTION>";
									}
									if ( $fields_type[$i] == 'timestamp' ) {
										echo "<OPTION VALUE='timestamp' selected>TIMESTAMP</OPTION>";
									} else {
										echo "<OPTION VALUE='timestamp'>TIMESTAMP</OPTION>";
									}
									if ( $fields_type[$i] == 'time' ) {
										echo "<OPTION VALUE='time' selected>TIME</OPTION>";
									} else {
										echo "<OPTION VALUE='time'>TIME</OPTION>";
									}
									if ( $fields_type[$i] == 'year' ) {
										echo "<OPTION VALUE='year' selected>YEAR</OPTION>";
									} else {
										echo "<OPTION VALUE='year'>YEAR</OPTION>";
									}
									echo "
									</SELECT></td>
								<td align='center'><INPUT type='text' size='2' name='fields_value[".$i."]' value='".$fields_value[$i]."'></td>
								<td align='center'><SELECT name='fields_attributes[".$i."]'>";
									if ( $fields_attributes[$i] == '' ) {
										echo "<OPTION VALUE='' selected></OPTION>";
									} else {
										echo "<OPTION VALUE=''></OPTION>";
									}
									if ( $fields_attributes[$i] == 'unsigned' ) {
										echo "<OPTION VALUE='unsigned' selected>UNSIGNED</OPTION>";
									} else {
										echo "<OPTION VALUE='unsigned'>UNSIGNED</OPTION>";
									}
									if ( $fields_attributes[$i] == 'unsigned zerofill' ) {
										echo "<OPTION VALUE='ON UPDATE CURRENT_TIMESTAMP' selected>CURRENT_TIMESTAMP</OPTION>";
									} else {
										echo "<OPTION VALUE='ON UPDATE CURRENT_TIMESTAMP'>CURRENT_TIMESTAMP</OPTION>";
									}
								
								echo "</SELECT></td>
								<td align='center'><SELECT name='fields_null[".$i."]'>";
									if ( $fields_null[$i] == 'not null' ) {
										echo "<OPTION VALUE='NOT NULL' selected>not null</OPTION>";
									} else {
										echo "<OPTION VALUE='not null'>NOT NULL</OPTION>";
									}
									if ( $fields_null[$i] == 'NULL' ) {
										echo "<OPTION VALUE='null' selected>NULL</OPTION>";
									} else {
										echo "<OPTION VALUE='null'>NULL</OPTION>";
									}
								echo "</SELECT></td>
								<td align='center'><INPUT type='text' size='2' name='fields_default[".$i."]' value='".$fields_default[$i]."'></td>
								<td align='center'><SELECT name='fields_index[".$i."]'>";
									if ( $fields_index[$i] == '' ) {
										echo "<OPTION VALUE='' selected></OPTION>";
									} else {
										echo "<OPTION VALUE=''></OPTION>";
									}
									if ( $fields_index[$i] == 'primary' ) {
										echo "<OPTION VALUE='primary' selected>PRIMARY</OPTION>";
									} else {
										echo "<OPTION VALUE='primary'>PRIMARY</OPTION>";
									}
									if ( $fields_index[$i] == 'unique' ) {
										echo "<OPTION VALUE='unique' selected>UNIQUE</OPTION>";
									} else {
										echo "<OPTION VALUE='unique'>UNIQUE</OPTION>";
									}
									if ( $fields_index[$i] == 'index' ) {
										echo "<OPTION VALUE='index' selected>INDEX</OPTION>";
									} else {
										echo "<OPTION VALUE='index'>INDEX</OPTION>";
									}
									if ( $fields_index[$i] == 'fulltext' ) {
										echo "<OPTION VALUE='fulltext' selected>FULLTEXT</OPTION>";
									} else {
										echo "<OPTION VALUE='fulltext'>FULLTEXT</OPTION>";
									}
									echo "										
									</SELECT></td>
								<td align='center' width='30%'>";
								if ( $i != 0 ) {
									echo "<table border='0' style='border-color:#666666'; width='100%' cellspacing='1' class='outer'>
											<tr>
												<td align='left' class='head' width='95%'>Form : Elements</td>
												<td align='right' class='even' width='5%'>
													<SELECT name='fields_param_elements[".$i."]'>";
												if ( $param_elements[$i] == 'XoopsFormText' ) {
													echo "<OPTION VALUE='XoopsFormText' selected>Text</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormText'>Text</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormTextArea' ) {
													echo "<OPTION VALUE='XoopsFormTextArea' selected>TextArea</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormTextArea'>TextArea</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormDhtmlTextArea' ) {
													echo "<OPTION VALUE='XoopsFormDhtmlTextArea' selected>DhtmlTextArea</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormDhtmlTextArea'>DhtmlTextArea</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormCheckBox' ) {
													echo "<OPTION VALUE='XoopsFormCheckBox' selected>CheckBox</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormCheckBox'>CheckBox</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormRadioYN' ) {
													echo "<OPTION VALUE='XoopsFormRadioYN' selected>RadioYN</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormRadioYN'>RadioYN</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormSelectUser' ) {
													echo "<OPTION VALUE='XoopsFormSelectUser' selected>SelectUser</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormSelectUser'>SelectUser</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormColorPicker' ) {
													echo "<OPTION VALUE='XoopsFormColorPicker' selected>ColorPicker</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormColorPicker'>ColorPicker</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormUploadImage' ) {
													echo "<OPTION VALUE='XoopsFormUploadImage' selected>UploadImage</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormUploadImage'>UploadImage</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormUploadFile' ) {
													echo "<OPTION VALUE='XoopsFormUploadFile' selected>UploadFile</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormUploadFile'>UploadFile</OPTION>";
												}
										
												if ( $param_elements[$i] == 'XoopsFormTextDateSelect' ) {
													echo "<OPTION VALUE='XoopsFormTextDateSelect' selected>TextDateSelect</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormTextDateSelect'>TextDateSelect</OPTION>";
												}
												$tablesHandler =& xoops_getModuleHandler('tables', 'TDMCreate');
												$criteria = new CriteriaCompo();
												$criteria->add(new Criteria('table_mid', $table_mid));
												$criteria->setSort('table_name');
												$criteria->setOrder('ASC');
												$table_arr2 = $tablesHandler->getall($criteria);
												
												foreach (array_keys($table_arr2) as $j) 
												{                                  
													$table_name2 = $table_arr2[$j]->getVar('table_name');
													if ( $table_name2 != 'categories' ) {
														if ( $table_name2 != $table_name )
														{
															if ( $param_elements[$i] == 'XoopsFormTables-'.$table_name2 ) {
																echo "<OPTION VALUE='XoopsFormTables-".$table_name2."' selected>Table : ".$table_name2."</OPTION>";
															} else {
																echo "<OPTION VALUE='XoopsFormTables-".$table_name2."'>Table : ".$table_name2."</OPTION>";
															}
														}
													} else {
														if ( $param_elements[$i] == 'XoopsFormCategory' ) {
															echo "<OPTION VALUE='XoopsFormCategory' selected>Table : categories</OPTION>";
														} else {
															echo "<OPTION VALUE='XoopsFormCategory'>Table : categories</OPTION>";
														}
													}	
												}												
												echo "</SELECT>
												</td>											
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_DISPLAY_ADMIN."</td>
												<td align='right' class='even'>";
												if ( $param_display_admin[$i] == 1 ) {
													echo "<INPUT type='checkbox' size='4' name='fields_param_admin[".$i."]' checked>";
												} else {
													echo "<INPUT type='checkbox' size='4' name='fields_param_admin[".$i."]'>";
												}	
												echo "</td>
											</tr>
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_DISPLAY_USER."</td>
												<td align='right' class='even'>";
												if ( $param_display_user[$i] == 1 ) {
													echo "<INPUT type='checkbox' size='4' name='fields_param_user[".$i."]' checked>";
												} else {
													echo "<INPUT type='checkbox' size='4' name='fields_param_user[".$i."]'>";
												}
												echo "</td>
											</tr>
											";
											//Afficher la case blocks
											if ( $table_blocks == 1 ) 
											{
												echo "<tr>
														<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_BLOC."</td>
														<td align='right' class='even'>";
												if ( $param_display_blocks[$i] == 1 ) {
													echo "<INPUT type='checkbox' size='4' name='fields_param_blocks[".$i."]' checked>";
												} else {
													echo "<INPUT type='checkbox' size='4' name='fields_param_blocks[".$i."]'>";
												}
												echo "</td>
													  </tr>";
											}
											echo "
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_MAIN_FIELD."</td>
												<td align='right' class='even'>";
												if ( $param_display_main_field[$i] == 1 ) {
													echo "<INPUT type='radio' value='".$i."' name='fields_param_main_field' checked>";
												} else {
													echo "<INPUT type='radio' value='".$i."' name='fields_param_main_field'>";
												}
												echo "</td>
											</tr>";
											//Afficher la case recherche
											if ( $table_search == 1 ) 
											{
											echo "
												<tr>
													<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_SEARCH.",</td>
													<td align='right' class='even'>";
													if ( $fields_param_search_field[$i] == 1 ) {
														echo "<INPUT type='checkbox' size='4' name='fields_param_search_field[".$i."]' checked>";
													} else {
														echo "<INPUT type='checkbox' size='4' name='fields_param_search_field[".$i."]'>";
													}
													echo "</td>
												</tr>";
											}
											echo "
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_FIELDS_MORE_REQUIRED."</td>
												<td align='right' class='even'>";
												if ( $fields_param_required_field[$i] == 1 ) {
													echo "<INPUT type='checkbox' size='4' name='fields_param_required_field[".$i."]' checked>";
												} else {
													echo "<INPUT type='checkbox' size='4' name='fields_param_required_field[".$i."]'>";
												}
												echo "</td>
											</tr>
											
											</table>";
								}
						echo "</td></tr>";
					}
			  echo "<tr>
						<td colspan='8' class='head' align='right'><input type='submit' value="._AM_TDMCREATE_ADMIN_SUBMIT."></td>
					</tr>";
		  echo "</table>
			  </FORM>";
	}
	
	//Form creation of tables
    function getFormTable($action = false, $table_mid)
    {
		global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
        $pathIcon32 = '../' . $xoopsModule->getInfo('icons32');

        if ($action === false) {
			$action = XOOPS_URL.'/modules/TDMCreate/admin/tables.php?op=create_table&table_mid='.$table_mid;
			$sending = $this->isNew() ? 'table_fields' : 'table_save_fields';
        }
        $title = $this->isNew() ? sprintf(_AM_TDMCREATE_TABLES_ADD) : sprintf(_AM_TDMCREATE_TABLES_EDIT);       
		
        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
		?>
        <script type="text/javascript">
			/*function selectModule(sel) {
				var mod_id = sel.options[sel.selectedIndex].value;				
				var url = 'tables.php?op=create_table&table_mid='+mod_id;				
				if( sel.options[sel.selectedIndex].value.length > 0 )
				{ 
					document.location.href = url;
					mod_id.focus();
				}				
			}	
           
            $(document).ready(function () {
				locations = 'tables.php?op=create_table&table_mid='+$(this).val();
				$('select').change(function () {
					var url = locations[$('select > option:selected').index()];
					window.location.href = url;
				})
			
			function WebForm_InitCallback() {
				var count = theForm.elements.length;
				var element;
				for (var i = 0; i < count; i++) {
					element = theForm.elements[i];
					var tagName = element.tagName.toLowerCase();
					if (tagName == "input") {
						var type = element.type;
						if ((type == "text" || type == "hidden" || type == "password" ||
							((type == "checkbox" || type == "radio") && element.checked)) &&
							(element.id != "__EVENTVALIDATION")) {
							WebForm_InitCallbackAddField(element.name, element.value);
						}
					}
					else if (tagName == "select") {
						var selectCount = element.options.length;
						for (var j = 0; j < selectCount; j++) {
							var selectChild = element.options[j];
							if (selectChild.selected == true) {
								WebForm_InitCallbackAddField(element.name, element.value);
							}
						}
					}
					else if (tagName == "textarea") {
						WebForm_InitCallbackAddField(element.name, element.value);
					}
				}
			}
				
			});	*/		 
			$(function(){
				$('select').on('change', function(){
					windows.location.href = 'tables.php?op=create_table&table_mid='+$(this).val();
				});      
				/*$('select').blur(function(){
					window.location = $('option:selected', this).val();
				});*/  
			});
		</script>
		<?php
        $form = new XoopsThemeForm($title, 'form_tables', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');		
		$modulesHandler =& xoops_getModuleHandler('modules', 'TDMCreate');
    	$modules_select = new XoopsFormSelect(_AM_TDMCREATE_TABLES_MODULES, 'table_mid', $this->getVar('table_mid'));  		
		//$modules_select->setExtra('onchange="javascript:selectModule(this)"');	
		$modules_select->addOption('');		
		$modules_select->addOptionArray($modulesHandler->getList());		
    	$form->addElement($modules_select, true);
	    $form->addElement(new XoopsFormText(_AM_TDMCREATE_TABLES_NAME, 'table_name', 40, 155, $this->getVar('table_name')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_TABLES_FIELDNAME, 'table_fieldname', 20, 100, $this->getVar('table_fieldname')));
	    $form->addElement(new XoopsFormText(_AM_TDMCREATE_TABLES_NUMBER_FIELDS, 'table_nbfields', 5, 10, $this->getVar('table_nbfields')), true);	
	    // Category		
		$tablesHandler =& xoops_getModuleHandler('tables', 'TDMCreate');
        $criteria = new CriteriaCompo();
		$criteria->add(new Criteria('table_mid', $table_mid), 'AND');
		$criteria->add(new Criteria('table_category', 1));
        $table_category = $tablesHandler->getCount($criteria);
        unset($criteria);		
		if ( $table_category == 0 ) {
			$radio_category = $this->isNew() ? 0 : $this->getVar('table_category');
			$category = new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_CATEGORY, 'table_category', $radio_category);
			$category->setDescription(_AM_TDMCREATE_TABLES_CATEGORY_DESC);
			$form->addElement($category);
		}
		// Block
		$radio_blocks = $this->isNew() ? 0 : $this->getVar('table_blocks');
	    $form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_BLOCKS, 'table_blocks', $radio_blocks));
		// Admin
	    $radio_admin = $this->isNew() ? 0 : $this->getVar('table_admin');
	    $form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_ADMIN, 'table_admin', $radio_admin));
        // User
	    $radio_user = $this->isNew() ? 0 : $this->getVar('table_user');
	    $form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_USER, 'table_user', $radio_user));
        // Others
        $form->addElement(new XoopsFormLabel('', _AM_TDMCREATE_FORM_INFO_TABLE_OPTIONAL_FIELD));
	    $radio_status = $this->isNew() ? 0 : $this->getVar('table_status');
	    $form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_STATUS, 'table_status', $radio_status));
	    $radio_waiting = $this->isNew() ? 0 : $this->getVar('table_waiting');
	    $form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_WAITING, 'table_waiting', $radio_waiting));
	    $radio_online = $this->isNew() ? 0 : $this->getVar('table_online');
	    $form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_ONLINE, 'table_online', $radio_online));
        $form->addElement(new XoopsFormLabel('', _AM_TDMCREATE_FORM_INFO_TABLE_STRUCTURES_FIELD));		
		// Search
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('table_mid', $table_mid), 'AND');
		$criteria->add(new Criteria('table_search', 1));		
        $table_search = $tablesHandler->getCount($criteria);
        unset($criteria);	
		if ( $table_search == 0 ) {
			$radio_search = $this->isNew() ? 1 : $this->getVar('table_search');
			$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_SEARCH, 'table_search', $radio_search));
		}
		// Comments
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('table_mid', $table_mid), 'AND');
		$criteria->add(new Criteria('table_comments', 1));		
        $table_comments = $tablesHandler->getCount($criteria);
        unset($criteria);	
		if ( $table_comments == 0 ) {
			$radio_comments = $this->isNew() ? 1 : $this->getVar('table_comments');
			$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_COMMENTS, 'table_comments', $radio_comments));
		}		
		// Notifications
		$radio_notifications = $this->isNew() ? 0 : $this->getVar('table_notifications');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_NOTIFICATIONS, 'table_notifications', $radio_notifications));
		// Permissions
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('table_mid', $table_mid), 'AND');
		$criteria->add(new Criteria('table_permissions', 1));		
        $table_permissions = $tablesHandler->getCount($criteria);
        unset($criteria);		
		if ( $table_permissions == 0 ) {
			$radio_permissions = $this->isNew() ? 0 : $this->getVar('table_permissions');
			$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_PERMISSIONS, 'table_permissions', $radio_permissions));
		}
		$form->addElement(new XoopsFormLabel('', _AM_TDMCREATE_FORM_INFO_TABLE_ICON_FIELD));
		// Image
		$table_image = $this->getVar('table_image') ? $this->getVar('table_image') : 'blank.gif';
		
        if(	is_dir( $pathIcon32	))	{
            $uploadirectory = $pathIcon32;
		} else {
			$uploadirectory = "/modules/".$xoopsModule->dirname()."/images/uploads/tables";
		}

		$imgtray = new XoopsFormElementTray(_AM_TDMCREATE_TABLES_IMAGE,'<br />');
        if(is_dir($pathIcon32)){
		   $imgpath = sprintf(_AM_TDMCREATE_FORMIMAGE_PATH, ".$pathIcon32");
		}else{
		   $imgpath = sprintf(_AM_TDMCREATE_FORMIMAGE_PATH, './modules/'.$xoopsModule->dirname().'/images/uploads/tables');
		}

		$imageselect= new XoopsFormSelect($imgpath, 'table_image', $table_image, 8);
		//$table_image_array = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH.$uploadirectory );
        $table_image_array = XoopsLists :: getImgListAsArray( $uploadirectory );

		foreach( $table_image_array as $image ) {
			$imageselect->addOption("{$image}", $image);
		}

        ?>
        <script type="text/javascript">

        function showImgSelected2(imgId, selectId, imgDir, extra, xoopsUrl)
        {
			if (xoopsUrl == null) {
				xoopsUrl = "./";
			}
			imgDom = xoopsGetElementById(imgId);
			selectDom = xoopsGetElementById(selectId);
			if (selectDom.options[selectDom.selectedIndex].value != "") {
				imgDom.src = xoopsUrl + imgDir + "/" + selectDom.options[selectDom.selectedIndex].value + extra;
			} else {
				imgDom.src = xoopsUrl + "/images/blank.gif";
			}
        }
        </script>


        <?php

        $imageselect->setExtra( "onchange='showImgSelected2(\"image3\", \"table_image\", \"" . $uploadirectory . "\", \"\", \"" . '' . "\")'" );

		$imgtray->addElement($imageselect,false);
		//mb $imgtray -> addElement( new XoopsFormLabel( '', "<br /><img src='" . XOOPS_URL . "/" . $uploadirectory . "/" . $table_image . "' name='image3' id='image3' alt='' />" ) );
        $imgtray -> addElement( new XoopsFormLabel( '', "<br /><img src='" . $pathIcon32 . "/" . $table_image . "' name='image3' id='image3' alt='' />" ) );
	
		$fileseltray= new XoopsFormElementTray('','<br />');
		$fileseltray->addElement(new XoopsFormFile(_AM_TDMCREATE_FORMUPLOAD , 'attachedfile', 104857600),false);
		$fileseltray->addElement(new XoopsFormLabel(''), false);
		$imgtray->addElement($fileseltray);
		$form->addElement($imgtray);
		
		$form->addElement(new XoopsFormHidden('op', $sending));
        $form->addElement(new XoopsFormButton(_REQUIRED.' <span class="red bold">*</span>', 'submit', _SUBMIT, 'submit'));
		$form->display();
        return $form;
	}	
	
	//Form to create Category table
    function getFormCategory($action = false)
    {
		global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
		
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $title = $this->isNew() ? sprintf(_AM_TDMCREATE_TABLES_CATEGORY_ADD) : sprintf(_AM_TDMCREATE_TABLES_CATEGORY_EDIT);

        include_once(XOOPS_ROOT_PATH . '/class/xoopsformloader.php');

        $form = new XoopsThemeForm($title, 'form_modules', $action.'?op=save_table&select=1', 'post', true);
		$form->setExtra('enctype="multipart/form-data"');

		$modulesHandler =& xoops_getModuleHandler('modules', 'TDMCreate');
    	$modules_select = new XoopsFormSelect(_AM_TDMCREATE_TABLES_MODULES, 'table_mid', $this->getVar('table_mid'));
    	$modules_select->addOptionArray($modulesHandler->getList());
    	$form->addElement($modules_select, true);
		
		$form->addElement(new XoopsFormLabel('', _AM_TDMCREATE_FORM_INFO_TABLE_OPTIONAL_FIELD));
	    $select_status = $this->isNew() ? 0 : $this->getVar('table_status');
	    $form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_STATUS, 'table_status', $select_status));
	    $select_waiting = $this->isNew() ? 0 : $this->getVar('table_waiting');
	    $form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_WAITING, 'table_waiting', $select_waiting));
	    $select_online = $this->isNew() ? 0 : $this->getVar('table_online');
	    $form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_ONLINE, 'table_online', $select_online));
		$form->addElement(new XoopsFormLabel('', _AM_TDMCREATE_FORM_INFO_TABLE_ICON_FIELD));
		$table_image1 = $this->getVar('table_image') ? $this->getVar('table_image') : 'blank.gif';
		
        if(is_dir(XOOPS_ROOT_PATH . "/Frameworks/moduleclasses/icons/32/")) {
		   $uploadirectory1 = "/Frameworks/moduleclasses/icons/32";
		}else{
		   $uploadirectory1 = "/modules/".$xoopsModule->dirname()."/images/uploads/tables";
		}
		       
		$imgtray1 = new XoopsFormElementTray(_AM_TDMCREATE_TABLES_IMAGE,'<br />');
        if(is_dir(XOOPS_ROOT_PATH . "/Frameworks/moduleclasses/icons/32")){
		   $imgpath1 = sprintf(_AM_TDMCREATE_FORMIMAGE_PATH, "./Frameworks/moduleclasses/icons/32");
		}else{
		   $imgpath1 = sprintf(_AM_TDMCREATE_FORMIMAGE_PATH, "./modules/".$xoopsModule->dirname()."/images/uploads/tables");
		}
		
		$imageselect1= new XoopsFormSelect($imgpath1, 'table_image1', $table_image1, 8);
		$table_image_array1 = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH.$uploadirectory1 );
		foreach( $table_image_array1 as $image1 ) {
			$imageselect1->addOption("{$image1}", $image1);
		}
		$imageselect1->setExtra( "onchange='showImgSelected(\"image4\", \"table_image1\", \"" . $uploadirectory1 . "\", \"\", \"" . XOOPS_URL . "\")'" );
		$imgtray1->addElement($imageselect1,false);
		$imgtray1->addElement( new XoopsFormLabel( '', "<br /><img src='" . XOOPS_URL . "/" . $uploadirectory1 . "/" . $table_image1 . "' name='image4' id='image4' alt='' />" ) );
	
		$fileseltray1= new XoopsFormElementTray('','<br />');
		$fileseltray1->addElement(new XoopsFormFile(_AM_TDMCREATE_FORMUPLOAD , 'attachedfile1', 104857600),false);
		$fileseltray1->addElement(new XoopsFormLabel(''), false);
		$imgtray1->addElement($fileseltray1);
		$form->addElement($imgtray1);
		
		$form->addElement(new XoopsFormHidden('op', 'save_table'));
        $form->addElement(new XoopsFormButton(_REQUIRED.' <span class="red bold">*</span>', 'submit', _SUBMIT, 'submit'));
		$form->display();
        return $form;
	}
}

class TDMCreateTablesHandler extends XoopsPersistableObjectHandler 
{
    function __construct(&$db) 
    {
        parent::__construct($db, 'mod_tdmcreate_tables', 'tdmcreatetables', 'table_id', 'table_name');
    }
}