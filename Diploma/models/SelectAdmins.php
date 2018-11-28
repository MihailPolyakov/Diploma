<?php
/**
 * 
 */
class SelectAdmins 
{
	//переменная с запросом в БД с администраторами
	public $admins = "SELECT id, login, password FROM users WHERE privilege = 'admin'";
	//функция проверки введенного логина пароля в БД администратора
	function checkAdmin($login, $password) {
		$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
		$checkAdmin = "SELECT login, password, privilege FROM users WHERE login = '$login' AND password = '$password' AND privilege = 'admin'";
		foreach ($pdo->query($checkAdmin) as  $value) {
			return 'true';
			exit;
		}
		return 'false';
	}
	//Функция удаления из БД ID - строки
	function delete($nameDB, $id) {
		$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
		$delete = $pdo->prepare("DELETE FROM $nameDB WHERE id = :id");
		$delete->execute(['id'=>$id]);
	}
	//Функция удаления из БД категории и всех вопросов и ответов из этой категории 
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
		$this -> delete($nameDB, $id);
	}
	
}
