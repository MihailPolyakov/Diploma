<?php
session_start();

function adminQA($classname){
	require "../models/" . "$classname" . ".php";
}
spl_autoload_register('adminQA');
/**
 * 
 */
class QuestionsAndAnswers
{
	//проверка на существование сессии с ID категории
	function showQuestionsAnswers()
	{
		if (!empty($_SESSION['id'])) {
			//подключение файлов с запросом в БД, для вывода данных о вопросах и отвтеов
			require_once "../models/connectDB.php";
			$categories = new SelectCategories;
			$select = new SelectQuestionsAnswers;
			require_once "../view/questionsAnswersAdmin.php";
		}
	}

	function deleteQuestion()
	{
		//подключение функции для удаление вопроса
		if (!empty($_GET['deleteQuestion'])) {
			$delete = new SelectAdmins;
			$delete -> delete('questions', $_GET['deleteQuestion']);
			header('location: controllerAdminQA.php');
		}
	}
	
	//переадресация на форму для изменения вопроса с сохранением ID вопроса
	function editQuestion()
	{
		if (!empty($_GET['editQuestion'])) {
			$_SESSION['idQuestion'] = $_GET['editQuestion'];
			header('location: ../view/formEditQuestion.php');
		}
	}
	//подключение функции на обновление вопроса после отправки форму с измененным вопроса
	function newQuestion()
	{
		if (!empty($_POST['editQuestion'])) {
			$update = new UpdateAny;
			$update -> update('questions', 'question', $_POST['editQuestion'], $_POST['idQuestion']);
			header('location: controllerAdminQA.php');
		}
	}
	//подключение функции на изменение Категории для ID вопроса
	function category()
	{
		if (!empty($_POST['category'])) {
			$updateCategory = new UpdateAny;
			$updateCategory -> update('questions', 'id_category', $_POST['category'], $_POST['idQuestion']);
			header('location: controllerAdminQA.php');
		}
	}

	//подключение функции на скрытие вопроса
	function hiddenQuestion()
	{
		if (!empty($_GET['hiddenQuestion'])) {
			$hiddenQuestion = new UpdateAny;
			$hiddenQuestion -> update('questions', 'status', 'hidden', $_GET['hiddenQuestion']);
			header('location: controllerAdminQA.php');
		}
	}
	//подключение функции на публикацию вопроса
	function publishedQuestion()
	{
		if (!empty($_GET['publishedQuestion'])) {
			$publeshedQuestion = new UpdateAny;
			$publeshedQuestion -> update('questions', 'status', 'published', $_GET['publishedQuestion']);
			header('location: controllerAdminQA.php');
		}
	}

	//Нужно доделать
	function editUser()
	{
		if (!empty($_GET['editUser'])) {
			header('location: controllerAdminQA.php');
		}
	}
	//переадресация на форму для изменения ответа с сохранением ID вопроса и ID Ответа
	function editAnswer()
	{
		if (!empty($_GET['editAnswer'])) {
			$_SESSION['idQuestion'] = $_GET['editAnswer'];
			$_SESSION['idAnswer'] = $_GET['idAnswer'];
			header('location: ../view/formEditAnswer.php');
		}
	}
	//Запуск проверок и поключение файлов с функциями на изменение или добавление нового ответа, с публикацие на сайте или со скрытием.
	function postNewAnswer()
	{
		if (!empty($_POST['editAnswer'])) {
			$updateNewAnswer = new UpdateAny;
			$insertAnswer = new InsertNewAnswer;
			if ($_POST['withPublished']) {
				$updateNewAnswer -> update('questions', 'status', 'published', $_POST['idQuestion']);
				if (!empty($_POST['idAnswer'])) {
					$updateNewAnswer -> update('answers', 'answer', $_POST['editAnswer'], $_POST['idAnswer']);
				} else {
					require_once '../models/insertNewAnswer.php';
					$insertAnswer -> insertAnswer($_POST['editAnswer'], $_POST['idQuestion']);
				}	
				header('location: controllerAdminQA.php');
			} else {
				require_once '../models/update.php';
				$updateNewAnswer -> update('questions', 'status', 'hidden', $_POST['idQuestion']);
					if (!empty($_POST['idAnswer'])) {
						$updateNewAnswer -> update('answers', 'answer', $_POST['editAnswer'], $_POST['idAnswer']);
					} else {
						require_once '../models/insertNewAnswer.php';
						$insertAnswer -> insertAnswer($_POST['editAnswer'], $_POST['idQuestion']);
					}
				header('location: controllerAdminQA.php');
			}
		}	
	}
}

$questionAnswers = new QuestionsAndAnswers;
$questionAnswers -> showQuestionsAnswers();
$questionAnswers -> deleteQuestion();
$questionAnswers -> editQuestion();
$questionAnswers -> newQuestion();
$questionAnswers -> category();
$questionAnswers -> hiddenQuestion();
$questionAnswers -> publishedQuestion();
$questionAnswers -> editUser();
$questionAnswers -> editAnswer();
$questionAnswers -> postNewAnswer();	