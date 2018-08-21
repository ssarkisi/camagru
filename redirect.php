<?php
	include "config/database.php"; 
	include_once 'print.php';
	include 'cookie.php';

	
	if (isset($_GET['img_src']) && isset($_GET['img_name'])) {
		set_img_id($_GET['img_name']);
		echo '<meta http-equiv="Refresh" content="0; URL=index.php?up=1&img_src='.$_GET['img_src'].'&img_name='.$_GET['img_name'].'">';
	}
	else {
		//echo 111;
		$sql = "SELECT value FROM `image` ORDER BY date_log DESC LIMIT 1"; 
		$res = $con->query($sql);
		if ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			set_img_id($row['value']);
			echo '<meta http-equiv="Refresh" content="0; URL=index.php?up=1&img_src=img/f_'.$row['value'].'&img_name='.$row['value'].'">';
		}
		else {
			echo '<meta http-equiv="Refresh" content="0; URL=index.php?up=-1">';
		}
	}
?>

