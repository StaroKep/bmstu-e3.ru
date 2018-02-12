$(function(){
function ShowSchedule(){
	let user_study_group_lS = localStorage.getItem('user_study_group_lS');
	if (user_study_group_lS != null) {
		let URL = "";
		switch (user_study_group_lS) {
			case "Э3-21 ": URL = "https://students.bmstu.ru/schedule/40513ea0-c780-11e6-8727-005056960017";
			break;
			case "Э3-22 ": URL = "https://students.bmstu.ru/schedule/404dda80-c780-11e6-b0be-005056960017";
			break;
			case "Э3-41 ": URL = "https://students.bmstu.ru/schedule/62f2527e-a264-11e5-94e6-005056960017";
			break;
			case "Э3-42 ": URL = "https://students.bmstu.ru/schedule/62f1b472-a264-11e5-9c22-005056960017";
			break;
			case "Э3-61 ": URL = "https://students.bmstu.ru/schedule/18ffa684-8781-11e4-a982-005056960017";
			break;
			case "Э3-62 ": URL = "https://students.bmstu.ru/schedule/1901407a-8781-11e4-ad95-005056960017";
			break;
			case "Э3-69 ": URL = "https://students.bmstu.ru/schedule/9104d472-2f33-11e7-b28c-005056960017";
			break;
			case "Э3-81 ": URL = "https://students.bmstu.ru/schedule/e5019e0c-e742-11e3-9f9c-024716c10819";
			break;
			case "Э3-82 ": URL = "https://students.bmstu.ru/schedule/e90d73f4-e742-11e3-bf0e-024716c10819";
			break;
			case "Э3-89 ": URL = "https://students.bmstu.ru/schedule/9aa97834-37a4-11e6-9d0d-005056960017";
			break;
			case "Э3-101 ": URL = "https://students.bmstu.ru/schedule/d8e18ce0-e742-11e3-b621-024716c10819";
			break;
			case "Э3-102 ": URL = "https://students.bmstu.ru/schedule/dc5714c6-e742-11e3-b5a4-024716c10819";
			break;
			case "Э3-109 ": URL = "https://students.bmstu.ru/schedule/76c04cc0-5863-11e5-ac5b-005056960017";
			break;
			default: URL = "";
			break;
		}
		$.get('/test-folder/grab.php',
			{
				URL: URL
			},
			onAjaxSuccess
		);
		function onAjaxSuccess(data){
			$(".Dynamic-Calendar").css('display', 'block');
			$(".Dynamic-Calendar").html(data);
		}
		let obj = $(".group-selector").children('.group:contains("'+localStorage.getItem('user_study_group_lS')+'")');
		$(obj).css('color', 'rgb(255,255,255)');
		$(obj).css('background-color', 'rgb(80,99,127)');
	}
}
ShowSchedule();
$(".group").click(function() {
	// Убираем расписание
	$(".Dynamic-Calendar").html("");
	// У всех групп возвращаем цвет текста к исходному
	$(".group-selector").children('.group').css('color', '');
	// У всех групп возвращаем фон к исходному
	$(".group-selector").children('.group').css('background-color', '');
	// Скрываем область расписания
	$(".Dynamic-Calendar").css('display', '');

	if ($(this).html() != localStorage.getItem('user_study_group_lS')) {
		localStorage.setItem('user_study_group_lS', $(this).html());
		$(this).css('color', 'rgb(255,255,255)');
		$(this).css('background-color', 'rgb(80,99,127)');
		ShowSchedule();
	} else {
		localStorage.removeItem('user_study_group_lS');
	}
});


})