<?php
function autoload($classname){
	$contr = "controllers/" . "$classname" . ".php";
	if (file_exists($contr)) {
		require $contr;
	} else {
		require "models/" . "$classname" . ".php";
	}
	
}

spl_autoload_register('autoload');