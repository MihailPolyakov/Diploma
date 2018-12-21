<?php
/**
 * 
 */

class ControllerUserHP
{
	private $pdo;

	function __construct($pdo) {
		return $this->pdo = $pdo;
	}
	//функция по выводы домашней страницы пользователя
	function homePage ()
	{	
		if (empty($_GET['admin'])) {
			$_SESSION['controller'] = 'UserHP';
			$category = new SelectCategories;
			require "view/view.php";
		} else {
			header('location:view/loginadmin.php');
		}
	}
	//функция для сохранения id категории и имя категории при нажатии на одну из категорий
	function controllerUserQA()
	{
		if (!empty($_GET['idcat'])) {
			$_SESSION['id'] = (int)$_GET['idcat'];
			$_SESSION['category'] = $_GET['category'];	
		}

	}
}


