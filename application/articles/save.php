<?php 

	session_start();

    // Подключаемся к базе
    include ("../db.php");
    // Устанавливаем кодировку
    mysqli_set_charset($link,'utf8');

    $Title = $_POST["Title"];
    $Summary = ($_POST["Summary"]);
    $Text = ($_POST["Text"]);
    $Date = $_POST["Date"];
    $Author = $_SESSION['user_id'];
    $People = $_POST["People"];
    $Keywords = $_POST["Keywords"];
    $ShowArticle = 1;
    $HistoryOfChanges = "-";
    // Получаем время в мс
    $Time = str_replace(" - ", " ", $Date);
    $Time = (int) strtotime($Time);

	$query1 = "INSERT INTO `articles` (`ID`, `Title`, `Summary`, `ArticleText`, `ArticleDate`, `Time`, `Author`, `People`, `Keywords`, `ShowArticle`, `HistoryOfChanges`) VALUES (NULL, '$Title', '$Summary', '$Text', '$Date', '$Time', '$Author', '$People', '$Keywords', '$ShowArticle', '$HistoryOfChanges')";

    $result = mysqli_query($link, $query1);
    echo $result;
    $id = mysqli_insert_id($link);
    echo $id;
    mysqli_close($link);

    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: /pages/news/"); 
    exit(); 
?>