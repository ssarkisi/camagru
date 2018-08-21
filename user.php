<?php
	include_once 'error.php';
	include_once 'print.php';

	function	check_user ($email) {
		include 'config/database.php';

		$sql = "SELECT COUNT(*) AS count FROM user WHERE email = '".$email."';";
		$res = $con->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return ($row['count']);

	}

	function	check_password ($email, $password) {
		include 'config/database.php';

		$sql = "SELECT password FROM user WHERE email = '".$email."';";
		$res = $con->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);

		if (strcmp($row['password'], $password) == 0) {
			return (1);
		}
		return (0);
	}

	function	get_login_status($email) {
		include 'config/database.php';

		$sql = "SELECT SUM(login_status) AS login_status FROM user WHERE email = '".$email."'";
		$res = $con->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return ($row['login_status']);
	}

	function	login_user($email, $password) {
		include 'config/database.php';
		include 'cookie.php';

		if (check_user($email) != 0 && check_password($email, $password) == 1) {
			setcookie('email', $email, time() + 60*60*24);
			set_user_id($email);
			
			$sql = "UPDATE user SET login_status = 1 WHERE email = '".$email."'";
			$con->query($sql);
		}
		else {
			print_login_error();
		}
	}

	function	logout_user() {
		include 'config/database.php';
		include_once 'cookie.php';

		$sql = "UPDATE user SET login_status = 1 WHERE email = '".get_cookie('email')."'";
		$con->query($sql);
		setcookie('email', '', time() - 60*60*24);
		del_user_id();
		
	}

	function	new_user($user, $password, $email) {
		include 'config/database.php';

		if (check_user($email) != 0) {
			print_user_exist_error();
		}
		else {
			$sql = "INSERT INTO user (name, password, email, login_status) VALUES ('$user', '$password', '$email', '0');";
			$con->query($sql);
		}
		
	}

	function	delete_user($email, $password) {
		include 'config/database.php';
	}


	if ($_GET['action'] == 0 && $_POST['submit'] && strcmp($_POST['submit'], 'Log in') == 0) {
		$email = $_POST['email'];
		$password = hash('whirlpool', $_POST['password']);

		login_user($email, $password);
		echo '<meta http-equiv="Refresh" content="0; URL=index.php?up=-1">';
		
	}
	else if ($_GET['action'] == 1) {
		include 'cookie.php';
		if (!get_user_id() || get_user_id() < 1)
			include 'registration_form.php';
		else
			echo '<meta http-equiv="Refresh" content="0; URL=index.php?up=-1">';
	}
	else if ($_GET['action'] == 2) {
		include 'send_mail_new_user.php';
		$user = $_POST['user'];
		$password = hash('whirlpool', $_POST['password']);
		$email = $_POST['email'];
		send_mail_new_user($user, $password, $email);
	}
	else if ($_GET['action'] == 3) {
		$user = $_GET['user'];
		$password = $_GET['password'];
		$email = $_GET['email'];
		new_user($user, $password, $email);
		echo '<div style="position: absolute; font-size: 1.3vw; padding: 1% 1%; font-family: Arial; border-radius: 10px; background-color: #f9e8ef; color: #237b90;">
				<p>Now you can login on the site. After a few seconds, the page will be redirected to the home page</p>
				<meta http-equiv="Refresh" content="5; URL=index.php?up=-1">
			 </div>';
	}
	else if ($_GET['action'] == 4) {
		logout_user();
		echo '<meta http-equiv="Refresh" content="0; URL=index.php?up=-1">';
	}
	else if ($_GET['action'] == 5) {
		include_once 'cookie.php';
		include_once 'config/database.php';
		if (get_user_id() && get_user_id() > 0) {
			logout_user();
			$sql = "UPDATE user SET email = NULL, password = NULL WHERE id = ".get_user_id();
			$con->query($sql);
			
		}
		echo '<meta http-equiv="Refresh" content="0; URL=index.php?up=-1">';
	}
	else {
		print_login_error();
	}

?>
