<section class="section">
	<div class="slider slider--articles">
		<?php
		if ( empty( $text = carbon_get_the_post_meta( 'crb_related_text' ) ) ) {
			$text = __( 'Other Stuff you might find useful…', 'crb' );
		}
		
		if ( $text ) :
		?>
			<header class="slider__head">
				<div class="shell">
					<h3>
						<span><?php esc_html_e( $text ); ?></span>
					</h3>
				</div><!-- /.shell -->
			</header><!-- /.slider__head -->
		<?php
		endif;
		
		if ( !empty( $related = carbon_get_the_post_meta( 'crb_related' ) ) ) {
			$args = array( 'post_type' => 'post', 'posts_per_page' => -1, 'post__in' => wp_list_pluck( $related, 'id' ), 'post__not_in'  => array( get_the_id() ) );
		} else {
			$args = array( 'post_type' => 'post', 'posts_per_page' => 10, 'post__not_in'  => array( get_the_id() ) );
			if ( !empty( $terms = wp_get_post_terms( get_the_id(), 'category' ) ) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => array( array_shift( $terms )->term_id ),
						'operator' => 'IN',
					),
				);
			}
		}
		
		$related_query = new WP_Query( $args );
		
		if ( $related_query->have_posts() ) :
			$class = '';
			if ( $related_query->found_posts < 5 ) {
				$class = 'hide-arrows';
			}
			?>
			<div class="slider__body <?php echo $class; ?>">
				<div class="shell">
					<div class="slider__clip swiper-container">
						<div class="slider__slides swiper-wrapper">
							<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
								<div class="slider__slide swiper-slide">
									<?php crb_render_fragment( 'article_loop' ); ?>
								</div><!-- /.slider__slide -->
							<?php endwhile ?>
						</div><!-- /.slider__slides -->

						<div class="slider__actions">
							<a href="#" class="slider__btn slider__btn--prev">
								<?php crb_render_fragment( 'icons/ico-arrow-left-dark' ); ?>
							</a>

							<a href="#" class="slider__btn slider__btn--next">
								<?php crb_render_fragment( 'icons/ico-arrow-right-dark' ); ?>
							</a>
						</div><!-- /.slider__actions -->
					</div><!-- /.slider__clip -->
				</div><!-- /.shell -->
			</div><!-- /.slider__body -->
		<?php
		endif;
		
		wp_reset_postdata();
		?>
	</div><!-- /.slider slider--articles -->
</section><!-- /.section -->