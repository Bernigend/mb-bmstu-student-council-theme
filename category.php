<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 10.01.2020
 * Time: 16:47
 */

get_header();

$categoryInfo  = $wp_query->get_queried_object();
$categoryTitle = "Все " . mb_strtolower($categoryInfo->cat_name, "UTF-8");

/**
 * Запоминаем изначальный запрос
 */
$query = $wp_query;

/**
 * Параметры для WP_Query
 * @var array
 */
$params = array(
//	категория
	"cat" => $categoryInfo->term_id,
//	страница категории
	"paged" =>  (get_query_var('paged')) ? get_query_var('paged') : 1
);

/**
 * Количесво постов на странице категории видео и фото
 */
if ($categoryInfo->term_id == PHOTO_ALBUMS_CATEGORY_ID || $categoryInfo->term_id == VIDEOS_CATEGORY_ID)
	$params["posts_per_page"] = 17;

/**
 * Работа с фильтром
 */
if (isset($_GET['filter'])) {
	/**
	 * Фильтр месяца
	 */
	if (isset($_GET['f_month']) && is_numeric($_GET['f_month']) && $_GET['f_month'] > 0 && $_GET['f_month'] < 13)
		$params["monthnum"] = $_GET['f_month'];

	/**
	 * Фильтр года
	 */
	if (isset($_GET['f_year']) && is_numeric($_GET['f_year']))
		$params["year"] = $_GET['f_year'];

	/**
	 * Получаем посты, удовлетворяющие фильтру
	 */
	$query = new WP_Query($params);
}

/**
 * Добавляем в выборку запланированные события в их категории
 * ----
 * Запланированные посты в категории мероприятий теперь публикуются как обычные =>
 * нет смысла добавлять их в выборку
 */
//if ($categoryInfo->term_id == EVENTS_CATEGORY_ID)
//	$params["post_status"] = array ("publish", "future");

/**
 * Посты для вывода
 */
$posts = $query->get_posts();

?>

	<!-- Родители категории -->
	<section class="page-parents">
		<div class="wrapper">
			<a href="<?php echo site_url(); ?>">Главная</a> »
			<?php echo get_category_parents($categoryInfo->term_id, true, " » ") . " {$categoryTitle}"; ?>
		</div>
	</section>
	<!-- // родители категории; -->

	<!-- Контент страницы -->
	<section class="page-content-container" id="js-page-content-container">

		<h2><?php echo $categoryTitle; ?></h2>

		<div class="aside-open" id="js-aside-open">
			<i class="icon-filter"></i> Фильтр
		</div>

		<!-- Правая колонка -->
		<section class="aside-right" id="js-aside">
			<div class="aside-close" id="js-aside-close"><i class="fas fa-times"></i></div>
			<section class="filter-container" id="js-filter" data-category-id="<?php echo $categoryInfo->term_id; ?>">
				<div class="filter__title">Фильтр</div>
				<div class="filter__items">

					<div class="filter__date">
						<div>
							<i class="icon-caret-square-o-left" id="js-filter-next-year"></i>
							<span id="js-filter-year"><?php echo (isset($params["year"])) ? $params["year"] : date("Y"); ?></span>
							<i class="icon-caret-square-o-right" id="js-filter-last-year"></i>
						</div>
						<span>Год:</span>
					</div>

					<div class="filter__months" data-chosen="<?php echo (isset($params["monthnum"])) ? $params["monthnum"] : ""; ?>">
						<ul>
							<li data-month="1">январь</li>
							<li data-month="2">февраль</li>
							<li data-month="3">март</li>
							<li data-month="4">апрель</li>
							<li data-month="5">май</li>
							<li data-month="6">июнь</li>
							<li data-month="7">июль</li>
							<li data-month="8">август</li>
							<li data-month="9">сентябрь</li>
							<li data-month="10">октябрь</li>
							<li data-month="11">ноябрь</li>
							<li data-month="12">декабрь</li>
						</ul>
					</div>
				</div>

				<div class="filter__warning" id="js-filter-warning"></div>

				<button class="filter__button--choose" id="js-filter-btn">применить</button>
				<a class="filter__button--cancel" href="?">сбросить</a>
			</section>
		</section>
		<!-- // правая колонка; -->

		<!-- Контент категории -->
		<section class="category-container <?php echo $categoryInfo->slug; ?>-category-container" id="js-category-frame">

		<?php

		foreach ( $posts as $post ) {
			setup_postdata($post);

			if ($categoryInfo->term_id == EVENTS_CATEGORY_ID)
				get_template_part("inc/templates/events_category_post");
			elseif ($categoryInfo->term_id == PHOTO_ALBUMS_CATEGORY_ID)
				get_template_part("inc/templates/photo_albums_category_post");
			elseif ($categoryInfo->term_id == VIDEOS_CATEGORY_ID)
				get_template_part("inc/templates/videos_category_post");
			else
				get_template_part("inc/templates/news_category_post");
		}

		if ($posts) {
			echo "<div class='nav-links'>";
			echo paginate_links(array (
				"total" => $query->max_num_pages,
				"prev_next" => true,
				"next_text" => "<i class=\"icon-chevron-right\"></i>",
				"prev_text" => "<i class=\"icon-chevron-left\"></i>"
			));
			echo "</div>";
		}

		wp_reset_postdata();

		?>

		<?php if (!$posts): ?>
			<div class="empty-category">Ничего не найдено...</div>
		<?php endif; ?>

		</section>
		<!-- // контент категории; -->

		<?php echo get_upcoming_events(); ?>

<?php get_footer(); ?>