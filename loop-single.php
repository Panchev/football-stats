<?php
get_header();
the_post();

	crb_set_post_views( get_the_id() );
	$url = '';
	$class = 'no-image';
	if ( !empty( $image = get_post_thumbnail_id() ) ) {
		$url = wp_get_attachment_image_url( $image, 'full' );
		if ( $url ) {
			$class = '';
		}
	}
	
	$intro_color_style = '';
	if ( $intro_color = carbon_get_the_post_meta( 'crb_intro_color_select' ) ) :
		$intro_color_style = 'style="background-color: ' . $intro_color . '"';
	elseif ( ( $terms = wp_get_post_terms( get_the_id(), 'category', array( 'exclude' => 1 ) ) ) && $intro_color = carbon_get_term_meta( $terms[0]->term_id, 'crb_intro_color' ) ) :
		$color = '#31BDBF';
		if ( $intro_color == 'blue' ) {
			$color = '#31BDBF';
		} elseif ( $intro_color == 'pink' ) {
			$color = '#E34598';
		} elseif ( $intro_color == 'green' ) {
			$color = '#75BF43';
		} elseif ( $intro_color == 'red' ) {
			$color = '#E51D38';
		} elseif ( $intro_color == 'violet' ) {
			$color = '#663290';
		} elseif ( $intro_color == 'yellow' ) {
			$color = '#F7C412';
		} elseif ( $intro_color == 'canesten' ) {
			$color = '#CB3B49';
		} else {
			$color = '#44D0D2';
		}
		
		$intro_color_style = 'style="background-color: ' . $color . '"';
	endif;
	?>
	<div class="main main--orange">
		<div class="intro-tertiary intro-tertiary--orange <?php echo $class; ?>" <?php echo $intro_color_style; ?>>
			<?php if ( empty( $url ) ): ?>
				<div class="shell">
			<?php endif ?>
			
			<div class="intro__content">
				<div class="intro__entry">
					<span class="intro__categories"><?php the_category( ', ' ); ?></span>
					<?php
					if ( empty( $title = carbon_get_the_post_meta( 'crb_intro_title' ) ) ) {
						$title = get_the_title();
					}
					
					if ( $title ) :?>
						<h1><?php echo nl2br( $title ); ?></h1>
					<?php endif;
					
					if ( !empty( $content = carbon_get_the_post_meta( 'crb_intro_content' ) ) ) {
						echo crb_content( $content );
					} ?>
				</div><!-- /.intro__entry -->
			</div><!-- /.intro__content -->
			
			<div class="intro__image" style="background-image: url(<?php echo $url; ?>)"></div><!-- /.intro__image -->
			
			<?php if ( empty( $url ) ) : ?>
				</div>
			<?php endif ?>
		</div><!-- /.intro-tertiary -->

		<div class="section-article">
			<div class="shell">
				<div class="section__container">
					<div class="section__content">
						<?php crb_render_fragment( 'breadcrumbs' ); ?>
						
						<div class="section__body">
							<div class="section__groups">
								<?php the_content(); ?>
							</div><!-- /.section__groups -->
						</div><!-- /.section__body -->
					</div><!-- /.section__content -->

					<div class="section__aside">
						<ul class="widgets">
							<?php get_template_part( 'fragments/share' ); ?>

							<li class="widget-nav">
								<h5>ON THIS PAGE</h5>

								<ul></ul>
							</li><!-- /.widget-nav -->

							<li class="widget-more">
								<div class="widget__nav">
									<ul>
										<li class="current">
											<a href="#related">Related</a>
										</li>

										<li>
											<a href="#trending">
												Trending

												<?php crb_render_fragment( 'icons/ico-arrow-trend' ); ?>
											</a>
										</li>
									</ul>
								</div><!-- /.widget__nav -->

								<div class="widget__tabs">
									<?php
									$args = array( 'post_type' => 'post', 'posts_per_page' => 5, 'post__not_in'  => array( get_the_id() ) );
									if ( !empty( $terms = wp_get_post_terms( get_the_id(), 'category', array( 'exclude' => 1 ) ) ) ) {
										$term_id = $terms[0]->term_id;
										$args['tax_query'] = array(
											array(
												'taxonomy' => 'category',
												'field'    => 'term_id',
												'terms'    => array( $term_id ),
												'operator' => 'IN',
											),
										);
									}
									
									$related_query = new WP_Query( $args );
									
									if ( $related_query->have_posts() ) :
									?>
										<div id="related" class="widget__tab active">
											<div class="widget__body">
												<div class="list-articles">
													<ul>
														<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
															<li>
																<a href="<?php the_permalink(); ?>"></a>
																
																<?php
																$thumb_id = get_post_thumbnail_id( get_the_id() );
																if ( empty( $thumb_id ) ) {																	
																	if ( !empty( $terms ) ) {
																		$thumb_id = carbon_get_term_meta( $terms[0]->term_id, 'crb_thumb' );
																	}
																}
																
																if ( !empty( $thumb_id ) ) :
																	$url = wp_get_attachment_image_url( $thumb_id, 'medium' );
																	?>
																		<div class="image" style="background-image: url(<?php echo $url; ?>); background-size: cover; ">
																			<?php echo wp_get_attachment_image( $thumb_id, 'medium' ); ?>
																		</div>
																	<?php
																endif;
																
																the_title( '<h6>', '</h6>' );
																?>
															</li>
														<?php endwhile ?>
													</ul>
												</div><!-- /.list-articles -->
											</div><!-- /.widget__body -->
											
											<?php if ( !empty( $term_id ) ) : ?>
												<div class="widget__actions">
													<a href="<?php echo get_term_link( $term_id ); ?>" class="widget__btn"><?php _e( 'More ...', 'crb' ); ?></a>
												</div><!-- /.widget__actions -->
											<?php endif ?>
										</div><!-- /.widget__tab -->
									<?php
									endif;
									
									$class = '';
									if ( !$related_query->have_posts() ) {
										$class = 'active';
									}
									
									$args = array(
										'paged' => $paged,
										'post_type' => 'post',
										'posts_per_page' => 4,
										'meta_key' => '_crb_post_views_count',
										'orderby' => 'meta_value_num',
										'order' => 'DESC'
									);
									
									$trending_query = new WP_Query( $args );
									
									if ( $trending_query->have_posts() ) :
									?>
										<div id="trending" class="widget__tab <?php echo $class; ?>">
											<div class="widget__body">
												<div class="list-articles">
													<ul>
														<?php while ( $trending_query->have_posts() ) : $trending_query->the_post(); ?>
															<li>
																<a href="<?php the_permalink(); ?>"></a>
																
																<?php
																$thumb_id = get_post_thumbnail_id( get_the_id() );
																if ( empty( $thumb_id ) ) {	
																	$terms = wp_get_post_terms( get_the_id(), 'category', array( 'exclude' => 1 ) );																
																	if ( !empty( $terms ) ) {
																		$thumb_id = carbon_get_term_meta( $terms[0]->term_id, 'crb_thumb' );
																	}
																}
																
																if ( !empty( $thumb_id ) ) :
																	$url = wp_get_attachment_image_url( $thumb_id, 'medium' );
																	?>
																		<div class="image" style="background-image: url(<?php echo $url; ?>); background-size: cover; ">
																			<?php echo wp_get_attachment_image( $thumb_id, 'medium' ); ?>
																		</div>
																	<?php
																endif;
																
																the_title( '<h6>', '</h6>' );
																?>
															</li>
														<?php endwhile ?>
													</ul>
												</div><!-- /.list-articles -->
											</div><!-- /.widget__body -->
										</div><!-- /.widget__tab -->
									<?php
									endif;
									
									wp_reset_postdata();
									?>
								</div><!-- /.widget__tabs -->
							</li><!-- /.widget-more -->
						</ul><!-- /.widgets -->
					</div><!-- /.section__aside -->
				</div><!-- /.section__container -->
			</div><!-- /.shell -->
		</div><!-- /.section-article -->

		<?php crb_render_fragment( 'slider-articles' ); ?>

		<?php crb_render_fragment( 'callout' ); ?>
	</div><!-- /.main -->

<?php get_footer();
