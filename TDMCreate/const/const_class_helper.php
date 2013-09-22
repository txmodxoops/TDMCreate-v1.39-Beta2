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
 * @version         $Id: const_class_helper.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_class_helper($modules)
{
	$mod_name = $modules->getVar('mod_name');
	$language = '_AM_'.strtoupper($mod_name).'_';
	$file = 'helper.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/class/'.$file;	
    $root_path = XOOPS_URL.'/modules/'.$mod_name.'/class/'.$file;	
	$ucf_mod_name = ucfirst($mod_name);
	$mod_name_helper = $ucf_mod_name.'_Module_Helper_Abstract';
	$text = '<?php'.const_header($modules, $file); 
$text .= <<<EOT
\n\ndefined('XOOPS_ROOT_PATH') or die('Restricted access');

class {$ucf_mod_name} /*extends {$mod_name_helper}*/
{ 
	/**
     * Init vars
     * @initialize variables
     */
	var \$_config;
	var \$_dirname;
	var \$_handler;
	var \$_module;	

	/**
     * Constructor
	 *
     * @param \$dirname
     */
	function __construct(\$dirname = '')
	{
		\$this->_dirname = \$dirname;		
	}
	
	/**
     * Get instance
     * @return object
     */
	function &getInstance() 
	{
		static \$instance = false;
		if (!\$instance) {
			\$instance = new self();
		}
		return \$instance;
	}

	/**
     * Init config
     * @initialize object
     */
	function initConfig()
    {        
        \$modConfigHandler = xoops_gethandler('config');
        \$this->_config = \$modConfigHandler->getConfigsByCat(0, \$this->getModule()->getVar('mid'));
    }
	
	/**
     * Init module
     * @initialize object
     */
	function initModule()
    {
        global \$xoopsModule;
        if (isset(\$xoopsModule) && is_object(\$xoopsModule) && \$xoopsModule->getVar('dirname') == \$this->_dirname) {
            \$this->_module = \$xoopsModule;
        } else {
            \$module_handler = xoops_gethandler('module');
            \$this->_module = \$module_handler->getByDirname(\$this->_dirname);
        }        
    }
	
	/**
     * Init handler
     * @initialize object
     */
	function initHandler(\$name)
    {        
        \$this->handler[\$name . '_handler'] = xoops_getmodulehandler(\$name, \$this->_dirname);
    }
	
	/**
     * Get module
     * @return object
     */
	function &getModule()
    {
        if (\$this->_module == null) {
            \$this->initModule();
        }
        return \$this->_module;
    }
	
	/**
     * Get modules
     * @return array objects
     */
	function &getModules(\$dirnames = array(), \$otherCriteria = null, \$asObj = false)
	{
		// get all dirnames
		\$module_handler = xoops_gethandler('module');
		\$criteria = new CriteriaCompo();
		if(count(\$dirnames) > 0) {		
			foreach(\$dirnames as \$mDir) {
				\$criteria->add(new Criteria('dirname', \$mDir), 'OR');
			}
		}
        if (!empty(\$otherCriteria)) {
            \$criteria->add(\$otherCriteria);
        }
		\$criteria->add(new Criteria('isactive', 1), 'AND');
		\$modules = \$module_handler->getObjects(\$criteria, true);
		if(\$asObj) return \$modules;
		\$dirs['system-root'] = _YOURHOME;
		foreach(\$modules as \$module) {
			\$dirs[\$module->dirname()] = \$module->name();
		}
		return \$dirs;
	}
	
	/**
     * Get handler
     * @return object
     */
	function &getHandler(\$name)
    {
        if (!isset(\$this->handler[\$name . '_handler'])) {
            \$this->initHandler(\$name);
        }        
        return \$this->handler[\$name . '_handler'];
    }	
}
EOT;
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_CLASSES,
				_AM_TDMCREATE_CONST_NOTOK_CLASSES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_CLASSES,
					_AM_TDMCREATE_CONST_NOTOK_CLASSES, $file);
	}
}