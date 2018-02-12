<?php 

session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

	function GenerateString($length){
	  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ1234567890_';
	  $numChars = strlen($chars);
	  $string = '';
	  for ($i = 0; $i < $length; $i++) {
	    $string .= substr($chars, rand(1, $numChars) - 1, 1);
	  }
	  return $string;
	}

	$email = $_POST["email"];

	$email_code = $_POST["email_code"];
	$svsc = $_POST["svsc"];

	$email_code_hash = hash('sha512', $email_code . 'bmstu-e3.ru' . $email);

if ($svsc == $email_code_hash) {

    // Подключаемся к базе
    include ("../../db.php");
    // Устанавливаем кодировку
    mysqli_set_charset($link,'utf8');

    $Password = GenerateString(16);
    $uid = $_SESSION['user_id'];

    $query = "UPDATE `users` SET `Password`='$Password' WHERE `ID`='$uid'";
	$result = mysqli_query($link, $query);

	if ($result) {

		$SQLResult = mysqli_query($link, "SELECT * FROM `users` WHERE `ID`='$uid'");
		$UserData = mysqli_fetch_array($SQLResult);

		$to = $email;
		$subject = "Код подтверждения | bmstu-e3.ru";
		
		$message = "<html><body><head><title>Письмо с сайта bmstu-e3.ru</title></head>";
		$message .= "Пароль на сайте bmstu-e3.ru успешно изменен.<br>";
		$message .= "- - - - - - - - - - - - - - - - - -<br>";
		$message .= "Данные аутентификации:<br>";
		$message .= "- - - - - - - - - - - - - - - - - -<br>";
		$message .= "Логин: <b>" . $UserData["Login"] . "</b><br>";
		$message .= "Пароль: <b>" . $UserData["Password"] . "</b><br>";
		$message .= "- - - - - - - - - - - - - - - - - -<br>";
		$message .= "С уважением, администрация сайта bmstu-e3.ru<br>";
		$message .= "</body></html>";
	
		$message = wordwrap($message, 70, "\r\n");
	
		$headers = array("From: bmstu-e3.ru",
		    "Reply-To: no reply",
		    "X-Mailer: PHP/" . phpversion(),
		    'Content-type: text/html; charset=utf8',
		);
		$headers = implode("\r\n", $headers);
	
		if (mail($to, $subject, $message, $headers)) {
			echo "ОК | Новый пароль успешно отправлен по адресу " . $email . ". ";
			echo "Обязательно проверьте папку СПАМ!";
		} else {
			echo "ERROR | При отправке письма возникла проблема! Повторите попытку.";
		}
	} else {
		echo "ERROR | Не удалось сменить пароль. Повторите попытку позже.";
	}
} else {
	echo "ERROR | Код подтверждения неверен или вы изменили Email!";
}

?>