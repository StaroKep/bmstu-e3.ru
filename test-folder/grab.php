<?php 

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$url = $_GET['URL'];
$result = file_get_contents($url);


$string_1 = '<div class="col-md-6 hidden-xs">';
$string_2 = '</div>';

$schedule = "";

// Пока находим в документе позицию строки $string_1
while (strpos($result, $string_1) != false) {
	$num = strpos($result, $string_1);
	// Выбираем весь код после этой строки 
	$result = substr($result, $num + strlen($string_1));
	
	// Находим в документе позицию строки $string_2
	$num = strpos($result, $string_2);
	// Выбираем весь код до этой строки
	$schedule = $schedule . substr($result, 0, $num);
	// Получаем таблицу с расписанием на один день недели
}

// Убираем некоторые части
$schedule = str_replace("<strong>", "", $schedule);
$schedule = str_replace("</strong>", "", $schedule);

$s1 = "table table-bordered text-center table-responsive";
$s2 = "daily-schedule-table";
$schedule = str_replace($s1, $s2, $schedule);

$s1 = 'class="bg-grey" rowspan="9" width="30px"';
$s2 = 'class="day-name" colspan="3"';
$schedule = str_replace($s1, $s2, $schedule);

$schedule = str_replace('colspan="3">ПН<', 'colspan="3">Понедельник<', $schedule);
$schedule = str_replace('colspan="3">ВТ<', 'colspan="3">Вторник<', $schedule);
$schedule = str_replace('colspan="3">СР<', 'colspan="3">Среда<', $schedule);
$schedule = str_replace('colspan="3">ЧТ<', 'colspan="3">Четверг<', $schedule);
$schedule = str_replace('colspan="3">ПТ<', 'colspan="3">Пятница<', $schedule);
$schedule = str_replace('colspan="3">СБ<', 'colspan="3">Суббота<', $schedule);

$schedule = str_replace('ЧС', 'Числитель', $schedule);
$schedule = str_replace('ЗН', 'Знаменатель', $schedule);

$s1 = '<td class="day-name" colspan="3">Понедельник</td>';
$s2 = '<td class="day-name first-day-name" colspan="3">Понедельник</td>';
$schedule = str_replace($s1, $s2, $schedule);

$s1 = '<td width="20%">Время</td>';
$s2 = '<td width="20%" class="day-time">Время</td>';
$schedule = str_replace($s1, $s2, $schedule);

$schedule = $schedule . '<table class="daily-schedule-table"><tbody><tr>
							<td class="day-name" colspan="3">Воскресенье</td></tr></tbody></table>';

print_r($schedule);

?>

<!-- 
<table class="table table-bordered text-center table-responsive"> 
	<tbody> 
		<tr> 
			<td class="bg-grey" rowspan="9" width="30px"><strong>ПН</strong></td> 
		</tr> 
		<tr class="bg-grey"> 
			<td width="20%">Время</td> 
			<td class="text-white bg-success" width="40%">ЧС</td> 
			<td class="text-white bg-info" width="40%">ЗН</td> 
		</tr> 
		<tr> 
			<td class="bg-grey text-nowrap">08:30 - 10:05</td> 
			<td></td>
			<td></td> 
		</tr> 
		<tr> 
			<td class="bg-grey text-nowrap">10:15 - 11:50</td> 
			<td></td>
			<td></td> 
		</tr> 
		<tr> 
			<td class="bg-grey text-nowrap">12:00 - 13:35</td> 
			<td class="text-success"><span>Химия</span> <i>327</i> <i></i></td>
			<td class="text-info"><span>Химия</span> <i>Каф</i> <i></i></td> 
		</tr> 
		<tr> 
			<td class="bg-grey text-nowrap">13:50 - 15:25</td> 
			<td colspan="2"><span>Экология</span> <i>327</i> <i></i></td> 
		</tr> 
		<tr> 
			<td class="bg-grey text-nowrap">15:40 - 17:15</td> 
			<td colspan="2"><span>Физ воспитание</span> <i>Каф</i> <i></i></td> 
		</tr> 
		<tr> 
			<td class="bg-grey text-nowrap">17:25 - 19:00</td> 
			<td></td>
			<td></td> 
		</tr> 
		<tr> 
			<td class="bg-grey text-nowrap">19:10 - 20:45</td> 
			<td></td><td></td> 
		</tr> 
	</tbody> 
</table> -->