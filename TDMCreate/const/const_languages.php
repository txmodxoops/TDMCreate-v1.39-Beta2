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
 * @version         $Id: const_languages.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_languages($modules)
{   
    $mod_name = $modules->getVar('mod_name');
	$language = '_AM_'.strtoupper($mod_name).'_';	
	$languagesHandler=& xoops_getModuleHandler('tdmcreate_languages', $mod_name);
	$text = '';	
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('lang_module', '0', '>'));
	$criteria->add(new Criteria('lang_file', $languages_file));
	$criteria->setSort('lang_id');
	$criteria->setOrder('ASC');
	$languages_arr = $languagesHandler->getAll($criteria);	
	$file = $languages_file.'.php';
	$text .= '<?php'.const_header($modules, $file);	
	if($languagesHandler->getVar('lang_file') == $languages_file) 
	{			
	    foreach (array_keys($languages_arr) as $i) 
        {     
	    $text .= '
define(\''.$language.strtoupper($languages_arr[$i]->getVar('lang_def')).'\', "'.ucfirst($languages_arr[$i]->getVar('lang_desc')).'");';
        }
	}	
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/language/'.$GLOBALS['xoopsConfig']['language'].'/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/language/'.$GLOBALS['xoopsConfig']['language'].'/'.$file;
	
	createFile(	$tdmcreate_path, $text,
			_AM_TDMCREATE_CONST_OK_LANGUAGES,
			_AM_TDMCREATE_CONST_NOTOK_LANGUAGES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_LANGUAGES,
					_AM_TDMCREATE_CONST_NOTOK_LANGUAGES, $file);
	}
}