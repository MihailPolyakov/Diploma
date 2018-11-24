<?php
//фйнкция на изменение логина и пароля администратору
function editAdmin($login, $password, $id) {
	$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
	$edit = $pdo->prepare("UPDATE users SET login = '$login', password = '$password' WHERE id = $id");
	$edit->execute();
};