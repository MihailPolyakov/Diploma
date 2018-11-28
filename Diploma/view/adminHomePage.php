<!DOCTYPE html>
<html>
<head>
	<title>Администратор сайта</title>
</head>
<body>
	<p><a href="../controllers/controllerUserHP.php">Выйти</a></p>
	<form action="" method=POST>
		<input type="text" name="category" placeholder="Напишите новую категорию">
		<input type="submit" value="Добавить">
	</form>
	<p><a href="../view/formCreateNewAdmin.php">Создать нового администратора</a></p>
	<table>
		<tr>
			<td>Категория</td>
			<td></td>
			<td>Количество вопросов</td>
			<td>Количество опубликованных вопросов</td>
			<td>Количество не отвеченных вопросов</td>
		</tr>
		<?php
		foreach ($categories -> categoryForAdmin() as $key => $value) {?>
		 	<tr>
				<td><a href="?idcat=<?php echo $value[1]?>&&category=<?php echo $value[0]?>"><?php echo $value[0]?></a></td>
				<td>
					<a href="?deleteCategory=<?php echo $value[1]?>">Удалить</a>	
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
			foreach ($pdo->query($admins -> admins) as  $value) {?>
				<tr>
					<td><?php echo $value['login']?></td>
					<td><?php echo $value['password']?></td>
					<td><a href="?editAdmin=<?php echo $value['id']?>">Изменить</a></td>
					<td><a href="?deleteAdmin=<?php echo $value['id']?>">Удалить</a></td>
				</tr>
			<?php } ?>
	</table>
		
</body>
</html>