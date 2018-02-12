<?php 
	$week = "Неделя 2 | Знаменатель"; // Неделя 2 | Знаменатель Числитель
	$week_special = "Неделя 2 | Знаменатель";
	$head_title = "Э3 МГТУ им. Н. Э. Баумана";

	include "../../templates/global/header.php";
?>

<link rel="stylesheet" href="home.css">

<div class="home-page-area">

<div class="news-area">
	<div class="center-news-title"><a href="/pages/news/">Новости</a></div>
	<div class="left-border"></div>
	<div class="right-border"></div>
	<div class="news">

	<?php 
		// ///////////////////////////////
	 	// Прописываем последние 10 новостей
		// ///////////////////////////////

		// Подключаемся к БД
		include "../../application/db.php";
	    // Устанавливаем кодировку
	    mysqli_set_charset($link,'utf8');
	
	    // Получаем последние 10 новостей
	    $result = mysqli_query($link, "SELECT * FROM `articles` order by `Time` desc limit 10");
	    
		while($myrow = mysqli_fetch_array($result)){
			$AuthorID = $myrow['Author'];
			$SQLResult = mysqli_query($link, "SELECT * FROM users WHERE ID = '$AuthorID'");
			$AuthorData = mysqli_fetch_array($SQLResult);
			echo "<a href='/pages/article/?id=" . $myrow["ID"] . "'>";
			echo "<div class=\"news-el\">";
			echo "<div class=\"news-title\">" . $myrow["Title"] . "</div>";
			echo "<div class=\"news-author-date\">" . "<span style='float: left;'>" . $AuthorData["Surname"] . " " . $AuthorData["Name"] . " " . $AuthorData["MiddleName"] . " </span> " . $myrow["ArticleDate"] . "</div>";
			echo "</div>";
			echo "</a>";
		}
	?>
	</div>	
			
		
</div>

<div>
	<div class="study-process">
		<div class="study-process-title">
			<span>
				<a href="https://students.bmstu.ru/schedule/list">
					Учебный процесс
				</a>
			</span>
		</div>
		<div class="study-process-content">
			<div class="sp-week"><?php echo $week ?></div>
			<div class="sp-week-points">
				<div class="spw-point spw-point-end">1</div>
				<div class="spw-point spw-point-current">2</div>
				<div class="spw-point">3</div>
				<div class="spw-point">4</div>
				<div class="spw-point">5</div>
				<div class="spw-point">6</div>
				<div class="spw-point">7</div>
				<div class="spw-point">8</div>
				<div class="spw-point">9</div>
				<div class="spw-point">10</div>
				<div class="spw-point">11</div>
				<div class="spw-point">12</div>
				<div class="spw-point">13</div>
				<div class="spw-point">14</div>
				<div class="spw-point">15</div>
				<div class="spw-point">16</div>
				<div class="spw-point">17</div>
			</div>
			
            <div class="sp-week">Расписание</div>
			<div class="group-selector">
			<!-- <div class="group">Э3-11 </div>
				<div class="group">Э3-12 </div>
				<div class="group">Э3-31 </div>
				<div class="group">Э3-32 </div>
				<div class="group">Э3-37М </div>
				<div class="group">Э3-51 </div>
				<div class="group">Э3-52 </div>
				<div class="group">Э3-59 </div>
				<div class="group">Э3-71 </div>
				<div class="group">Э3-72 </div>
				<div class="group">Э3-79 </div>
				<div class="group">Э3-91 </div>
				<div class="group">Э3-92 </div>
				<div class="group">Э3-99 </div>
				<div class="group">Э3-111 </div>
				<div class="group">Э3-112 </div> -->

                <div class="group">Э3-21 </div>
                <div class="group">Э3-22 </div>
                <div class="group">Э3-41 </div>
                <div class="group">Э3-42 </div>
                <div class="group">Э3-61 </div>
                <div class="group">Э3-62 </div>
                <div class="group">Э3-69 </div>
                <div class="group">Э3-81 </div>
                <div class="group">Э3-82 </div>
                <div class="group">Э3-89 </div>
                <div class="group">Э3-101 </div>
                <div class="group">Э3-102 </div>
                <div class="group">Э3-109 </div>
            </div>

			<!-- <div class="Dynamic-Calendar">
				<?php
					// include '../../test-folder/grab.php';
				?>
			</div> -->
		</div>
	</div>
</div>

</div>


<script src="home.js"></script>
<?php 
	include "../../templates/global/footer-full.php";
?>