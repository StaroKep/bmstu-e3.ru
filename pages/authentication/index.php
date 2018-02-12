<?php 
	$head_title = "Авторизация | Э3 МГТУ им. Н. Э. Баумана";
	$title = "Авторизация";

	include "../../templates/global/header.php";
?>

<!-- <link rel="stylesheet" href="authentication.css"> -->

<div class="page-content">
	<div class="authentication-page">
		<form action="/application/authorization/index.php" method="POST">
			<input type="text" name="Login" placeholder="Логин"><br>
			<input type="password" name="Password" placeholder="Пароль"><br>
			<input type="submit" value="Войти" class="submit-input">
		</form>
	</div>
	<div style="text-align: right;">
		<a href="/pages/registration/get-password/">Восстановить пароль</a>
	</div>
</div>

<?php 
	include "../../templates/global/footer-full.php";
?>