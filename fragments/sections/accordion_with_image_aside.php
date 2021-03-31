<div class="section__group">
	<div class="details">
		<div class="details__content">
			<header class="details__head">
				<?php if ( !empty( $title ) ) : ?>
					<h4><?php esc_html_e( $title ); ?></h4>
				<?php
				endif;
				
				if ( !empty( $content ) ) {
					echo crb_content( $content );
				}
				?>
			</header><!-- /.details__head -->
			
			<?php
			if ( !empty( $button_text ) && !empty( $button_link ) ) :
				$target = '';
				if ( !empty( $button_new_tab ) && $button_new_tab === true ) {
					$target = 'target="_blank"';
				}
				?>
				<div class="details__actions">
					<a href="<?php echo $button_link; ?>" class="btn btn--inherit" <?php echo $target; ?>><?php esc_html_e( $button_text ); ?></a>
				</div><!-- /.details__actions -->
			<?php
			endif;
			
			if ( !empty( $crb_accordion_items ) ) :
			?>
				<div class="details__body">
					<div class="accordion">
						<?php foreach ( $crb_accordion_items as $item ) : ?>
							<div class="accordion__section">
								<div class="accordion__head">
									<h3><?php esc_html_e( $item['title'] ); ?></h3>
								</div><!-- /.accordion__head -->

								<div class="accordion__body">
									<?php echo crb_content( $item['content'] ); ?>
								</div><!-- /.accordion__body -->
							</div><!-- /.accordion__section -->
						<?php endforeach ?>
					</div><!-- /.accordion -->
				</div><!-- /.details__body -->
			<?php endif ?>
		</div><!-- /.details__content -->

		<?php if ( !empty( $image ) ) : ?>
			<div class="details__image" style="background-image: url(<?php echo wp_get_attachment_image_url( $image, 'large' ); ?>)"></div><!-- /.details__image -->
		<?php endif ?>
	</div><!-- /.details -->
</div><!-- /.section__group -->