<?php
/**
 * 
 */
class CreateAdmin
{
	//функция для создания нового администратора
	function createAdmin($login, $password) 
	{
		$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
		$create = $pdo->prepare("INSERT INTO users (login, password, privilege) VALUES (:login, :password, :privilege)");
		$admin = 'admin';
		$create->bindParam(':login', $login);
		$create->bindParam(':password', $password);
		$create->bindParam(':privilege', $admin);
		$create->execute();
	}
}
