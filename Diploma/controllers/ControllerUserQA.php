<?php
/**
 * 
 */
class ControllerUserQA
{
	private $pdo;

	function __construct($pdo){
		$this->pdo = $pdo;
	}
	//функция для вывода вопросов и отвтеов по тому id категории, которая получала функция
	function questionsAnswers ()
	{
		$select = new SelectQuestionsAnswers;
		require_once "view/questionsAnswers.php";
	}
	//функция для переадресации на форму для добавления нового вопроса
	function askQuestion ()
	{
		require_once "view/formAskQuestion.php";
	}
	//функция на добавление отправленного вопроса
	function insertQuestion ()
	{
		$insertQuestion = new InsertNewQuestion;
		$insertQuestion -> insertQuestion($_POST['name'], $_POST['mail'], $_POST['question'], $_SESSION['id'], $this->pdo);
	}
}

