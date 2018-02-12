<?php 
	$head_title = "Тестовый слайдер | Э3 МГТУ им. Н. Э. Баумана";
	include "../../templates/global/header.php";
?>

<div class="page-content">
	<script>
		$.get('/templates/local/slider.php',
			{
				slider_height: 500,
				images_path: "/assets/images/galleries/test-galary",
				img_count: 4
			},
			function(data) {
			$(".page-content").html(data);
		});
	</script>
</div>

<?php 
	include "../../templates/global/footer-full.php";
?>

