<?php 
//require_once '../models/connectDB.php';
//переменная с запросом в БД всех категорий
//$categories = "SELECT id, category FROM categories";
//функция создает новую категорию в БД
/*function insertCategory($value) {
	$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
	$insertCategory = $pdo->prepare("INSERT INTO categories (category) VALUES (:category)");
	$insertCategory -> bindParam(':category', $value);
	$insertCategory -> execute();
}*/
/**
 * 
 */
class SelectCategories
{
	public $categories = "SELECT id, category FROM categories";

	function insertCategory($value) 
	{
	$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
	$insertCategory = $pdo->prepare("INSERT INTO categories (category) VALUES (:category)");
	$insertCategory -> bindParam(':category', $value);
	$insertCategory -> execute();
	}
}