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
 * @version         $Id: const_templates_admin_about.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';

function const_templates_admin_about($modules)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_AM_'.strtoupper($mod_name).'_ABOUT_';
	$file = $mod_name.'_admin_about.html';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/templates/admin/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/templates/admin/'.$file;
	$text = '<div id="about">
	<table class="width90 floatcenter0">
		<tr>
			<td class="aligntop width45">
				<fieldset>
					<legend class="Slideshow_MediumTitle bold shadowlight"><{$module_name}></legend>
					<div>
						<img class="logo" src="<{$smarty.const.XOOPS_URL}>/modules/<{$module_dirname}>/<{$module_image}>" alt="" /><br />
						<label> Version : </label><text><{$module_version}></text><br />
						<!--label><{$smarty.const.'.$language.'RELEASEDATE}></label><text><{$module_release}></text><br /-->
						<label><{$smarty.const.'.$language.'DESCRIPTION}></label><text><{$module_description}></text><br />
						<label><{$smarty.const.'.$language.'AUTHOR}></label><text><{$module_author}></text><br />
						<label><{$smarty.const.'.$language.'CREDITS}></label><text><{$module_credits}></text><br />
						<label><{$smarty.const.'.$language.'LICENSE}></label><text><a class="tooltip" href="<{$module_license_url}>" rel="external" title="<{$module_license}><br /><{$module_license_url}>"><{$module_license}></a></text>
					</div>
				</fieldset>
				<fieldset>
					<legend class="Slideshow_MediumTitle bold shadowlight"><{$smarty.const.'.$language.'MODULE_INFO}></legend>
					<div>
						<label><{$smarty.const.'.$language.'RELEASEDATE}></label><text class="bold"><{$module_update_date}></text></br />
						<label><{$smarty.const.'.$language.'MODULE_STATUS}></label><text><{$module_status}></text><br />
						<label><{$smarty.const.'.$language.'WEBSITE}></label><text><a class="tooltip" href="<{$module_website_url}>" rel="external" title="<{$module_website_name}> - <{$module_website_url}>"><{$module_website_name}></a></text><br />
					</div>
				</fieldset>
				<fieldset>
					<legend class="Slideshow_MediumTitle bold shadowlight"><{$smarty.const.'.$language.'AUTHOR_INFO}></legend>
					<div>
						<label><{$smarty.const.'.$language.'AUTHOR_NAME}></label><text><{$module_author}></text><br />
						<label><{$smarty.const.'.$language.'WEBSITE}></label><text><a class="tooltip" href="<{$author_website_url}>" rel="external" title="<{$author_website_name}><br /><{$author_website_url}>"><{$author_website_name}></a></text><br />
					</div>
				</fieldset>
			</td>
			<td class="aligntop width50">
				<{if $changelog}>
					<fieldset>
						<legend class="Slideshow_MediumTitle bold shadowlight"><{$smarty.const.'.$language.'CHANGELOG}></legend>
						<div class="txtchangelog"><{$changelog}></div>
					</fieldset>
				<{/if}>
			</td>
		</tr>
	</table>
</div>
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