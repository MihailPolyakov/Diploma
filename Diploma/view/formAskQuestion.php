<!DOCTYPE html>
<html>
<head>
	<title>Напишите свой вопрос</title>
	<!-- Последняя компиляция и сжатый CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Дополнение к теме -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Последняя компиляция и сжатый JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<form action="index.php" method="POST" class="form-horizontal container">
		<div class="form-group">
			<label for = "Question" class="col-sm-2 control-label">Вопрос</label>
			<div class="col-sm-10">
				<input class="form-control" id = "Question" type="text" name="question" placeholder="Напишите свой вопрос">
			</div>
		</div>

		<div class="form-group">
			<label for = "Name" class="col-sm-2 control-label">Имя</label>
			<div class="col-sm-10">
				<input class="form-control" id = "Name" type="text" name="name" placeholder="Напишите своей имя">
			</div>
		</div>

		<div class="form-group">
			<label for = "Mail" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10">
				<input class="form-control" id = "Mail" type="text" name="mail" placeholder="Напишите свой mail">
			</div>
		</div>	
			
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">	
				<input class="btn btn-success" type="submit" value="Отправить">
			</div>	
		</div>
	</form>
</body>
</html>