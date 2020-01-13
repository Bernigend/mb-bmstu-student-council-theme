<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 10.01.2020
 * Time: 17:20
 */

$meta = get_post_meta($post->ID);
$permalink = get_permalink();
$thumbnailUrl = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : false;

?>

<article class="news" style="<?php echo ($shadowColor) ? "color: {$shadowColor}" : ""; ?>">

	<?php if ($thumbnailUrl): ?>
		<a href="<?php echo $permalink; ?>" style="background-image: url(<?php echo $thumbnailUrl; ?>)"
		   class="news__thumbnail"></a>
	<?php endif; ?>

	<div class="news__info <?php echo ($thumbnailUrl) ?: "no-thumbnail"; ?>">
		<a href="<?php echo $permalink; ?>" class="news__title">
			<?php echo esc_html( get_the_title() ); ?>
		</a>

		<div class="news__more-info">
			<div><i class="icon-calendar-o"></i> <?php echo get_the_date(); ?></div>

			<?php if (isset($meta['event_place'])): ?>
				<div><i class="fas fa-map-marker-alt"></i> <?php echo $meta['event_place'][0]; ?></div>
			<?php endif; ?>
		</div>

		<div class="news__description">
			<p><?php the_excerpt(); ?></p>
		</div>

		<div class="news__bottom">
			<a href="<?php echo $permalink; ?>" class="news__read-more"
			   style="<?php echo ($shadowColor) ? "border-color: {$shadowColor}" : ""; ?>">
				подробнее
			</a>
		</div>
	</div>

</article>
