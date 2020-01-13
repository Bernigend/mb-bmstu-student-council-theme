<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 10.01.2020
 * Time: 18:02
 */

get_header();

$postInfo = $wp_query->get_queried_object();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		$categoryInfo = get_the_category()[0];

		?>

		<!-- Родители категории -->
		<section class="page-parents">
			<div class="wrapper">
				<a href="<?php echo site_url(); ?>">Главная</a> »
				<?php echo get_category_parents($categoryInfo->term_id, true, " » ") . " " . esc_html(get_the_title()); ?>
			</div>
		</section>
		<!-- // родители категории; -->

		<!-- Контент страницы -->
		<section class='content-container page-content-container' id='js-page-content-container'>

		<?php

		if ($categoryInfo->term_id == EVENTS_CATEGORY_ID)
			get_template_part("inc/templates/event_single_post");
		elseif ($categoryInfo->term_id == PHOTO_ALBUMS_CATEGORY_ID)
			get_template_part("inc/templates/photo_album_single_post");
		elseif ($categoryInfo->term_id == VIDEOS_CATEGORY_ID)
			get_template_part("inc/templates/video_single_post");
		else
			get_template_part("inc/templates/news_single_post");
	}
} else echo "<div class='empty-category'>Ничего не найдено...</div>";

get_footer();