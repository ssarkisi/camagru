<?php

	function validate_email($img_id) {
		include 'config/database.php';

		$sql = "SELECT COUNT(*) a FROM user WHERE id = (SELECT user_id FROM image WHERE id = ".$img_id.") AND send_mail = 1 AND email IS NOT NULL;";
		$res = $con->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return ($row['a']);
	}

	function get_user_email($img_id) {
		include 'config/database.php';

		$sql = "SELECT email FROM user WHERE id = (SELECT user_id FROM image WHERE id = ".$img_id.")";
		$res = $con->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return ($row['email']);
	}

	function send_mail($message, $img_id) {
		if (validate_email($img_id) == 0)
			return (0);
		$to = get_user_email($img_id);
		$subject = "Camagru";
		$message = '<!DOCTYPE html>
					<html>
						<head>
							<title></title>
						</head>
						<body>
							<div style="position: absolute; font-size: 1.3vw; padding: 1% 1%; font-family: Arial; border-radius: 10px; background-color: #f9e8ef; color: #237b90;">
								<p>'.$message.'</p>
							</div>
						</body>
					</html>';
		$from = 'samvelsarkisian@gmail.com';

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From:" . $from;

		mail($to,$subject,$message,$headers);
	}

?>