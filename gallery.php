<?php
	include 'ft_gallery.php';
	$files = get_file_name(0);
?>

<div class="right0">

	<div class="right1">
		<?php get_right1_photo($files); ?>
	</div>


	<div class="right2">
		<?php get_right2_photo($files, 'img-central', 0);	?>
		<div class="like-rating">
			<a class="a-rating" id="content1">
				<?php get_rating(); ?>
			</a>
			<?php
				get_like();
				get_newComment();
			?>
		</div>

		<div class="comments">
			<div class="com2" id="com2">
				<?php get_comment(); ?>
			</div>
		</div>
	</div>

</div>
