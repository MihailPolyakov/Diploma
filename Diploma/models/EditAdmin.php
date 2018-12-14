<?php
/**
 * 
 */
class EditAdmin
{
	//фйнкция на изменение логина и пароля администратору
	public function edit($login, $password, $id, $pdo) 
	{
		$edit = $pdo->prepare("UPDATE users SET login = '$login', password = '$password' WHERE id = $id");
		$edit->execute();
	}
}
