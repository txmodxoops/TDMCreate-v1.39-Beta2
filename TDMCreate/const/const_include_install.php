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
 * @version         $Id: const_include_install.php 11084 2013-02-23 15:44:20Z timgno $
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';
function const_include_install($modules, $tables_arr)
{		
	$mod_name = strtolower($modules->getVar('mod_name'));
	$file = 'install.php';
	$tdmcreate_path = TDM_CREATE_MURL.'/'.$mod_name.'/include/'.$file;
	$root_path = XOOPS_URL.'/modules/'.$mod_name.'/include/'.$file;
	$text = '<?php'.const_header($modules, $file);
$text .= <<<EOT
\n\$indexFile = XOOPS_UPLOAD_PATH.'/index.html';
\$blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';

// Making of "uploads" folder
\${$mod_name} = XOOPS_UPLOAD_PATH.'/{$mod_name}';
if(!is_dir(\${$mod_name}))
	mkdir(\${$mod_name}, 0777);
	chmod(\${$mod_name}, 0777);
copy(\$indexFile, \${$mod_name}.'/index.html');
EOT;
	foreach (array_keys($tables_arr) as $i) 
	{	
		$table_name = $tables_arr[$i]->getVar('table_name');

		//fields
		$fields = explode('|', $tables_arr[$i]->getVar('table_fields'));
		$nb_fields = count($fields);

		//parameters
		$parameters = explode('|', $tables_arr[$i]->getVar('table_parameters'));
		$nb_parameters = count($parameters);
		$j=0;
		for ($i=0; $i<$nb_fields; $i++)
		{
			$structure_fields = explode(':', $fields[$i]);
			if ( $i != 0 ) {
				$structure_parameters = explode(':', $parameters[$j]);
				$j++;
			}
			if ( $i == 0 ) {
$text .= <<<EOT
\n// Making of {$table_name} uploads folder
\${$table_name} = \${$mod_name}.'/{$table_name}';
if(!is_dir(\${$table_name}))
	mkdir(\${$table_name}, 0777);
	chmod(\${$table_name}, 0777);
copy(\$indexFile, \${$table_name}.'/index.html');
EOT;
			} else {
				if ( $structure_parameters[0] == 'XoopsFormUploadImage' )
				{
$text .= <<<EOT
\n// Making of "{$structure_fields[0]}" images folder
\${$table_name} = \${$mod_name}.'/images';
if(!is_dir(\${$table_name}))
	mkdir(\${$table_name}, 0777);
	chmod(\${$table_name}, 0777);
copy(\$indexFile, \${$table_name}.'/index.html');
copy(\$blankFile, \${$table_name}.'/blank.gif');

// Making of "{$structure_fields[0]}" images folder
\${$table_name} = \${$mod_name}.'/images/{$table_name}';
if(!is_dir(\${$table_name}))
	mkdir(\${$table_name}, 0777);
	chmod(\${$table_name}, 0777);
copy(\$indexFile, \${$table_name}.'/index.html');
copy(\$blankFile, \${$table_name}.'/blank.gif');
EOT;
				} elseif (  $structure_parameters[0] == 'XoopsFormUploadFile' ) {
$text .= <<<EOT
// Making of "{$structure_fields[0]}" files folder
\${$table_name} = \${$mod_name}.'/files';
if(!is_dir(\${$table_name}))
	mkdir(\${$table_name}, 0777);
	chmod(\${$table_name}, 0777);
copy(\$indexFile, \${$table_name}.'/index.html');

// Making of "{$structure_fields[0]}" files folder
\${$table_name} = \${$mod_name}.'/files/{$table_name}';
if(!is_dir(\${$table_name}))
	mkdir(\${$table_name}, 0777);
	chmod(\${$table_name}, 0777);
copy(\$indexFile, \${$table_name}.'/index.html');
EOT;
				}
			}
		}
	}
;
	createFile(	$tdmcreate_path, $text,
				_AM_TDMCREATE_CONST_OK_INCLUDES,
				_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	if( $modules->getVar('mod_install') == 1 ) {
		createFile(	$root_path, $text,
					_AM_TDMCREATE_CONST_OK_INCLUDES,
					_AM_TDMCREATE_CONST_NOTOK_INCLUDES, $file);
	}
}