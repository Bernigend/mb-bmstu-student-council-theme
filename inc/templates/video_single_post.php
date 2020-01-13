<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 10.01.2020
 * Time: 18:48
 */

?>

<!-- Контент поста -->
<section class="post-container">
	<article class="post">
		<h2 class="post__title"><?php echo esc_html(get_the_title()); ?></h2>

		<div class="post__more-info">
			<div><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></div>
			<?php if (isset($meta['event_place'])): ?>
				<div><i class="fas fa-map-marker-alt"></i> <?php echo $meta['event_place'][0]; ?></div>
			<?php endif; ?>
		</div>

		<?php if (current_user_can('edit_post', $post->ID)): ?>
			<div class="post__admin-bar">
				<span><strong>ID: <?php echo $post->ID; ?>,</strong> </span>
				<a href="<?php echo get_edit_post_link($post->ID); ?>"><i class='fas fa-edit'></i> редактировать</a>
			</div>
		<?php endif; ?>

		<hr>

		<?php the_content(); ?>
	</article>
</section>
<!-- // контент поста; -->