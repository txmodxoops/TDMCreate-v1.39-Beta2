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
 * @version         $Id: const_include_search.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_include_search($modules, $table_name, $table_fieldname, $table_fields, $table_parameters, $table_image)
{
	$mod_name = $modules->getVar('mod_name');
	$file = 'search.inc.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/include/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/include/'.$file;
	//copie de l'image de la table et renommer
	$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '\\1' , $table_image) ;
	$imgFile = XOOPS_ROOT_PATH.'/modules/TDMCreate/images/uploads/tables/'.$table_image;
	$img_search = $table_fieldname.'_search.'.$extension;
	if (file_exists($imgFile)) {
		copy($imgFile, TDM_CREATE_MURL.'/'.$mod_name.'/images/icons/'.$img_search);
	}
	
	//fields
	$fields_total = explode('|', $table_fields);
	$nb_fields = count($fields_total);
	//print_r($fields_total);
	//parameters
	$parameters_total = explode('|', $table_parameters);
	$k = 0;
	//Recuperation des parameters affichage dans le formulaire
	for($j=0; $j<$nb_fields; $j++)
	{
		$fields = explode(':', $fields_total[$j]);
		$field[$j] = $fields[0];
		//Afficher dans les elements du formulaire et choisir le type
		if( $j == 0 ) {
		    $fpsf[$k] = $fields[0];
			$fpmf = '0';
		} else {
			$parameters1 = explode(':', $parameters_total[$j-1]);
			if ( $parameters1[5] == 1 )
			{
				$fpsf[$k] = $fields[0];
				$k++;
			}
			if ( $parameters1[4] == 1 ) {
				$fpmf = $fields[0];
			}
		}
	}	
	
	$text = '<?php'.const_header($modules, $file).'	
function '.$mod_name.'_search($queryarray, $andor, $limit, $offset, $userid)
{
	global $xoopsDB;
	
	$sql = "SELECT '.$field[0].', '.$fpmf.' FROM ".$xoopsDB->prefix(\'mod_'.$table_name.'\')." WHERE '.$table_fieldname.'_online = 1";
	
	if ( $userid != 0 ) {
		$sql .= " AND '.$table_fieldname.'_submitter=".intval($userid);
	}
	
	if ( is_array($queryarray) && $count = count($queryarray) ) 
	{
		$sql .= " AND (';
		$text .= ''.search_field($fpsf, 0).'";
		
		for($i=1;$i<$count;$i++)
		{
			$sql .= " $andor ";
			';
			$text .= '$sql .= "'.search_field($fpsf, '$i').'";
		}
		$sql .= ")";
	}
	
	$sql .= " ORDER BY '.$field[0].' DESC";
	$result = $xoopsDB->query($sql,$limit,$offset);
	$ret = array();
	$i = 0;
	while($myrow = $xoopsDB->fetchArray($result))
	{
		$ret[$i][\'image\'] = \'images/icons/32/'.$img_search.'\';
		$ret[$i][\'link\'] = \''.$table_name.'.php?'.$field[0].'=\'.$myrow[\''.$field[0].'\'];
		$ret[$i][\'title\'] = $myrow[\''.$fpmf.'\'];			
		$i++;
	}
	return $ret;
}	
';		
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_INCLUDES,
				_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_INCLUDES,
					_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	}
}