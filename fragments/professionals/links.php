<?php
if ( empty( $section['features'] ) ) {
	return;
}
?>
<div class="content">
	<section class="section-events">
		<div class="shell">
			<div class="events">
				<ul>
					<?php foreach ( $section['features'] as $feature ) : ?>
						<li>
							<div class="event">
								<div class="event__content">
									<?php if ( ! empty( $feature['title'] ) || ! empty( $feature['text'] ) ) : ?>
										<div class="event__body">
											<?php if ( ! empty( $feature['title'] ) ) : ?>
												<h5><?php echo esc_html( $feature['title'] ); ?></h5>
											<?php endif; ?>
											
											<?php if ( ! empty( $feature['text'] ) ) : ?>
												<p>
													<?php echo esc_html( $feature['text'] ) ; ?>
												</p>
											<?php endif; ?>
										</div><!-- /.event__body -->
									<?php endif; ?>
									
									<?php if ( ! empty( $feature['btn_label'] ) && ! empty( $feature['btn_link'] ) ) : ?> 
										<?php
										$target = '';
										$ext_link_class = '';
										if ( $feature['btn_open_in_new_tab'] ) {
											$target = 'target="_blank"';
											$ext_link_class = 'link-ext';
										}
										?>
										<div class="event__actions">
											<a href="<?php echo esc_url( $feature['btn_link'] ); ?>" class="<?php echo $ext_link_class; ?>" <?php echo $target; ?>><?php echo esc_html( $feature['btn_label'] ); ?></a>
										</div><!-- /.event__actions -->
									<?php endif; ?>
								</div><!-- /.event__content -->
								
								<?php if ( ! empty( $feature['image'] ) ) : ?>
									<div class="event__image" style="background-image: url(<?php echo wp_get_attachment_image_url( $feature['image'], 'crb_professionals_links_image_size' ); ?>)"></div><!-- /.event__image -->
								<?php endif; ?>
							</div><!-- /.event -->
						</li>
					<?php endforeach; ?>
				</ul>
			</div><!-- /.events -->
		</div><!-- /.shell -->
	</section><!-- /.section-events -->
</div>