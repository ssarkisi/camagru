<?php
	
	include 'image.php';

	function jpg2png($originalFile, $outputFile, $quality) {
		$image = imagecreatefromjpeg($originalFile);
		imagepng($image, $outputFile, $quality);
		imagedestroy($image);
		unlink($originalFile);
	}

	function gif2png($originalFile, $outputFile, $quality) {
		$image = imagecreatefromgif($originalFile);
		imagepng($image, $outputFile, $quality);
		imagedestroy($image);
		unlink($originalFile);
	}


	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if(isset($_POST["submit"]) && isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != NULL) {
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	if ($_FILES["file"]["size"] > (7 * 1024 * 1024)) { //7MB
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	} else {
		if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			echo "Sorry, there was an error uploading your file.";
		} else {
			echo "The file ". basename($_FILES["file"]["name"]). " has been uploaded.";


			$info = new SplFileInfo(basename($_FILES["file"]["name"]));
			$newName = uniqid();
			$fn = 'uploads/'.basename($_FILES["file"]["name"]);    
			$newfn = 'img/'.$newName.'.'.$info->getExtension();
			copy($fn,$newfn);
			unlink('uploads/'.basename($_FILES["file"]["name"]));

			if (strcmp($info->getExtension(), 'jpg') == 0 || strcmp($info->getExtension(), 'jpeg') == 0) {
				jpg2png($newfn, 'img/'.$newName.'.png', 1);
			}
			else if (strcmp($info->getExtension(), 'gif') == 0) {
				gif2png($newfn, 'img/'.$newName.'.png', 1);
			}
			copy('img/'.$newName.'.png', 'img/f_'.$newName.'.png');
			save_to_db($newName.'.png', 'f0.png');
			echo '<meta http-equiv="Refresh" content="0; URL=upload.php">';
		}
	}

?>