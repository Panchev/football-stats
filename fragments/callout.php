<section class="section-callout">
	<div class="section__container">
		<?php if ( !empty( $image = carbon_get_theme_option( 'crb_callout_image' ) ) ) : ?>
			<div class="section__image">
				<div class="section__image-inner" style="background-image: url(<?php echo wp_get_attachment_image_url( $image, 'full' ); ?>)"></div><!-- /.section__image-inner -->
			</div><!-- /.section__image -->
		<?php endif ?>

		<div class="section__content">
			<div class="section__entry">
				<?php if ( !empty( $title = carbon_get_theme_option( 'crb_callout_title' ) ) ) : ?>
					<header class="section__head">
						<h2><?php esc_html_e( $title ); ?></h2>
					</header><!-- /.section__head -->
				<?php endif ?>

				<div class="section__actions">
					<?php
					$button_text = carbon_get_theme_option( 'crb_callout_button_text' );
					$button_link = carbon_get_theme_option( 'crb_callout_button_link' );
					$button_new_tab = carbon_get_theme_option( 'crb_callout_button_new_tab' );
					if ( !empty( $button_text ) && !empty( $button_link ) ) :
						$target = '';
						if ( !empty( $button_new_tab ) && $button_new_tab === true ) {
							$target = 'target="_blank"';
						}
						
						if ( !empty( $button_color = carbon_get_theme_option( 'crb_callout_button_color' ) ) ) {
							$button_color = 'blue';
						}
						?>
						<a href="<?php echo esc_url( $button_link ); ?>" class="btn btn--<?php echo $button_color; ?>" <?php echo $target; ?>><?php esc_html_e( $button_text ); ?></a>
					<?php
					endif;
					
					if ( !empty( $content_bottom = carbon_get_theme_option( 'crb_callout_content_bottom' ) ) ) :
					?>
						<p>
							<strong><?php esc_html_e( $content_bottom ); ?></strong>
						</p>
					<?php endif ?>
				</div><!-- /.section__actions -->
			</div><!-- /.section__entry -->
		</div><!-- /.section__content -->
	</div><!-- /.section__container -->
</section><!-- /.section-callout -->