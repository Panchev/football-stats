<div class="subscribe">
	<a href="#modal-subscribe" class="subscribe__trigger" data-modal></a>

	<div class="mfp-hide">
		<div id="modal-subscribe" class="modal-subscribe">
			<div class="modal__content">
				<?php if ( $form = carbon_get_theme_option( 'crb_newsletter_form' ) ) : ?>
					<div class="modal__body">
						<div class="form-subscribe">
							<?php crb_render_gform( $form, true, array('display_title' => true, 'display_description' => true)); ?>
						</div><!-- /.form-subscribe -->
					</div><!-- /.modal__body -->
				<?php
				endif;
				
				if ( !empty( $content = carbon_get_theme_option( 'crb_newsletter_content' ) ) ) :
				?>
					<div class="modal__foot">
						<?php echo crb_content( $content ); ?>
					</div><!-- /.modal__foot -->
				<?php endif ?>
			</div><!-- /.modal__content -->
			
			<?php
			$url = '';
			if ( !empty( $image = carbon_get_theme_option( 'crb_newsletter_image' ) ) ) {
				$url = wp_get_attachment_image_url( $image, 'large' );
			}
			?>
			
			<div class="modal__image" style="background-image: url(<?php echo $url; ?>)"></div><!-- /.modal__image -->
		</div><!-- /#modal-subscribe -->
	</div><!-- /.mfp-hide -->
</div><!-- /.subscribe -->