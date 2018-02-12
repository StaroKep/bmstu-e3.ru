<?php 
	$slider_height = $_GET["slider_height"];
	$images_path =  $_GET["images_path"];
	$img_count =  $_GET["img_count"];
?>

<style>
	.bmstu-e3-slider{
		width: 100%;
		height: 500px;
		position: relative;
		padding: 10% 0;

	}
	.bmstu-e3-slider .img{
		background-position: center;
		background-repeat: no-repeat;
		-webkit-background-size: cover;
		background-size: 100%;	
		transition: .3s;
		transition-property: background-image;
	}
	.bmstu-e3-slider .clickable-img{
		position: absolute;
		width: calc(300px / 0.53125);
		height: 300px;
		top: 20%;
		z-index: 9;
		opacity: 0.5;
		cursor: pointer;
	}
	.bmstu-e3-slider .current-img{
		position: relative;
		width: 80%;
		height: 100%;
		margin: auto;
		background-image: url("<?php echo $images_path . "/1.jpg"; ?>");
		box-shadow: 2px 2px 2px rgba(0,0,0,0.5);
		z-index: 10;
	}
	.bmstu-e3-slider .previous-img{
		left: -20%;
		display: none;
	}
	.bmstu-e3-slider .next-img{
		background-image: url("<?php echo $images_path . "/2.jpg"; ?>");
		right: -20%;
	}
</style>

<div class="bmstu-e3-slider" title="<?php echo $images_path; ?>">
	<div class="img clickable-img previous-img"></div>
	<div class="img current-img"></div>
	<div class="img clickable-img next-img"></div>
</div>	

<!-- <script src="/assets/js/jq/jquery-3.1.1.min.js"></script> -->
<script>
	i = 1;
	n = <?php echo $img_count ?>;
	var flag = true;
	$(".previous-img").click(function() {
		if (flag == true) {
			flag = false;
			i -= 1;
			$(".current-img").css('backgroundImage', 'url(<?php echo $images_path ?>/' + i + '.jpg)');
			if (i!=1) {
				$(".previous-img").css('backgroundImage', 'url(<?php echo $images_path ?>/' + (i-1) + '.jpg)');
			}
			$(".next-img").css('backgroundImage', 'url(<?php echo $images_path ?>/' + (i+1) + '.jpg)');
			
			if (i == 1) {
				$(".previous-img").css('display', 'none');
			}
			if (i == n-1) {
				$(".next-img").css('display', 'block');	
			}
			setTimeout(function(){
				flag = true;
			},400)
		}
	});
	$(".next-img").click(function() {
		if (flag == true) {
			flag = false;
			i += 1;
			$(".current-img").css('backgroundImage', 'url(<?php echo $images_path ?>/' + i + '.jpg)');
			$(".previous-img").css('backgroundImage', 'url(<?php echo $images_path ?>/' + (i-1) + '.jpg)');
			if (i!=n) {
				$(".next-img").css('backgroundImage', 'url(<?php echo $images_path ?>/' + (i+1) + '.jpg)');
			}
			
			if (i == n) {
				$(".next-img").css('display', 'none');
			}
			if (i == 2) {
				$(".previous-img").css('display', 'block');	
			}
			setTimeout(function(){
				flag = true;
			},400)
		}
	});
</script>