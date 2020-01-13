<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 04.01.2020
 * Time: 23:16
 */

// ID категории новостей
define( "NEWS_CATEGORY_ID", 4 );
// ID категории мероприятий
define( "EVENTS_CATEGORY_ID", 3 );
// ID категории фотоальбомов
define( "PHOTO_ALBUMS_CATEGORY_ID", 5 );
// ID категории видео материалов
define( "VIDEOS_CATEGORY_ID", 6 );

// Включение поддержки меню
add_theme_support( 'menus' );

// Включение поддержки виджетов
add_theme_support( 'widgets' );

// Поддержка миниатюр записей
add_theme_support( 'post-thumbnails' );

// Поддержка HTML5
add_theme_support( 'html5' );

// Поддержка кастомного лого
add_theme_support( 'custom-logo' );

//	Регистрация шорткода ближайших мероприятий
add_shortcode( 'upcoming_events', 'get_upcoming_events' );

//	Регистрация шорткода последних новостей
add_shortcode( 'last_news', 'get_last_news' );

//	Регистрация шорткода последних альбомов
add_shortcode( 'last_photo_albums', 'get_last_photo_albums' );

//	Регистрация шорткода последних видео материалов
add_shortcode( 'last_videos', 'get_last_videos' );

//	Регистрация шорткода большого заголовка (разделителя, называйте как хотите :D, долго думал, так и не придумал)
add_shortcode( 'big_title', 'print_big_title' );

// Регистрация меню
register_nav_menus( array(
	'header_horizontal_menu' => 'Фиксированное горизонтальное меню вверху страницы',
	'header_menu'            => 'Основное меню сайта',
	'footer_menu'            => 'Меню в подвале (снизу) страницы'
) );

/**
 * Шорткод: выводит ближайшие мероприятия
 * @return string
 */
function get_upcoming_events() {
	$posts = get_posts(
		array(
			'numberposts' => 3,
			'category'    => EVENTS_CATEGORY_ID,
			'post_type'   => 'post',
			'post_status' => 'publish,future'
		)
	);

	if ( ! $posts ) {
		return "";
	}

	$return = "<!-- Ближайшие мероприятия -->";
	$return .= "<h2 class='with-see-all'>Ближайшие мероприятия | <a href='" . get_category_link( EVENTS_CATEGORY_ID ) . "'>смотреть все</a></h2>";
	$return .= "<section class='upcoming-events-container'>";

	foreach ( $posts as $post ) {
		$shadowColor = get_post_meta( $post->ID, 'shadow_color', true );
		$thumbnailUrl = (has_post_thumbnail($post)) ? get_the_post_thumbnail_url($post) : get_theme_file_uri("dist/images/bg/event-no-thumbnail.jpg");

		$return .= "<a href='" . get_permalink( $post ) . "'>";
		$return .= "<img data-shadow-color='{$shadowColor}' class='event-poster' src='{$thumbnailUrl}' alt='анонс мероприятия'>";
		$return .= "</a>";
	}

	$return .= "</section>";
	$return .= "<!-- // ближайшие мероприятия; -->";

	return $return;
}

/**
 * Шорткод: выводит последние повости (как на оф. сайте МФ МГТУ)
 * @return string
 */
function get_last_news() {
	$posts = get_posts(
		array(
			'numberposts' => 3,
			'category'    => NEWS_CATEGORY_ID,
			'post_type'   => 'post'
		)
	);

	if ( ! $posts ) {
		return "";
	}

	$return = "<!-- Последние новости -->";
	$return .= "<h2 class='with-see-all'>Новости | <a href='" . get_category_link( NEWS_CATEGORY_ID ) . "'>смотреть все</a></h2>";
	$return .= "<section class='last-news-container' id='js-last-news-container'>";
	$return .= "<div class='news-preview' id='js-preview-news'></div>";
	$return .= "<ul>";

	foreach ( $posts as $postKey => $post ) {
		$return .= "<li class='news " . ( ( $postKey == 0 ) ? "active" : "" ) . "'>";
		$return .= "<a href='" . get_permalink( $post ) . "'>";
		$return .= "<div class='news__date'>" . get_the_date( "d-m-Y", $post ) . "</div>";
		$return .= "<h4 class='news__title'>" . esc_html( get_the_title( $post ) ) . "</h4>";
		$return .= "<img class='news__img' src='" . get_the_post_thumbnail_url( $post ) . "' alt='изображение новости'>";
		$return .= "</a>";
		$return .= "</li>";
	}

	$return .= "</ul>";
	$return .= "</section>";
	$return .= "<!-- // последние новости; -->";

	return $return;
}

/**
 * Шорткод: выводит последние фотоальбомы
 * @return string
 */
function get_last_photo_albums() {
	$posts = get_posts(
		array(
			'numberposts' => 7,
			'category'    => PHOTO_ALBUMS_CATEGORY_ID,
			'post_type'   => 'post'
		)
	);

	if ( ! $posts ) {
		return "";
	}

	$return = "<!-- Фотоальбомы -->";
	$return .= "<h2 class='with-see-all'>Фотоальбомы | <a href='" . get_category_link( PHOTO_ALBUMS_CATEGORY_ID ) . "'>смотреть все</a></h2>";
	$return .= "<section class='albums-container'>";

	foreach ( $posts as $post ) {
		$return .= "<a class='album' href='" . get_permalink( $post ) . "'>";
		$return .= "<div class='album__info'>";
		$return .= "<h4 class='album__title'>" . esc_html( get_the_title( $post ) ) . "</h4>";
		$return .= "</div>";
		$return .= "<div class='album__bg' style='background-image: url(" . get_the_post_thumbnail_url( $post ) . ")'></div>";
		$return .= "</a>";
	}

	$return .= "</section>";
	$return .= "<!-- // фотоальбомы; -->";

	return $return;
}

/**
 * Шорткод: выводит последние видео материалы
 * @return string
 */
function get_last_videos() {
	$posts = get_posts(
		array(
			'numberposts' => 7,
			'category'    => VIDEOS_CATEGORY_ID,
			'post_type'   => 'post'
		)
	);

	if ( ! $posts ) {
		return "";
	}

	$return = "<!-- Видео материалы -->";
	$return .= "<h2 class='with-see-all'>Видео | <a href='" . get_category_link( VIDEOS_CATEGORY_ID ) . "'>смотреть все</a></h2>";
	$return .= "<section class='albums-container'>";

	foreach ( $posts as $post ) {
		$return .= "<a class='album' href='" . get_permalink( $post ) . "'>";
		$return .= "<div class='album__info'>";
		$return .= "<div class='album__date'>" . get_the_date( "d-m-Y", $post ) . " </div>";
		$return .= "<h4 class='album__title'>" . esc_html( get_the_title( $post ) ) . "</h4>";
		$return .= "</div>";
		$return .= "<div class='album__bg' style='background-image: url(" . get_the_post_thumbnail_url( $post ) . ")'></div>";
		$return .= "</a>";
	}

	$return .= "</section>";
	$return .= "<!-- // видео материалы; -->";

	return $return;
}

/**
 * Шорткод: выводит большой заголовок по типу шапки сайта
 *
 * @param $args
 *
 * @return string
 */
function print_big_title( $args ) {
	// белый список параметров и значения по умолчанию
	$args = shortcode_atts( array(
		'title'         => 'Заголовок',
		'close_section' => true
	), $args );

	$return = ( $args['close_section'] ) ? "</section>" : "";
	$return .= "<div class='big-title'><h2 class='title'>{$args['title']}</h2></div>";
	$return .= ( $args['close_section'] ) ? "<section class='page-content-container'>" : "";

	return $return;
}