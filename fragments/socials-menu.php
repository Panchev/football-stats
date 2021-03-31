<footer class="dropdown__foot">
	<div class="socials">
		<?php get_template_part( 'fragments/social' ); ?>
	</div><!-- /.socials -->

	<div class="dropdown__foot-text">
		<?php if ( $privac_page_id = get_option( 'wp_page_for_privacy_policy' ) ) : ?>
			<p>
				<a href="<?php echo get_permalink( $privac_page_id ); ?>"><?php esc_html_e( get_the_title( $privac_page_id ) ); ?></a>
			</p>
		<?php
		endif;
		
		if ( !empty( $form = carbon_get_theme_option( 'crb_newsletter_form' ) ) ) :
		?>
			<p>
				<a href="#modal-subscribe" data-modal><?php _e( 'Sign up for our newsletter', 'crb' ); ?></a>
			</p>
		<?php endif ?>
	</div><!-- /.dropdown__foot-text -->
</footer><!-- /.dropdown__foot -->