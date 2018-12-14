<?php 
/**
 * 
 */
class SelectCategories
{
	public $categories = "SELECT id, category FROM categories";
	//функция для добавления новой категории
	public function insertCategory($value, $pdo) {
		$insertCategory = $pdo->prepare("INSERT INTO categories (category) VALUES (:category)");
		$insertCategory -> bindParam(':category', $value);
		$insertCategory -> execute();
	}
}
