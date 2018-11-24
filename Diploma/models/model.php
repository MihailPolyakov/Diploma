<?php
//функция создает массив с данным о категория, и подсчет количества вопросов, опубликованных вопросов и вопросов без ответа
function categoryForAdmin() {
	$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");	
	$categories = "SELECT id, category FROM categories";
	$arrayCategory = [];
	$key = -1;
	foreach ($pdo->query($categories) as $value) {
		$idcat = $value['id'];
		$countQuestion = "SELECT COUNT(q.id_category) AS count_questions FROM categories c INNER JOIN questions q ON c.id = q.id_category WHERE q.id_category = $idcat";
		$countPubQuestion = "SELECT COUNT(q.status) AS count_pub_questions FROM questions q INNER JOIN categories c ON c.id = q.id_category WHERE q.status = 'published' AND q.id_category = $idcat";
		$countWithoutAnswer = "SELECT COUNT(q.id) AS notAnswer FROM questions q LEFT JOIN answers a ON  q.id = a.id_question WHERE a.id_question IS NULL AND q.id_category = $idcat";
		$arrayCategory[] = (array)$value['category'];
		++$key;
		foreach ($pdo->query($countQuestion) as  $questions) {
			$arrayCategory[$key][] = $value['id'];
			$arrayCategory[$key][] = $questions['count_questions'];
		}

		foreach ($pdo->query($countPubQuestion) as $questions) {
			$arrayCategory[$key][] = $questions['count_pub_questions'];
		}

		foreach ($pdo->query($countWithoutAnswer) as $withoutAnswer) {
			$arrayCategory[$key][] = $withoutAnswer['notAnswer'];
		}
	}	
	return $arrayCategory;
};
