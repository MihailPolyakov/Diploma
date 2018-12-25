<?php 
/**
 * 
 */
class delete
{
	
		//Функция удаления из БД ID - строки
	public function deleteFromDb($nameDB, $id, $pdo) {
		$delete = $pdo->prepare("DELETE FROM $nameDB WHERE id = :id");
		$delete->execute(['id'=>$id]);
	}
	//Функция удаления из БД категории и всех вопросов и ответов из этой категории 
	public function deleteCategories($nameDB, $id, $pdo) {
		$questions = "SELECT id FROM questions WHERE id_category = $id";
		foreach ($pdo->query($questions) as $value) {
			$idquestion = $value['id'];
			$answers = "SELECT id FROM answers WHERE id_question = $idquestion";
			foreach ($pdo->query($answers) as  $valueanswer) {
				$this -> deleteFromDb('answers', $valueanswer['id'], $pdo);
			}
		}
		$this -> deleteFromDb($nameDB, $id, $pdo);
	}
}