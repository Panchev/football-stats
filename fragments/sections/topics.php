<?php
$categories = get_terms( 'category', array( 'exclude' => array(1,25), 'hide_empty' => false ) );

if ( empty( $categories ) ) {
	return;
}
?>

<section class="section">
	<div class="slider slider--tiles">
		<?php if ( !empty( $title ) ) : ?>
			<header class="slider__head">
				<div class="shell">
					<h3>
						<span><?php esc_html_e( $title ); ?></span>
					</h3>
				</div><!-- /.shell -->
			</header><!-- /.slider__head -->
		<?php endif ?>

		<div class="slider__body">
			<div class="slider__clip swiper-container">
				<div class="slider__slides swiper-wrapper">
					<?php foreach ( $categories as $category ) : ?>
						<div class="slider__slide swiper-slide">
							<div class="tile-topic">
								<div class="tile__container">
									<a href="<?php echo get_term_link( $category ); ?>" class="tile__link"></a>

									<?php if ( $thumb_id = carbon_get_term_meta( $category->term_id, 'crb_thumb' ) ) : ?>
										<div class="tile__image">
											<?php echo wp_get_attachment_image( $thumb_id, 'full' ); ?>
										</div><!-- /.tile__image -->
									<?php endif ?>

									<h4 class="tile__title"><?php esc_html_e( $category->name ); ?></h4><!-- /.tile__title -->
								</div><!-- /.tile__container -->
							</div><!-- /.tile-topic -->
						</div><!-- /.slider__slide -->						
					<?php endforeach ?>
				</div><!-- /.slider__slides -->

				<div class="slider__actions">
					<a href="#" class="slider__btn slider__btn--prev">
						<?php crb_render_fragment( 'icons/ico-arrow-left-dark' ); ?>
					</a>

					<a href="#" class="slider__btn slider__btn--next">
						<?php crb_render_fragment( 'icons/ico-arrow-right-dark' ); ?>
					</a>
				</div><!-- /.slider__actions -->

				<div class="slider__paging"></div><!-- /.slider__paging -->
			</div><!-- /.slider__clip -->
		</div><!-- /.slider__body -->
	</div><!-- /.slider slider--tiles -->
</section><!-- /.section -->