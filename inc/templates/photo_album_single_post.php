<?php
/**
 * Created by PhpStorm.
 * User: Bernigend
 * Date: 10.01.2020
 * Time: 18:47
 */

echo "<div class='post-container for-album'>";
echo "<div class='post'>";
echo "<h2 class='post__title'>" . esc_html(get_the_title()) . "</h2>";

if (current_user_can('edit_post', $post->ID)) {
	echo '<div class="post__admin-bar">';
	echo "<span><strong>ID: {$post->ID},</strong> </span>";
	echo '<a href="' . get_edit_post_link($post->ID) . '"><i class="fas fa-edit"></i> редактировать</a>';
	echo "</div>";
}

the_content();

echo "</div>";
echo "</div>";