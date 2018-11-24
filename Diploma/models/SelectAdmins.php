<?php
require '../models/connectDB.php';
$admins = "SELECT id, login, password FROM users WHERE privilege = 'admin'";
function checkAdmin($login, $password) {
	$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
	$checkAdmin = "SELECT login, password, privilege FROM users WHERE login = '$login' AND password = '$password' AND privilege = 'admin'";
	foreach ($pdo->query($checkAdmin) as  $value) {
		return 'true';
		exit;
	}
	return 'false';
};

function delete($nameDB, $id) {
	$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
	$delete = $pdo->prepare("DELETE FROM $nameDB WHERE id = :id");
	$delete->execute(['id'=>$id]);
};

function deleteCategories($nameDB, $id) {
	$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
	$questions = "SELECT id FROM questions WHERE id_category = $id";
	foreach ($pdo->query($questions) as $value) {
		$idquestion = $value['id'];
		$answers = "SELECT id FROM answers WHERE id_question = $idquestion";
		foreach ($pdo->query($answers) as  $value) {
			delete('answers', $value['id']);
		}
	}
	delete($nameDB, $id);
}