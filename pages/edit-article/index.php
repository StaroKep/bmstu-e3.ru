<?php 
	include "../../templates/global/header-short.php";
	date_default_timezone_set('Europe/Moscow');
?>

<?php 
	if ($_SESSION["user_login"] == "") {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /"); 
		exit(); 
	}
?>


<?php 
	if ($_GET["id"] != "") {
		echo "<form id=\"NewArticleForm\" method=\"POST\" action=\"/application/articles/save-edited.php\">";
	}
?>

<link rel="stylesheet" href="edit-article.css">

<div class="write-article-page">
	<div class="top-menu">
		<div class="tm-wall">
			<div class="zone-1">
				<a href="/pages/home/"><div class="tm-el tm-el-left">Главная</div></a>
				<a href="/pages/news/"><div class="tm-el tm-el-left">Новости</div></a>
				<a href="/application/exit/"><div class="tm-el tm-el-right">Выход</div></a>
				<a href="/pages/i/"><div class="tm-el tm-el-right">
					<i class="fa fa-user-circle-o" aria-hidden="true"></i>
				</div></a>
			</div>
			<div class="zone-2"></div>
			<div class="zone-3">
				Редактировать статью.
			</div>



			<div class="zone-4">

			<?php 
				if ($_GET["id"] == "") {
					echo "
						<div class=\"enter-article-id\">
							<form action=\"/pages/edit-article/\" method=\"GET\">
								<input class=\"article-id\" name=\"id\" type=\"text\" placeholder=\"Введите номер статьи\">
								<input class=\"edit-article-btn\" type=\"submit\" value=\"Редактировать\">
							</form>
						</div>
					";
				} else {

					// Сохраняем номер статьи
					$ArticleID = $_GET["id"];
					// Подключаемся к базе данных
					include '../../application/db.php';
					// Устанавливаем кодировку
					mysqli_set_charset($link,'utf8');
					// Получаем статью
					$SQLResult = mysqli_query($link, "SELECT * FROM articles WHERE ID = '$ArticleID'");
					$ArticleData = mysqli_fetch_array($SQLResult);

					echo "
				<!-- Название статьи -->
				<input id=\"ArticleTitle\" name=\"Title\" type=\"text\" value=\"". $ArticleData["Title"] ."\">
				<div class=\"ArticleDate-Div\">
					Дата и время написания статьи:
					<!-- Дата -->
					<input id=\"ArticleDate\" name=\"Date\" type=\"text\" value=\"" . $ArticleData["ArticleDate"] . "\">
				</div>
				<div class=\"ArticleSummary-Text\">Краткое содержание статьи. Только текст. О чем идет речь?</div>
				<!-- Краткое содержание статьи -->
				<textarea name=\"Summary\" id=\"ArticleSummary\">". $ArticleData["Summary"] ."</textarea>
				<div class=\"ArticleText-Text\">Полный текст статьи с картинками и др. медиа вложениями.</div>
				<!-- Полное содержание статьи -->
				<textarea name=\"Text\" id=\"ArticleText\">". $ArticleData["ArticleText"] ."</textarea>
				<!-- Упоминаемые личности -->
				<input id=\"ArticlePeople\" name=\"People\" type=\"text\" placeholder=\"Упоминаемые личности\"value=\"". $ArticleData["People"] ."\">
				<!-- Ключевые слова  -->
				<input id=\"ArticleKeyWords\" name=\"Keywords\" type=\"text\" placeholder=\"Ключевые слова\" value=\"". $ArticleData["Keywords"] ."\">
				<input name=\"ArticleID\" type=\"text\" value=\"". $ArticleID ."\" style=\"display: none;\">
				<input id=\"ArticleSubmit\" type=\"submit\" value=\"Опубликовать\">
				<a href=\"/application/articles/delete.php/?ArticleID=". $ArticleID ."\" style=\"color: black;\">Удалить статью</a>
					";
				}
			?>




			</div>
		</div>
	</div>

</div>

<?php 
	if ($_GET["id"] != "") {
		echo "</form>";
	}
?>


<!-- Подключаем текстовый редактор nicEditor -->
<script src="/assets/other/nicEditor/nicEdit.js" type="text/javascript"></script>

<script>
	new nicEditor({buttonList : ['removeformat','italic','underline','strikeThrough','subscript','superscript', 'left', 'center', 'right', 'justify', 'indent', 'outdent', 'link', 'unlink', 'fontSize'], iconsPath : '/assets/other/nicEditor/nicEditorIcons.gif'}).panelInstance('ArticleSummary');
	new nicEditor({buttonList : ['removeformat','italic','underline','strikeThrough','subscript','superscript', 'left', 'center', 'right', 'justify', 'indent', 'outdent', 'ol', 'ul', 'hr', 'link', 'unlink', 'forecolor', 'bgcolor', 'image', 'fontSize' ,'xhtml'], iconsPath : '/assets/other/nicEditor/nicEditorIcons.gif'}).panelInstance('ArticleText');
</script>


<?php 
	include "../../templates/global/footer.php";
?>