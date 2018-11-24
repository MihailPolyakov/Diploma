<?php
session_start();
//Делаем проверку логина и пароля, при отправки формы авторизации администратора
if (!empty($_POST['login']) || !empty($_SESSION['login'])) {
	//подключаем файл с запросом в БД Users, где хранятся Админы
	require_once'../models/SelectAdmins.php';
	//делаем проверку, на существование сессии с именем Админа
	if (!empty($_SESSION['login'])) {
		//Если сессия уже существует, то мы загружаем файлы с запросом в БД по категориям и открываем Домашнюю страницу администратора
		require_once '../models/model.php';
		$categories = categoryForAdmin();
		require_once '../view/adminHomePage.php';
	} else {
		//Если сессии нет, то проверяем введенные данные пользователем на существование такого Логина и Пароля с правами администратора.
		$_SESSION['login'] = $_POST['login'];
		$checkAdmin = checkAdmin($_POST['login'], $_POST['password']);
		//Если проверка прошла успешна, то делаем переадрисацию на текущий контроллер с сохранением сессии. 
		if ($checkAdmin == 'false') {
			echo 'Неправильное имя или пароль';?>
			<a href="../view/loginadmin.php"> Попробовать снова</a>
			<a href="controller.php">Вернуться на главную страницу</a>
		<?php } else {
			header('location:controllerAdminHP.php');
		}
	}
	
};
//подключаем функцию на удаление администратора
if (!empty($_GET['deleteAdmin'])) {
	require_once '../models/SelectAdmins.php';
	$id = (int)$_GET['deleteAdmin'];
	delete('users', $id);
	header('location:controllerAdminHP.php');
};
//подключаем функцию на добавление новой категории в БД
if (!empty($_POST['category'])) {
	require_once '../models/SelectAdmins.php';
	require_once '../models/SelectCategories.php';
	insertCategory($_POST['category']);
	header('location:controllerAdminHP.php');;
};
//подключаем функцию на добавление нового администратора в БД
if (!empty($_POST['newlogin'])) {
	require_once '../models/createAdmin.php';
	createAdmin($_POST['newlogin'], $_POST['newpassword'], 'INSERT');
	header('location:controllerAdminHP.php');
};
//подключаем файл с формой для изменения админисратора
if (!empty($_GET['editAdmin'])) {
	require_once '../view/formEditAdmin.php';
};
//подключаем функцию на обновления администратора с новым Логином и Паролем в БД, после отправки
if (!empty($_GET['editlogin'])) {
	require_once '../models/editAdmin.php';
	$id = (int)$_GET['id'];
	editAdmin($_GET['editlogin'], $_GET['editpassword'], $id);
	header('location:controllerAdminHP.php');
};
//подключаем функцию на удаление категории
if (!empty($_GET['deleteCategory'])) {
	require_once '../models/SelectAdmins.php';
	deleteCategories('categories', $_GET['deleteCategory']);
	header('location:controllerAdminHP.php');
}
//переадресация на другой контроллер с сохранением ID категории и Наименование категории, после нажатия админом на какую-нибудь категорию
if (!empty($_GET['idcat'])) {
	$_SESSION['id'] = (int)$_GET['idcat'];
	$_SESSION['category'] = $_GET['category'];
	header('location:controllerAdminQA.php');
}
