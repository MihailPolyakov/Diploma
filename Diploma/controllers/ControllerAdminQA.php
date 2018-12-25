<?php

class ControllerAdminQA
{
	private $pdo;

	function __construct($pdo){
		$this->pdo = $pdo;
	}
	//проверка на существование сессии с ID категории
	function showQuestionsAnswers()
	{
		//подключение файлов с запросом в БД, для вывода данных о вопросах и отвтеов
		$categories = new SelectCategories;
		$select = new SelectQuestionsAnswers;
		$users = new SelectUsers;
		require_once "view/questionsAnswersAdmin.php";
	}

	function deleteQuestion()
	{
		//подключение функции для удаление вопроса
		$delete = new delete;
		$delete -> deleteFromDb('questions', $_POST['deleteQuestion'], $this->pdo);
	}
	
	//переадресация на форму для изменения вопроса с сохранением ID вопроса
	function editQuestion()
	{
		$_SESSION['idQuestion'] = $_GET['editQuestion'];
		header('location: view/formEditQuestion.php');
	}
	//подключение функции на обновление вопроса после отправки форму с измененным вопроса
	function newQuestion()
	{
		$update = new UpdateAny;
		$update -> update('questions', 'question', $_POST['editQuestion'], $_POST['idQuestion'], $this->pdo);
	}
	//подключение функции на изменение Категории для ID вопроса
	function category()
	{
		$updateCategory = new UpdateAny;
		$updateCategory -> update('questions', 'id_category', $_POST['category'], $_POST['idQuestion'], $this->pdo);
	}

	//подключение функции на скрытие вопроса
	function hiddenQuestion()
	{
		$hiddenQuestion = new UpdateAny;
		$hiddenQuestion -> update('questions', 'status', 'hidden', $_POST['hiddenQuestion'], $this->pdo);
	}
	//подключение функции на публикацию вопроса
	function publishedQuestion()
	{
		$publeshedQuestion = new UpdateAny;
		$publeshedQuestion -> update('questions', 'status', 'published', $_POST['publishedQuestion'], $this->pdo);
	}

	//изменяем автора вопроса
	function editUser()
	{
		$editUser = new UpdateAny;
		$editUser -> update('questions', 'id_user', $_POST['editUser'], $_POST['idQuestion'], $this->pdo);
	}
	//переадресация на форму для изменения ответа с сохранением ID вопроса и ID Ответа
	function editAnswer()
	{
		if (!empty($_GET['editAnswer'])) {
			$_SESSION['idQuestion'] = $_GET['editAnswer'];
			$_SESSION['idAnswer'] = $_GET['idAnswer'];
			header('location: view/formEditAnswer.php');
		}
	}
	//Запуск проверок с функциями на изменение или добавление нового ответа, с публикацие на сайте или со скрытием.
	function postNewAnswer()
	{
			$updateNewAnswer = new UpdateAny;
			$insertAnswer = new InsertNewAnswer;
			if (!empty($_POST['withPublished'])) {
				$updateNewAnswer -> update('questions', 'status', 'published', $_POST['idQuestion'], $this->pdo);
				if (!empty($_POST['idAnswer'])) {
					$updateNewAnswer -> update('answers', 'answer', $_POST['editAnswer'], $_POST['idAnswer'], $this->pdo);
				} else {
					$insertAnswer -> insertAnswer($_POST['editAnswer'], $_POST['idQuestion'], $this->pdo);
				}	
			} else {
				$updateNewAnswer -> update('questions', 'status', 'hidden', $_POST['idQuestion'], $this->pdo);
					if (!empty($_POST['idAnswer'])) {
						$updateNewAnswer -> update('answers', 'answer', $_POST['editAnswer'], $_POST['idAnswer'], $this->pdo);
					} else {
						$insertAnswer -> insertAnswer($_POST['editAnswer'], $_POST['idQuestion'], $this->pdo);
					}
			}	
	}
}

	