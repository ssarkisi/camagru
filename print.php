<?php

	function print_cookie($name)
	{
		if(isset($_COOKIE[$name])) {
			echo '|'.$_COOKIE[$name].'|';
		}
	}

	function get_cookie($name)
	{
		if(isset($_COOKIE[$name])) {
			return ($_COOKIE[$name]);
		}
		return (-1);
	}

?>
