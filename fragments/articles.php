<div class="tiles-grid">
	<ul class="ajax-posts">
		<?php
		$posts_per_page = get_option( 'posts_per_page' );
		if ( is_archive() ) {
			$posts_per_page = -1;
		}
		$paged = get_query_var( 'paged' );
		if ( !$paged ) {
			$paged = 1;
		}

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $posts_per_page,
			'paged' => $paged,
		);

		if ( empty( $term_id ) ) {
			$term_id = '';
		}

		if ( !empty( $term_id ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => array( $term_id ),
					'operator' => 'IN',
				),
			);

			if ( !empty( $post__in ) ) {
				$args['post__in'] = $post__in;
				$args['orderby'] = 'post__in';
			}
		} elseif ( !empty( $post__in ) ) {
			$args['post__in'] = $post__in;
			$args['orderby'] = 'post__in';
		}

		$article_query = new WP_Query( $args );

		while ( $article_query->have_posts() ) :
			$article_query->the_post();
			?>
			<li>
				<?php crb_render_fragment( 'article_loop', array( 'term_id' => $term_id ) ); ?>
			</li>

			<?php
			$post_index = $article_query->current_post;

			if ( ( $paged == 1 ) && ( ( $post_index == 5 ) || ( ( $post_index == $article_query->found_posts - 1 ) && ( $post_index < 5 ) ) ) && !empty( $post_type = carbon_get_term_meta( $term_id, 'crb_modal_post_type' ) ) ) :
				$notes = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );

				if ( !empty( $notes ) ) :
				?>
					<li class="tiles__lg">
						<div class="callout callout--lg">
							<div class="callout__content">
								<div class="callout__image">
									<img src="<?php bloginfo('stylesheet_directory'); ?>/resources/images/callout-image.svg" alt="">
								</div><!-- /.callout__image -->

								<?php if ( !empty( $title = carbon_get_term_meta( $term_id, 'crb_accordion_callout_title' ) ) ) : ?>
									<div class="callout__head">
										<h4><?php esc_html_e( $title ); ?></h4>
									</div><!-- /.callout__head -->
								<?php
								endif;

								if ( !empty( $text = carbon_get_term_meta( $term_id, 'crb_accordion_button_text' ) ) ) :
								?>
									<div class="callout__actions">
										<a href="#modal1" class="btn btn--violet" data-modal="mfp-details"><?php esc_html_e( $text ); ?></a>
									</div><!-- /.callout__actions -->
								<?php endif ?>
							</div><!-- /.callout__content -->
						</div><!-- /.callout -->

						<div id="modal1" class="modal-details mfp-hide">
							<div class="modal__content">
								<div id="modal__tab-intro" class="modal__tab active">
									<div class="modal__head">
										<?php if ( !empty( $title = carbon_get_term_meta( $term_id, 'crb_accordion_popup_title' ) ) ) : ?>
											<h4><?php esc_html_e( $title ); ?></h4>
										<?php
										endif;

										if ( !empty( $subtitle = carbon_get_term_meta( $term_id, 'crb_accordion_popup_subtitle' ) ) ) {
											echo wpautop( $subtitle );
										}
										?>
									</div><!-- /.modal__head -->

									<div class="modal__body">
										<div class="modal__nav">
											<ul>
												<?php foreach ( $notes as $index => $note ) : ?>
													<li>
														<a href="#modal__tab<?php echo $index + 1; ?>"><?php esc_html_e( get_the_title( $note->ID ) ); ?></a>
													</li>
												<?php endforeach ?>
											</ul>
										</div><!-- /.modal__nav -->
									</div><!-- /.modal__body -->
								</div><!-- /.modal__tab -->

								<?php foreach ( $notes as $index => $note ) : ?>
									<div id="modal__tab<?php echo $index + 1; ?>" class="modal__tab">
										<div class="modal__head">
											<?php
											$text = __( 'Symptom:', 'crb' );
											if ( $post_type === 'crb_cont_tool' ) {
												$text = __( 'Contraceptives that:' );
											}
											?>
											<span><?php echo $text; ?></span>
											<h4><?php esc_html_e( get_the_title( $note->ID ) ); ?></h4>
										</div><!-- /.modal__head -->

										<?php if ( !empty( $note_additional_notes = carbon_get_post_meta( $note->ID, 'crb_modal_notes' ) ) ) : ?>
											<div class="modal__body">
												<div class="features">
													<ul>
														<?php foreach ( $note_additional_notes as $additiona_note ) : ?>
															<li>

																<div class="feature">
																	<?php if ( $additiona_note['crb_related'] ) : ?>
																		<a href="<?php echo get_permalink( $additiona_note['crb_related'][0]['id'] ); ?>" class="feature__link"></a>
																	<?php endif;
																	
																	$image = '';
																	if ( empty( $additiona_note['image'] ) ) {
																		if ( !empty( $additiona_note['crb_related'] ) && $thumb_id = get_post_thumbnail_id( $additiona_note['crb_related'][0]['id'] ) ) {
																			$image = $thumb_id;
																		}
																	} else {
																		$image = $additiona_note['image'];
																	}

																	if ( !empty( $image ) ) :
																	?>
																		<div class="feature__image">
																			<?php echo wp_get_attachment_image( $image, [42, 42] ); ?>
																		</div><!-- /.feature__image -->

																	<?php endif; ?>

																	<div class="feature__content">

																	<?php if ( !empty( $additiona_note['crb_related'] ) ) : ?>
																		<h5><?php echo get_the_title( $additiona_note['crb_related'][0]['id'] ); ?></h5>
																	<?php
																	endif;

																	echo crb_content( $additiona_note['content'] );

																	if ( !empty( $image ) ) :
																	?>
																		</div>
																	<?php endif; ?>
																</div><!-- /.feature -->
															</li>
														<?php endforeach ?>
													</ul>
												</div><!-- /.features -->
											</div><!-- /.modal__body -->
										<?php endif ?>

										<div class="modal__actions">
											<a href="#modal__tab-intro" class="modal__back"><?php _e( 'Go back', 'crb' ); ?></a>
										</div><!-- /.modal__actions -->
									</div><!-- /.modal__tab -->
								<?php endforeach ?>
							</div><!-- /.modal__content -->

							<?php if ( !empty( $popup_bottom_content = carbon_get_term_meta( $term_id, 'crb_accordion_bottom_information' ) ) ) : ?>
								<footer class="modal__foot">
									<div class="box box--sm box--blue">
										<div class="box__image">
											<img src="<?php bloginfo('stylesheet_directory'); ?>/resources/images/ico-question@2x.png" alt="">
										</div><!-- /.box__image -->

										<header class="box__head">
											<?php echo crb_content( $popup_bottom_content ); ?>
										</header><!-- /.box__head -->
									</div><!-- /.box box -/-sm box-/-blue -->
								</footer><!-- /.modal__foot -->
							<?php endif ?>
						</div><!-- /.modal-details -->
					</li>
				<?php
				endif;
			endif;

			if ( ( ( $post_index == $article_query->post_count - 1 ) || ( ( $post_index == $article_query->found_posts - 1 ) && $post_index > 5 ) ) && !empty( $post_type = carbon_get_term_meta( $term_id, 'crb_modal_post_type' ) ) ) :
				$notes = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
				?>
				<li class="tiles__lg-mobile">
					<div class="callout">
						<div class="callout__content">
							<div class="callout__image">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/resources/images/callout-image.svg" alt="">
							</div><!-- /.callout__image -->

							<?php if ( !empty( $title = carbon_get_term_meta( $term_id, 'crb_accordion_callout_title' ) ) ) : ?>
								<div class="callout__head">
									<h4><?php esc_html_e( $title ); ?></h4>
								</div><!-- /.callout__head -->
							<?php
							endif;

							if ( !empty( $text = carbon_get_term_meta( $term_id, 'crb_accordion_button_text' ) ) ) :
							?>
								<div class="callout__actions">
									<a href="#modal1" class="btn btn--violet" data-modal="mfp-details"><?php esc_html_e( $text ); ?></a>
								</div><!-- /.callout__actions -->
							<?php endif ?>
						</div><!-- /.callout__content -->
					</div><!-- /.callout -->
				</li>
			<?php
			endif;
		endwhile;
		?>
	</ul>

	<?php
	$link = get_term_link( get_queried_object_id() );
	$max_num_pages = $article_query->max_num_pages;
	if ( intval( $max_num_pages ) > intval( $paged ) ) :
	?>
		<div class="section__load_more">
			<a href="<?php echo $link; ?>page/<?php echo $paged + 1 ?>/" class="link-icon load-more-posts-nonslider">
				<?php
				crb_render_fragment( 'icons/logo-xs' );

				_e( 'Load More', 'crb' );
				?>
			</a>
		</div><!-- /.section__load_more -->
	<?php
	endif;

	wp_reset_postdata();
	?>
</div><!-- /.tiles-grid -->