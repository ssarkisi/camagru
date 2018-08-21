<?php
	
	if (isset($_POST['img'])) {
		include 'cookie.php';
		include 'config/database.php';
		$img = $_POST['img'];

		$sql = "SELECT id FROM image WHERE value = '".$img."';";
		$res = $con->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$img_id = $row['id'];

		$sql1 = "DELETE FROM comments WHERE image_id = ".$img_id.";";
		$con->query($sql1);
		$sql2 = "DELETE FROM likes WHERE image_id = ".$img_id.";";
		$con->query($sql2);
		$sql3 = "DELETE FROM rating WHERE image_id = ".$img_id.";";
		$con->query($sql3);
		$sql4 = "DELETE FROM image WHERE id = ".$img_id.";";
		$con->query($sql4);

		unlink('img/'.$img);
		unlink('img/f_'.$img);

		echo "Image successfully deleted";
	}

?>
