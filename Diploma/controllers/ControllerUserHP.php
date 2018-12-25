<?php
/**
 * 
 */

class ControllerUserHP
{
	private $pdo;

	function __construct($pdo) {
		$this->pdo = $pdo;
	}
	//функция по выводы домашней страницы пользователя
	function homePage ()
	{	
		$category = new SelectCategories;
		require "view/view.php";
	}

	function loginadmin() {
		header('location:view/loginadmin.php');
	}
	//функция для сохранения id категории и имя категории при нажатии на одну из категорий
	function controllerUserQA()
	{
		$_SESSION['id'] = (int)$_GET['idcat'];
		$_SESSION['category'] = $_GET['category'];	

	}
}


