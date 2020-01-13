<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 10.01.2020
 * Time: 17:43
 */

$meta = get_post_meta($post->ID);
$shadowColor = (isset($meta['shadow_color'])) ? $meta['shadow_color'][0] : false;
$albumId = (isset($meta['album_id']) && get_post_status($meta['album_id'])) ? $meta['album_id'][0] : false;
$videoId = (isset($meta['video_id']) && get_post_status($meta['video_id'])) ? $meta['video_id'][0] : false;
//var_dump($post);
?>

<!-- Правая колонка -->
<section class="aside-right">
	<?php $thumbnailUrl = (has_post_thumbnail($post)) ? get_the_post_thumbnail_url($post) : get_theme_file_uri("dist/images/bg/event-no-thumbnail.jpg"); ?>
	<img class="event-poster post__mobile--not" src="<?php echo $thumbnailUrl; ?>" style="color: <?php echo $shadowColor; ?>" alt="постер мероприятия">

	<?php if ($albumId): ?>
		<div class="aside__title">Фото</div>
		<div class="albums-container">
			<a href="<?php echo get_permalink($albumId); ?>" class="album__item">
				<div class="album__info">
					<h4 class="album__title"><?php echo esc_html(get_the_title($albumId)); ?></h4>
				</div>
				<div class="album__bg" style="background-image: url('<?php echo get_the_post_thumbnail_url($albumId); ?>')"></div>
			</a>
		</div>
	<?php endif; ?>

	<?php if ($videoId): ?>
		<div class="aside__title">Видео</div>
		<div class="albums-container">
			<a href="<?php echo get_permalink($videoId); ?>" class="album__item">
				<div class="album__info">
					<div class="album__date"><?php echo get_the_date(null, $videoId); ?></div>
					<h4 class="album__title"><?php echo esc_html(get_the_title($videoId)); ?></h4>
				</div>
				<div class="album__bg" style="background-image: url('<?php echo get_the_post_thumbnail_url($videoId); ?>')"></div>
			</a>
		</div>
	<?php endif; ?>
	<div class="aside-close" id="js-aside-close"><i class="fas fa-times"></i></div>
</section>
<!-- // правая колонка; -->

<!-- Контент поста -->
<section class="post-container">
	<article class="post">
		<h2 class="post__title"><?php echo esc_html(get_the_title()); ?></h2>

		<div class="post__more-info">
			<span><i class="icon-calendar-o"></i> <?php echo get_the_date(); ?></span>
			<span><i class="icon-clock-o"></i> <?php echo get_the_time(); ?></span>
			<?php if (isset($meta['event_place'])): ?>
				<span><i class="fas fa-map-marker-alt"></i> <?php echo $meta['event_place'][0]; ?></span>
			<?php endif; ?>
		</div>

		<?php if (current_user_can('edit_post', $post->ID)): ?>
			<div class="post__admin-bar">
				<span><strong>ID: <?php echo $post->ID; ?>,</strong> </span>
				<a href="<?php echo get_edit_post_link($post->ID); ?>"><i class='fas fa-edit'></i> редактировать</a>
			</div>
		<?php endif; ?>

		<hr>

		<div class="post__mobile">
			<img class="event-poster" src="<?php echo $thumbnailUrl; ?>" style="color: <?php echo $shadowColor; ?>" alt="постер мероприятия">
			<?php if ($albumId || $videoId): ?>
				<div class="aside-open" id="js-aside-open">Дополнительно</div>
			<?php endif; ?>
			<hr>
		</div>

		<?php the_content(); ?>
	</article>
</section>
<!-- // контент поста; -->