<?php
/**
 * 
 */
class ControllerUserQA
{
	private $pdo;

	function __construct($pdo){
		return $this->pdo = $pdo;
	}
	//функция для вывода вопросов и отвтеов по тому id категории, которая получала функция
	function questionsAnswers ($idCategory = NULL)
	{
		if ($idCategory != NULL) {
			$_SESSION['controller'] = 'UserQA';
			$select = new SelectQuestionsAnswers;
			require_once "view/questionsAnswers.php";
		}
	}
	//функция для переадресации на форму для добавления нового вопроса
	function askQuestion ($ask = NULL)
	{
		if ($ask != NULL) {
			header('location: view/formAskQuestion.php');
		}
	}
	//функция на добавление отправленного вопроса
	function insertQuestion ($name = NULL)
	{
		if ($name != NULL) {
			$insertQuestion = new InsertNewQuestion;
			$insertQuestion -> insertQuestion($_POST['name'], $_POST['mail'], $_POST['question'], $_SESSION['id'], $this->pdo);
		}
	}
}

