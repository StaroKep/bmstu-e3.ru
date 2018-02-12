<?php 
	include "../../templates/global/header.php";
?>
<!-- Стили для этой страницы -->
<link rel="stylesheet" href="write-mail.css">

		<div class="page-content">
			<div class="send-mail-form">
				<input id="Name" type="text" placeholder="Фамилия" autocomplete="off">
				<input id="Name2" type="text" placeholder="• Имя" autocomplete="off">
				<input id="Name3" type="text" placeholder="• Отчество" autocomplete="off">
				<input id="Phone" type="text" placeholder="Телефон" autocomplete="off">
				<input id="Email" type="text" placeholder="• Email" autocomplete="off">
				<input id="svsc" type="text" autocomplete="off">
				<textarea id="Mail" placeholder="Письмо | сообщение | вопрос" autocomplete="off"></textarea>
				<div class="SecretCodeDiv" style="position: relative;">
					<div id="send-secret-code-again"><i class="fa fa-refresh" aria-hidden="true"></i></div>
					<input id="SecretCode" type="text" placeholder="• Код подтверждения" autocomplete="off">
				</div>
				<div class="submit-btn" id="send-mail-btn">Отправить письмо</div>
				<div class="submit-btn" id="GSC-btn">Получить код подтверждения</div>
			</div>
			<div class="mail-info">
				• обязательное для заполнения поле

			</div>
		</div>

<script src='write-mail.js'></script>
<?php 
	include "../../templates/global/footer-full.php";
?>

