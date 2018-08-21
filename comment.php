<?php
	include_once "config/database.php"; 
	include 'cookie.php';
	include 'send_mail.php';

	$comment = $_POST['v'];
	$comment = str_replace("\\", "\\\\", $comment);
	$comment = str_replace("'", "\'", $comment);

	$sql = "INSERT INTO comments (user_id, image_id, value) VALUES (".get_user_id().", ".get_img_id().", '".$comment."');";
	$con->query($sql);

	$sql = "SELECT u.name, c.image_id, c.value, c.date_log
			FROM comments c
			INNER JOIN user u ON c.user_id = u.id
			WHERE c.user_id = ".get_user_id()." AND c.image_id = ".get_img_id()." ORDER BY c.date_log DESC LIMIT 1;";
	$res = $con->query($sql);
	$row = $res->fetch(PDO::FETCH_ASSOC);
	echo '<a class="comment-info">'.$row['name'].' ('.$row['date_log'].'):</a><br>'.$row['value'];
	send_mail('You have new comment!', get_img_id());

?>