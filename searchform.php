<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text" id="search-field">Поиск по сайту</span>
	</label>

	<div class="search">
		<input type="search" class="search-field" id="search-field" placeholder="Введите запрос..." value="<?php echo get_search_query() ?>" name="s" title="Введите запрос..." />
		<input type="submit" class="search-submit" value="найти" />
	</div>
</form>