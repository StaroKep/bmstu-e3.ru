<?php 
	$head_title = "Новости | Э3 МГТУ им. Н. Э. Баумана";
	$title = "Новости";

	include "../../templates/global/header.php";
?>

<div class="page-content full-news-page">

	<?php 

		if ($_GET["number"] == "") {
			$number = 25;
		}
		else {
			$number = $_GET["number"];
		}

		// ///////////////////////////////
	 	// Прописываем последние 25 новости
		// ///////////////////////////////

		// Подключаемся к БД
		include "../../application/db.php";
	    // Устанавливаем кодировку
	    mysqli_set_charset($link,'utf8');
	
	    // Получаем последние 10 новостей
	    $result = mysqli_query($link, "SELECT * FROM `articles` order by `Time` desc limit $number");

	    $i = 0;
		while($myrow = mysqli_fetch_array($result)){	
			$i = $i + 1;
			$AuthorID = $myrow['Author'];
			$SQLResult = mysqli_query($link, "SELECT * FROM users WHERE ID = '$AuthorID'");
			$AuthorData = mysqli_fetch_array($SQLResult);
			echo "<a href='/pages/article/?id=" . $myrow["ID"] . "'>";
			if ($i == mysqli_num_rows($result)) {
				echo "<div class=\"news-el\" style=\"border-bottom: none !important; padding: 0px; margin: 0px;\">";
			} else {
				echo "<div class=\"news-el\">";
			}
			echo "<div class=\"news-title\">" . $myrow["Title"] . "</div>";
			echo "<div class=\"news-author-date\">" . $AuthorData["Surname"] . " " . $AuthorData["Name"] . " " . $AuthorData["MiddleName"] . "<span style='float: right;'>" . $myrow["ArticleDate"] . "</span></div>";
			echo "</div>";
			echo "</a>";
		}
	?>
</div>





<?php 
	include "../../templates/global/footer-full.php";
?>