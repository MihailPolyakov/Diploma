<?php 
require_once '../models/connectDB.php';
$categories = "SELECT id, category FROM categories";
function insertCategory($value) {
	$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
	$insertCategory = $pdo->prepare("INSERT INTO categories (category) VALUES (:category)");
	$insertCategory -> bindParam(':category', $value);
	$insertCategory -> execute();
};
