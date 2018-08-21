<?php
	include_once "config/database.php";

	include 'cookie.php';

	if ($_POST['hidden-id'] == -1) {
		$sql = "INSERT INTO likes (user_id, image_id, value) VALUES (".get_user_id().", ".get_img_id().", 1);";
		$con->query($sql);

		$sql2 = "SELECT max(id) id from likes;";
		$res = $con->query($sql2);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		echo '<div id="content"><input type="hidden" id="hidden-id" value="'.$row['id'].'"></div>';
	}
	else {
		$sql = "DELETE FROM likes WHERE id = ".$_POST['hidden-id'].";";
		$con->query($sql);

		echo '<div id="content"><input type="hidden" id="hidden-id" value="-1"></div>';
	}

?>