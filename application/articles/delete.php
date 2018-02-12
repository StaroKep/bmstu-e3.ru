<?php 

	session_start();

    // Подключаемся к базе
    include ("../db.php");
    // Устанавливаем кодировку
    mysqli_set_charset($link,'utf8');

    $ArticleID = $_GET["ArticleID"];
    $query = "DELETE FROM `articles` WHERE `ID`='$ArticleID'";

    $result = mysqli_query($link, $query);
    echo $result;
    $id = mysqli_insert_id($link);
    echo $id;
    mysqli_close($link);

    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: /pages/news/"); 
    exit();
?>