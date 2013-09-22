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
 * @version         $Id: const_help_language.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_help_language($modules)
{
    $mod_name = $modules->getVar('mod_name');
	$language = '_AH_'.strtoupper($mod_name).'_';
	$file = 'help.html';
    $tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/language/'.xoops_getConfigOption('language').'/help/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/language/'.xoops_getConfigOption('language').'/help/'.$file;
	$text = <<<EOT
<div id='help-template' class='outer'>
    <h1 class='head'>Help:
        <a class='ui-corner-all tooltip' href='<{\$xoops_url}>/modules/{$mod_name}/admin/index.php'
           title='Back to the administration of {$mod_name}'> {$mod_name} <img src='<{xoAdminIcons home.png}>'
                                                                         alt='Back to the Administration of {$mod_name}'/>
        </a></h1>
    <!-- -----Help Content ---------- -->
    <h4 class='odd'>Description</h4>
    <p class='even'>
        {$modules->getVar('mod_description')}<br /><br />
    </p>
    <h4 class='odd'>Install/uninstall</h4>
    <p class='even'>
    No special measures necessary, follow the standard installation process - extract the /{$mod_name} folder into the
    ../modules directory. Install the module through Admin -> System Module -> Modules. If you need detailed
    instructions on how to install a module, please see the <a href='http://goo.gl/adT2i' target='_blank'>XOOPS Operations
    Manual</a>.<br/><br/></p>
    <h4 class='odd'>Tutorial</h4>
    <p class='even'>
        A detailed tutorial coming soon...</p>
        <!-- -----Help Content ---------- -->
</div>
EOT;
	createFile(	$tdmcreate_path, $text,
			_AM_TDMCREATE_CONST_OK_LANGUAGES,
			_AM_TDMCREATE_CONST_NOTOK_LANGUAGES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_LANGUAGES,
					_AM_TDMCREATE_CONST_NOTOK_LANGUAGES, $file);
	}
}