<?php
/**
 * 
 */
class checkAdmin
{
	
		//функция проверки введенного логина пароля в БД администратора
	public function check($login, $password, $pdo) {
		$checkAdmin = "SELECT login, password, privilege FROM users WHERE login = '$login' AND password = '$password' AND privilege = 'admin'";
		foreach ($pdo->query($checkAdmin) as  $value) {
			return 'true';
		}
		return 'false';
	}
}