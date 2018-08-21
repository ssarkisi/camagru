<?php

	function	set_user_id($email) {
		include 'config/database.php';
		include_once 'print.php';

		$sql = "SELECT id FROM user WHERE email ='".$email."'";
		$res = $con->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$user_id = $row['id'];
		if ($user_id == null || $user_id < 1 || $user_id == "") {
			setcookie('user_id', -1, time() + 60*60*24);
		}
		else {
			setcookie('user_id', $user_id, time() + 60*60*24);
		}
	}

	function	get_user_id() {
		include_once 'print.php';
		return (get_cookie('user_id'));
	}

	function	del_user_id() {
		setcookie('user_id', '', time() - 60*60*24);
	}

	function	get_user_name() {
		include 'config/database.php';
		if (get_user_id() > 0) {
			$sql = "SELECT id, name FROM user WHERE id = ".get_user_id();
			$res = $con->query($sql);
			$row = $res->fetch(PDO::FETCH_ASSOC);
			$name = $row['name'];
			return ($name);
		}
		return 'Guest';
	}

	function	set_img_id($img_name) {
		include 'config/database.php';

		$sql = "SELECT id FROM image WHERE value ='".$img_name."'";
		$res = $con->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$img_id = $row['id'];
		if ($img_id == null || $img_id < 1 || $img_id == "") {
			setcookie('img_id', -1, time() + 60*60*24);
		}
		else {
			setcookie('img_id', $img_id, time() + 60*60*24);
		}
	}

	function	get_img_id() {
		include_once 'print.php';
		return (get_cookie('img_id'));
	}

	function	del_img_id() {
		setcookie('img_id', '', time() - 60*60*24);
	}

?>
