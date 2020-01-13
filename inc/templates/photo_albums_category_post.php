<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 10.01.2020
 * Time: 17:16
 */
?>

<a class="album" href="<?php echo get_permalink(); ?>">
	<div class="album__info">
		<h4 class="album__title"><?php echo esc_html( get_the_title() ); ?></h4>
	</div>
	<div class="album__bg" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')"></div>
</a>