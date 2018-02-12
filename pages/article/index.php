<?php 
	
	if ($_GET["id"] == "") {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /pages/news/"); 
		exit(); 
	}

	if ($_GET["id"] != "") {
		// Сохраняем номер статьи
		$ArticleID = $_GET["id"];
		// Подключаемся к базе данных
		include '../../application/db.php';
		// Устанавливаем кодировку
		mysqli_set_charset($link,'utf8');
		// Получаем статью
		$SQLResult = mysqli_query($link, "SELECT * FROM articles WHERE ID = '$ArticleID'");
		$ArticleData = mysqli_fetch_array($SQLResult);
	}

	$head_title = $ArticleData["Title"] . " | Новости | Э3 МГТУ им. Н. Э. Баумана";
	$title = "Новости";
	include "../../templates/global/header.php";
?>
<link rel="stylesheet" href="article.css">

<div class="page-content">

			<div class="article-title"><?php echo $ArticleData["Title"]; ?></div>
			<?php /*if ($ArticleData["Summary"] != "") {
				echo "<div class=\"article-summary\">". $ArticleData["Summary"] ."</div>";
			} */?>
			<?php if ($ArticleData["ArticleText"] != "") {
				echo "<div class=\"article-text\">". $ArticleData["ArticleText"] ."</div>";
			} ?>
			<div class="article-info">
				<div class="article-author">
					<?php 
						$AuthorID = $ArticleData['Author'];
						$AuthorSQLResult = mysqli_query($link, "SELECT * FROM users WHERE ID = '$AuthorID'");
						$AuthorData = mysqli_fetch_array($AuthorSQLResult);
						echo $AuthorData["Surname"] . " " .$AuthorData["Name"] . " " . $AuthorData["MiddleName"];
					?>

				</div>
				<div class="article-date"><?php echo $ArticleData["ArticleDate"] ?></div>
			</div>
	
			<!-- Блок комментариев VK -->
			<script type="text/javascript">
			  VK.init({
			    apiId: 6104910,
			    onlyWidgets: true
			  });
			</script>

			<div id="vk_comments_<?php echo $ArticleID;?>" class="vk_comments" style="margin-top: 20px;"></div>
			<script type="text/javascript">
				VK.Widgets.Comments('vk_comments_<?php echo $ArticleID;?>');
			</script>
			<!-- /// /// /// /// /// /// /// /// /// /// /// /// -->


			<div class="bottom-menu">
				<?php 
					if ($_SESSION['user_canedit'] == 1) {
						echo "<a class=\"end-riding\" href=\"/pages/edit-article/?id=". $ArticleID ."\" style=\"margin-bottom: 20px;\">Редактировать статью</a>";
					}
				?>
				<a class="end-riding" href="/pages/news/">Завершить чтение</a>
			</div>
			
</div>


<script src="article.js"></script>
<?php 
	include "../../templates/global/footer-full.php";
?>