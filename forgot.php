<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/structure.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<script src="js/registration_form.js"></script>
	<link rel="stylesheet" type="text/css" href="css/registration_form.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">

</head>
<body>
		
	<div class="header">
		<?php
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		include_once 'navbar.php';
		include_once 'print.php';
		include_once 'cookie.php';

		?>
	</div>

	<div class="middle">
		<div class="left">
			<?php include 'login_form.php'; ?>	
		</div>
		<?php

			function get_form($n, $password) {

				$message = "";
				if ($n == 1) {
					$message = "No such email or user name";
				}
				else if ($n == 2) {
					$message = "Your new password:<h2>".$password."</h2>";
				}
				echo '
							<div class="right">
								<div class="general">
									<form action="forgot.php" method="post" target="_self">
										<a id="error">'.$message.'</a>
										<input class="registration-form input-login" type="email" id="email" name="email" placeholder="Email" oninput="checkEmail()" required>
										<input class="registration-form input-login" type="text" id="user" name="user" placeholder="User name" oninput="checkUser()" required>
										<input class="registration-button input-submit" type="submit" id="submit" name="submit" value="Reset the password">
									</form>
								</div>
							</div>
					';
			}


			if (isset($_POST['email']) && isset($_POST['user'])) {
				include_once "config/database.php";
				$sql = "SELECT COUNT(*) c FROM user WHERE name = '".$_POST['user']."' AND email = '".$_POST['email']."'";
				$res = $con->query($sql);
				$row = $res->fetch(PDO::FETCH_ASSOC);
				if ($row['c'] == 0) {
					get_form(1, 0);
				}
				else {
					$pasw = uniqid();
					$sql = "UPDATE user SET password = '".hash('whirlpool', $pasw)."' WHERE name = '".$_POST['user']."' AND email = '".$_POST['email']."'";
					$con->query($sql);
					get_form(2, $pasw);
				}

			}
			else {
				get_form(0, 0);
			}


		?>

	</div>
	
	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>

</body>
</html>















