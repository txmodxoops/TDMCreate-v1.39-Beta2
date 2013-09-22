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
 * @version         $Id: const_architecture.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/class/structure.php';
function const_architecture($modules)
{	
    global $pathIcon16;
	$class = 'odd';
	if( false !== structureFile( $modules, XOOPS_ROOT_PATH.'/modules/TDMCreate' ) ) {		
		echo '<tr class="'.$class.'">
				<td style="padding-left: 30px;">'._AM_TDMCREATE_CONST_OK_ARCHITECTURE.'</td>
				<td class="center"><img src='. $pathIcon16.'/on.png></td>
				<td>&nbsp;</td>
			</tr>'; 	
	} else {
	    echo '<tr class="'.$class.'">
				<td style="padding-left: 30px;">'._AM_TDMCREATE_CONST_NOTOK_ARCHITECTURE.'</td>
				<td>&nbsp;</td>
				<td class="center"><img src='. $pathIcon16.'/off.png></td>				
			</tr>'; 
	}
   
	if( $modules->getVar('mod_install') == 1 ) {
		$class = 'even';
		if( false !== structureFile( $modules, XOOPS_ROOT_PATH ) ) {
			echo '<tr class="'.$class.'">
					<td style="padding-left: 30px;">'._AM_TDMCREATE_CONST_OK_ARCHITECTURE_ROOT.'</td>
					<td class="center"><img src='. $pathIcon16.'/on.png></td>
					<td>&nbsp;</td>
				</tr>'; 
		} else {		
			echo '<tr class="'.$class.'">
					<td style="padding-left: 30px;">'._AM_TDMCREATE_CONST_NOTOK_ARCHITECTURE_ROOT.'</td>
					<td>&nbsp;</td>
					<td class="center"><img src='. $pathIcon16.'/off.png></td>					
				</tr>'; 
		}
	}	   
}

function structureFile( $modules, $pathName )
{	
    global $pathIcon16;	
	$indexFile = $pathName.'/include/index.html';  
    $thisPath = XOOPS_ROOT_PATH.'/modules/TDMCreate';	
	$fdocs = $thisPath.'/docs';	
	$fimages = $thisPath.'/images';
	//Creation of the Directory of modules
    $targetDirectory = $pathName.'/modules/'.$modules->getVar('mod_name');	
	
    // Making of a new object
	$classArch = new constArchitecture($targetDirectory);
	// Creation of "module" folder
	echo $tDir = $classArch->makeDir($targetDirectory);
	// Creation of "admin" folder and index.html file
	echo $admin_index = $classArch->makeDirAndCopyFile('admin', $indexFile, 'index.html');
    // Creation of "blocks" folder and index.html file
	echo $blocks_index = $classArch->makeDirAndCopyFile('blocks', $indexFile, 'index.html');
	// Creation of "class" folder and index.html file
	echo $class_index = $classArch->makeDirAndCopyFile('class', $indexFile, 'index.html');	
	// Creation of "css" folder and index.html file
	echo $css_index = $classArch->makeDirAndCopyFile('css', $indexFile, 'index.html');
	// Creation of "images" folder and index.html file
	echo $images_index = $classArch->makeDirAndCopyFile('images', $indexFile, 'index.html');	
	//Copy the logo of the module
	$mod_image = str_replace(' ', '', strtolower($modules->getVar('mod_image')));
	echo $logo_image = $classArch->CopyFile('images', $fimages.'/uploads/modules/'.$mod_image, $mod_image);	
	
    // Creation of 'images/icons' folder and index.html file - Added in Version 1.15
	echo $images_icons_index = $classArch->makeDirAndCopyFile('images/icons', $indexFile, 'index.html');	
	// Creation of "images/icons/16" folder and index.html file
	echo $images_index = $classArch->makeDirAndCopyFile('images/icons/16/', $indexFile, 'index.html');
	// Creation of "images/icons/32" folder and index.html file
	echo $images_index = $classArch->makeDirAndCopyFile('images/icons/32/', $indexFile, 'index.html');	
    // Creation of 'on.png' file
	echo $module_images_icon_on = $classArch->CopyFile('images/icons/16/', $fimages.'/icons/16/on.png', 'on.png');
    // Creation of 'off.png' file
	echo $module_images_icon_off = $classArch->CopyFile('images/icons/16/', $fimages.'/icons/16/off.png', 'off.png');
    // Creation of 'arrow.gif' file
	echo $module_images_icon_arrow = $classArch->CopyFile('images/icons/16/', $fimages.'/icons/16/arrow.gif', 'arrow.gif');
	// Creation of 'txmodxoops_logo.png' file
	echo $module_images_icon_arrow = $classArch->CopyFile('images/', $fimages.'/txmodxoops_logo.png', 'txmodxoops_logo.png');	
	
	// Creation of 'docs' folder and index.html file
	echo $docs_index = $classArch->makeDirAndCopyFile('docs', $indexFile, 'index.html');    
	// Creation of 'credits.txt' file
	echo $docs_credits = $classArch->CopyFile('docs', $fdocs.'/credits.txt', 'credits.txt');	
	// Creation of 'install.txt' file
	echo $docs_install = $classArch->CopyFile('docs', $fdocs.'/install.txt', 'install.txt');
	// Creation of 'lang_diff.txt' file
	echo $docs_lang_diff = $classArch->CopyFile('docs', $fdocs.'/lang_diff.txt', 'lang_diff.txt');
	// Creation of 'license.txt' file
	echo $docs_licence = $classArch->CopyFile('docs', $fdocs.'/license.txt', 'license.txt');
	// Creation of 'readme.txt' file
	echo $docs_readme = $classArch->CopyFile('docs', $fdocs.'/readme.txt', 'readme.txt');
    
	// Creation of "include" folder and index.html file	
	echo $include_index = $classArch->makeDirAndCopyFile('include', $indexFile, 'index.html');
	// Creation of "language" folder and index.html file	
	echo $language_index = $classArch->makeDirAndCopyFile('language', $indexFile, 'index.html');
	// Creation of "language/local_language" folder and index.html file	
	echo $language_local_index = $classArch->makeDirAndCopyFile('language/'.$GLOBALS['xoopsConfig']['language'], $indexFile, 'index.html');	
	// Creation of "language/local_language/help" folder and index.html file	
	echo $language_help_index = $classArch->makeDirAndCopyFile('language/'.$GLOBALS['xoopsConfig']['language'].'/help', $indexFile, 'index.html');
	// Creation of "templates" folder and index.html file	
	echo $templates_index = $classArch->makeDirAndCopyFile('templates', $indexFile, 'index.html');
	// Creation of "templates/admin" folder and index.html file	
	echo $templates_admin_index = $classArch->makeDirAndCopyFile('templates/admin', $indexFile, 'index.html');	
	// Creation of "templates/blocks" folder and index.html file	
	echo $templates_blocks_index = $classArch->makeDirAndCopyFile('templates/blocks', $indexFile, 'index.html');
    // Creation of "sql" folder and index.html file	
	echo $sql_index = $classArch->makeDirAndCopyFile('sql', $indexFile, 'index.html');	
}