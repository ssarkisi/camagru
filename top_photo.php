<?php

	function	get_top_photo($page) {
		include "config/database.php";
		if ($page == 1) {
			$sql = "SELECT t1.image_id, t1.avr, t2.value, t2.grayscale, t2.brightness, t2.contrast, t2.sepia, t2.invert, t2.hue_rotate, t2.opacity
					FROM (SELECT image_id, AVG(value) avr FROM rating GROUP BY image_id) t1
					INNER JOIN image t2 ON t1.image_id = t2.id
					ORDER BY t1.avr DESC, t2.date_log DESC  LIMIT 5";
		}
		else if ($page == 2) {
			$sql = "SELECT value, grayscale, brightness, contrast, sepia, invert, hue_rotate, opacity
					FROM image
					WHERE user_id = ".get_user_id()." 
					ORDER BY date_log DESC  LIMIT 5";
		}

		$res = $con->query($sql);
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			$value = 'img/f_' . $row['value'];
			$grayscale = $row['grayscale'];
			$brightness = $row['brightness'];
			$contrast = $row['contrast'];
			$sepia = $row['sepia'];
			$invert = $row['invert'] * 100;
			$hue_rotate = $row['hue_rotate'];
			$opacity = (100 - $row['opacity']) / 100;

			$style = 'style=" width: 12vmin; filter:	grayscale('.$grayscale.'%) brightness('.$brightness.'%) contrast('.$contrast.'%) sepia('.$sepia.'%) invert('.$invert.'%) hue-rotate('.$hue_rotate.'deg) opacity('.$opacity.');"';
			echo '<img class="image" '.$style.' src="'.$value.'?i='.date_format(date_create(), 'YmdHisu').'"><br>';
		}
	}


?>
