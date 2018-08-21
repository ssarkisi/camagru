<?php
	include 'config/database.php';
	include 'image.php';

	$img = $_POST['img'];
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

	$sql = "UPDATE image SET 	grayscale = ".$grayscale.",
								brightness = ".$brightness.",
								contrast = ".$contrast.",
								sepia = ".$sepia.",
								invert = ".$invert.",
								hue_rotate = ".$hue_rotate.",
								opacity = ".$opacity."
			WHERE value = '".$img."'";

	$con->query($sql);

?>
