<?php 
	include "../../templates/global/header.php";
?>

<?php 
	$Login = $_SESSION['user_login'];
	if (isset($Login) && $Login != "") {
    	// Подключаемся к базе
    	include ("../../application/db.php");
    	// Устанавливаем кодировку
    	mysqli_set_charset($link,'utf8');
	
    	// Получаем все данные о игре
    	$result = mysqli_query($link, "SELECT * FROM users WHERE Login='$Login'");
    	$myrow = mysqli_fetch_array($result);
	}
	else {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /pages/authentication/"); 
		exit(); 
	}
?>

<style>
	.area1 .area1-wall .page-content-area .user-photo{
		width: 240px;
		height: 240px;
		background-image: url(<?php echo $myrow['PhotoLink']; ?>);
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
		border-radius: 120px;
		box-shadow: 0px 1px 4px rgba(0,0,0,0.5);
		margin: auto;
		top: 40px;
		position: relative;
	}
</style>

<div class="area1">
	<div class="area1-wall">
		<div class="menu">
			<a href="/"><div class="menu-el menu-el-left">Главная</div></a>
			<a href="/pages/news/"><div class="menu-el menu-el-left">Новости</div></a>
			<a href="/application/exit"><div class="menu-el menu-el-right">Выход</div></a>
		</div>
		<div class="bmstu-logo"></div>
		<div class="text-under-bmstu-logo">Персональная страница</div>
		<div class="page-content-area">
			<div class="user-bgimage">
				<div class="user-bgimage-wall">
					<?php 
						if ($_GET["action"] == "edit") {
							echo "<a href=\"/pages/i/\"><div class=\"back-personal-page\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></div></a>";
						}
					?>
					<?php 
						if ($_GET["action"] != "edit") {
							echo "<a href=\"/pages/i/?action=edit\"><div class=\"edit-personal-info\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></div></a>";
						}
					?>
					<?php 
						if (($myrow["CanWrite"] == 1) and ($_GET["action"] != "edit")) {
							echo "<a href=\"/pages/write-article/\"><div class=\"write-new-article\"><i class=\"fa fa-newspaper-o\" aria-hidden=\"true\"></i></div></a>";
						}
					?>
					<?php 
						if ((($myrow["UniversityStatus"] == "Студент") or ($myrow["UniversityStatus"] == "Аспирант")) and ($_GET["action"] != "edit")) {
							echo "<a href=\"https://drive.google.com/drive/folders/0Bx0YgdNbSxG2UllYdk5jWHVWbHc?usp=sharing/\"><div class=\"student-google-drive\"><i class=\"fa fa-cloud-download\" aria-hidden=\"true\"></i></div></a>";
						}
					?>
					<div class="user-photo"></div>
					<?php if ($_GET["action"] != "edit") { echo "<a href='/pages/i/?action=edit'>";} ?>
						<div class="user-name">
							<?php 
								echo $myrow["Surname"] . " " . $myrow["Name"] . " " . $myrow["MiddleName"];
							?>
						</div>
					<?php if ($_GET["action"] != "edit") { echo "</a>";} ?>
					
				</div>
			</div>

			<?php 
				if ($_GET["action"] == "edit") {
					echo "<form action=\"/application/user/save-changes/\" method=\"POST\">";
				}
			?>
			<table class="table-with-user-data">
				<tr>
					<td class="td1 td-first">Статус:</td>
					<td class="td2 td-first"><?php echo $myrow["UniversityStatus"] ?></td>
				</tr>
				<?php 
					if ($myrow["Position"] != "") {
						echo "<tr>";
							echo "<td class=\"td1\">Должность:</td>";
							echo "<td class=\"td2\">". $myrow["Position"] ."</td>";
						echo "</tr>";
					}
					if ($myrow["StudyGroup"] != "") {
						echo "<tr>";
							echo "<td class=\"td1\">Учебная группа:</td>";
							echo "<td class=\"td2\">". $myrow["StudyGroup"] ."</td>";
						echo "</tr>";
					}
				?>
				<tr>
					<td class="td1">День рождения:</td>
					<td class="td2"><?php echo $myrow["Birthday"] ?></td>
				</tr>
				<tr>
					<td class="td1">Email:</td>
					<td class="td2"><?php 
						if ($_GET["action"] == "edit") {
							echo "<input id='email-input' name='email' type='text' value='". $myrow["Email"] ."'></input>";
						} else {
							echo $myrow["Email"];
						}
					?></td>
				</tr>
				<tr>
					<td class="td1">Телефон:</td>
					<td class="td2"><?php 
						if ($_GET["action"] == "edit") {
							echo "<input name='phone' type='text' value='". $myrow["Phone"] ."'></input>";
						} else {
							echo $myrow["Phone"];
						}
					?></td>
				</tr>
				<tr>
					<td class="td1">Писать:</td>
					<td class="td2">
						<?php 
						if ($myrow["CanWrite"] == 1) {
							echo "Да";
						} else {
							echo "Нет";
						}
						?>
					</td>
				</tr>
				<tr>
					<td class="td1">Редактировать:</td>
					<td class="td2">
						<?php 
						if ($myrow["CanEdit"] == 1) {
							echo "Да";
						} else {
							echo "Нет";
						}
						?>
					</td>
				</tr>
				<tr>
					<td class="td1">Удалять:</td>
					<td class="td2">
						<?php 
						if ($myrow["CanWrite"] == 1) {
							echo "Да";
						} else {
							echo "Нет";
						}
						?>
					</td>
				</tr>
				<tr>
					<td class="td1">Кратко о себе:</td>
					<td class="td2"><?php 
						if ($_GET["action"] == "edit") {
							echo "<textarea name='SmallDescription' id='SmallDescription'>". $myrow["SmallDescription"]  ."</textarea>";
						} else {
							echo $myrow["SmallDescription"];
						}
					?></td>
				</tr>
				<tr>
					<td class="td1 td-last">Подробно о себе:</td>
					<td class="td2 td-last"><?php 
						if ($_GET["action"] == "edit") {
							echo "<textarea name='BigDescription' id='BigDescription'>". $myrow["BigDescription"]  ."</textarea>";
						} else {
							echo $myrow["BigDescription"];
						}
					?></td>
				</tr>
			</table>
			<?php 
				if ($_GET["action"] == "edit") {
					echo "<div class='btns-area'>";
					if ($myrow["visibility"] == 1) {
						echo "
							<div class='other-actions' id='change-profile-visibility'>
								Скрыть профиль
							</div>
						";
					} else if ($myrow["visibility"] == 0) {
						echo "
							<div class='other-actions' id='change-profile-visibility'>
								Открыть досту к профилю
							</div>
						";
					}
					echo "

						<input class='other-actions' id='email-code' type='text' placeholder='Код подтверждения'></input>
						<input id='svsc' type='password' style='display: none'></input>
						<div class='other-actions' id='get-new-password'>
							Получить новый пароль
						</div>";
					echo "<input class='btn-submit-save-changes' type='submit' value='Сохранить изменения'></input>";
					echo "</div></form>";
				}
			?>
		</div>
	</div>
</div>

<?php 
 	if ($_GET["action"] == "edit") {
	// Подключаем текстовый редактор nicEditor
 		echo "<script src=\"/assets/other/nicEditor/nicEdit.js\" type=\"text/javascript\"></script>";
 		echo "<script>";
 		echo "new nicEditor({buttonList : ['removeformat','italic','underline','strikeThrough','subscript','superscript', 'left', 'center', 'right', 'justify', 'indent', 'outdent', 'link', 'unlink', 'fontSize'], iconsPath : '/assets/other/nicEditor/nicEditorIcons.gif'}).panelInstance('SmallDescription');";
 		echo "new nicEditor({buttonList : ['removeformat','italic','underline','strikeThrough','subscript','superscript', 'left', 'center', 'right', 'justify', 'indent', 'outdent', 'ol', 'ul', 'hr', 'link', 'unlink', 'forecolor', 'bgcolor', 'image', 'fontSize' ,'xhtml'], iconsPath : '/assets/other/nicEditor/nicEditorIcons.gif'}).panelInstance('BigDescription');";
 		echo "</script>";
}
?>

<script src='i.js'></script>
<?php 
	include "../../templates/global/footer-full.php";
?>