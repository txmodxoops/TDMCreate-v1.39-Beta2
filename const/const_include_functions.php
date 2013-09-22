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
 * @version         $Id: const_include_functions.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_include_functions($modules)
{
	$mod_name = $modules->getVar('mod_name');
	$file = 'functions.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/include/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/include/'.$file;
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\n/***************Blocks***************/
function {$mod_name}_block_addCatSelect(\$cats) {
	if(is_array(\$cats)) 
	{
		\$cat_sql = '('.current(\$cats);
		array_shift(\$cats);
		foreach(\$cats as \$cat) 
		{
			\$cat_sql .= ','.\$cat;
		}
		\$cat_sql .= ')';
	}
	return \$cat_sql;
}

function {$mod_name}_CleanVars( &\$global, \$key, \$default = '', \$type = 'int' ) {
    switch ( \$type ) {
        case 'string':
            \$ret = ( isset( \$global[\$key] ) ) ? filter_var( \$global[\$key], FILTER_SANITIZE_MAGIC_QUOTES ) : \$default;
            break;
        case 'int': default:
            \$ret = ( isset( \$global[\$key] ) ) ? filter_var( \$global[\$key], FILTER_SANITIZE_NUMBER_INT ) : \$default;
            break;
    }
    if ( \$ret === false ) {
        return \$default;
    }
    return \$ret;
}

function {$mod_name}_meta_keywords(\$content)
{
	global \$xoopsTpl, \$xoTheme;
	\$myts =& MyTextSanitizer::getInstance();
	\$content= \$myts->undoHtmlSpecialChars(\$myts->displayTarea(\$content));
	if(isset(\$xoTheme) && is_object(\$xoTheme)) {
		\$xoTheme->addMeta( 'meta', 'keywords', strip_tags(\$content));
	} else {	// Compatibility for old Xoops versions
		\$xoopsTpl->assign('xoops_meta_keywords', strip_tags(\$content));
	}
}

function {$mod_name}_meta_description(\$content)
{
	global \$xoopsTpl, \$xoTheme;
	\$myts =& MyTextSanitizer::getInstance();
	\$content = \$myts->undoHtmlSpecialChars(\$myts->displayTarea(\$content));
	if(isset(\$xoTheme) && is_object(\$xoTheme)) {
		\$xoTheme->addMeta( 'meta', 'description', strip_tags(\$content));
	} else {	// Compatibility for old Xoops versions
		\$xoopsTpl->assign('xoops_meta_description', strip_tags(\$content));
	}
}
EOT;
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_INCLUDES,
				_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_INCLUDES,
					_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	}
}