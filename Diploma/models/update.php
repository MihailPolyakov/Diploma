<?php
function update($db, $whatUpdate, $value, $id ){
	$pdo = new PDO("mysql:host=localhost;dbname=diploma_php", "Miha", "Qwerty123");
	$update = $pdo->prepare("UPDATE $db set $whatUpdate = '$value' WHERE id = $id");
	$update->execute(); 
}