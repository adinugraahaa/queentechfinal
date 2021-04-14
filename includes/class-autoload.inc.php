<?php

spl_autoload_register("autoload");

function autoload($classname){
	$path = "classes/";
	$ext = ".class.php";
	$filename = $path . $classname . $ext;

	if(!file_exists($filename)) {
		return false;
	}

	include_once $filename;
}
