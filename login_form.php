<form action="user.php?action=0" method="post" target="_self">
	<div class="text">
		<input class="input-login" type="email" name="email" placeholder="email" required>
		<input class="input-login" type="password" name="password" placeholder="password" required>
		<input class="input-submit" type="submit" name="submit" value="Log in" <?php if (get_user_id() !== NULL && get_user_id() != '' && get_user_id() != -1) echo 'disabled=""'; ?>>
		<a class="input-new" class="create-account" href="user.php?action=1" disable> Create account?</a><br>
	</div>
</form>
