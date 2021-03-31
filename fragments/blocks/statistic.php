<?php extract( $fields ); ?>
<div class="tile-solid">
	<div class="tile__content">
		<?php if ( !empty( $text_top ) ) : ?>
			<h6><?php esc_html_e( $text_top ); ?></h6>
		<?php endif;
		
		if ( !empty( $text_middle ) ) : ?>
			<h3><?php esc_html_e( $text_middle ); ?></h3>
		<?php endif;
		
		if ( !empty( $text_bottom ) ) {
			echo crb_content( $text_bottom );
		}
		?>
	</div><!-- /.tile__content -->
</div><!-- /.tile-solid -->