<div class="search-featured">
	<a href="#" class="search__close">Close</a>

	<form action="?" method="get" class="search_articles_form">
		<label for="q" class="hidden">Search</label>

		<input type="search" name="q" id="q" value="" placeholder="Quick-search our info, advice & real stories…" class="search__field aa-search-input aa-search-input-local" autocomplete="off">

		<input type="submit" value="GO" class="search__btn">
	</form>

	<ul class="results"></ul>

	<?php if ( empty( carbon_get_the_post_meta( 'crb_intro_button_text' ) ) && empty( carbon_get_the_post_meta( 'crb_intro_button_link' ) ) ) : ?>
		<div class="search__tooltip">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/resources/images/search-tooltip.svg" alt="">

			<p>“Try typing <strong>am I pregnant?</strong> or <strong>contraception</strong>”</p>
		</div><!-- /.search__tooltip -->
	<?php endif ?>
</div><!-- /.search-featured -->