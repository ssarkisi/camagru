<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/gallery.js"></script>

<?php

	function get_file_name($user_id) {
		include 'config/database.php';

		$i = 0;
		$array = array();
		$gallery_dir = 'img/';

		$sql = "SELECT id, user_id, value, grayscale, brightness, contrast, sepia, invert, hue_rotate, opacity, filter, description, date_log FROM `image` ORDER BY date_log DESC";
		if ($user_id != 0)
			$sql = "SELECT id, user_id, value, grayscale, brightness, contrast, sepia, invert, hue_rotate, opacity, filter, description, date_log FROM `image` WHERE user_id = ".$user_id." ORDER BY date_log DESC";

		$res = $con->query($sql);
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			$array[$i] = array( 'id' => $row['id'], 
								'user_id' => $row['user_id'], 
								'value' => $gallery_dir . 'f_' . $row['value'], 
								'grayscale' => $row['grayscale'], 
								'brightness' => $row['brightness'], 
								'contrast' => $row['contrast'], 
								'sepia' => $row['sepia'], 
								'invert' => $row['invert'] * 100, 
								'hue_rotate' => $row['hue_rotate'], 
								'opacity' => (100 - $row['opacity']) / 100, 
								'filter' => $row['filter'], 
								'description' => $row['description'],
								'date_log' => $row['date_log'],
								'img_name' => $row['value']);
			$i++;
		}
		return ($array);
	}

	function	get_rating() {
		include 'config/database.php';
		if (get_user_id() !== NULL && get_user_id() != '' && get_user_id() != -1) {
			$sql = "SELECT COUNT(*) co FROM `rating` WHERE image_id = ".get_img_id()." AND user_id = ".get_user_id();
			$res = $con->query($sql);
			$row = $res->fetch(PDO::FETCH_ASSOC);
		}

		if (isset($row['co']) && $row['co'] == 0) {

			echo '
					<button class="rating" name="rating" id="rating1" onclick="setRating(1)">♥</button>
					<button class="rating" name="rating" id="rating2" onclick="setRating(2)">♥</button>
					<button class="rating" name="rating" id="rating3" onclick="setRating(3)">♥</button>
					<button class="rating" name="rating" id="rating4" onclick="setRating(4)">♥</button>
					<button class="rating" name="rating" id="rating5" onclick="setRating(5)">♥</button>
			';
		}
		else {
			$sql = "SELECT AVG(value) AS avr FROM rating WHERE image_id = ".get_img_id();
			$res = $con->query($sql);
			$row = $res->fetch(PDO::FETCH_ASSOC);
			echo '<button class="rating">Average rating: '.round($row['avr'], 1).'</button>';
		}

	}
	function	get_like_count($image_id) {
		include 'config/database.php';
	
		$sql = "SELECT COUNT(*) l FROM likes WHERE  image_id = ".$image_id;
		$res = $con->query($sql);
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return ($row['l']);
	}


	function	get_like() {
		include 'config/database.php';
		if (get_user_id() !== NULL && get_user_id() != '' && get_user_id() != -1) {
			$user_id = get_user_id();
			$image_id = get_img_id();; /*$_GET['img_id'];*/
			$sql = "SELECT id, value FROM likes WHERE user_id = ".$user_id." AND image_id = ".$image_id;
			$res = $con->query($sql);
			if ($row = $res->fetch(PDO::FETCH_ASSOC)) {
				echo '<button style="color: #fa5457;" class="like" name="like" id="like" value="del">♥ Like <input type="button" value="'.get_like_count($image_id).'" id="like-count"></button>';
				echo '<div id="content"><input type="hidden" id="hidden-id" value="'.$row['id'].'"></div>';
			}
			else {
				echo '<button style="color: #1b6577;" class="like" name="like" id="like" value="add">♥ Like <input type="button" value="'.get_like_count($image_id).'" id="like-count"></button>';
				echo '<div id="content"><input type="hidden" id="hidden-id" value="-1"></div>';
			}
		}
	}
	function	get_newComment() {
		if (get_user_id() !== NULL && get_user_id() != '' && get_user_id() != -1) {
			echo '<div class="com1"><textarea minlength="1" maxlength="1000" class="new-comment" id="comment"></textarea>';
			echo '<input type="submit" class="com-submit" onclick="setComment()" value="Add"></div>';
		}
	}

	function	get_comment() {
		include 'config/database.php';

		$sql = "SELECT u.name, c.image_id, c.value, c.date_log
				FROM comments c
				INNER JOIN user u ON c.user_id = u.id
				WHERE c.image_id = ".get_img_id()." ORDER BY c.date_log DESC;";
		$res = $con->query($sql);
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			echo '<p class="com2-p"><a class="comment-info">'.$row['name'].' ('.$row['date_log'].'):</a><br>'.$row['value'].'</p>';
		}
	}

	function	get_right1_photo($files) {
		

		$start = 0;
		$end = count($files);


		while ($start < $end) {
				if (isset($files[$start]['value'])) {
					$v = "'?img_src=".$files[$start]['value']."&img_name=".$files[$start]['img_name']."'";
					$style = 'style="width: 10vw; filter:	grayscale('.$files[$start]['grayscale'].'%) brightness('.$files[$start]['brightness'].'%) contrast('.$files[$start]['contrast'].'%) sepia('.$files[$start]['sepia'].'%) invert('.$files[$start]['invert'].'%) hue-rotate('.$files[$start]['hue_rotate'].'deg) opacity('.$files[$start]['opacity'].');"';
					echo '<img class="image" onclick="location.href='.$v.'" '.$style.' src="'.$files[$start]['value'].'?i='.date_format(date_create(), 'YmdHisu').'"><br>';
				}
				$start++;
			}
	}


	function	get_right2_photo($files, $id, $f) {
		if (count($files) == 0) {
			echo "You can upload photo or to make a photo";
			exit ;
		}

		if (isset($_GET['img_src']) && isset($_GET['img_name'])) {
			$s = 0;
			$e = count($files);
			while ($s < $e) {
				if (strcmp($files[$s]['img_name'], $_GET['img_name']) == 0)
					break ;
				$s++;
			}

			list($w, $h) = getimagesize($_GET['img_src']);
			$size = 'width: 60vmin;';
			if ($h > $w)
				$size = 'height: 45vmin;';

			$style = 'style="'.$size.' filter:	grayscale('.$files[$s]['grayscale'].'%) brightness('.$files[$s]['brightness'].'%) contrast('.$files[$s]['contrast'].'%) sepia('.$files[$s]['sepia'].'%) invert('.$files[$s]['invert'].'%) hue-rotate('.$files[$s]['hue_rotate'].'deg) opacity('.$files[$s]['opacity'].');"';

			echo '<img id="'.$id.'" '.$style.' src="'.$_GET['img_src'].'?i='.date_format(date_create(), 'YmdHisu').'">';
			$img_rating_id = get_img_id($_GET['img_src']);
		}
		else {
			
			list($w, $h) = getimagesize($files[0]['value']);
			$size = 'width: 60vmin;';
			if ($h > $w)
				$size = 'height: 45vmin;';
			
			$style = 'style="'.$size.' filter:	grayscale('.$files[0]['grayscale'].'%) brightness('.$files[0]['brightness'].'%) contrast('.$files[0]['contrast'].'%) sepia('.$files[0]['sepia'].'%) invert('.$files[0]['invert'].'%) hue-rotate('.$files[0]['hue_rotate'].'deg) opacity('.$files[0]['opacity'].');"';
			echo '<img id="'.$id.'" '.$style.' src="'.$files[0]['value'].'">';
			$img_rating_id = $files[0]['id'];
		}
		if ($f == 1) {
		}
	}

?>