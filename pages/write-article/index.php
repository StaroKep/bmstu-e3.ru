<?php 
	include "../../templates/global/header-short.php";
	date_default_timezone_set('Europe/Moscow');
?>
<link rel="stylesheet" href="write-article.css">

<?php 
	if ($_SESSION["user_login"] == "") {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /"); 
		exit(); 
	}
?>

<form id="NewArticleForm" method="POST" action="/application/articles/save.php">

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
				Создать новость. Нописать статью.
			</div>
			<div class="zone-4">
				<!-- Название статьи -->
				<input id="ArticleTitle" name="Title" type="text" value="Введите название статьи">
				<div class="ArticleDate-Div">
					Дата и время написания статьи:
					<!-- Дата -->
					<input id="ArticleDate" name="Date" type="text" value="<?php echo date('d.m.o - H:i:s'); ?>">
				</div>
				<div class="ArticleSummary-Text">Краткое содержание статьи. Только текст. О чем идет речь?</div>
				<!-- Краткое содержание статьи -->
				<textarea name="Summary" id="ArticleSummary"></textarea>
				<div class="ArticleText-Text">Полный текст статьи с картинками и др. медиа вложениями.</div>
				<!-- Полное содержание статьи -->
				<textarea name="Text" id="ArticleText"></textarea>
				<!-- Упоминаемые личности -->
				<input id="ArticlePeople" name="People" type="text" placeholder="Упоминаемые личности">
				<!-- Ключевые слова  -->
				<input id="ArticleKeyWords" name="Keywords" type="text" placeholder="Ключевые слова">
				<input id="ArticleSubmit" type="submit" value="Опубликовать">
			</div>
		</div>
	</div>

</div>

</form>

<!-- Подключаем текстовый редактор nicEditor -->
<script src="/assets/other/nicEditor/nicEdit.js" type="text/javascript"></script>

<script>
	new nicEditor({buttonList : ['removeformat','italic','underline','strikeThrough','subscript','superscript', 'left', 'center', 'right', 'justify', 'indent', 'outdent', 'link', 'unlink', 'fontSize'], iconsPath : '/assets/other/nicEditor/nicEditorIcons.gif'}).panelInstance('ArticleSummary');
	new nicEditor({buttonList : ['removeformat','italic','underline','strikeThrough','subscript','superscript', 'left', 'center', 'right', 'justify', 'indent', 'outdent', 'ol', 'ul', 'hr', 'link', 'unlink', 'forecolor', 'bgcolor', 'image', 'fontSize' ,'xhtml'], iconsPath : '/assets/other/nicEditor/nicEditorIcons.gif'}).panelInstance('ArticleText');
</script>


<?php 
	include "../../templates/global/footer.php";
?>