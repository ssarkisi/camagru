<div class="bar-element-logout bar-element" onclick="location.href='user.php?action=4'"><div class="logout text">×</div></div>
<div class="bar-element" onclick="location.href='index.php'"><div class="text">News Feed</div></div>
<?php
include_once 'cookie.php';
	if (get_user_id() && get_user_id() != -1) {
		include 'navbar_login.php';
	}
	else {
		$href = "'forgot.php'";
		echo '<div class="bar-element" onclick="location.href='.$href.'"><div class="text">Forgot your password?</div></div>';
	}
?>
