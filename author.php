<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 10.01.2020
 * Time: 16:05
 */

get_header();

$userInfo  = $wp_query->get_queried_object();
//var_dump($userInfo);
$userMeta = get_the_author_meta("description", $userInfo->data->ID);
//var_dump($userMeta);
?>

<!-- Родители категории -->
<section class="page-parents">
	<div class="wrapper">
		<a href="<?php echo site_url(); ?>">Главная</a> » Пользователи » <?php echo $userInfo->data->display_name; ?>
	</div>
</section>
<!-- // родители категории; -->

<!-- Контент страницы -->
<section class="page-content-container" id="js-page-content-container">

	<h2>
		<?php

		echo $userInfo->data->display_name;

		if (current_user_can("editor") || current_user_can("administrator"))
			echo " (ID: {$userInfo->data->ID})";

		?>
	</h2>
	<?php echo get_avatar($userInfo->data->ID); ?>

	<?php echo $userMeta; ?>

<?php get_footer(); ?>
