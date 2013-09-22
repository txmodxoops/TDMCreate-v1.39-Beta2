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
 * @version         $Id: const_user_pages.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_user_pages($modules, $table_name, $table_fieldname, $table_fields, $table_parameters)
{	
	$mod_name = $modules->getVar('mod_name');
	$language = '_MA_'.strtoupper($mod_name).'';
	$file = $table_name.'.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/'.$file;
	$stu_mod_name = strtoupper($mod_name);
	$stl_mod_name = strtolower($mod_name);
	$stu_table_name = strtoupper($table_name);
	$stl_table_name = strtolower($table_name);
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\ninclude_once 'header.php';
\$xoopsOption['template_main'] = '{$stl_mod_name}_{$table_name}.html';	
include_once XOOPS_ROOT_PATH . '/header.php';
\$start = {$stl_mod_name}_CleanVars( \$_REQUEST, 'start', 0);
// Define Stylesheet
\$xoTheme->addStylesheet( \$style );
// Get Handler
\${$stl_table_name}Handler =& xoops_getModuleHandler('{$stl_table_name}', \$dirname);
\$nb_{$stl_table_name} = xoops_getModuleOption('userpager', \$dirname);

\$criteria = new CriteriaCompo();
\${$stl_table_name}_count = \${$stl_table_name}Handler->getCount(\$criteria);
\${$stl_table_name}_arr = \${$stl_table_name}Handler->getAll(\$criteria);
if (\${$stl_table_name}_count > 0) {
	foreach (array_keys(\${$stl_table_name}_arr) as \$i) 
	{
EOT;
// Fields
$fields = explode('|', $table_fields);
$nb_fields = count($fields);
//parameters
$parameters_total = explode('|', $table_parameters);

for ($i = 0; $i < $nb_fields; $i++)
{
    $field = explode(':', $fields[$i]);
	if( $i == 0 ) {
		$fpt[$i] = '0';
	} else {
	    $param = explode(':', $parameters_total[$i-1]);
		$fpt[$i] = $param[0]; // fpt = fields parameters type	
		if ( $param[4] == 1 ) {
			$fpmf = $field[0]; // fpmf = fields parameters main field
		}
	}
	$structure_fields = explode(':', $fields[$i]);	
	
	if ( $fpt[$i] == 'XoopsFormDhtmlTextArea' || $fpt[$i] == 'XoopsFormTextArea' ) {
$text .= <<<EOT
\n\t\t\${$table_fieldname}['{$structure_fields[0]}'] = strip_tags(\${$stl_table_name}_arr[\$i]->getVar('{$structure_fields[0]}'));
EOT;
	} else {
$text .= <<<EOT
\n\t\t\${$table_fieldname}['{$structure_fields[0]}'] = \${$stl_table_name}_arr[\$i]->getVar('{$structure_fields[0]}');
EOT;
	}
}
$text .= <<<EOT
\n\t\t\$GLOBALS['xoopsTpl']->append('{$stl_table_name}', \${$table_fieldname});
		\$keywords[] = \${$stl_table_name}_arr[\$i]->getVar('{$fpmf}');
        unset(\${$table_fieldname});
    }
	// Display Navigation
    if (\${$stl_table_name}_count > \$nb_{$stl_table_name}) {
	    include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        \$nav = new XoopsPageNav(\${$stl_table_name}_count, \$nb_{$stl_table_name}, \$start, 'start');
        \$GLOBALS['xoopsTpl']->assign('pagenav', \$nav->renderNav(4));
    }
}
//keywords
{$stl_mod_name}_meta_keywords(xoops_getModuleOption('keywords', \$dirname) .', '. implode(', ', \$keywords));
//description
{$stl_mod_name}_meta_description({$language}_{$stu_table_name}_DESC);
//
\$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', {$stu_mod_name}_URL . '/{$stl_table_name}.php'); 
\$GLOBALS['xoopsTpl']->assign('{$stl_mod_name}_url', {$stu_mod_name}_URL);
\$GLOBALS['xoopsTpl']->assign('adv', xoops_getModuleOption('advertise', \$dirname));
//
\$GLOBALS['xoopsTpl']->assign('bookmarks', xoops_getModuleOption('bookmarks', \$dirname));
\$GLOBALS['xoopsTpl']->assign('fbcomments', xoops_getModuleOption('fbcomments', \$dirname)); 
//
\$GLOBALS['xoopsTpl']->assign('admin', {$stu_mod_name}_ADMIN);
\$GLOBALS['xoopsTpl']->assign('copyright', \$copyright);
//
include_once XOOPS_ROOT_PATH . '/footer.php';	
EOT;
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_ROOTS,
				_AM_TDMCREATE_CONST_NOTOK_ROOTS, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_ROOTS,
					_AM_TDMCREATE_CONST_NOTOK_ROOTS, $file);
	}
}