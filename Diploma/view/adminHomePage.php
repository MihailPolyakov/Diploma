<!DOCTYPE html>
<html>
<head>
	<title>Администратор сайта</title>
</head>
<body>
	<p><a href="index.php">Выйти</a></p>
	<form action="index.php" method=POST>
		<input type="text" name="newcategory" placeholder="Напишите новую категорию">
		<input type="submit" value="Добавить">
	</form>
	<p><a href="view/formCreateNewAdmin.php">Создать нового администратора</a></p>
	<table>
		<tr>
			<td>Категория</td>
			<td></td>
			<td>Количество вопросов</td>
			<td>Количество опубликованных вопросов</td>
			<td>Количество не отвеченных вопросов</td>
		</tr>
		<?php
		foreach ($categories -> categoryForAdmin($this->pdo) as $key => $value) {?>
		 	<tr>
				<td><a href="?idcatadmin=<?php echo $value[1]?>&&category=<?php echo $value[0]?>"><?php echo $value[0]?></a></td>
				<td>
					<form action="index.php" method="POST">
						<input type="hidden" name="deleteCategory" value="<?php echo $value[1]?>">
						<input type="submit" value="Удалить">
					</form>	
				</td>
				<td><?php echo $value[2]?></td>
				<td><?php echo $value[3]?></td>
				<td><?php echo $value[4]?></td>
			</tr>	
	    <?php }?>
	</table>
	<table>
		<tr>
			<td>Логин</td>
			<td>Пароль</td>
			<td></td>
		</tr>
		<?php 
			foreach ($this->pdo->query($admins -> admins) as  $value) {?>
				<tr>
					<td><?php echo $value['login']?></td>
					<td><?php echo $value['password']?></td>
					<td><a href="?editAdmin=<?php echo $value['id']?>">Изменить</a></td>
					<td>
						<form action="index.php" method="POST">
						<input type="hidden" name="deleteAdmin" value="<?php echo $value['id']?>">
						<input type="submit" value="Удалить">
						</form>
					</td>
				</tr>
			<?php } ?>
	</table>
		
</body>
</html>