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
 * @version         $Id: const_admin_permissions.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_admin_permissions($modules, $table_name, $table_fields, $table_parameters)
{	
	$mod_name = $modules->getVar('mod_name');
	$language = '_AM_'.strtoupper($mod_name).'_PERMISSIONS_';
	$file = 'permissions.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/admin/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/admin/'.$file;
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
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\ninclude_once 'header.php';
include_once XOOPS_ROOT_PATH.'/class/xoopsform/grouppermform.php';
if( !empty(\$_POST['submit']) ) 
{
	redirect_header( XOOPS_URL.'/modules/'.\$xoopsModule->dirname().'/admin/permissions.php', 1, _MP_GPERMUPDATED );
}
// Check admin have access to this page
/*\$group = \$xoopsUser->getGroups ();
\$groups = xoops_getModuleOption ( 'admin_groups', \$thisDirname );
if (count ( array_intersect ( \$group, \$groups ) ) <= 0) {
	redirect_header ( 'index.php', 3, _NOPERM );
}*/

echo \$adminMenu->addNavigation('permissions.php');

\$permission = {$mod_name}_CleanVars(\$_POST, 'permission', 1, 'int');
\$selected = array('', '', '');
\$selected[\$permission-1] = ' selected';
	
echo "
<form method='post' name='fselperm' action='permissions.php'>
	<table border=0>
		<tr>
			<td>
				<select name='permission' onChange='javascript: document.fselperm.submit()'>					
					<option value='1'".\$selected[0].">".{$language}GLOBAL."</option>
					<option value='2'".\$selected[1].">".{$language}APPROVE."</option>
					<option value='3'".\$selected[2].">".{$language}SUBMIT."</option>
					<option value='4'".\$selected[3].">".{$language}VIEW."</option>
				</select>
			</td>
		</tr>
	</table>
</form>";

\$module_id = \$xoopsModule->getVar('mid');
switch(\$permission)
{
	case 1:
        \$formTitle = {$language}GLOBAL;
        \$permName = '{$mod_name}_ac';
        \$permDesc = {$language}GLOBAL_DESC;
        \$globalPerms = array(	'4' => {$language}GLOBAL_4,
								'8' => {$language}GLOBAL_8,
								'16' => {$language}GLOBAL_16 );
		break;
	case 2:
		\$formTitle = {$language}APPROVE;
		\$permName = '{$mod_name}_access';
		\$permDesc = {$language}APPROVE_DESC;
		break;
	case 3:
		\$formTitle = {$language}SUBMIT;
		\$permName = '{$mod_name}_submit';
		\$permDesc = {$language}SUBMIT_DESC;
		break;
	case 4:
		\$formTitle = {$language}VIEW;
		\$permName = '{$mod_name}_view';
		\$permDesc = {$language}VIEW_DESC;
		break;
}

\$permform = new XoopsGroupPermForm(\$formTitle, \$module_id, \$permName, \$permDesc, 'admin/permissions.php');
if (\$permission == 1) {
    foreach (\$globalPerms as \$perm_id => \$perm_name) {
        \$permform->addItem(\$perm_id, \$perm_name);		
    }
	echo \$permform->render();
	echo '<br /><br />';
} else {
    \$criteria = new CriteriaCompo();
	\$criteria->setSort('{$fpmf}');
	\$criteria->setOrder('ASC');
	\${$table_name}_count = \${$table_name}Handler->getCount(\$criteria);
	\${$table_name}_arr = \${$table_name}Handler->getObjects(\$criteria);
	unset(\$criteria);
    foreach (array_keys(\${$table_name}_arr) as \$i) {		
		\$permform->addItem(\${$table_name}_arr[\$i]->getVar('{$fpif}'), \${$table_name}_arr[\$i]->getVar('{$fpmf}'));		
	} 
	// Check if {$table_name} exist before rendering the form and redirect, if there aren't {$table_name}   
	if (\${$table_name}_count > 0) {		
		echo \$permform->render();
		echo '<br /><br />';
	} else {
		redirect_header ( '{$table_name}.php?op=new', 3, {$language}NOPERMSSET );
		exit ();
	}     
}
unset(\$permform);
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