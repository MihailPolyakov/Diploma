<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION['category']?></title>
</head>
<body>
	<a href="?homepage=admin">Вернуться на домашнюю страницу</a>
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
		foreach ($this->pdo->query($select -> questionAnswer($_SESSION['id'])) as  $value) {?>
			<tr>
				<td><?php echo $value['question'];?></td>
				<td><?php echo $value['date'];?></td>
				<td><?php echo $value['status'];?></td>
				<td>
					<form action="index.php" method="POST">
						<input type="hidden" name="deleteQuestion" value = <?php echo $value['id'];?>>
						<input type="submit" value="Удалить вопрос">
					</form>
					<a href="?editQuestion=<?php echo $value['id'];?>">Редактировать вопрос</a>
					<form action="index.php" method="POST">
						<select name = 'category'>
						<?php foreach ($this->pdo->query($categories -> categories) as $cat) {?>
							<option value="<?php echo $cat['id'];?>"><?php echo $cat['category'];?></option>
						<?php } ?>
						</select>
						<input type="hidden" name="idQuestion" value = <?php echo $value['id'];?>>
						<input type="submit" value="Переместить в другую папку">
					</form>
					<?php if ($value['status'] == 'published') {?>
						<form action="index.php" method="POST">
						<input type="hidden" name="hiddenQuestion" value = <?php echo $value['id'];?>>
						<input type="submit" value="Скрыть">
						</form>
					<?php } else { ?>
						<form action="index.php" method="POST">
						<input type="hidden" name="publishedQuestion" value = <?php echo $value['id'];?>>
						<input type="submit" value="Опубликовать">
						</form>
					<?php } ?>
				</td>
				<td>
					<p><?php echo $value['login'];?></p>
					<form action="index.php" method="POST">
						<input type="hidden" name="idQuestion" value="<?php echo $value['id'];?>">
						<select name = 'editUser'>
							<?php foreach ($this->pdo->query($users -> users) as  $logins) {?>
								<option value="<?php echo $logins['id']?>"><?php echo $logins['login']?></option>
							<?php } ?> 
							<input type="submit" value="Изменить автора">
						</select>
					</form>
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