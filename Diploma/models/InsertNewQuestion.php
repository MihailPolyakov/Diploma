<?php 
//функция создания нового вопроса и занесение юзера в БД.
/**
 * 
 */
class InsertNewQuestion
{
	//функция на добавление нового вопроса
	public function insertQuestion($name, $mail, $question, $idCategory, $pdo)
	{
		$createUser = $pdo->prepare("INSERT INTO users (login, mail) VALUES (:login, :mail)");
		$createUser->bindParam(':login', $name);
		$createUser->bindParam(':mail', $mail);
		$createUser->execute();
		$getIdLastUser = "SELECT MAX(id) FROM users";

		foreach ($pdo->query($getIdLastUser) as $value) {
			$getIdLastUser = $value[0];
			break;
		};

		$createQuestion = $pdo->prepare("INSERT INTO questions (question, id_category, id_user) VALUES (:question, :id_category, :id_user)");
		$createQuestion->bindParam(':question', $question);
		$createQuestion->bindParam(':id_category', $idCategory);
		$createQuestion->bindParam(':id_user', $getIdLastUser);
		$createQuestion->execute();
	}
}
