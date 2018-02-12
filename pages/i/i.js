$(function(){
	function NewFuncForBtn(){
		$("#get-new-password").click(function(){
			let email = $("#email-input").val();
			let email_code = $("#email-code").val();
			let svsc = $("#svsc").val();

			$.post('/application/user/create-new-user-password/index.php', 
				{
					email: email,
					email_code: email_code,
					svsc: svsc
				}, 
					onAjaxSuccess
				);
			function onAjaxSuccess(data){
				alert(data);
			}
		});
	}

	$("#change-profile-visibility").click(function() {
		$.post('/application/user/change-profile-visibility/index.php', onAjaxSuccess);
		function onAjaxSuccess(data){
			if (data == "Профиль успешно скрыт!") {
				$("#change-profile-visibility").html("Открыть досту к профилю");
			} else if (data == "Теперь доступ к профилю открыт и доступен по ссылке!") {
				$("#change-profile-visibility").html("Скрыть профиль");
			}
			alert(data);
		}
	});

	$("#get-new-password").click(function() {
		let email = $("#email-input").val();

		// Коротенька проверка Email адреса
		if (email == "") {
			alert("Не указан Email адрес!");
		} else if (email.indexOf("@") == -1) {
			alert("Недопустимая форма Email адреса!");
		} else {
			$("#get-new-password").unbind();
			$("#get-new-password").width("640px");
			$("#get-new-password").css('float', 'right');
			$("#get-new-password").html('Отправить пароль на почту');
			NewFuncForBtn();
			setTimeout(function(){
				$("#email-code").css('display', 'block');
				setTimeout(function(){
					$.post('/application/user/create-new-user-password/send-secret-code.php', 
						{
							email: email
						}, 
							onAjaxSuccess
						);
					function onAjaxSuccess(data){
						alert("Код подтверждения отправлен по адресу " + email + ". Проверьте почту. Отправка кода может занять 5-15 мин.");
						alert("Обязательно проверьте папку СПАМ.");
						$("#svsc").val(data);
					}
				}, 400);
			}, 300);
		}
	});
});