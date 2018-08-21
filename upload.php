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
	<link rel="stylesheet" type="text/css" href="css/upload.css">
	<script src="js/image.js?n=<?php echo date_format(date_create(), 'YmdHisu'); ?>"></script>


</head>
<body>
	<?php
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		include "config/database.php"; 
		include_once 'print.php';
		include 'ft_gallery.php';
		$files = get_file_name(get_user_id());


		if (!isset($_GET['up']) && !isset($_GET['img_name']) && isset($files[0]))
		{
			echo '<meta http-equiv="Refresh" content="0; URL=?up=1&img_name='.$files[0]['img_name'].'">';
			
		}
	?>

	<div class="header">
		<?php
			include_once 'navbar.php';
			if (!(get_user_id() > 0)) {
				echo '<div class="middle">user_id_error</div>';
				exit ;
			}
		?>
	</div>

	<div class="middle">

		<div class="left">
			<?php include 'login_form.php';	?>

			<div class="popular-img">
				<p class="input-new" style="color: #237b90;">Latest Photos</p>
				<?php
					include 'top_photo.php';
					get_top_photo(2);
				?>
			</div>
		</div>

		<div class="right">

			<div class="upload-form">
				<form action="upload_query.php" method="post" enctype="multipart/form-data">
					<input type="file" class="file" name="file" id="file"  title="Choose a video please">
					<input class="input-submit upload-submit" type="submit" value="Upload Image" name="submit">
					<input class="input-submit upload-submit" type="button" value="Webcam" name="submit" onclick="location.href='video.php'">
				</form>

			</div>
			<hr>
			<div class="right0">
				<div class="right1">
					<?php get_right1_photo($files); ?>
				</div>

				<div class="right2">
					<div id="content">
					<?php get_right2_photo($files, 'canvas', 1);	?>
					</div>

					<div class="filter">
						<form class="filter-type1" method="post" accept-charset="utf-8" name="form1">
							<?php

								if ($handle = opendir('filter')) {
									$f = 0;
									
									while (false !== ($file = readdir($handle))) { 
										if ($file != "." && $file != ".." && $file != ".DS_Store") { 

											echo '<input type="radio" name="filter-name" id="'.$file.'" class="input-hidden" onclick="changeF(';
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

							<?php
								$img_v = "";
								if (isset($_GET['img_name']))
									$img_v = $_GET['img_name'];
								$sql = "SELECT id, user_id, value, grayscale, brightness, contrast, sepia, invert, hue_rotate, opacity, filter, description, date_log FROM `image` WHERE value = '".$img_v."'";
								$res = $con->query($sql);
								$row = $res->fetch(PDO::FETCH_ASSOC);
							?>
							<script type="text/javascript">
								$(function(){
									$('#delete').click(function(){
										$.ajax({
											type: "POST",
											url: "delete.php",
											data:'img='+getImgName(),
											success:function(html) {
												alert(html);
												location.href = 'upload.php';
											}
										});
									});
								});
							</script>

							<div style="font-size: 1.3vmin; width: 40vmin;  margin: 0 20%; text-align: left;">
								<input class="range" type="range" min="0" max="100" id="grayscale" name="grayscale" oninput="NewStyle()" onchange="saveStyle(1)" value="<?php echo $row['grayscale']; ?>">		
								<a class="range-a">Grayscale:</a> <a class="range-a" id="a_grayscale"><?php echo $row['grayscale']; ?></a><br>	
								
								<input class="range" type="range" min="0" max="200" id="brightness" name="brightness" oninput="NewStyle()" onchange="saveStyle(1)" value="<?php echo $row['brightness']; ?>">
								<a class="range-a">Brightness:</a> <a class="range-a" id="a_brightness"><?php echo $row['brightness'] - 100; ?></a><br>

								<input class="range" type="range" min="0" max="200" id="contrast" name="contrast" oninput="NewStyle()" onchange="saveStyle(1)" value="<?php echo $row['contrast']; ?>">
								<a class="range-a">Contrast:</a> <a class="range-a" id="a_contrast"><?php echo $row['contrast'] - 100; ?></a><br>

								<input class="range" type="range" min="0" max="100" id="sepia" name="sepia" oninput="NewStyle()" onchange="saveStyle(1)" value="<?php echo $row['sepia']; ?>">
								<a class="range-a">Sepia:</a> <a class="range-a" id="a_sepia"><?php echo $row['sepia']; ?></a><br>

								<input class="range" type="range" min="0" max="1" id="invert" name="invert" oninput="NewStyle()" onchange="saveStyle(1)" value="<?php echo $row['invert']; ?>">
								<a class="range-a">Invert:</a> <a class="range-a" id="a_invert"><?php echo $row['invert']; ?></a><br>

								<input class="range" type="range" min="0" max="360" id="hue_rotate" name="hue_rotate" oninput="NewStyle()" onchange="saveStyle(1)" value="<?php echo $row['hue_rotate']; ?>">
								<a class="range-a">Hue_rotate:</a> <a class="range-a" id="a_hue_rotate"><?php echo $row['hue_rotate']; ?></a><br>

								<input class="range" type="range" min="0" max="100" id="opacity" name="opacity" oninput="NewStyle()" onchange="saveStyle(1)" value="<?php echo $row['opacity']; ?>">
								<a class="range-a">Opacity:</a> <a class="range-a" id="a_opacity"><?php echo $row['opacity']; ?></a><br>
								<input class="input-submit video-submit" type="button" min="0" max="1" id="default" name="default" onclick="saveStyle(0)" value="Default filter">
								<input class="input-submit video-submit" type="button" id="delete" name="delete" value="Delete">
								
							</div>
							

							<input name="hidden_data" id='hidden_data' type="hidden"/>
						</form>

					</div>

				</div>
			</div>

		</div>


	</div>
	
	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>

</body>
</html>
