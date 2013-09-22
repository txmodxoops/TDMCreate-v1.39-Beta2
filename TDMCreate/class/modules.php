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
 * Xoops Javascript class
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         media
 * @since           2.5.x
 * @author          TDM TEAM DEV MODULE
 * @version         $Id$ modules.php 11114 2013-02-13 10:22:12Z timgno $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

//include_once 'iconGenerator.php';

class TDMCreateModules extends XoopsObject
{ 
	// constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar('mod_id',XOBJ_DTYPE_INT, 0);
		$this->initVar('mod_name',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['name']);
		$this->initVar('mod_version',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['version']);
		$this->initVar('mod_since',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['since']);
		$this->initVar('mod_min_php',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['min_php']);
		$this->initVar('mod_min_xoops',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['min_xoops']);
		$this->initVar('mod_min_admin',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['min_admin']);
		$this->initVar('mod_min_mysql',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['min_mysql']);
		$this->initVar('mod_description',XOBJ_DTYPE_TXTAREA, $GLOBALS['xoopsModuleConfig']['description']);
		$this->initVar('mod_author',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['author']);
		$this->initVar('mod_author_mail',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['author_email']);
		$this->initVar('mod_author_website_url',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['author_website_url']);
        $this->initVar('mod_author_website_name',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['author_website_name']);
		$this->initVar('mod_credits',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['credits']);
		$this->initVar('mod_license',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['license']);
		$this->initVar('mod_release_info',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['release_info']);
		$this->initVar('mod_release_file',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['release_file']);
		$this->initVar('mod_manual',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['manual']);
		$this->initVar('mod_manual_file',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['manual_file']);
		$this->initVar('mod_image',XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('mod_demo_site_url',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['demo_site_url']);
		$this->initVar('mod_demo_site_name',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['demo_site_name']);
		$this->initVar('mod_support_url',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['support_url']);
        $this->initVar('mod_support_name',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['support_name']);
		$this->initVar('mod_website_url',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['website_url']);
		$this->initVar('mod_website_name',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['website_name']);
		$this->initVar('mod_release',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['release_date']);
		$this->initVar('mod_status',XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['status']);
		$this->initVar('mod_admin',XOBJ_DTYPE_INT,$GLOBALS['xoopsModuleConfig']['display_admin']);
		$this->initVar('mod_user',XOBJ_DTYPE_INT, $GLOBALS['xoopsModuleConfig']['display_user']);
		$this->initVar('mod_search',XOBJ_DTYPE_INT, $GLOBALS['xoopsModuleConfig']['active_search']);
		$this->initVar('mod_comments',XOBJ_DTYPE_INT, $GLOBALS['xoopsModuleConfig']['active_comments']);
		$this->initVar('mod_notifications', XOBJ_DTYPE_INT, $GLOBALS['xoopsModuleConfig']['active_notifications']);
        $this->initVar('mod_permissions', XOBJ_DTYPE_INT, $GLOBALS['xoopsModuleConfig']['active_permissions']);	
        $this->initVar('mod_install', XOBJ_DTYPE_INT, $GLOBALS['xoopsModuleConfig']['inroot_install']);			
		$this->initVar('mod_donations', XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['donations']);
		$this->initVar('mod_subversion', XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsModuleConfig']['subversion']);
	}

    function getForm($action = false)
    {
		global $xoopsModule, $pathIcon32;
		
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $title = $this->isNew() ? sprintf(_AM_TDMCREATE_MODULES_ADD) : sprintf(_AM_TDMCREATE_MODULES_EDIT);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'modulesform', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		
		$form->insertBreak('<div class="center"><b>'._AM_TDMCREATE_MODULES_IMPORTANT.'</b></div>','head');
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_NAME, 'mod_name', 50, 255, $this->getVar('mod_name')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_VERSION, 'mod_version', 10, 25, $this->getVar('mod_version')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_SINCE, 'mod_since', 10, 25, $this->getVar('mod_since')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_MIN_PHP, 'mod_min_php', 10, 25, $this->getVar('mod_min_php')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_MIN_XOOPS, 'mod_min_xoops', 10, 25, $this->getVar('mod_min_xoops')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_MIN_ADMIN, 'mod_min_admin', 10, 25, $this->getVar('mod_min_admin')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_MIN_MYSQL, 'mod_min_mysql', 10, 25, $this->getVar('mod_min_mysql')), true);
		// Name description
        $editor_configs=array();
        $editor_configs['name'] = 'mod_description';
        $editor_configs['value'] = $this->getVar('mod_description', 'e');
        $editor_configs['rows'] = 5;
        $editor_configs['cols'] = 100;
        $editor_configs['width'] = '50%';
        $editor_configs['height'] = '100px';
        $editor_configs['editor'] = $GLOBALS['xoopsModuleConfig']['tdmcreate_editor'];
        $form->addElement( new XoopsFormEditor(_AM_TDMCREATE_MODULES_DESCRIPTION, 'mod_description', $editor_configs), true);
		// Author
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_AUTHOR, 'mod_author', 50, 255, $this->getVar('mod_author')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_LICENSE, 'mod_license', 50, 255, $this->getVar('mod_license')), true);
		$mod_admin =  $this->isNew() ? $GLOBALS['xoopsModuleConfig']['display_admin'] : $this->getVar('mod_admin');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_MODULES_DISPLAY_ADMIN, 'mod_admin', $mod_admin, _YES, _NO));
		$mod_user =  $this->isNew() ? $GLOBALS['xoopsModuleConfig']['display_user'] : $this->getVar('mod_user');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_MODULES_DISPLAY_USER, 'mod_user', $mod_user, _YES, _NO));
		$mod_search =  $this->isNew() ? $GLOBALS['xoopsModuleConfig']['active_search'] : $this->getVar('mod_search');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_MODULES_ACTIVE_SEARCH, 'mod_search', $mod_search, _YES, _NO));
		$mod_comments =  $this->isNew() ? $GLOBALS['xoopsModuleConfig']['active_comments'] : $this->getVar('mod_comments');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_MODULES_ACTIVE_COMMENTS, 'mod_comments', $mod_comments, _YES, _NO));
		
		$mod_notifications =  $this->isNew() ? $GLOBALS['xoopsModuleConfig']['active_notifications'] : $this->getVar('mod_notifications');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_MODULES_ACTIVE_NOTIFICATIONS, 'mod_notifications', $mod_notifications, _YES, _NO));
		
		$mod_permissions =  $this->isNew() ? $GLOBALS['xoopsModuleConfig']['active_permissions'] : $this->getVar('mod_permissions');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_MODULES_ACTIVE_PERMISSIONS, 'mod_permissions', $mod_permissions, _YES, _NO));
		
		$mod_install =  $this->isNew() ? $GLOBALS['xoopsModuleConfig']['inroot_install'] : $this->getVar('mod_install');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_MODULES_INROOT_INSTALL, 'mod_install', $mod_install, _YES, _NO));
		
		$mod_image = $this->getVar('mod_image') ? $this->getVar('mod_image') : 'empty.png';
		
		$uploadirectory = '/modules/'.$xoopsModule->dirname().'/images/uploads/modules';
		$imgtray = new XoopsFormElementTray(_AM_TDMCREATE_MODULES_IMAGE,'<br />');
		$imgpath = sprintf(_AM_TDMCREATE_FORMIMAGE_PATH, './modules/'.$xoopsModule->dirname().'/images/uploads/modules');
		$imageselect= new XoopsFormSelect($imgpath, 'mod_image', $mod_image);
		$mod_image_array = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH.$uploadirectory );
		foreach( $mod_image_array as $image ) {
			$imageselect->addOption("$image", $image);
		}
		$imageselect->setExtra( "onchange='showImgSelected(\"image3\", \"mod_image\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'" );
		$imgtray->addElement($imageselect);
		$imgtray -> addElement( new XoopsFormLabel( '', "<br /><img src='" . XOOPS_URL . "/" . $uploadirectory . "/" . $mod_image . "' name='image3' id='image3' alt='' />" ) );
		
        $fileseltray = new XoopsFormElementTray('', '<br />');
		$fileseltray->addElement(new XoopsFormFile(_AM_TDMCREATE_FORMUPLOAD, 'attachedfile', $GLOBALS['xoopsModuleConfig']['maxsize']));
		$fileseltray->addElement(new XoopsFormLabel(''));
		$imgtray->addElement($fileseltray);
		$form->addElement($imgtray);

//---------- START -----------------
        ?>

    <script type="text/javascript">

        function showImgSelected2(imgId, selectId, imgDir, extra, xoopsUrl) {
            if (xoopsUrl == null) {
                xoopsUrl = "./";
            }
            imgDom = xoopsGetElementById(imgId);
            selectDom = xoopsGetElementById(selectId);
            if (selectDom.options[selectDom.selectedIndex].value != "") {
                imgDom.src = xoopsUrl + imgDir + "/" + selectDom.options[selectDom.selectedIndex].value + extra;
            } else {
                imgDom.src = xoopsUrl + "/modules/TDMCreate/images/uploads/modules/blank.gif";
            }
        }

        function createNewModuleLogo(xoopsUrl) {  // this is JavaScript  function

            iconDom = xoopsGetElementById(image4);
            iconName = iconDom.src;
            caption = xoopsGetElementById(mod_name).value;
            logoDom = xoopsGetElementById(image3);
            moduleImageDom=xoopsGetElementById(mod_image);
            moduleImageSelected=moduleImageDom.options[moduleImageDom.selectedIndex].value;
            $.ajax({
                type:'GET',
                url:xoopsUrl + "/modules/TDMCreate/class/logoGenerator.php?f=phpFunction&iconName=" + iconName + "&caption=" + caption,
                // call php function , phpFunction=function Name , x= parameter
                data:{},
                dataType:"html",
                success:function (data1) {
                    //alert(data1);
                    logoDom.src = data1.split('\n')[0];//the data returned has too many lines. We need only the link to the image
                    logoDom.load; //refresh the logo
                    mycheck=caption+'_logo.png'; //name of the new logo file
                    //if file is not in the list of logo files, add it to the dropdown menu
                    var fileExist;
                    elems = moduleImageDom.options;
                            for (var i = 0, max = elems.length; i < max; i++) {
                                if (moduleImageDom.options[i].text == mycheck){
                                    fileExist=true;}
                            }

                    if (null == fileExist){
                        var opt = document.createElement("option");
                        document.getElementById("mod_image").options.add(opt);
                        opt.text = mycheck;
                        opt.value = mycheck;
                    }
                    $('#mod_image').load;
                    $('#mod_image').val(mycheck);//change value of selected logo file to the new file
                }
            });
        }
    </script>


    <?php
		$tables_img = $this->getVar('table_image') ? $this->getVar('table_image') : 'about.png';
		 if(is_dir($pathIcon32)){
			$uploadirectory = $pathIcon32;
		}else{
			$uploadirectory = "/modules/".$xoopsModule->dirname()."/images/uploads/tables";
		}
		$createLogoTray = new XoopsFormElementTray('Create new Logo','<br />');
		if(is_dir($pathIcon32)){
			$imgpath = sprintf(_AM_TDMCREATE_FORMIMAGE_PATH, ".$pathIcon32");
		}else{
			$imgpath = sprintf(_AM_TDMCREATE_FORMIMAGE_PATH, "./modules/".$xoopsModule->dirname()."/images/uploads/tables");
		}
		$iconSelect= new XoopsFormSelect($imgpath, 'tables_img', $tables_img, 8);
		$tables_img_array = XoopsLists :: getImgListAsArray( $uploadirectory );
		foreach( $tables_img_array as $image ) {
			$iconSelect->addOption("$image", $image);
		}
		$iconSelect->setExtra( "onchange='showImgSelected2(\"image4\", \"tables_img\", \"" . $uploadirectory . "\", \"\", \"" . '' . "\")'" );
		$createLogoTray->addElement($iconSelect);
		$createLogoTray -> addElement( new XoopsFormLabel( '', "<br /><img src='" . $pathIcon32 . "/" . $tables_img . "' name='image4' id='image4' alt='' />" ) );

		// Create preview and submit buttons
		$buttonLogoGenerator4= new XoopsFormButton('', 'button4', "Create New Logo", 'button');
		$buttonLogoGenerator4->setExtra("onclick='createNewModuleLogo(\"" . XOOPS_URL . "\")'");
		$createLogoTray->addElement($buttonLogoGenerator4);

		$form->addElement($createLogoTray);

//------------ END --------------------
		        
		$form->insertBreak('<div class="center"><b>'._AM_TDMCREATE_MODULES_NOTIMPORTANT.'</b></div>','head');		
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_AUTHOR_MAIL, 'mod_author_mail', 50, 255, $this->getVar('mod_author_mail')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_AUTHOR_WEBSITE_URL, 'mod_author_website_url', 50, 255, $this->getVar('mod_author_website_url')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_AUTHOR_WEBSITE_NAME, 'mod_author_website_name', 50, 255, $this->getVar('mod_author_website_name')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_CREDITS, 'mod_credits', 50, 255, $this->getVar('mod_credits')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_RELEASE_INFO, 'mod_release_info', 50, 255, $this->getVar('mod_release_info')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_RELEASE_FILE, 'mod_release_file', 50, 255, $this->getVar('mod_release_file')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_MANUAL, 'mod_manual', 50, 255, $this->getVar('mod_manual')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_MANUAL_FILE, 'mod_manual_file', 50, 255, $this->getVar('mod_manual_file')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_DEMO_SITE_URL, 'mod_demo_site_url', 50, 255, $this->getVar('mod_demo_site_url')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_DEMO_SITE_NAME, 'mod_demo_site_name', 50, 255, $this->getVar('mod_demo_site_name')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_FORUM_SITE_URL, 'mod_support_url', 50, 255, $this->getVar('mod_support_url')));
        $form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_FORUM_SITE_NAME, 'mod_support_name', 50, 255, $this->getVar('mod_support_name')));
        $form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_WEBSITE_URL, 'mod_website_url', 50, 255, $this->getVar('mod_website_url')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_WEBSITE_NAME, 'mod_website_name', 50, 255, $this->getVar('mod_website_name')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_RELEASE, 'mod_release', 50, 255, $this->getVar('mod_release')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_STATUS, 'mod_status', 50, 255, $this->getVar('mod_status')));		
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_PAYPAL_BUTTON, 'mod_donations', 50, 255, $this->getVar('mod_donations')));
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_SUBVERSION, 'mod_subversion', 50, 255, $this->getVar('mod_subversion')));
    
		$form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButton(_REQUIRED.' <span class="red bold">*</span>', 'submit', _SUBMIT, 'submit'));
		$form->display();
        return $form;
	}
}

class TDMCreateModulesHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
        parent::__construct($db, 'mod_tdmcreate_modules', 'tdmcreatemodules', 'mod_id', 'mod_name');
    }
}
?>