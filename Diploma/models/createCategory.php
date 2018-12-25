<?php
/**
 * 
 */
class createCategory
{
	
	//функция для добавления новой категории
	public function insertCategory($value, $pdo) {
		$insertCategory = $pdo->prepare("INSERT INTO categories (category) VALUES (:category)");
		$insertCategory -> bindParam(':category', $value);
		$insertCategory -> execute();
	}
}