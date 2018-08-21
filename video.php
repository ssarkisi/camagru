<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php
			include 'cookie.php';
			if (!(get_user_id() > 0)) {
				echo '<meta http-equiv="Refresh" content="0; URL=index.php?up=-1">';
				exit ;
			}
	?>
	<link rel="stylesheet" type="text/css" href="css/structure.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link rel="stylesheet" type="text/css" href="css/video.css">
	<link rel="stylesheet" type="text/css" href="css/gallery.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<script src="js/video.js?n=<?php echo date_format(date_create(), 'YmdHisu'); ?>"></script>
	<script src="js/image.js?n=<?php echo date_format(date_create(), 'YmdHisu'); ?>"></script>


</head>

<body>

	<div class="header">
		<?php
			include_once 'navbar.php';
			include "config/database.php"; 
			include_once 'print.php';

		?>
	</div>

	<div class="middle">
		<div class="left">
			<?php include 'login_form.php'; ?>

			<div class="popular-img">
				<p class="input-new" style="color: #237b90;">Latest Photos</p>
				<?php
					include 'top_photo.php';
					get_top_photo(2);
				?>
			</div>
		</div>

		
		<div class="right">

			<div id="allow">Allow to use the web camera</div>

			<div class="item">
				<video style="border: 0px solid;" id="video" width="640" height="480" autoplay="autoplay" ></video>
				<img class="filter-video" src="filter/f0.png" id="imgFilter">
			</div>

			<div class="item">
				<canvas id="canvas" width="640" height="480" type="hidden"></canvas>
				<img class="filter-canvas" src="filter/f0.png" id="imgFilter2">
			</div>

			<form class="filter-type" method="post" accept-charset="utf-8" name="form1">
				<?php

					if ($handle = opendir('filter')) {
						$f = 0;
						
						while (false !== ($file = readdir($handle))) { 
							if ($file != "." && $file != ".." && $file != ".DS_Store") { 
								echo '<input type="radio" name="filter-name" id="'.$file.'" class="input-hidden" onclick="changeImage(';
								echo "'filter/".$file."'";
								echo ')" value="'.$file.'"';

								if ($f == 0) {
									echo ' checked="" ';
									$f++;
								}
								echo '/><label for="'.$file.'"><img src="filter/'.$file.'" /></label>';
							} 
						}
						closedir($handle); 
					}
				?>

				<div style="font-size: 1.4vmin; margin: 5% 0;">
					<input class="range" type="range" min="0" max="100" id="grayscale" name="grayscale" oninput="NewStyle()" value="0">		
					<a class="range-a">Grayscale:</a> <a class="range-a" id="a_grayscale">0</a><br>	
					
					<input class="range" type="range" min="0" max="200" id="brightness" name="brightness" oninput="NewStyle()" value="100">
					<a class="range-a">Brightness:</a> <a class="range-a" id="a_brightness">0</a><br>

					<input class="range" type="range" min="0" max="200" id="contrast" name="contrast" oninput="NewStyle()" value="100">
					<a class="range-a">Contrast:</a> <a class="range-a" id="a_contrast">0</a><br>

					<input class="range" type="range" min="0" max="100" id="sepia" name="sepia" oninput="NewStyle()" value="0">
					<a class="range-a">Sepia:</a> <a class="range-a" id="a_sepia">0</a><br>

					<input class="range" type="range" min="0" max="1" id="invert" name="invert" oninput="NewStyle()" value="0">
					<a class="range-a">Invert:</a> <a class="range-a" id="a_invert">0</a><br>

					<input class="range" type="range" min="0" max="360" id="hue_rotate" name="hue_rotate" oninput="NewStyle()" value="0">
					<a class="range-a">Hue_rotate:</a> <a class="range-a" id="a_hue_rotate">0</a><br>

					<input class="range" type="range" min="0" max="100" id="opacity" name="opacity" oninput="NewStyle()" value="0">
					<a class="range-a">Opacity:</a> <a class="range-a" id="a_opacity">0</a><br>

					<input class="input-submit video-submit" type="button" min="0" max="1" id="default" name="default" onclick="DefaultStyle()" value="Default filter">
					<input class="input-submit video-submit" type="button" id="take-a-photo" class="take-a-photo" value="To make a photo" />


				</div>

				<input name="hidden_data" id='hidden_data' type="hidden"/>
			</form>
		</div>
	</div>

	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>

</body>
</html>