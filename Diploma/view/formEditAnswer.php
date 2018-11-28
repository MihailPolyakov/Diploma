<?php session_start();?>
<form action="../controllers/controllerAdminQA.php" method="POST">
	<input type="hidden" name="idQuestion" value="<?php echo $_SESSION['idQuestion']?>">
	<input type="hidden" name="idAnswer" value="<?php echo $_SESSION['idAnswer']?>">
	<input type="text" name="editAnswer" placeholder="Напишите ответ">
	<input type="submit" name="withPublished" value="Отправить с публикацией на сайте">
	<input type="submit" name="withoutPublished" value="Отправить без публикации на сайте">
</form>