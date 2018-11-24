<?php
session_start();
//Как только сделали переадресацию с домашней страницы пользователя, подключаем файл с запрососами в БД и выводим на экран список вопросов, выбраной категории
if (!empty($_SESSION['id'])) {
	require_once "../models/selectQuestionsAnswers.php";
	require_once "../models/connectDB.php";
	$select = questionAnswer($_SESSION['id'], 'published');
	require_once "../view/questionsAnswers.php";
}
//Если пользователь нажал на "Задать вопрос", то идет переадресация на форму, в которой нужно заполнить "Вопрос, имя, мэйл"
if (!empty($_GET['ask'])) {
	header('location: ../view/formAskQuestion.php');
}
//После отправки нового вопроса, подключаем файл с функцией для добавления нового вопроса в БД
if (!empty($_POST['question'])) {
	require_once "../models/insertNewQuestion.php";
	insertQuestion($_POST['name'], $_POST['mail'], $_POST['question'], $_SESSION['id']);
}