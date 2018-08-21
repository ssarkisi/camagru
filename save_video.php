<?php

	include 'image.php';

	$upload_dir = "img/";
	$filter_dir = "filter/";
	$filter_name = $_POST['filter-name'];
	$img = $upload_dir . $filter_name;
	$filter = $filter_dir . $filter_name;
	$new_filename = uniqid().'.png';

	$img = $_POST['hidden_data'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = $upload_dir . $new_filename;
	$success = file_put_contents($file, $data);

	print $success ? $file : 'Unable to save the file.';
	merge('img/'.$new_filename, 'filter/'.$filter_name, 'img/f_'.$new_filename);
	save_to_db($new_filename, $filter_name);

?>
