<?php 
//функция создания нового ответа с ID вопросом
function insertAnswer($answer, $idQuestion){
	$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
	$createUser = $pdo->prepare("INSERT INTO answers (answer, id_question) VALUES (:answer, :id_question)");
	$createUser->bindParam(':answer', $answer);
	$createUser->bindParam(':id_question', $idQuestion);
	$createUser->execute();
}