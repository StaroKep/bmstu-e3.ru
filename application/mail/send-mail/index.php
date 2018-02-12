<?php 

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$name = $_POST["Name"];
$name2 = $_POST["Name2"];
$name3 = $_POST["Name3"];
$phone = $_POST["Phone"];
$email = $_POST["Email"];
$mail = $_POST["Mail"];
$email_code = $_POST["EmailCode"];
$svsc = $_POST["SVSC"];

$email_code_hash = hash('sha512', $email_code . 'bmstu-e3.ru');

if ($svsc == $email_code_hash) {
	$to = "e3.bmstu@gmail.com";
	$subject = "Письмо | bmstu-e3.ru";
	
	$message = "<html><body><head><title>Письмо с сайта bmstu-e3.ru</title></head>";
	$message .= "Письмо с сайта bmstu-e3.ru <br>";
	$message .= "- - - - - - - - - - - - - - - - - -<br>";
	$message .= "Фамилия: " . $name . "<br>";
	$message .= "Имя: " . $name2 . "<br>";
	$message .= "Отчество: " . $name3 . "<br>";
	$message .= "- - - - - - - - - - - - - - - - - -<br>";
	$message .= "Телефон: " . $phone . "<br>";
	$message .= "Email: " . $email . "<br>";
	$message .= "- - - - - - - - - - - - - - - - - -<br>";
	$message .= "Сообщение: <br>";
	$message .= $mail;
	$message .= "</body></html>";

	$message = wordwrap($message, 70, "\r\n");

	$headers = array("From: bmstu-e3.ru",
	    "Reply-To: no reply",
	    "X-Mailer: PHP/" . phpversion(),
	    'Content-type: text/html; charset=utf8',
	);
	$headers = implode("\r\n", $headers);

	if (mail($to, $subject, $message, $headers)) {
		echo "ОК | Письмо успешно отправлено!";
	} else {
		echo "ERROR | При отправке письма возникла проблема! Повторите попытку.";
	}
} else {
	echo "ERROR | Код подтверждения неверен!";
}

?>