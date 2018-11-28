<?php
//функция создает запрос в БД, для вывода вопросов и ответов. Для администратора и пользователя будут разные запросы.
/**
 * 
 */
class SelectQuestionsAnswers
{
	
	function questionAnswer($id, $published = NULL) {
		if (is_null($published)) {
			$select = "SELECT q.id, q.id_user, q.id_category, q.question, q.status, q.date, a.id_question, a.answer, u.login, a.id AS id_answer FROM questions q LEFT JOIN answers a ON q.id = a.id_question LEFT JOIN users u ON q.id_user = u.id WHERE q.id_category=$id ORDER BY q.date";
		return $select;
		} else {
			$select = "SELECT q.id, q.id_user, q.id_category, q.question, q.status, q.date, a.id_question, a.answer, u.login, a.id AS id_answer FROM questions q LEFT JOIN answers a ON q.id = a.id_question LEFT JOIN users u ON q.id_user = u.id WHERE q.id_category=$id AND q.status = '$published'";
		return $select;
		}
	}
}

