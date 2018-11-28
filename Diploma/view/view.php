<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>I want to know</title>
</head>
<body>
	<p>Добро пожаловать в сервис по вопросам и ответам I want to know</p>
	<p><a href="?admin=admin">Я администратор</a></p>
	<ul>
		<?php foreach ($pdo->query($category->categories) as  $value) {?>
			<li><a href="?idcat=<?php echo $value['id']?>&&category=<?php echo $value['category']?>"><?php echo $value['category']?></a></li>
		<?php } ?>
	</ul>
</body>
</html>