/*function get_current_lesson(){
	let time = new Date;
	    hour = time.getHours();
	    min = time.getMinutes();
	    // День недели
	    day = time.getDay();
	if (day == 0) {
		return "Выходной | ВС";
	}
	if ((hour == 7) || ((hour == 8) && (min <= 29))) {
		return "Начало дня";
	} 
	// 1 пара
	else if ( ((hour == 8) && (min >= 30)) || ( (hour == 9) && ((min <= 14) || (min >= 21)) ) || ((hour == 10) && (min <= 5)) ) {
		return "Пара 8:30 - 10:05";
	} else if ( (hour == 9) && ((min >= 15) && (min <= 20)) ) {
		return "Пауза 5 минут";
	} 
	// 2 пара
	else if ( ((hour == 10) && (min >= 15)) || ( (hour == 11) && ((min >= 6) && (min <= 50)) ) ) {
		return "Пара 10:15 - 11:50";
	} else if ( (hour == 11) && ((min >= 0) && (min <= 5)) ) {
		return "Пауза 5 минут";
	} 
	// 3 пара
	else if ( ((hour == 12) && ((min <= 44) || (min >= 51))) || ((hour == 13) && (min <= 35)) ) {
		return "Пара 12:00 - 13:35";
	} else if ( (hour == 12) && ((min >= 45) && (min <= 50)) ) {
		return "Пауза 5 минут";
	}  
	// 4 пара
	else if ( ((hour == 13) && (min >= 50)) || ( (hour == 14) && ((min <= 34) || (min >= 41)) ) || ((hour == 15) && (min <= 25)) ) {
		return "Пара 13:50 - 15:25";
	} else if ( (hour == 14) && ((min >= 35) && (min <= 40)) ) {
		return "Пауза 5 минут";
	}   
	// 5 пара
	else if ( ((hour == 15) && (min >= 40)) || ( (hour == 16) && ((min <= 24) || (min >= 31)) ) || ((hour == 17) && (min <= 15)) ) {
		return "15:40 - 17:15";
	} else if ( (hour == 16) && ((min >= 25) && (min <= 30)) ) {
		return "Пауза 5 минут";
	}    
	// 6 пара
	else if ( ((hour == 17) && (min >= 25)) || ( (hour == 18) && ((min <= 9) || (min >= 16)) ) ) {
		return "17:25 - 19:00";
	} else if ( (hour == 18) && ((min >= 10) && (min <= 15)) ) {
		return "Пауза 5 минут";
	}  
	// --- --- ---
	else if ((hour >= 19) && (hour <= 22)) {
		return "Завершение дня";
	} else if ((hour >= 23) || (hour <= 6)) {
		return "Университет закрыт";
	} else {
		return "Перерыв"
	}
}
*/

$(function(){

	function ON_OFF_GIF(){
		function GET_FILE_NAME(el){
			let url = $(el).css('background-image');
				url = url.split("/");
				url = url[url.length-1];
			return url.substring(0, url.length-5);
		}

		let on_off_gif_lS = localStorage.getItem('on_off_gif_lS');
		if (on_off_gif_lS == 0) {
			let els = $(".gif-bgi");
			for (let i = 0; i < els.length; i++) {
				let el = els[i];
				let file_name = GET_FILE_NAME(el);

				// Кастыль для ios
				if (file_name[file_name.length-1] != "."){
					file_name += ".";
				}

				let new_url = "url(/assets/images/jpg/gif-to-jpg/" + file_name + "jpg)";
				$(el).css('background-image', new_url);
			}
		} else if (on_off_gif_lS == 1) {
			let els = $(".gif-bgi");
			for (let i = 0; i < els.length; i++) {
				let el = els[i];
				let file_name = GET_FILE_NAME(el);

				// Кастыль для ios
				if (file_name[file_name.length-1] != "."){
					file_name += ".";
				}

				let new_url = "url(/assets/images/gif/" + file_name + "gif)";
				$(el).css('background-image', new_url);
			}
		}
	}
	ON_OFF_GIF();

	var flag_0 = true;
	$("#start-full-menu").click(function() {
		let flag = $(".full-menu-area").css('display');
		if ( (flag_0 === true) && (flag == "none") ) {
			flag_0 = false;
			$(".bmstu-logo").css('opacity', '0');
			$(".energo-name").css('opacity', '0');
			$(".e3-name").css('opacity', '0');
			$(".header").css('background-color', 'rgba(20,31,52,0.6)');
			setTimeout(function(){
				$(".logo-and-department").css('display', 'none');
				$(".full-menu-area").css('display', 'block');
			}, 550);
			setTimeout(function(){
				$(".top-menu").css('border-color', 'rgba(255,255,255,0.1)');
				$(".full-menu-area").css('opacity', '1');
			}, 600);
			setTimeout(function(){
				flag_0 = true;
			}, 1200);
		} else if ( (flag_0 === true) && (flag == "block") ) {
			flag_0 = false;
			$(".top-menu").css('border-color', '');
			$(".full-menu-area").css('opacity', '');
			setTimeout(function(){
				$(".logo-and-department").css('display', '');
				$(".full-menu-area").css('display', '');
			}, 550);
			setTimeout(function(){
				$(".bmstu-logo").css('opacity', '');
				$(".energo-name").css('opacity', '');
				$(".e3-name").css('opacity', '');
				$(".header").css('background-color', '');
			}, 600);
			setTimeout(function(){
				flag_0 = true;
			}, 1200);
		}
	});


	$("#on-off-gif").click(function() {
		let on_off_gif_lS = localStorage.getItem('on_off_gif_lS');
		if (on_off_gif_lS === null) {
			localStorage.setItem('on_off_gif_lS', 1);
			ON_OFF_GIF();
		} else if (on_off_gif_lS == 1) {
			localStorage.setItem('on_off_gif_lS', 0);
			ON_OFF_GIF();
		} else {
			localStorage.setItem('on_off_gif_lS', 1);
			ON_OFF_GIF();
		}
	});
});

/*
$(function(){
	let TextDate = $("#menu-schedule-time").attr('title');
	let date = new Date(TextDate);
	
	setInterval(function(){
		date.setSeconds(date.getSeconds()+5);

		
		// Пишем день месяца
		// if ( date.getDate().toString().length < 2 ) {
		// 	TextDate = "0" + date.getDate();
		// } else {
		// 	TextDate = date.getDate();
		// }
		// // Пишем номер месяца
		// if (  (date.getMonth() + 1).toString().length < 2 ) {
		// 	TextDate += "." + "0" + (date.getMonth() + 1);
		// } else {
		// 	TextDate += "." + (date.getMonth() + 1);
		// }
		// // Пишем год
		// TextDate += "." + date.getFullYear();
		// // Получаем Day.Month.Year
		

		// Пишем часы
		if ( date.getHours().toString().length < 2 ) {
			TextDate = "0" + date.getHours();
		} else {
			TextDate = date.getHours();
		}
		// Пишем минуты
		if ( date.getMinutes().toString().length < 2 ) {
			TextDate += ":" + "0" + date.getMinutes();
		} else {
			TextDate += ":" + date.getMinutes();
		}
		// Пишем секунды
		if ( date.getSeconds().toString().length < 2 ) {
			TextDate += ":" + "0" + date.getSeconds();
		} else {
			TextDate += ":" + date.getSeconds();
		}

		// Формируем информацию о неделе
		let week = $(".sp-week").html().split(" | ");
		let week_type;
		if (week[1] == "Числитель") {
			week_type = "чс";
		} else {
			week_type = "зн";
		}
		week = week[0].split(" ");

		TextDate += " - " + get_current_lesson(date) + " | " + week[1] + " неделя " + " ( " + week_type + " )";

		
		$("#menu-schedule-time").html(TextDate);
		$("#menu-schedule-time").attr('title', TextDate);;
	}, 5000);

})
*/

// $("html").click(function(){
// 	let audio = new Audio();
// 	audio.src = "/assets/ui_audio/NFCTransferComplete.ogg";
// 	audio.play(); 
// })