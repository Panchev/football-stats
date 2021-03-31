<?php extract( $fields ); ?>
<div class="tile-related">
	<?php if ( !empty ( $image ) ) : ?>
		<div class="tile__image" style="background-image: url(<?php echo wp_get_attachment_image_url( $image, 'medium-large' ); ?>)"></div>
	<?php endif;

	if ( !empty( $image_with_text_content ) ) : ?>
		<div class="tile__content">
			<?php echo crb_content( $image_with_text_content ); ?>
		</div><!-- /.tile__content -->
	<?php endif; ?>
</div><!-- /.tile-related -->