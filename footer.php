</section>
<!-- // контент страницы; -->
<div class="pre-footer" id="js-pre-footer"></div>
</div>

<!-- Подвал сайта -->
<footer class="footer-container" id="js-main-footer">
	<div class="footer__page-up" id="js-page-up"><i class="icon-angle-up"></i> Наверх <i class="icon-angle-up"></i></div>
	<div class="wrapper">
		<nav class="menu-container">
			<?php
				wp_nav_menu (array (
					'theme_location' => 'footer_menu',
					'menu_class' => '',
					'container' => 'ul',
				));
			?>
		</nav>
	</div>

	<div class="footer__copyright">
		<div class="wrapper">
			<div class="footer__social-networks">
				<a href="https://instagram.com/mf_bmstu" class="footer__instagram"><i class="icon-instagram"></i></a>
				<a href="https://vk.com/studsovetmfmgtu" class="footer__vk"><i class="icon-vk"></i></a>
			</div>
			<span>&copy; Студенческий совет МФ МГТУ им.Н.Э. Баумана, <?php echo date ("Y"); ?></span>
		</div>
	</div>
</footer>
<!-- // подвал сайта; -->

<div class="overlay" id="js-overlay"></div>

<?php wp_footer(); ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
		integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
		crossorigin="anonymous"></script>

<script src="<?php echo get_template_directory_uri() . "/dist/bundle.js?v=1"; ?>"></script>

<script src="https://browser.sentry-cdn.com/5.11.0/bundle.min.js"
		integrity="sha384-jbFinqIbKkHNg+QL+yxB4VrBC0EAPTuaLGeRT0T+NfEV89YC6u1bKxHLwoo+/xxY"
		crossorigin="anonymous">
</script>

</body>
</html>