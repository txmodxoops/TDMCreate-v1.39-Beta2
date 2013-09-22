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
 * @version         $Id: const_admin_index.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_admin_index($modules, $tables_arr)
{	
    $mod_name = $modules->getVar('mod_name');
	$language = '_AM_'.strtoupper($mod_name).'_';
	$thereare = $language.'THEREARE_';	
	$file = 'index.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/admin/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/admin/'.$file;
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\ninclude_once 'header.php';
EOT;
foreach (array_keys($tables_arr) as $i)
{
    $table_name = $tables_arr[$i]->getVar('table_name');
	$table_fieldname = $tables_arr[$i]->getVar('table_fieldname');
$text .= <<<EOT
\n//count "total {$table_name}"
\$total_{$table_name} = \${$table_name}Handler->getCount();
EOT;
	if(isset($_REQUEST['table_status'])) {
$text .= <<<EOT
\n//count "status"	
\$criteria = new CriteriaCompo();
\$criteria->add(new Criteria("{$table_fieldname}_status", 1));
\${$table_fieldname}_status = ${$table_name}Handler->getCount(\$criteria);
EOT;
	}
	if(isset($_REQUEST['table_online'])) {
$text .= <<<EOT
\n//count "online"	
\$criteria = new CriteriaCompo();
\$criteria->add(new Criteria("{$table_fieldname}_online", 1));
\${$table_fieldname}_online = ${$table_name}Handler->getCount(\$criteria);
EOT;
	}
	if(isset($_REQUEST['table_waiting'])) {
$text .= <<<EOT
\n\$criteria = new CriteriaCompo();
\$criteria->add(new Criteria("{$table_fieldname}_waiting", 1));
\${$table_fieldname}_waiting = ${$table_name}Handler->getCount(\$criteria);
EOT;
	}
}
$text .= <<<EOT
\n// InfoBox Statistics
\$adminMenu->addInfoBox({$language}STATISTICS);
EOT;
foreach (array_keys($tables_arr) as $i)
{
    $table_name = $tables_arr[$i]->getVar('table_name');
	$table_fieldname = $tables_arr[$i]->getVar('table_fieldname');
	$ta_stu_table_name = $thereare.strtoupper($table_name);
	$ta_stu_table_fieldname = $thereare.strtoupper($table_fieldname);
$text .= <<<EOT
\n// InfoBox {$table_name}
\$adminMenu->addInfoBoxLine({$language}STATISTICS, {$ta_stu_table_name}, \$total_{$table_name}); 
EOT;
	if(isset($_REQUEST['table_status'])) {
$text .= <<<EOT
\n\$adminMenu->addInfoBoxLine({$language}STATISTICS, {$ta_stu_table_fieldname}_STATUS, \${$table_fieldname}_status);
EOT;
	}
	if(isset($_REQUEST['table_online'])) {
$text .= <<<EOT
\n\$adminMenu->addInfoBoxLine({$language}STATISTICS, {$ta_stu_table_fieldname}_ONLINE, \${$table_fieldname}_online);
EOT;
	}
	if(isset($_REQUEST['table_waiting'])) {
$text .= <<<EOT
\n\$adminMenu->addInfoBoxLine({$language}STATISTICS, {$ta_stu_table_fieldname}_WAITING, \${$table_fieldname}_waiting);
EOT;
    }
}
$text .= <<<EOT
\n// Render Index
echo \$adminMenu->addNavigation('index.php');
echo \$adminMenu->renderIndex();
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