<?php
session_start();
function adminHP($classname){
	require "../models/" . "$classname" . ".php";
}
spl_autoload_register('adminHP');
/**
 * 
 */
class HomePageAdmin
{

	//Делаем проверку логина и пароля, при отправки формы авторизации администратора
	function categories()
	{
		if (!empty($_POST['login']) || !empty($_SESSION['login'])) {
			require_once "../models/connectDB.php";
			//подключаем файл с запросом в БД Users, где хранятся Админы
			$admins = new SelectAdmins;
			//require_once'../models/SelectAdmins.php';
			//делаем проверку, на существование сессии с именем Админа
			if (!empty($_SESSION['login'])) {
				//Если сессия уже существует, то мы загружаем файлы с запросом в БД по категориям и открываем Домашнюю страницу администратора
				$categories = new CategoryForAdmin;
				require_once '../view/adminHomePage.php';
			} else {
				//Если сессии нет, то проверяем введенные данные пользователем на существование такого Логина и Пароля с правами администратора.
				$_SESSION['login'] = $_POST['login'];
				//Если проверка прошла успешна, то делаем переадрисацию на текущий контроллер с сохранением сессии. 
				if ($admins -> checkAdmin($_POST['login'], $_POST['password']) == 'false') {
					echo 'Неправильное имя или пароль';?>
					<a href="../view/loginadmin.php"> Попробовать снова</a>
					<a href="controller.php">Вернуться на главную страницу</a>
				<?php } else {
					header('location:controllerAdminHP.php');
				}
			}
			
		}
	}

	function deleteAdmin()
	{
		//подключаем функцию на удаление администратора
		if (!empty($_GET['deleteAdmin'])) {
			$deleteAdmin = new SelectAdmins;
			$deleteAdmin -> delete('users', $_GET['deleteAdmin']);
			header('location:controllerAdminHP.php');
		};
	}

	function newCategory()
	{
		//подключаем функцию на добавление новой категории в БД
		if (!empty($_POST['category'])) {
			$newCategory = new SelectCategories;
			$newCategory -> insertCategory($_POST['category']);
			header('location:controllerAdminHP.php');;
		};
	}

	function newLogin()
	{
		//подключаем функцию на добавление нового администратора в БД
		if (!empty($_POST['newlogin'])) {
			$createAdmin = new CreateAdmin;
			$createAdmin -> createAdmin($_POST['newlogin'], $_POST['newpassword']);
			header('location:controllerAdminHP.php');
		};
	}

	function editAdmin()
	{
		//подключаем файл с формой для изменения админисратора
		if (!empty($_GET['editAdmin'])) {
			require_once '../view/formEditAdmin.php';
		};
	}

	function editLogin()
	{
		//подключаем функцию на обновления администратора с новым Логином и Паролем в БД, после отправки
		if (!empty($_GET['editlogin'])) {
			var_dump($_GET);
			$id = (int)$_GET['id'];
			$editLogin = new EditAdmin;
			$editLogin -> edit($_GET['editlogin'], $_GET['editpassword'], $id);
			header('location:controllerAdminHP.php');
		};
	}

	function deleteCategory()
	{
		//подключаем функцию на удаление категории
		if (!empty($_GET['deleteCategory'])) {
			$deleteCategory = new SelectAdmins;
			$deleteCategory -> deleteCategories('categories', $_GET['deleteCategory']);
			header('location:controllerAdminHP.php');
		}
	}

	function transferAnotherController(){
		//переадресация на другой контроллер с сохранением ID категории и Наименование категории, после нажатия админом на какую-нибудь категорию
		if (!empty($_GET['idcat'])) {
			$_SESSION['id'] = (int)$_GET['idcat'];
			$_SESSION['category'] = $_GET['category'];
			header('location:controllerAdminQA.php');
		}
	}
}

$homePageAdmin = new HomePageAdmin;
$homePageAdmin -> categories();
$homePageAdmin -> newCategory();
$homePageAdmin -> deleteAdmin();
$homePageAdmin -> newLogin();
$homePageAdmin -> editLogin();
$homePageAdmin -> editAdmin();
$homePageAdmin -> deleteCategory();
$homePageAdmin -> transferAnotherController();







