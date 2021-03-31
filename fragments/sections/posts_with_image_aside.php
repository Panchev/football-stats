<div class="section__group posts_with_image_aside">
	<div class="complex">
		<div class="complex__content">
			<div class="complex__arrow">
				<?php crb_render_fragment( 'icons/ico-arrow-right-lg' ); ?>
			</div><!-- /.complex__arrow -->

			<div class="details">
				<div class="details__content">
					<header class="details__head">
						<?php if ( !empty( $title ) ) : ?>
							<h4><?php esc_html_e( $title ); ?></h4>
						<?php

						if ( !empty( $content ) ) {
							echo crb_content( $content );
						}
						endif;
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
					<?php endif; ?>
				</div><!-- /.details__content -->
			</div><!-- /.details -->
		</div><!-- /.complex__content -->

		<?php
		if ( !empty( $posts ) ) :
			$related_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => -1, 'post__in' => wp_list_pluck( $posts, 'id'  ) ) );
			if ( $related_query->have_posts() ) :
			?>
				<div class="complex__aside">
					<div class="slider slider-grid slider-grid--sm swiper-container">
						<ul class="swiper-wrapper">
							<?php
							while ( $related_query->have_posts() ) :
								$related_query->the_post();
								?>
								<li class="swiper-slide">
									<?php crb_render_fragment( 'article_loop' ); ?>
								</li>
							<?php endwhile ?>
						</ul>

						<div class="slider__paging"></div><!-- /.slider__paging -->
					</div><!-- /.slider-grid -->
				</div><!-- /.complex__aside -->
			<?php endif ?>
		<?php endif; ?>
	</div><!-- /.complex -->
</div><!-- /.section__group -->