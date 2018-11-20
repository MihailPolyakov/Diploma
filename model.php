<?php
require __DIR__ . "/index.php";
$categories = "SELECT c.id AS id_category, c.category, q.id_category AS number_category, COUNT(q.id_category) AS count_questions FROM categories c INNER JOIN questions q ON c.id = q.id_category";
$countPubQuestion = "SELECT c.id AS id_pub_questions, q.id AS id_category_pub_questions, COUNT(q.status) AS count_pub_questions FROM questions q INNER JOIN categories c ON c.id = q.id_category WHERE q.status = 'Опублкован'";
$countWithoutAnswer = "SELECT a.id_question, q.id AS id_category_without_answer, COUNT(q.id) AS count_without_answer FROM answers a INNER JOIN questions q ON a.id_question = q.id WHERE q.id != a.id_question";
$adminHP = [];

foreach ($pdo->query($categories) as $value) {
	$adminHP[] = $value;
}
foreach ($pdo->query($countPubQuestion) as  $value) {
	$adminHP[] = $value;

}
foreach ($pdo->query($countWithoutAnswer) as  $value) {
	$adminHP[] = $value;
}
foreach ($adminHP as $key => $value) {
	var_dump($value);
}
	echo "<pre>";
	print_r($adminHP);
	echo "</pre>";
/*$admin = "SELECT login, password FROM users WHERE login = '$login' AND password = '$password'";

foreach ($pdo->query($admin) as $value) {
	if ($value['login'] == $login && $value['password'] == $password) {
	}
}*/