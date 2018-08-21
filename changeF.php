<?php
	include 'config/database.php';
	include 'image.php';

	$f =  $_POST['f'];
	$img = $_POST['img'];
	list($w, $h) = getimagesize('img/'.$img);
	$size = 'width: 60vmin;';
	if ($h > $w)
		$size = 'height: 45vmin;';

	$gallery_dir = 'img/';

	$sql = "SELECT id, user_id, value, grayscale, brightness, contrast, sepia, invert, hue_rotate, opacity, filter, description, date_log FROM `image` WHERE value = '".$img."'";

	$res = $con->query($sql);
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
		$files = array( 'id' => $row['id'], 
							'user_id' => $row['user_id'], 
							'value' => $gallery_dir . 'f_' . $row['value'], 
							'grayscale' => $row['grayscale'], 
							'brightness' => $row['brightness'], 
							'contrast' => $row['contrast'], 
							'sepia' => $row['sepia'], 
							'invert' => $row['invert'] * 100, 
							'hue_rotate' => $row['hue_rotate'], 
							'opacity' => (100 - $row['opacity']) / 100, 
							'filter' => $row['filter'], 
							'description' => $row['description'],
							'date_log' => $row['date_log'],
							'img_name' => $row['value']);
	}


	unlink($files['value']);
	merge('img/'.$files['img_name'], $f, $files['value']);


	$grayscale = 0;
	$brightness = 100;
	$contrast = 100;
	$sepia = 0;
	$invert = 0;
	$hue_rotate = 0;
	$opacity = 0;
	$default = 1;

	if (isset($_POST['grayscale'])) {
		$grayscale = $_POST['grayscale'];
	}
	if (isset($_POST['brightness'])) {
		$brightness = $_POST['brightness'];
	}
	if (isset($_POST['contrast'])) {
		$contrast = $_POST['contrast'];
	}
	if (isset($_POST['sepia'])) {
		$sepia = $_POST['sepia'];
	}
	if (isset($_POST['invert'])) {
		$invert = $_POST['invert'];
	}
	if (isset($_POST['hue_rotate'])) {
		$hue_rotate = $_POST['hue_rotate'];
	}
	if (isset($_POST['opacity'])) {
		$opacity = $_POST['opacity'];
	}
	$filter = str_replace("filter/", "", $f);	

			

	$sql = "UPDATE image SET 	grayscale = ".$grayscale.",
								brightness = ".$brightness.",
								contrast = ".$contrast.",
								sepia = ".$sepia.",
								invert = ".$invert.",
								hue_rotate = ".$hue_rotate.",
								opacity = ".$opacity.",
								filter = '".$filter."'
			WHERE value = '".$img."'";

	$con->query($sql);


?>
