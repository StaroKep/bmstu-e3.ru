<?php 
	include "../../../templates/global/header.php";

	if (($_SESSION["user_login"] == "") or (!isset($_SESSION["user_login"]))) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /pages/contingent/tutors/"); 
		exit(); 
	}
?>
<!-- Стили для этой страницы -->
<link rel="stylesheet" href="students.css">

		<div class="page-content">

		<input id="find_by_surname" type="text" placeholder="Поиск по фамилии">
		<br>

	<?php 
		// ///////////////////////////////
	 	// Из БД получаем всех студентов
		// ///////////////////////////////

		// Подключаемся к БД
		include "../../../application/db.php";
	    // Устанавливаем кодировку
	    mysqli_set_charset($link,'utf8');
	
	    // Получаем последние 3 новости
	    $result = mysqli_query($link, "SELECT * FROM `users` WHERE UniversityStatus = 'Студент' order by `Surname`");
	 
		while($myrow = mysqli_fetch_array($result)){
			$StudentID = $myrow['ID'];
			$Name = $myrow['Name'];
			$MiddleName = $myrow['MiddleName'];
			$Surname = $myrow['Surname'];
			$StudyGroup = $myrow['StudyGroup'];

			echo "<a class='student_a' href='/pages/contingent/user/?id=".$StudentID."'>";
			echo $Surname. " " .$Name. " " .$MiddleName. " - " . $StudyGroup;
			echo "<br></a>";
		}
	?>


		</div>


<script src='students.js'></script>
<?php 
	include "../../../templates/global/footer-full.php";
?>

