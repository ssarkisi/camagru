<?php
	include_once "config/database.php"; 
	include 'cookie.php';

	$sql = "INSERT INTO rating (user_id, image_id, value) VALUES (".get_user_id().", ".get_img_id().", ".$_POST['v'].");";
	$con->query($sql);

	$sql = "SELECT AVG(value) AS avr FROM rating WHERE image_id = ".get_img_id();
	$res = $con->query($sql);
	$row = $res->fetch(PDO::FETCH_ASSOC);
	echo '<button class="rating">Average rating: '.round($row['avr'], 1).'</button>';

?>
