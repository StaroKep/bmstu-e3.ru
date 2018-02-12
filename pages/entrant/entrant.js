function Slider(els, min, max, side){
	let i = min;
	for (i = min; i <= max; i++) {
		let i_display = $(""+els+i).css("display");
		if (side == "<") {
			if ((i == min) && (i_display == "block")) {
				$(""+els+i).css("display", "none");
				$(""+els+max).css("display", "block");
				break;
			}
			else if (i_display == "block") {
				$(""+els+i).css("display", "none");
				$(""+els+(i-1)).css("display", "block");
				break;
			}
		}
		else if (side == ">") {
			if ((i == max) && (i_display == "block")) {
				$(""+els+i).css("display", "none");
				$(""+els+min).css("display", "block");
				break;
			}
			else if (i_display == "block") {
				$(""+els+i).css("display", "none");
				$(""+els+(i+1)).css("display", "block");
				break;
			}
		}
	}
}

$(function(){
	$(".left-arrow").click(function() {
		Slider(".gtd-application-", 1, 5, "<");
	});
	$(".right-arrow").click(function() {
		Slider(".gtd-application-", 1, 5, ">");
	});
})