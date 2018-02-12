$(function(){
	$("img").click(function() {
		let url = $(this).attr('src');
		url = url.replace("export=download&", "");
		window.open(url, '_blank');
	});
})