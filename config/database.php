<?php
	$DB_DSN = 'mysql:dbname=camagru;host=localhost';
	$DB_USER = 'root';
	$DB_PASSWORD = '11111111';

	try {
		$con = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	} catch (PDOException $e) {
		$e->getMessage();
		exit ;
	}

?>
