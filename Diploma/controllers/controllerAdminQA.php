<?php
session_start();
//проверка на существование сессии с ID категории
if (!empty($_SESSION['id'])) {
	//подключение файлов с запросом в БД, для вывода данных о вопросах и отвтеов
	require_once "../models/connectDB.php";
	require_once "../models/selectCategories.php";
	require_once "../models/selectQuestionsAnswers.php";
	$select = questionAnswer($_SESSION['id']);
	require_once "../view/questionsAnswersAdmin.php";
}
//подключение функции для удаление вопроса
if (!empty($_GET['deleteQuestion'])) {
	require_once "../models/SelectAdmins.php";
	delete('questions', $_GET['deleteQuestion']);
	header('location: controllerAdminQA.php');
}
//переадресация на форму для изменения вопроса с сохранением ID вопроса
if (!empty($_GET['editQuestion'])) {
	$_SESSION['idQuestion'] = $_GET['editQuestion'];
	header('location: ../view/formEditQuestion.php');
}
//подключение функции на обновление вопроса после отправки форму с измененным вопроса
if (!empty($_POST['editQuestion'])) {
	require_once '../models/update.php';
	update('questions', 'question', $_POST['editQuestion'], $_POST['idQuestion']);
	header('location: controllerAdminQA.php');
}
//подключение функции на изменение Категории для ID вопроса
if (!empty($_POST['category'])) {
	require_once '../models/update.php';
	update('questions', 'id_category', $_POST['category'], $_POST['idQuestion']);
	header('location: controllerAdminQA.php');
}
//подключение функции на скрытие вопроса
if (!empty($_GET['hiddenQuestion'])) {
	require_once '../models/update.php';
	update('questions', 'status', 'hidden', $_GET['hiddenQuestion']);
	header('location: controllerAdminQA.php');
}
//подключение функции на публикацию вопроса
if (!empty($_GET['publishedQuestion'])) {
	require_once '../models/update.php';
	update('questions', 'status', 'published', $_GET['publishedQuestion']);
	header('location: controllerAdminQA.php');
}

//Нужно доделать
if (!empty($_GET['editUser'])) {
	header('location: controllerAdminQA.php');
}
//переадресация на форму для изменения ответа с сохранением ID вопроса и ID Ответа
if (!empty($_GET['editAnswer'])) {
	$_SESSION['idQuestion'] = $_GET['editAnswer'];
	$_SESSION['idAnswer'] = $_GET['idAnswer'];
	header('location: ../view/formEditAnswer.php');
}
//Запуск проверок и поключение файлов с функциями на изменение или добавление нового ответа, с публикацие на сайте или со скрытием.
if (!empty($_POST['editAnswer'])) {
	if ($_POST['withPublished']) {
		require_once '../models/update.php';
		update('questions', 'status', 'published', $_POST['idQuestion']);
		if (!empty($_POST['idAnswer'])) {
			update('answers', 'answer', $_POST['editAnswer'], $_POST['idAnswer']);
		} else {
			require_once '../models/insertNewAnswer.php';
			insertAnswer($_POST['editAnswer'], $_POST['idQuestion']);
		}	
		header('location: controllerAdminQA.php');
	} else {
		require_once '../models/update.php';
		update('questions', 'status', 'hidden', $_POST['idQuestion']);
		if (!empty($_POST['idAnswer'])) {
			update('answers', 'answer', $_POST['editAnswer'], $_POST['idAnswer']);
		} else {
			require_once '../models/insertNewAnswer.php';
			insertAnswer($_POST['editAnswer'], $_POST['idQuestion']);
		}
		header('location: controllerAdminQA.php');
	}
}
		