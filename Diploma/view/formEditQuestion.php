<form action="index.php" method="POST">
	<input type="hidden" name="idQuestion" value="<?php echo $_SESSION['idQuestion']?>">
	<input type="text" name="editQuestion" placeholder="Введите свой вопрос">
	<input type="submit" value="Изменить">
</form>