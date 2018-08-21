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
			include_once 'navbar.php';
			include_once 'print.php';
		?>
	</div>

	<div class="middle">
		<div class="left">
			<?php include 'login_form.php'; ?>	
		</div>
			<div class="right">
				<div class="general">
					<form action="user.php?action=2" method="post" target="_self">
						<a id="error"></a>
						<input class="registration-form input-login" type="email" id="email" name="email" placeholder="Email" oninput="checkEmail()" required>
						<input class="registration-form input-login" type="password" id="password" name="password" placeholder="Password" oninput="checkPassword()" required minlength="8">
						<input class="registration-form input-login" type="password" id="password2" name="password2" placeholder="Confirm password" oninput="checkPassword2()" required>
						<input class="registration-form input-login" type="text" id="user" name="user" placeholder="User name" oninput="checkUser()" required>
						<input class="registration-button input-submit" type="submit" id="submit" name="submit" value="Create" disabled="">
					</form>
				</div>
			</div>
	</div>
	
	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>

</body>
</html>
