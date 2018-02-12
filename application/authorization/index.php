<?php 
	session_start();

	$Login = $_POST["Login"];
	$Password = $_POST["Password"];

    // Подключаемся к базе
    include ("../db.php");

    // Устанавливаем кодировку
    mysqli_set_charset($link,'utf8');

    // Получаем все данные о игре
    $result = mysqli_query($link, "SELECT * FROM users WHERE Login='$Login'");
    $myrow = mysqli_fetch_array($result);

    if ($Password == $myrow['Password']) {
    	$_SESSION['user_auth'] = 1;
    	$_SESSION['user_id'] = $myrow['ID'];
    	$_SESSION['user_login'] = $myrow['Login'];
   		$_SESSION['user_canwrite'] = $myrow['CanWrite'];
   		$_SESSION['user_canedit'] = $myrow['CanEdit'];
   		$_SESSION['user_candelete'] = $myrow['CanDelete'];
   		$_SESSION['user_sitegroup'] = $myrow['SiteGroup'];
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /pages/i/"); 
		exit(); 
    }
    else {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /pages/authentication/"); 
		exit(); 
    }
?>