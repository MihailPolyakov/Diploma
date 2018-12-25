<?php

class ControllerAdminHP
{
	private $pdo;

	function __construct($pdo){
		$this->pdo = $pdo;
	}
	//Делаем проверку логина и пароля, при отправки формы авторизации администратора
	function categories()
	{
		$admins = new SelectAdmins;
		$checkadmin = new checkAdmin;
		$categories = new CategoryForAdmin($this->pdo);
			//делаем проверку, на существование сессии с именем Админа
		if (!empty($_SESSION['login'])) {
			require_once 'view/adminHomePage.php';
		} elseif ($checkadmin -> check($_POST['login'], $_POST['password'], $this->pdo) == 'false') {
			header('location: view/wrongLogIn.php');
		} else {
			//Если проверка прошла успешна, то делаем переадресацию с сохранением сессии.
			$_SESSION['login'] = $_POST['login'];
			require_once 'view/adminHomePage.php';
		} 
	}

	function deleteAdmin()
	{
		//подключаем функцию на удаление администратора
		$deleteAdmin = new delete;
		$deleteAdmin -> deleteFromDb('users', $_POST['deleteAdmin'], $this->pdo);
	}

	function newCategory()
	{
		//подключаем функцию на добавление новой категории в БД
		$newCategory = new createCategory;
		$newCategory -> insertCategory($_POST['newcategory'], $this->pdo);
	}

	function newLogin()
	{
		//подключаем функцию на добавление нового администратора в БД
		$createAdmin = new CreateAdmin;
		$createAdmin -> createNewAdmin($_POST['newlogin'], $_POST['newpassword'], $this->pdo);
	}

	function editAdmin()
	{
		//подключаем файл с формой для изменения админисратора
		require_once 'view/formEditAdmin.php';
	}

	function editLogin()
	{
		//подключаем функцию на обновления администратора с новым Логином и Паролем в БД, после отправки
		$id = (int)$_GET['id'];
		$editLogin = new EditAdmin;
		$editLogin -> edit($_GET['editlogin'], $_GET['editpassword'], $id, $this->pdo);
	}

	function deleteCategory()
	{
		//подключаем функцию на удаление категории
		$deleteCategory = new delete;
		$deleteCategory -> deleteCategories('categories', $_POST['deleteCategory'], $this->pdo);
	}

	function transferAnotherController(){
		//переадресация на другой контроллер с сохранением ID категории и Наименование категории, после нажатия админом на какую-нибудь категорию
		$_SESSION['id'] = (int)$_GET['idcatadmin'];
		$_SESSION['category'] = $_GET['category'];
	}
}









