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
 * @version         $Id: const_templates_admin_help.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_templates_admin_help($modules)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_AM_'.strtoupper($mod_name).'_';
	$language1 = '_AH_'.strtoupper($mod_name).'_';
	$file = $mod_name.'_admin_help.html';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/templates/admin/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/templates/admin/'.$file;
	$text = '<!-- $Id '.strtoupper($mod_name).' $ -->
<div id="Slideshow_Title" class="bold shadowlight alignmiddle">
    <div id="Slideshow_Help">
        <{$smarty.const.'.$language.'ADMIN_HELP}>
    </div>
    <div id="Slideshow_Action">
    </div>
</div>
<div id="myid">
	<div class="width45 floatleft pad5">
	<{$smarty.const.'.$language1.'HELP1}>
	</div>
	<div class="width45 floatright pad5">
	<{$smarty.const.'.$language1.'HELP2}>
	</div>
</div>
<div class="clear"></div>
';
	createFile(	$tdmcreate_path, $text,
			_AM_TDMCREATE_CONST_OK_TEMPLATES_ADMIN,
			_AM_TDMCREATE_CONST_NOTOK_TEMPLATES_ADMIN, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_TEMPLATES_ADMIN,
					_AM_TDMCREATE_CONST_NOTOK_TEMPLATES_ADMIN, $file);
	}
}