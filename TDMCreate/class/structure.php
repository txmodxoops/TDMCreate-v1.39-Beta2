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
 * @version         $Id: structure.php 11084 2013-02-23 15:44:20Z timgno $
 */
if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

class constArchitecture {
	/*
	*
	* 
	*/
	var $module_name = '';
	/*
	*
	* 
	*/  
	var $folder_name = null;
	/*
	*
	* 
	*/
	var $file_name = null;
	/*
	*
	* 
	*/ 
	var $path = null;
	/*
	*
	* 
	*/
	var $copieFile;
	/*
	*  @public function constructor class
	*  @param string $path
	*/
	function __construct($path) {    
		$this->path = $path;	   	     
	} 
	/*
	*  @public function class
	*  @param string $path
	*/
	function constArchitecture($path)
	{         
		$this->__construct($path);
	}
	/* 
	*  @public function makeDir
	*  @param string $path
	*/
	function makeDir($path)
	{   
		$this->path = $path;        
		if(!is_dir($this->path)) {
		   mkdir($this->path, 0755);
		   chmod($this->path, 0755);	       
		}
	}
	/* 
	*  @public function makeDirModule
	*  @param string $folder_name                                 
	*/
	function makeDirInModule($folder_name)
	{   
		$this->folder_name = $folder_name;   
		$fname = $this->path . '/' .$this->module_name. '/' .$this->folder_name; 	   
		if(!is_dir($fname)) {
		   mkdir($fname, 0755);
		   chmod($fname, 0755);	       
		}
	}
	/* 
	*  @public function makeDir & copy file
	*  @param string $folder_name                                 
	*  @param string $copieFile            
	*  @param string $file                           
	*/
	function makeDirAndCopyFile($folder_name, $copieFile, $file)
	{
		$this->file_name = $file;
		$this->folder_name = $folder_name;
		$this->copieFile = $copieFile;	
		$fname = $this->path . '/' .$this->module_name. '/' .$this->folder_name; 	   
		if(!is_dir($fname)) {
		   mkdir($fname, 0755);
		   chmod($fname, 0755);
		   $this->copyFile($this->folder_name, $this->copieFile, $this->file_name);	       
		} else {
		   $this->copyFile($this->folder_name, $this->copieFile, $this->file_name);
		}
	}
	/* 
	*  @public function copy file
	*  @param string $folder_name                                 
	*  @param string $copieFile            
	*  @param string $file	
	*/
	function copyFile($folder_name, $copieFile, $file)
	{	   
		$this->file_name = $file;
		$this->folder_name = $folder_name;
		$this->copieFile = $copieFile;
		$fname = $this->path . '/' .$this->module_name. '/' .$this->folder_name. '/'. $this->file_name;
		/*if(!is_readable($fname)) {		   
		   chmod($fname, 0777);
		   copy($this->copieFile, $fname);
		} else {*/
		   copy($this->copieFile, $fname);
		//}	   
	}	
}
?>