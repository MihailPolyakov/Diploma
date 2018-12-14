<?php

class ControllerAdminHP
{
	private $pdo;

	function __construct($pdo){
		return $this->pdo = $pdo;
	}
	//Делаем проверку логина и пароля, при отправки формы авторизации администратора
	function categories()
	{
		if (!empty($_POST['login']) || !empty($_SESSION['login'])) {
			$admins = new SelectAdmins;
			//делаем проверку, на существование сессии с именем Админа
			if (!empty($_SESSION['login'])) {
				//Если сессия уже существует, то мы загружаем файлы с запросом в БД по категориям и открываем Домашнюю страницу администратора
				$categories = new CategoryForAdmin($this->pdo);
				require_once 'view/adminHomePage.php';
			} else {
				//Если сессии нет, то проверяем введенные данные пользователем на существование такого Логина и Пароля с правами администратора.
				//Если проверка прошла успешна, то делаем переадресацию с сохранением сессии. 
				if ($admins -> checkAdmin($_POST['login'], $_POST['password'], $this->pdo) == 'false') {
					header('location: view/wrongLogIn.php');
				} else {
					$_SESSION['login'] = $_POST['login'];
					$_SESSION['controller'] = 'AdminHP';
					header('location:index.php');
				}
			}
			
		}
	}

	function deleteAdmin()
	{
		//подключаем функцию на удаление администратора
		if (!empty($_GET['deleteAdmin'])) {
			$deleteAdmin = new SelectAdmins;
			$deleteAdmin -> delete('users', $_GET['deleteAdmin'], $this->pdo);
		};
	}

	function newCategory()
	{
		//подключаем функцию на добавление новой категории в БД
		if (!empty($_POST['category'])) {
			$newCategory = new SelectCategories;
			$newCategory -> insertCategory($_POST['category'], $this->pdo);
		};
	}

	function newLogin()
	{
		//подключаем функцию на добавление нового администратора в БД
		if (!empty($_POST['newlogin'])) {
			$createAdmin = new CreateAdmin;
			$createAdmin -> createNewAdmin($_POST['newlogin'], $_POST['newpassword'], $this->pdo);
		};
	}

	function editAdmin()
	{
		//подключаем файл с формой для изменения админисратора
		if (!empty($_GET['editAdmin'])) {
			require_once 'view/formEditAdmin.php';
		};
	}

	function editLogin()
	{
		//подключаем функцию на обновления администратора с новым Логином и Паролем в БД, после отправки
		if (!empty($_GET['editlogin'])) {
			$id = (int)$_GET['id'];
			$editLogin = new EditAdmin;
			$editLogin -> edit($_GET['editlogin'], $_GET['editpassword'], $id, $this->pdo);
		};
	}

	function deleteCategory()
	{
		//подключаем функцию на удаление категории
		if (!empty($_GET['deleteCategory'])) {
			$deleteCategory = new SelectAdmins;
			$deleteCategory -> deleteCategories('categories', $_GET['deleteCategory'], $this->pdo);
		}
	}

	function transferAnotherController(){
		//переадресация на другой контроллер с сохранением ID категории и Наименование категории, после нажатия админом на какую-нибудь категорию
		if (!empty($_GET['idcatadmin'])) {
			$_SESSION['id'] = (int)$_GET['idcatadmin'];
			$_SESSION['category'] = $_GET['category'];
		}
	}
}









