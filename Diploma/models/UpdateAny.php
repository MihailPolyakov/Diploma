<?php
/**
 * 
 */
class UpdateAny
{
	//фйнкция на обновление информации в БД
	public function update($db, $whatUpdate, $value, $id, $pdo ){
		$update = $pdo->prepare("UPDATE $db set $whatUpdate = '$value' WHERE id = $id");
		$update->execute(); 
	}
}
