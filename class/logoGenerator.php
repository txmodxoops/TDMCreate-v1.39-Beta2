<?php

include_once dirname(dirname(dirname(dirname(__FILE__)))) . '/mainfile.php';

if(function_exists($_GET['f'])) { // get function name and parameter  $_GET['f']($_GET["p"]);
    include_once 'logoGenerator.php';
    $ret = logoGenerator::createLogo($_GET["iconName"],$_GET["caption"]);
    phpFunction($ret);
} else {
	echo 'Method Not Exist';
}


function phpFunction($val='')
{      // create php function here
	echo $val;
}

class logoGenerator
{
    static function createLogo($logoIcon, $moduleName)
	{
		if (!extension_loaded("gd")) {
			return false;
		} else {
			$required_functions = array("imagecreatefrompng", "imagefttext", "imagecopy", "imagepng", "imagedestroy", "imagecolorallocate");
			foreach ($required_functions as $func) {
				if (!function_exists($func)) {
					return false;
				}
			}
		}

		$dirname = 'TDMCreate';
		$iconFileName = XOOPS_ROOT_PATH . "/Frameworks/moduleclasses/icons/32/".basename($logoIcon);

		$dirlogos = XOOPS_ROOT_PATH . "/modules/" . $dirname . "/images/logos";
		if (!file_exists($imageBase = $dirlogos . "/xoops2.png") || 
			!file_exists($font = $dirlogos . "/VeraBd.ttf") || 
			!file_exists($iconFile = $iconFileName)) {
			return false;
		}

		$imageModule = imagecreatefrompng($imageBase);
		$imageIcon = imagecreatefrompng($iconFile);

		// Write text
		$text_color = imagecolorallocate($imageModule, 0, 0, 0);
		$space_to_border = (92 - strlen($moduleName) * 7.5) / 2;
		imagefttext($imageModule, 8.5, 0, $space_to_border, 45, $text_color, $font, ucfirst($moduleName), array());

		imagecopy($imageModule, $imageIcon, 29, 2, 0, 0, 32, 32);

		$targetImage= "/modules/" . $dirname . "/images/uploads/modules/".$moduleName."_logo.png";

		imagepng($imageModule, XOOPS_ROOT_PATH . $targetImage );

		imagedestroy($imageModule);
		imagedestroy($imageIcon);

		return XOOPS_URL.$targetImage;
	}
}