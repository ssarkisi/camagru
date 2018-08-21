<?php

	function send_mail_new_user($user, $password, $email) {
		$to = $email;
		$subject = "Confirm the password";
		$message = '<!DOCTYPE html>
					<html>
						<head>
							<title></title>
						</head>
						<body>
							<div style="position: absolute; font-size: 1.3vw; padding: 1% 1%; font-family: Arial; border-radius: 10px; background-color: #f9e8ef; color: #237b90;">
								To confirm the password, click on the <a href="http://localhost:8100/user.php?action=3&user='.$user.'&password='.$password.'&email='.$email.'">link</a>
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

<div style="position: absolute; font-size: 1.3vw; padding: 1% 1%; font-family: Arial; border-radius: 10px; background-color: #f9e8ef; color: #237b90;">
	<p>To confirm the password, click on the link that was sent to you by e-mail. After a few seconds, the page will be redirected to the home page</p>
	<meta http-equiv="Refresh" content="5; URL=index.php?up=-1">
</div>