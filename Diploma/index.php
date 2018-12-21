<?php
session_start();
//Загружаем файлы с автолоударем и подключением к БД
require "models/connectDB.php";
require "models/autoload.php";

//проверка на присутствие гет параметра с именем контроллера, отправляются при переходе на другой контроллер или выходе на главную страницу
if (!empty($_GET['controller'])) {
	$_SESSION['controller'] = $_GET['controller'];
}
//проверка на присутствие пост запроса с именем логина, для обнуления сессии
if (!empty($_POST['login'])) {
	$_SESSION['login'] = NULL;
}
//проверка на присутствие параметров, по которым можно определить, что нужно вызвать контроллер с вопросами и ответами для Администратора
if ((!empty($_GET['idcatadmin']) && !empty($_GET['category'])) || $_SESSION['controller'] == 'AdminQA') {	
	
	$homePageAdmin = new ControllerAdminHP($pdo);
	$homePageAdmin -> transferAnotherController();
	
	$questionAnswers = new ControllerAdminQA($pdo);
	$questionAnswers -> deleteQuestion();
	$questionAnswers -> editQuestion();
	$questionAnswers -> newQuestion();
	$questionAnswers -> category();
	$questionAnswers -> hiddenQuestion();
	$questionAnswers -> publishedQuestion();
	$questionAnswers -> editUser();
	$questionAnswers -> editAnswer();
	$questionAnswers -> postNewAnswer();
	$questionAnswers -> showQuestionsAnswers();
//проверка на присутствие параметров, по которым можно определить, что нужно вызвать контроллер с домашней для Администратора
} elseif (!empty($_POST['login']) ||  $_SESSION['controller'] == 'AdminHP') {
	$homePageAdmin = new ControllerAdminHP($pdo);
	$homePageAdmin -> newCategory();
	$homePageAdmin -> deleteAdmin();
	$homePageAdmin -> newLogin();
	$homePageAdmin -> editLogin();
	$homePageAdmin -> editAdmin();
	$homePageAdmin -> deleteCategory();
	$homePageAdmin -> categories();
//проверка на присутствие параметров, по которым можно определить, что нужно вызвать контроллер с вопросами и ответами для юзера	
} elseif ((!empty($_GET['idcat']) && !empty($_GET['category'])) || $_SESSION['controller'] == 'UserQA') {
	$user = new ControllerUserHP($pdo);
	$user -> controllerUserQA();

	$idCategory = new ControllerUserQA($pdo);
	$idCategory -> insertQuestion();
	$idCategory -> askQuestion();
	$idCategory -> questionsAnswers();	
	//в случае если не одно условие не выполнелось вызывается контроллер с домашней страницей
} else {
	$user = new ControllerUserHP($pdo);
	$user -> homePage();
}

