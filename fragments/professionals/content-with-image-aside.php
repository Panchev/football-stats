<?php
if ( empty( $section['content'] ) && empty( $section['image'] ) && empty( $section['btn_link'] ) && empty( $section['btn_label'] ) ) {
	return;
}
?>
<div class="content">
	<div class="section-learn">
		<div class="shell">
			<div class="more">
				<div class="more__content">
					<div class="more__body">
						<?php if ( ! empty( $section['content'] ) ) : ?>
							<?php echo crb_content( $section['content'] ); ?>
						<?php endif; ?>
					</div><!-- /.more__body -->
					
					<?php if ( ! empty( $section['btn_label'] ) && ! empty( $section['btn_link'] ) ) : ?>
						<div class="more__actions">
							<?php
							$target = '';
							if ( $section['btn_open_in_new_tab'] ) {
								$target = 'target="_blank"';
							}
							?>
							<a href="<?php echo esc_url( $section['btn_link'] ); ?>" class="btn btn--pink" <?php echo $target; ?>><?php echo esc_html( $section['btn_label'] ); ?></a>
						</div><!-- /.more__actions -->
					<?php endif; ?>
				</div><!-- /.more__content -->
				
				<?php if ( ! empty( $section['image'] ) ) : ?>
					<div class="more__image" style="background-image: url(<?php echo wp_get_attachment_image_url( $section['image'], 'crb_professionals_features_block_image_size' ); ?>)"></div><!-- /.more__image -->
				<?php endif; ?>
			</div><!-- /.more -->
		</div><!-- /.shell -->
	</div><!-- /.section-learn -->
</div>