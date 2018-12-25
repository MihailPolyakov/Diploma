<?php
session_start();
//Загружаем файлы с автолоударем и подключением к БД
require "models/connectDB.php";
require "models/autoload.php";

$user = new ControllerUserHP($pdo);
$homePageAdmin = new ControllerAdminHP($pdo);
$questionAnswers = new ControllerAdminQA($pdo);
$idCategory = new ControllerUserQA($pdo);

	if (!empty($_GET['idcatadmin']) && !empty($_GET['category'])) {
	//вызвать функцию для отображения вопросов и ответтов для администартора		
		$homePageAdmin -> transferAnotherController();
		$questionAnswers -> showQuestionsAnswers();
	}

	if (!empty($_POST['login'])) {
	//вызвать функцию для отображения домашней страницы для администратора	
		$homePageAdmin -> categories();	
	}

	if (!empty($_GET['admin'])){
		$user -> loginadmin();
	}

	if ((!empty($_GET['idcat']) && !empty($_GET['category']))) {
	//вызвать функцию для отображения вопросов и ответтов для пользователя	
		$user -> controllerUserQA();
		$idCategory -> questionsAnswers();		
	}

	if (empty($_GET) && empty($_POST)) { 
		//вызвать функцию для отображения домашней страницы
		$user -> homePage();
	}


	if (!empty($_POST['deleteAdmin'])) {
		$homePageAdmin -> deleteAdmin();
		$homePageAdmin -> categories();
	};

	if (!empty($_POST['newcategory'])) {
		$homePageAdmin -> newCategory();
		$homePageAdmin -> categories();
	};	
	
	if (!empty($_POST['newlogin'])) {
		$homePageAdmin -> newLogin();
		$homePageAdmin -> categories();
	};
	
	if (!empty($_GET['editAdmin'])) {
		$homePageAdmin -> editAdmin();
		$homePageAdmin -> categories();
	};

	if (!empty($_GET['editlogin'])) {
		$homePageAdmin -> editLogin();
		$homePageAdmin -> categories();
	};

	if (!empty($_POST['deleteCategory'])) {
		$homePageAdmin -> deleteCategory();
		$homePageAdmin -> categories();
	}
	if (!empty($_GET['homepage'])) {
		$homePageAdmin -> categories();
	}



	if (!empty($_GET['ask'])) {
		$idCategory -> askQuestion();
		$idCategory -> questionsAnswers();
	}
	
	if (!empty($_POST['name'])) {
		$idCategory -> insertQuestion();
		$idCategory -> questionsAnswers();
	}


	if (!empty($_POST['deleteQuestion'])) {
		$questionAnswers -> deleteQuestion();
		$questionAnswers -> showQuestionsAnswers();
	}
	if (!empty($_GET['editQuestion'])) {
		$questionAnswers -> editQuestion();
		$questionAnswers -> showQuestionsAnswers();
	}
	if (!empty($_POST['editQuestion'])) {
		$questionAnswers -> newQuestion();
		$questionAnswers -> showQuestionsAnswers();
	}
	if (!empty($_POST['category'])) {
		$questionAnswers -> category();
		$questionAnswers -> showQuestionsAnswers();
	}
	if (!empty($_POST['hiddenQuestion'])) {
		$questionAnswers -> hiddenQuestion();
		$questionAnswers -> showQuestionsAnswers();
	}
	if (!empty($_POST['publishedQuestion'])) {
		$questionAnswers -> publishedQuestion();
		$questionAnswers -> showQuestionsAnswers();
	}
	if (!empty($_POST['editUser'])) {
		$questionAnswers -> editUser();
		$questionAnswers -> showQuestionsAnswers();
	}
	if (!empty($_GET['editAnswer'])) {
		$questionAnswers -> editAnswer();
		$questionAnswers -> showQuestionsAnswers();
	}
	if (!empty($_POST['editAnswer'])) {
		$questionAnswers -> postNewAnswer();
		$questionAnswers -> showQuestionsAnswers();
	}