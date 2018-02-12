<?php 

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

// Подключаемся к БД
include '../../db.php';
// Устанавливаем кодировку
mysqli_set_charset($link,'utf8');

$uid = $_SESSION['user_id'];

// Получаем все данные о пользователе
$result = mysqli_query($link, "SELECT * FROM users WHERE ID='$uid'");
$myrow = mysqli_fetch_array($result);

if ($myrow['visibility'] == 1) {
	$result1 = mysqli_query($link, "UPDATE `users` SET `visibility`='0' WHERE `ID`='$uid'");
	if ($result1) {
		echo "Профиль успешно скрыт!";
		exit();
	}
} else if ($myrow['visibility'] == 0) {
	$result1 = mysqli_query($link, "UPDATE `users` SET `visibility`='1' WHERE `ID`='$uid'");
	if ($result1) {
		echo "Теперь доступ к профилю открыт и доступен по ссылке!";
		exit();
	}
}

?>