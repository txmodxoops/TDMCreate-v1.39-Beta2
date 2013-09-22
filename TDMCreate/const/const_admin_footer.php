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
 * @version         $Id: const_admin_footer.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_admin_footer($modules)
{	
	$mod_name = $modules->getVar('mod_name');
	$mod_support_name = $modules->getVar('mod_support_name');
	$language = '_AM_'.strtoupper($mod_name).'_';
	$file = 'footer.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/admin/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/admin/'.$file;
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\necho "<div class='center'><a href='http://www.xoops.org' title='Visit XOOPS' target='_blank'>
         <img src='".\$sysPathIcon32."/xoopsmicrobutton.gif' alt='XOOPS' /></a></div>";
echo "<div class='center smallsmall italic pad5'>
          <strong>" . \$xoopsModule->getVar('name') . "</strong> ".{$language}MAINTAINEDBY."
            <a href='{$modules->getVar('mod_support_url')}' title='Visit {$mod_support_name}' class='tooltip' rel='external'>{$mod_support_name}</a></div>";
xoops_cp_footer();  
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