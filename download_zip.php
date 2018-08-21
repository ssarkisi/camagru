<?php
	function get_usr_photo_name() {
		include 'config/database.php';
		include_once 'cookie.php';

		$i = 0;
		$array = array();
		$gallery_dir = 'img/';
		$user_id = get_user_id();

		$sql = "SELECT id, user_id, value FROM `image` WHERE user_id = ".$user_id." ORDER BY date_log DESC";

		$res = $con->query($sql);
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			$array[$i] = $gallery_dir.$row['value'];
			$i++;
		}
		return ($array);
	}

	$photo = get_usr_photo_name();
	$archive_name = "Photo.zip";
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	$zip = new ZipArchive();
	$zip->open($archive_name, ZIPARCHIVE::CREATE);
	$i = 0;
	$n = count($photo);
	while ($i < $n) {
		$zip->addFile($photo[$i]);
		$i++;
	}
	if ($n == 0) {
		$zip->addFile('logo/noPhoto.gif');
	}
	$zip->close(); //Завершаем работу с архивом

	header("Content-type: application/zip"); 
	header("Content-Disposition: attachment; filename=".$archive_name); 
	header("Pragma: no-cache"); 
	header("Expires: 0"); 
	readfile($archive_name);
	unlink($archive_name);
?>