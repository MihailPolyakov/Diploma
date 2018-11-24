<?php
session_start();
//Подключаем файл для соединения с БД
require "../models/connectDB.php";
//Проверяем, что если он не нажал что он является админом, мы ему выводим форму страницы обычного пользователя
if (!empty($_GET['admin'])) {
	//Подключаем файл с формой авторизации администратора
	require '../view/loginadmin.php'; 
} else {
	//подключаем файлы с запросом в БД, для вывода всех категорий и выводом домашней страницы пользователя со списком категорий
	require "../models/SelectCategories.php";
	require "../view/view.php";
}
//Проверка, что пользователь нажал на какую-либо категорию
if (!empty($_GET['idcat'])) {
	//сохраняем ID категории и Название категории и делаем переадресацию на контроллер, для вопросов и ответов.
	$_SESSION['id'] = (int)$_GET['idcat'];
	$_SESSION['category'] = $_GET['category'];
	header('location:controllerUserQA.php');
}

