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
 * @since           2.5.5
 * @author          Txmod Xoops http://www.txmodxoops.org
 * @version         $Id: const_header.php 11084 2013-02-23 15:44:20Z timgno $
 */
function const_header($module, $filename)
{
	$mod_name = $module->getVar('mod_name');
	$mod_version = $module->getVar('mod_version');
	$mod_min_xoops = $module->getVar('mod_min_xoops');
	$mod_author = $module->getVar('mod_author');
	$mod_credits = $module->getVar('mod_credits');
	$mod_a_m = $module->getVar('mod_author_mail');
	$mod_a_w_url = $module->getVar('mod_author_website_url');
	$mod_license = $module->getVar('mod_license');  
	$mod_subversion = $module->getVar('mod_subversion');
	$date = date('D Y/m/d G:i:s');

	$text = <<<EOT
\n/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/**
 * {$mod_name} module for xoops
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         {$mod_license}
 * @package         {$mod_name}
 * @since           {$mod_min_xoops}
 * @author          {$mod_author} <{$mod_a_m}> - <{$mod_a_w_url}>
 * @version         \$Id: {$mod_version} {$filename} {$mod_subversion} {$date}Z {$mod_credits} \$
 */
EOT
; 
	return $text;
}   