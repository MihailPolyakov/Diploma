<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION['category']?></title>
</head>
<body>
	<a href="../controllers/controllerAdminHP.php">Вернуться на домашнюю страницу</a>
	<table>
		<tr>
			<td>Вопрос</td>
			<td>Дата</td>
			<td>Статус</td>
			<td></td>
			<td>Автор</td>
			<td>Ответ</td>
		</tr>
		<?php
		foreach ($pdo->query($select -> questionAnswer($_SESSION['id'])) as  $value) {?>
			<tr>
				<td><?php echo $value['question'];?></td>
				<td><?php echo $value['date'];?></td>
				<td><?php echo $value['status'];?></td>
				<td>
					<a href="?deleteQuestion=<?php echo $value['id'];?>">Удалить</a>
					<a href="?editQuestion=<?php echo $value['id'];?>">Редактировать вопрос</a>
					<form action="" method="POST">
						<select name = 'category'>
						<?php foreach ($pdo->query($categories -> categories) as $cat) {?>
							<option value="<?php echo $cat['id'];?>"><?php echo $cat['category'];?></option>
						<?php } ?>
						</select>
						<input type="hidden" name="idQuestion" value = <?php echo $value['id'];?>>
						<input type="submit" value="Переместить в другую папку">
					</form>
					<?php if ($value['status'] == 'published') {?>
						<a href="?hiddenQuestion=<?php echo $value['id'];?>">Скрыть</a>
					<?php } else { ?>
						<a href="?publishedQuestion=<?php echo $value['id'];?>">Опубликовать</a>
					<?php } ?>
				</td>
				<td>
					<p><?php echo $value['login'];?></p>
					<p><a href="?editUser=<?php echo $value['id']?>&&idUser=<?php echo($value['id_user'])?>">Изменить автора</a></p>
				</td>
				<td>
					<?php if (is_null($value['answer'])) {?>
						<a href="?editAnswer=<?php echo $value['id'];?>&&idAnswer=<?php echo $value['id_answer']?>">Ответить</a>
					<?php } else { ?>
						<p><?php echo $value['answer'];?></p>
						<p><a href="?editAnswer=<?php echo $value['id']?>&&idAnswer=<?php echo $value['id_answer']?>">Изменить ответ</a></p>
					<?php } ?>	
				</td>
			</tr>
		<?php } ?>
	</table>
</body>
</html>