<?php 
/**
 * 
 */
class InsertNewAnswer
{
	//функция создания нового ответа с ID вопросом
	public function insertAnswer($answer, $idQuestion, $pdo){
		$createUser = $pdo->prepare("INSERT INTO answers (answer, id_question) VALUES (:answer, :id_question)");
		$createUser->bindParam(':answer', $answer);
		$createUser->bindParam(':id_question', $idQuestion);
		$createUser->execute();
	}
}
