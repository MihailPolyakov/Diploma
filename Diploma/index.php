<?php

class ConnectToController 
{
	
	function connect($header)
	{
		return header("location: $header");
	}
}

$header = new ConnectToController;
$header->connect('controllers/controllerUserHP.php');
