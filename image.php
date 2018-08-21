<?php

	function merge($img, $filter, $new_filename) {

		list($width_x, $height_x) = getimagesize($img);
		list($width_y, $height_y) = getimagesize($filter);

		$image = imagecreatetruecolor($width_x, $height_x);

		
		$image_x = imagecreatefrompng($img);
		$image_y = imagecreatefrompng($filter);

		imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, $height_x);
		imagecopyresized($image, $image_y, 0, 0, 0, 0, $width_x, $height_x, $width_y, $height_y);

		imagejpeg($image, $new_filename);

		imagedestroy($image);
		imagedestroy($image_x);
		imagedestroy($image_y);
	}

	function save_to_db($new_filename, $filter_name) {
		include 'config/database.php';
		include 'cookie.php';


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
		if (isset($_POST['default'])) {
			$default = $_POST['default'];
		}

		

		$sql = "INSERT INTO image	(user_id, value, grayscale, brightness, contrast, sepia, invert, hue_rotate, opacity, filter, description) VALUES
									(
									".get_user_id().",'".
									$new_filename."',".
									$grayscale.",".
									$brightness.",".
									$contrast.",".
									$sepia.",".
									$invert.",".
									$hue_rotate.",".
									$opacity.",'".
									$filter_name."',''".
									");";
		$con->query($sql);
	}

?>