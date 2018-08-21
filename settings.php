<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php
		include 'cookie.php';
		if (!(get_user_id() > 0)) {
			echo '<meta http-equiv="Refresh" content="0; URL=index.php?up=-1">';
			exit ;
		}
	?>

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

			<div class="popular-img">
				<p class="input-new" style="color: #237b90;">Latest Photos</p>
				<?php
					include 'top_photo.php';
					get_top_photo(2);
				?>
			</div>
		</div>
			<div class="right">
				<div class="general">
					<a id="error"></a>
					<form action="settings_save.php?action=1" method="post" target="_self">
						<input class="registration-form input-login" type="email" id="email" name="email" placeholder="New Email" oninput="checkEmail()" required>
						<input class="registration-button input-submit" type="submit" id="save-email" name="save-email" value="Change Email">
					</form>

					<form action="settings_save.php?action=2" method="post" target="_self">
						<input class="registration-form input-login" type="password" id="password" name="password" placeholder="New password" oninput="checkPassword()" required minlength="8">
						<input class="registration-form input-login" type="password" id="password2" name="password2" placeholder="Confirm new password" oninput="checkPassword2()" required>
						<input class="registration-button input-submit" type="submit" id="save-password" name="save-password" value="Change password">
					</form>

					<form action="settings_save.php?action=3" method="post" target="_self">
						<input class="registration-form input-login" type="text" id="user" name="user" placeholder="User name" oninput="checkUser()" required>
						<input class="registration-button input-submit" type="submit" id="save-user" name="save-user" value="Change user name">
					</form>
						
					<form action="settings_save.php?action=4" method="post" target="_self">
						<div class="registration-form input-login">
							<label for="send-mail">Allow sending messages?</label>
							<input type="checkbox" id="send-mail" name="send-mail">
						</div>
						<input class="registration-button input-submit" type="submit" id="save-send-mail" name="save-send-mail" value="Change send message settings">
					</form>
						
					
					<form action="user.php?action=5" method="post" target="_self">
						<input class="registration-button input-submit" type="submit" id="delete" name="delete" value="Delete">
					</form>
				</div>
			</div>
	</div>
	
	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>

</body>
</html>
