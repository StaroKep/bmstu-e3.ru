<?php 
	ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

	include "../../../templates/global/header.php";
?>

<link rel="stylesheet" href="get-password.css">

<div class="header">
	<div class="header-wall">
		<div class="menu">
			<div id="other-good-links" class="menu-el left-menu-el">
				<a id="menu-link-to-other-links" href="/pages/other-links/"></a>
				<i class="fa fa-rss" aria-hidden="true"></i>
				<div class="other-good-links-area">
					<a href="http://www.bmstu.ru/">МГТУ им. Н. Э. Баумана</a>
					<a href="http://energo.bmstu.ru/">Энергомашиностроение</a>
					<a href="https://vk.com/e3.bmstu">Наша группа ВКонтакте</a>
					<a href="https://vk.com/pr.bmstu">ВК | МГТУ Н. Э. Баумана</a>
					<a href="https://vk.com/energo_bmstu">ВК | Энергомаш МГТУ</a>
					<a href="https://vk.com/studsovetdesyatka">ВК | Общежитие №10</a>
					<a href="https://vk.com/studsovet_bmstu">ВК | Студсовет МГТУ</a>
					<a href="https://vk.com/profkom_bmstu">ВК | Профсоюз студентов</a>
				</div>
			</div>
			<a href="/"><div class="menu-el left-menu-el">Главная</div></a>
			<a href="/pages/news/"><div class="menu-el left-menu-el">Новости</div></a>
			<a href="/pages/entrant/"><div class="menu-el left-menu-el">Абитуриентам</div></a>
			<a href="/pages/about/"><div class="menu-el left-menu-el">О кафедре</div></a>
			<a href="/pages/chronicle/"><div class="menu-el left-menu-el">Летопись</div></a>
			<a href="/pages/contingent/tutors/"><div class="menu-el left-menu-el">Контингент</div></a>
			<?php
				if ($_SESSION["user_login"] != "") { 
				echo '
				<a href="/application/exit/">
					<div class="menu-el right-menu-el">
						Выход
					</div>
				</a> 
				<a href="/pages/i/">
					<div class="menu-el right-menu-el">
						<i class="fa fa-user-circle-o" aria-hidden="true"></i>
					</div>
				</a>
				';
				} else {
					echo '
						<a href="/pages/authentication/">
							<div class="menu-el right-menu-el">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
						</a>
					';
				}
			?>
			<a href="/pages/write-mail/">
				<div class="menu-el right-menu-el">
					<i class="fa fa-envelope" aria-hidden="true"></i>
				</div>
			</a> 
			<a href="/pages/route/">
				<div class="menu-el right-menu-el">
					<i class="fa fa-plane" aria-hidden="true"></i>
				</div>
			</a>  
			<br clear="all"/>
		</div>
		<div class="bmstu-logo"></div>
		<div class="page-title">Восстановление пароля (В разработке)</div>
		<div class="page-content">
			<div class="get-password-page">
				<form action="/pages/registration/get-password/" method="POST">
					<input type="text" name="Surname" placeholder="Фамилия">
					<input type="text" name="Name" placeholder="Имя">
					<input type="text" name="MiddleName" placeholder="Отчество"><br>
					<input type="text" name="NumOfBook" placeholder="Номер зачетной книжки "><br>
					<input type="text" name="Email" placeholder="Email"><br>
					<input type="submit" value="Восстановить пароль" class="submit-input">
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
	include "../../../templates/global/footer.php";
?>