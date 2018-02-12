<?php 

session_start();

// Получаем обновленные данные пользователя
$email = $_POST['email'];
$phone = $_POST['phone'];
$SmallDescription = $_POST['SmallDescription'];
$BigDescription = $_POST['BigDescription'];

// Подключаемся к БД
include '../../db.php';
// Устанавливаем кодировку
mysqli_set_charset($link,'utf8');

$uid = $_SESSION['user_id'];

$query = "UPDATE `users` SET `Email`='$email', `Phone`='$phone', `SmallDescription`='$SmallDescription', `BigDescription`='$BigDescription' WHERE `ID`='$uid'";
$result = mysqli_query($link, $query);
mysqli_close($link);

header("HTTP/1.1 301 Moved Permanently"); 
header("Location: /pages/i/"); 
exit(); 

?>