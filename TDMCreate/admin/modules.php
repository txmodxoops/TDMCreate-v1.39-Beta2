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
 * @version         $Id: modules.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once 'header.php';
$op = TDMCreate_CleanVars( $_REQUEST, 'op', 'list', 'string' );
echo $adminMenu->addNavigation('modules.php');
switch ($op) 
{
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
           redirect_header('modules.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }

        if (isset($_REQUEST['mod_id'])) {
           $obj =& $modulesHandler->get($_REQUEST['mod_id']);
        } else {
           $obj =& $modulesHandler->create();
        }
        //Image 'gif|jpeg|pjpeg|png' 500000
        include_once XOOPS_ROOT_PATH.'/class/uploader.php';
        $uploaddir = XOOPS_ROOT_PATH . '/modules/'.$xoopsModule->dirname().'/images/uploads/modules/';
        $uploader = new XoopsMediaUploader($uploaddir, xoops_getModuleOption('mimetypes', $thisDirname), 
		                                               xoops_getModuleOption('maxsize', $thisDirname), null, null);

        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
            $extension = preg_replace( '/^.+\.([^.]+)$/sU' , '\\1' , $_FILES['attachedfile']['name']) ;
            $img_name = $obj->getVar('mod_name').'_slogo.'.$extension;
            $uploader->setTargetFileName($img_name);
            $uploader->fetchMedia($_POST['xoops_upload_file'][0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $obj->setVar('mod_image', $uploader->getSavedFileName());
            }
        } else {
            $obj->setVar('mod_image', $_POST['mod_image']);
        }
                                    
        $obj->setVar('mod_name', preg_replace('/\s+/', '', $_POST['mod_name'])); //remove all spaces from the new name
        $obj->setVar('mod_version', $_POST['mod_version']);
		$obj->setVar('mod_since', $_POST['mod_since']);
		$obj->setVar('mod_min_php', $_POST['mod_min_php']); 
		$obj->setVar('mod_min_xoops', $_POST['mod_min_xoops']); 
        $obj->setVar('mod_min_admin', $_POST['mod_min_admin']); 
		$obj->setVar('mod_min_mysql', $_POST['mod_min_mysql']); 
        $obj->setVar('mod_description', $_POST['mod_description']);
        $obj->setVar('mod_author', $_POST['mod_author']);
        $obj->setVar('mod_author_mail', $_POST['mod_author_mail']);
        $obj->setVar('mod_author_website_url', $_POST['mod_author_website_url']);
        $obj->setVar('mod_author_website_name', $_POST['mod_author_website_name']);
        $obj->setVar('mod_credits', $_POST['mod_credits']);
        $obj->setVar('mod_license', $_POST['mod_license']);
        $obj->setVar('mod_release_info', $_POST['mod_release_info']);
        $obj->setVar('mod_release_file', $_POST['mod_release_file']);
        $obj->setVar('mod_manual', $_POST['mod_manual']);
        $obj->setVar('mod_manual_file', $_POST['mod_manual_file']);
        $obj->setVar('mod_demo_site_url', $_POST['mod_demo_site_url']);
        $obj->setVar('mod_demo_site_name', $_POST['mod_demo_site_name']);
        $obj->setVar('mod_support_url', $_POST['mod_support_url']);
        $obj->setVar('mod_support_name', $_POST['mod_support_name']);
        $obj->setVar('mod_website_url', $_POST['mod_website_url']);
        $obj->setVar('mod_website_name', $_POST['mod_website_name']);
        $obj->setVar('mod_release', $_POST['mod_release']);
        $obj->setVar('mod_status', $_POST['mod_status']);        
        $obj->setVar('mod_admin', $_REQUEST['mod_admin']);
        $obj->setVar('mod_user', $_REQUEST['mod_user']);
        $obj->setVar('mod_search', $_REQUEST['mod_search']);
		$obj->setVar('mod_comments', $_REQUEST['mod_comments']);
		$obj->setVar('mod_notifications', $_REQUEST['mod_notifications']);
		$obj->setVar('mod_permissions', $_REQUEST['mod_permissions']);
		$obj->setVar('mod_install', $_REQUEST['mod_install']);
		$obj->setVar('mod_donations', $_POST['mod_donations']);
		$obj->setVar('mod_subversion', $_POST['mod_subversion']);

        if ($modulesHandler->insert($obj)) {
			redirect_header('modules.php?op=list', 2, _AM_TDMCREATE_FORMOK);
        }
	break;

    case 'new':        
        $adminMenu->addItemButton(_AM_TDMCREATE_MODULES_LIST, 'modules.php?op=list', 'list');
        echo $adminMenu->renderButton();

        $obj =& $modulesHandler->create();
        $form = $obj->getForm();
    break;
    case 'edit':
		$obj =& $modulesHandler->get($_REQUEST['mod_id']);
        $form = $obj->getForm();
    break;
    case 'delete':
		$obj =& $modulesHandler->get($_REQUEST['mod_id']);
		if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1)
		{
			if (!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('modules.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if ($modulesHandler->delete($obj)) {
				$xoopsDB->queryF("DELETE FROM ".$xoopsDB->prefix("tdmcreate_modules")." WHERE mod_id = ".$_REQUEST['mod_id']);
				redirect_header('modules.php', 3, _AM_TDMCREATE_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array('ok' => 1, 'mod_id' => $_REQUEST['mod_id'], 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_TDMCREATE_FORMSUREDEL, $obj->getVar('mod_name')));
		}
    break;
    case 'list':
    default:       
        $adminMenu->addItemButton(_AM_TDMCREATE_MODULES_NEW, 'modules.php?op=new', 'add');
        echo $adminMenu->renderButton();

        $criteria = new CriteriaCompo();
        $criteria->setSort('mod_id');
        $criteria->setOrder('ASC');
        $mod_arr = $modulesHandler->getall($criteria);
        $numrows_modules = $modulesHandler->getCount();

        if ( $numrows_modules > 0 )
		{
			echo '<table width="100%" cellspacing="1" class="outer">';
			echo '<tr class="center">';
			echo '<th width="1%">'._AM_TDMCREATE_ID.'</th>';
			echo '<th width="10%">'._AM_TDMCREATE_NAME.'</th>';
			echo '<th width="10%">'._AM_TDMCREATE_IMAGE.'</th>';
			echo '<th width="15%">'._AM_TDMCREATE_DISPLAY_ADMIN.'</th>';
			echo '<th width="15%">'._AM_TDMCREATE_DISPLAY_USER.'</th>';
			echo '<th width="1%">'._AM_TDMCREATE_FORMACTION.'</th>';
			echo '</tr>';
			$class = 'odd';
			foreach (array_keys($mod_arr) as $i)
			{
				$mod_id = $mod_arr[$i]->getVar('mod_id');
				$mod_name = $mod_arr[$i]->getVar('mod_name');
				$mod_image = $mod_arr[$i]->getVar('mod_image');
				//$mod_blocks = $mod_arr[$i]->getVar('mod_blocks');
				$mod_admin = $mod_arr[$i]->getVar('mod_admin');
				$mod_user = $mod_arr[$i]->getVar('mod_user');
				$admin = ($mod_admin == 1) ? _YES : _NO;
				$user = ($mod_user == 1) ? _YES : _NO;            
				echo '<tr class="odd center">';
				echo '<td><b>'.$i.'</b></td>';
				$nbsps = '&nbsp;&nbsp;&nbsp;';
				echo '<td class="left">'.$nbsps.'<img src="../images/icons/16/arrow.gif" alt="Arrow" />'.$nbsps.'<b>'.$mod_name.'</b></td>';
				echo '<td><img src="../images/uploads/modules/'.$mod_image.'" height="30px" /></td>';
				echo '<td>'.$admin.'</td>';
				echo '<td>'.$user.'</td>';				
				echo '<td>';
				echo '<a href="modules.php?op=edit&mod_id='.$mod_id.'"><img src="'. $pathIcon16 .'/edit.png" alt="'._EDIT.'" title="'._EDIT.'" /></a>&nbsp;<a href="modules.php?op=delete&mod_id='.$mod_id.'"><img src="'. $pathIcon16 .'/delete.png" alt="'._DELETE.'" title="'._DELETE.'" /></a>';
				echo '</td>';
				echo '</tr>';
				}
			echo '</table><br><br>';
		} else {
		    echo '<table width="100%" cellspacing="1" class="outer">';
			echo '<tr class="center">';
			echo '<th width="1%">'._AM_TDMCREATE_ID.'</th>';
			echo '<th width="10%">'._AM_TDMCREATE_NAME.'</th>';
			echo '<th width="10%">'._AM_TDMCREATE_IMAGE.'</th>';
			echo '<th width="15%">'._AM_TDMCREATE_DISPLAY_ADMIN.'</th>';
			echo '<th width="15%">'._AM_TDMCREATE_DISPLAY_USER.'</th>';			
			echo '<th width="1%">'._AM_TDMCREATE_FORMACTION.'</th>';
			echo '<tr><td class="errorMsg" colspan="8">No modules</td></tr>';
			echo '</tr></table><br><br>';			
		}
    break;
}
include_once 'footer.php';