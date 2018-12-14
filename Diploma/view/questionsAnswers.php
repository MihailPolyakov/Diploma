<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title><?php echo $_SESSION['category'];?></title>
	<!-- Последняя компиляция и сжатый CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Дополнение к теме -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Последняя компиляция и сжатый JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body>
	<div class="row container-fluid">
		<div class="col-md-1" ><a href="?ask=question">Задать вопрос</a></div>
		<div class="col-md-2"><a href="index.php?controller=UserHP">Вернуться на домашнюю страницу</a></div>
	</div>
	<div class="row container col-md-6 col-md-offset-3">
		<table class="table table-bordered table-striped">
			<thead>
				<th class="col-md-8">Вопрос</th>
				<th class="text-center">Ответ</th>
			</thead>
			<tbody>
				<?php 
				foreach ($this->pdo->query($select -> questionAnswer($_SESSION['id'], 'published')) as  $value) {?>
					<tr>
						<td>
							<p><?php echo $value['question'];?></p>
							<p>Автор <?php echo $value['login'];?></p>
						</td>
						<td class="text-center"><?php echo $value['answer'];?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</body>
</html>