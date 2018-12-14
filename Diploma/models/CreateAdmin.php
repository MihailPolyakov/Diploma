<?php
/**
 * 
 */
class CreateAdmin
{
	//функция для создания нового администратора
	public function createNewAdmin($login, $password, $pdo) 
	{
		$create = $pdo->prepare("INSERT INTO users (login, password, privilege) VALUES (:login, :password, :privilege)");
		$admin = 'admin';
		$create->bindParam(':login', $login);
		$create->bindParam(':password', $password);
		$create->bindParam(':privilege', $admin);
		$create->execute();
	}
}
