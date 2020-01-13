<!--
 -- Created by Bernigend, https://vk.com/bernigend, https://bernigend.ru
 -- MB BMSTU Student`s council site on Wordpress
 -->

<!doctype html>
<html lang="ru" <?php //if (current_user_can('manage_options')) echo 'class="with-admin-bar"'; ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/dist/main.css?v=1"; ?>">

	<?php wp_site_icon(); ?>

	<title><?php echo wp_get_document_title(); ?></title>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="js-page">

<!-- Горизонтальная панель навигации -->
	<section class="main-navigation" id="js-main-navigation">
		<div class="wrapper">
			<a class="main-nav__site-info" href="/" id="js-main-nav-site-info">
				<div class="main-nav__site-logo"></div>
				<div class="main-nav__site-name">
					<p>Студенческий совет</p>
					<p>МФ МГТУ им.Н.Э. Баумана</p>
				</div>
			</a>

			<nav class="main-nav__menu">
				<?php

				wp_nav_menu (array (
					'theme_location' => 'header_horizontal_menu',
					'menu' => 'Горизонтальное меню',
					'menu_class' => 'main-nav__ul',
					'menu_id' => 'js-main-nav-menu',
					'container' => 'ul',
				));

				?>
				<div class="main-nav__toggle-menu" id="js-toggle-menu">
					<a href="#">Меню</a>
				</div>
			</nav>
		</div>
	</section>
<!-- // горизонтальная панель навигации; -->

<!-- Главное меню сайта -->
	<section class="main-menu-container" id="js-main-menu-container">
		<div class="wrapper">
			<?php get_search_form(); ?>

			<nav class="menu-container">
				<?php

				wp_nav_menu (array (
					'theme_location' => 'header_menu',
					'menu_class' => '',
					'container' => 'ul',
				));

				?>
			</nav>
		</div>
	</section>
<!-- // главное меню сайта; -->

<!-- Шапка сайта -->
	<section class="main-header" id="js-main-header">
		<div class="wrapper">
			<div class="main-head__site-info">
				<?php $custom_logo_id = get_theme_mod('custom_logo'); ?>
				<?php $logo_url = ($custom_logo_id) ? wp_get_attachment_image_url($custom_logo_id, 'large') : false; ?>
				<div class="main-head__site-logo" style="<?php echo ($logo_url) ? "background-image: url('{$logo_url}')" : ""; ?>" onclick="location.href='/'"></div>
				<div class="main-head__site-name">
					<p>Студенческий совет</p>
					<p>МФ МГТУ им.Н.Э. Баумана</p>
				</div>
			</div>
		</div>
	</section>
<!-- // шапка сайта; -->

