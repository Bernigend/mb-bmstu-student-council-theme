<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 04.01.2020
 * Time: 22:24
 */

get_header();
?>

	<!-- Родители категории -->
	<section class="page-parents">
		<div class="wrapper">
			<a href="<?php echo site_url(); ?>">Главная</a>
		</div>
	</section>
	<!-- // родители категории; -->

	<!-- Контент страницы -->
	<section class="page-content-container" id="js-page-content-container">

	<!-- Контент категории -->
	<section class="category-container" id="js-category-frame">

		<?php

		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( "inc/templates/news_category_post" );
			}
		} else {
			echo "<div class='empty-category'>Ничего не найдено...</div>";
		}

		the_posts_pagination();

		?>

	</section>

<?php get_footer(); ?>