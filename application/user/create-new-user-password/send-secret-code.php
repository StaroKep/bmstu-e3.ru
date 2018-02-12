<?php 

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

	function GenerateString($length){
	  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ';
	  $numChars = strlen($chars);
	  $string = '';
	  for ($i = 0; $i < $length; $i++) {
	    $string .= substr($chars, rand(1, $numChars) - 1, 1);
	  }
	  return $string;
	}

	$email = $_POST["email"];

	$random_string = random_int(100000, 999999) . GenerateString(2);
	$hash = hash('sha512', $random_string . 'bmstu-e3.ru' . $email);

	$to = $email;
	$subject = "Код подтверждения | bmstu-e3.ru";
	$message = "Ваш код подтверждения: " . $random_string;
	$message = wordwrap($message, 70, "\r\n");

	$headers = array("From: bmstu-e3.ru",
	    "Reply-To: no reply",
	    "X-Mailer: PHP/" . phpversion()
	);
	$headers = implode("\r\n", $headers);

	if (mail($to, $subject, $message, $headers)) {
		echo $hash;
	} else {
		echo "ERROR!";
	}
	
?>