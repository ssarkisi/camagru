<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/structure.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link rel="stylesheet" type="text/css" href="css/gallery.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">

</head>
<body>
	<?php
		include "config/database.php"; 
		include_once 'print.php';
		include 'cookie.php';

		if (!isset($_GET['up']))
		{
			if (isset($_GET['img_src']) && isset($_GET['img_name'])) {
				echo '<meta http-equiv="Refresh" content="0; URL=redirect.php?img_src='.$_GET['img_src'].'&img_name='.$_GET['img_name'].'">';
			}
			else {
				echo '<meta http-equiv="Refresh" content="0; URL=redirect.php">';
			}
		}

	?>

	<div class="header">
		<?php
			include_once 'navbar.php';
		?>
	</div>

	<div class="middle">
		<div class="left">

			<?php include 'login_form.php'; ?>

			<div class="popular-img">
				<p class="input-new" style="color: #237b90;">Top 5 popular Photos</p>
				<?php
					include 'top_photo.php';
					get_top_photo(1);
				?>
				</div>
			</div>

			<div class="right">
				<?php include_once 'gallery.php'; ?>

			</div>
	</div>
	
	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>

	
		

</body>
</html>
