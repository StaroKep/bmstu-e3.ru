<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<table>

<?php 

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


header('Content-type: text/html; charset=UTF-8');

	// Подключаемся к БД
	include '../db.php';
    // Устанавливаем кодировку
    mysqli_set_charset($link,'utf8');

	function translit($str) {
		$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
		$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
		return str_replace($rus, $lat, $str);
	}

$lines = file('tutors.txt');
// Осуществим проход массива и выведем содержимое в виде HTML-кода вместе с номерами строк.
foreach ($lines as $line_num => $line) {
	// Данные о студенте разбиваем в массив
	$student = explode(" ", $line);
	// echo substr($student[5], 2, 1);
	// Если в массиве 7 элементов
	if ((count($student) == 3) /*and (substr($student[5], 2, 1) == "3")*/) {
		//$BirthdayArray = explode("-", $student[4]);
		//$Birthday = $BirthdayArray[2] . "." . $BirthdayArray[1] . "." . $BirthdayArray[0];
		$Login = translit($student[1].$student[2].$student[0]/*.$student[3]*/);
		$Email = $student[1] . " укажите, пожалуйста, Email.";

		// Пытаемся найти пользователя с таким же Login и Email
		$SQLResult = mysqli_query($link, "SELECT ID FROM users WHERE Login = '$Login' AND Email = '$Email'");
		$ResultID = mysqli_fetch_array($SQLResult);

		$query = "INSERT INTO `users` (`ID`, `Login`, `Password`, `Name`, `MiddleName`, `Surname`, `Email`, `Phone`, `Gender`, `Birthday`, `SmallDescription`, `BigDescription`, `CanWrite`, `CanEdit`, `CanDelete`, `SiteGroup`, `UniversityStatus`, `Position`, `StudyGroup`, `PhotoLink`) VALUES (NULL, '$Login', '$Login', '$student[1]', '$student[2]', '$student[0]', '', '', '', '', '', '', '0', '0', '0', 'Tutor', 'Преподаватель', '', '', 'http://bmstu-e3.ru/assets/images/jpg/tutors-photo/NoPhoto.jpg');";

		if ($ResultID["ID"] != "") {
			echo $query . "<br>";
		} else {
			$result = mysqli_query($link, $query);
		};
		
	} else if ((count($student) != 3) /*and (substr($student[4], 2, 1) == "3")*/) {
		echo "<tr>";
			echo "<td>" . $student[0] . "</td>";
			echo "<td>" . $student[1] . "</td>";
			echo "<td>" . $student[2] . "</td>";
			//echo "<td>" . $student[3] . "</td>";
			//echo "<td>" . $student[4] . "</td>";
			//echo "<td>" . $student[5] . "</td>";
    	echo "</tr>";
	}
}
?>	
</table>
</body>
</html>



