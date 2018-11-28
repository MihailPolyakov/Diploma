<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION['category'];?></title>
</head>
<body>
	<a href="?ask=question">Задать вопрос</a>
	<a href="../controllers/controllerUserHP.php">Вернуться на домашнюю страницу</a>
	<table>
		<tr>
			<td>Вопрос</td>
			<td>Ответ</td>
		</tr>
		<?php 
		foreach ($pdo->query($select -> questionAnswer($_SESSION['id'], 'published')) as  $value) {?>
			<tr>
				<td>
					<p><?php echo $value['question'];?></p>
					<p>Автор <?php echo $value['login'];?></p>
				</td>
				<td><?php echo $value['answer'];?></td>
			</tr>
		<?php } ?>
	</table>
</body>
</html>