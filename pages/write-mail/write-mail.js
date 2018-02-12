function Send_Secret_Code_Timer(){
		// Ставим таймер
		let Interval1 = setInterval(function(){
			t = localStorage.getItem("Timer_GetNewSecretCode");
			if (t <= 0) {
				$("#GSC-btn").html("Получить код подтверждения");
				$("#send-secret-code-again").html('<i class="fa fa-refresh" aria-hidden="true"></i>');
				clearInterval(Interval1);
			} else {
				$("#send-secret-code-again").html(t);
				$("#GSC-btn").html("Пожалуйста, подождите " + t + " сек.");
				localStorage.setItem("Timer_GetNewSecretCode", t - 1);
			}
		}, 1000);
}

$(function(){

	Send_Secret_Code_Timer();

	$("#GSC-btn").click(function() {
		t = localStorage.getItem("Timer_GetNewSecretCode");
		if ((t == null) || (t == 0)) {
			let Email = $("#Email").val();
			$.post('/application/mail/send-secret-code/index.php', 
				{
					email: Email
				}, 
					onAjaxSuccess
				);
			function onAjaxSuccess(data){
				alert("Код подтверждения отправлен по адресу " + Email + ". Проверьте почту. Отправка кода может занять 5-15 мин.");
				alert("Обязательно проверьте папку СПАМ.");
				$("#svsc").val(data);
			}

			$("#GSC-btn").css('display', 'none');
			$(".SecretCodeDiv").css('display', 'block');
			$("#send-mail-btn").css('display', 'block');
		} else {
			alert("Подождите еще " + t + " сек.");
		}
	});

	$("#send-secret-code-again").click(function() {
		// Получаем содержимое div'a
		t = localStorage.getItem("Timer_GetNewSecretCode");

		// Если в div'e ноль или иконка, то можно отправлять новый код
		if ((t == null) || (t == 0)) {
			
			/* *** */
			let Email = $("#Email").val();
			$.post('/application/mail/send-secret-code/index.php', 
				{
					email: Email
				}, 
					onAjaxSuccess
				);
			function onAjaxSuccess(data){
				alert("Код подтверждения отправлен по адресу " + Email + ". Проверьте почту.");
				alert("Обязательно проверьте папку СПАМ.");
				$("#svsc").val(data);
			}
			/* *** */
			// Получаем время таймера из localStorage
			t = localStorage.getItem("Timer_GetNewSecretCode");
			if ((t == null) || (t == 0)) {
				t = 90;
				$("#send-secret-code-again").html(t);
				localStorage.setItem("Timer_GetNewSecretCode", t);
			} else {
				$("#send-secret-code-again").html(t);
			}

			Send_Secret_Code_Timer();
		} else {
			alert("Подождите еще " + t + " сек.");
		}
	});


	$("#send-mail-btn").click(function() {
			let Name = $("#Name").val();
			let Name2 = $("#Name2").val();
			let Name3 = $("#Name3").val();
			let Phone = $("#Phone").val();
			let Email = $("#Email").val();
			let Mail = $("#Mail").val();
			let EmailCode = $("#SecretCode").val();
			let SVSC = $("#svsc").val();

			$.post('/application/mail/send-mail/index.php', 
				{
					Name: Name,
					Name2: Name2,
					Name3: Name3,
					Phone: Phone,
					Email: Email,
					Mail: Mail,
					EmailCode: EmailCode,
					SVSC: SVSC
				}, 
					onAjaxSuccess
				);
			function onAjaxSuccess(data){
				alert(data);
				if (data == "ОК | Письмо успешно отправлено!") {
					$("#send-mail-btn").unbind();
					$("#send-mail-btn").html("<a href=''>Обновить страницу</a>");
					$("#send-mail-btn").attr('id', '#send-mail-btn-nonactive');
				}
			}
	});





})

