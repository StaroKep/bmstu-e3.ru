<?php 
	$head_title = "Персональная страница пользователя | Э3 МГТУ им. Н. Э. Баумана";
	include "../../../templates/global/header-short.php";
?>
<link rel="stylesheet" href="user.css">

<?php 
	$UserId = $_GET['id'];
	if ($UserId != "") {
    	// Подключаемся к базе
    	include ("../../../application/db.php");
    	// Устанавливаем кодировку
    	mysqli_set_charset($link,'utf8');
	
    	// Получаем все данные о игре
    	$result = mysqli_query($link, "SELECT * FROM users WHERE ID='$UserId'");
    	$myrow = mysqli_fetch_array($result);
	}
	else {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /pages/contingent/tutors/"); 
		exit(); 
	}
?>

<?php 
$Login = $_SESSION['user_login'];

if (($myrow['visibility'] == 0) && (!isset($Login) || ($Login == ""))) {
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: /pages/contingent/tutors/"); 
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
					<a href="/pages/contingent/tutors/"><div class="back-personal-page"><i class="fa fa-times-circle" aria-hidden="true"></i></div></a>
					<?php 
						/*if ($_GET["action"] != "edit") {
							echo "<a href=\"/pages/i/?action=edit\"><div class=\"edit-personal-info\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></div></a>";
						}*/
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

				<!-- Если есть информация о статусе -->
				<?php if ($myrow["UniversityStatus"] != ""): ?>
				<tr>
					<td class="td1 td-first">Статус:</td>
					<td class="td2 td-first"><?php echo $myrow["UniversityStatus"] ?></td>
				</tr>
				<?php endif ?>

				
				<?php 
					// Если есть информация о занимаемой позиции
					if ($myrow["Position"] != "") {
						echo "<tr>";
							echo "<td class=\"td1\">Должность:</td>";
							echo "<td class=\"td2\">". $myrow["Position"] ."</td>";
						echo "</tr>";
					}
					// Если есть информация о учебной группе
					if ($myrow["StudyGroup"] != "") {
						echo "<tr>";
							echo "<td class=\"td1\">Учебная группа:</td>";
							echo "<td class=\"td2\">". $myrow["StudyGroup"] ."</td>";
						echo "</tr>";
					}
				?>

				<!-- Если есть информация о дне рождения -->
				<?php if ($myrow["Birthday"] != ""): ?>
				<tr>
					<td class="td1">День рождения:</td>
					<td class="td2"><?php echo $myrow["Birthday"] ?></td>
				</tr>
				<?php endif ?>

				<!-- Если есть информация о контактном Email адресе -->
				<?php if (($myrow["Email"] != "") && ($_GET["action"] != "edit")): ?>
				<tr>
					<td class="td1">Email:</td>
					<td class="td2"><?php 
						if ($_GET["action"] == "edit") {
							echo "<input name='email' type='text' value='". $myrow["Email"] ."'></input>";
						} else {
							echo $myrow["Email"];
						}
					?></td>
				</tr>
				<?php endif ?>

				<!-- Если есть информация о контактном номере телефона адресе -->
				<?php if (($myrow["Phone"] != "") && ($_GET["action"] != "edit")): ?>
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
				<?php endif ?>

				<!-- Если есть информация о публикациях -->
				<?php if (($myrow["publications"] != "") && ($_GET["action"] != "edit")): ?>
				<tr>
					<td class="td1">Публикации:</td>
					<td class="td2"><?php echo $myrow["publications"] ?></td>
				</tr>
				<?php endif ?>

				<!-- Если страницу просматривает авторизованный пользователь -->
				<?php if (isset($Login) && ($Login != "")): ?>
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
				<?php endif ?>

				<!-- Если есть краткая информация о себе -->
				<?php if (($myrow["SmallDescription"] != "") && ($_GET["action"] != "edit")): ?>
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
				<?php endif ?>

				<!-- Если есть подробная информация о себе -->
				<?php if (($myrow["BigDescription"] != "") && ($_GET["action"] != "edit")): ?>
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
				<?php endif ?>
			</table>

			<?php 
				if ($_GET["action"] == "edit") {
					echo "<input class='btn-submit-save-changes' type='submit' value='Сохранить изменения'></input>";
					echo "</form>";
				}
			?>
		</div>
</div>


<?php 
	include "../../../templates/global/footer.php";
?>