<?php

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}
	else {
		echo "Action error";
		exit ;
	}

	include 'cookie.php';
	include 'config/database.php';

	function	check_user_email($email) {
		include 'config/database.php';

		$sql = "SELECT COUNT(*) AS count FROM user WHERE email = '".$email."';";
		$res = $con->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return ($row['count']);

	}

	if ($action == 1) {
		$email = $_POST['email'];
		if (check_user_email($email) == 0) {
			$sql = "UPDATE user SET email = '".$email."' WHERE id = ".get_user_id();
			$con->query($sql);
			echo "e-mail has been changed";
			echo '<meta http-equiv="Refresh" content="2; URL=user.php?action=4">';
		}
		else {
			echo "email exist error";
			echo '<meta http-equiv="Refresh" content="2; URL=settings.php">';
		}
	}

	else if ($action == 2) {
		$password = hash('whirlpool', $_POST['password']);
		$password2 = hash('whirlpool', $_POST['password2']);
		if (strcmp($password, $password2) == 0) {
			$sql = "UPDATE user SET password = '".$password."' WHERE id = ".get_user_id();
			$con->query($sql);
			echo "password has been changed";
			echo '<meta http-equiv="Refresh" content="2; URL=user.php?action=4">';
		}
		else {
			echo "password error";
			echo '<meta http-equiv="Refresh" content="2; URL=settings.php">';
		}

	}
	
	else if ($action == 3) {
		$user = $_POST['user'];
		$sql = "UPDATE user SET name = '".$user."' WHERE id = ".get_user_id();
		$con->query($sql);
		echo "user name has been changed";
		echo '<meta http-equiv="Refresh" content="2; URL=settings.php">';
	}
	
	else if ($action == 4) {
		if (isset($_POST['send-mail'])) {
			$sql = "UPDATE user SET send_mail = 1 WHERE id = ".get_user_id();
		}
		else {
			$sql = "UPDATE user SET send_mail = 0 WHERE id = ".get_user_id();
		}
		$con->query($sql);
		echo "user name has been changed";
		echo '<meta http-equiv="Refresh" content="2; URL=settings.php">';
	}

?>
