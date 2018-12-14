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
	function homePage ($hz = NULL)
	{	
		if ($hz == NULL) {
			$_SESSION['controller'] = 'UserHP';
			$category = new SelectCategories;
			require "view/view.php";
		} else {
			header('location:view/loginadmin.php');
		}
	}
	//функция для сохранения id категории и имя категории при нажатии на одну из категорий
	function controllerUserQA($idCategory = NULL, $category = NULL)
	{
		if ($idCategory != NULL) {
			$_SESSION['id'] = (int)$idCategory;
			$_SESSION['category'] = $category;	
		}

	}
}


