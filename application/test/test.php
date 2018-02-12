<?php 
	list($usec, $sec) = explode(" ", microtime());



	$date = "27.04.2017 - 14:25:00";
	$date = str_replace(" - ", " ", $date);
	echo strtotime($date), "\n";
	echo $sec;
?>