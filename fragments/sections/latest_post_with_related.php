<section class="section-featured">
	<?php if ( !empty( $title_top ) ) : ?>
		<header class="section__head">
			<div class="section__head-inner">
				<h2><?php esc_html_e( $title_top ); ?></h2>
			</div><!-- /.section__head-inner -->
		</header><!-- /.section__head -->
	<?php endif ?>

	<div class="section__body">
		<div class="section__content">
			<div class="section__entry">
				<?php if ( !empty( $post_title_top ) ) : ?>
					<h5><?php esc_html_e( $post_title_top ); ?></h5>
				<?php
				endif;

				if ( !empty( $post_content ) ) :
				?>
					<p>
						<strong><?php echo nl2br( $post_content ); ?></strong>
					</p>
				<?php endif ?>
			</div><!-- /.section__entry -->
		</div><!-- /.section__content -->

		<?php if ( !empty( $post_image ) ) : ?>
			<div class="section__image" style="background-image: url(<?php echo wp_get_attachment_image_url( $post_image, 'full' ); ?>)"></div><!-- /.section__image -->
		<?php endif ?>
	</div><!-- /.section__body -->
</section><!-- /.section-featured -->

<?php
if ( !empty( $crb_related ) ) :
	$related_query = new WP_Query( array( 'post_type' => array( 'post', 'page' ), 'posts_per_page' => -1, 'post__in' => wp_list_pluck( $crb_related, 'id'  ), 'orderby' => 'post__in' ) );
	if ( $related_query->have_posts() ) :
	?>
		<section class="section-related">
			<div class="shell">
				<header class="section__head">
					<h3>
						<span><?php _e( 'Related Posts', 'crb' ); ?></span>
					</h3>
				</header><!-- /.section__head -->

				<div class="section__body">
					<div class="slider slider-grid swiper-container">
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

						<div class="slider__actions">
							<a href="#" class="slider__btn slider__btn--prev">
								<?php crb_render_fragment( 'icons/ico-arrow-left-dark' ); ?>
							</a>

							<a href="#" class="slider__btn slider__btn--next">
								<?php crb_render_fragment( 'icons/ico-arrow-right-dark' ); ?>
							</a>
						</div><!-- /.slider__actions -->

						<div class="slider__paging"></div><!-- /.slider__paging -->
					</div><!-- /.slider-grid -->
				</div><!-- /.section__body -->

				<?php
				wp_reset_postdata();

				if ( !empty( $button_text ) && !empty( $button_link ) ) :
					$target = '';
					if ( !empty( $button_new_tab ) && $button_new_tab === true ) {
						$target = 'target="_blank"';
					}
					?>
					<div class="section__actions">
						<a href="<?php echo $button_link; ?>" class="btn btn--<?php echo $button_color; ?>" <?php echo $target; ?>><?php esc_html_e( $button_text ); ?></a>
					</div><!-- /.section__actions -->
				<?php endif ?>
			</div><!-- /.shell -->
		</section><!-- /.section-related -->
	<?php endif ?>
<?php endif;
