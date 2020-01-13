<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 10.01.2020
 * Time: 16:45
 */

$meta = get_post_meta($post->ID);
$shadowColor = (isset($meta['shadow_color'])) ? $meta['shadow_color'][0] : false;
$permalink = get_permalink();
$thumbnailUrl = (has_post_thumbnail($post)) ? get_the_post_thumbnail_url($post) : get_theme_file_uri("dist/images/bg/event-no-thumbnail.jpg");

?>

<article class="event" style="<?php echo ($shadowColor) ? "border-color:{$shadowColor};color:{$shadowColor}" : ""; ?>">

	<a href="<?php echo $permalink; ?>" style="background-image: url(<?php echo $thumbnailUrl; ?>)"
	   class="event__thumbnail"></a>

	<div class="event__info">
		<a href="<?php echo $permalink; ?>" class="event__title">
			<?php echo esc_html( get_the_title() ); ?>
		</a>

		<div class="event__more-info">
			<div><i class="icon-calendar-o"></i> <?php echo (isset($meta['event_date'])) ? $meta['event_date'][0] : get_the_date(); ?></div>
			<div><i class="icon-clock-o"></i> <?php echo (isset($meta['event_time'])) ? $meta['event_time'][0] : get_the_time(); ?></div>

			<?php if (isset($meta['event_place'])): ?>
				<div><i class="fas fa-map-marker-alt"></i> <?php echo $meta['event_place'][0]; ?></div>
			<?php endif; ?>
		</div>

		<div class="event__description">
			<p><?php the_excerpt(); ?></p>
		</div>

		<div class="event__bottom">
			<a href="<?php echo $permalink; ?>" class="event__read-more"
			   style="<?php echo ($shadowColor) ? "color: {$shadowColor}" : ""; ?>">
				<span>подробнее</span>
			</a>
		</div>
	</div>

</article>
