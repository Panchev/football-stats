<?php
exit('tren');
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$link = get_permalink( get_the_id() );
if ( is_home() ) {
	$link = get_permalink( intval( get_option( 'page_for_posts' ) ) );
}
?>

<section class="section-more">
	<div class="shell">
		<?php if ( !empty( $title ) ) : ?>
			<header class="section__head">
				<div class="section__head-inner">
					<h2><?php esc_html_e( $title ); ?></h2>
				</div><!-- /.section__head-inner -->
			</header><!-- /.section__head -->
		<?php endif ?>

		<div class="section__body">
			<div class="toggle">
				<div class="toggle__head">
					<nav class="toggle__nav">
						<ul>
							<li class="current">
								<a href="#trending-posts">
									<?php
									crb_render_fragment( 'icons/ico-arrow' );
									
									_e( 'Trending Posts', 'crb' );
									?>
								</a>
							</li>

							<li>
								<a href="#just-added">
									<?php
									crb_render_fragment( 'icons/ico-clock' );
									
									_e( 'Just Added' );
									?>
								</a>
							</li>
						</ul>
					</nav><!-- /.toggle__nav -->
				</div><!-- /.toggle__head -->

				<div class="toggle__body">
					<div id="trending-posts" class="toggle__tab active">
						<header class="toggle__tab-head">
							<h3>
								<span>
									<?php
									crb_render_fragment( 'icons/ico-arrow' );
									
									_e( 'Trending Posts', 'crb' );
									?>
								</span>
							</h3>
						</header><!-- /.toggle__tab-head -->
						
						<?php
						$args = array(
							'paged' => $paged,
							'post_type' => 'post',
							'posts_per_page' => get_option( 'page_per_posts' ),
							'meta_key' => '_crb_post_views_count',
							'orderby' => 'meta_value_num',
							'order' => 'DESC'
						);
						
						if ( !empty( $_GET['s'] ) ) {
							$args['s'] = $_GET['s'];
						}
						
						$trending_query = new WP_Query( $args );
						?>
						<div class="ajax-posts trending">
							<div class="tiles-grid swiper-container trending">
								<ul class="swiper-wrapper trending">
									<?php
									while ( $trending_query->have_posts() ) :
										$trending_query->the_post();
										?>
										<li class="swiper-slide">
											<?php crb_render_fragment( 'article_loop' ); ?>
										</li>
									<?php endwhile ?>
								</ul>
							</div><!-- /.tiles-grid -->
						</div>
						<?php
						$max_num_pages = $trending_query->max_num_pages;
						
						if ( intval( $max_num_pages ) > intval( $paged ) ) :
						?>
							<div class="section__actions">
								<a href="<?php echo $link; ?>page/<?php echo $paged + 1 ?>/" class="link-icon load-more-posts trending">
									<?php
									crb_render_fragment( 'icons/logo-xs' );
									
									_e( 'Load More', 'crb' );
									?>
								</a>
							</div><!-- /.section__actions -->
						<?php endif ?>
					</div><!-- /.toggle__tab -->

					<div id="just-added" class="toggle__tab">
						<header class="toggle__tab-head">
							<h3>
								<span>
									<?php
									crb_render_fragment( 'icons/ico-clock' );
									
									_e( 'Just Added' );
									?>
								</span>
							</h3>
						</header><!-- /.toggle__tab-head -->

						<?php
						$args = array(
							'paged' => $paged,
							'post_type' => 'post',
							'posts_per_page' => get_option( 'page_per_posts' ),
							'order' => 'DESC'
						);
						
						if ( !empty( $_GET['s'] ) ) {
							$args['s'] = $_GET['s'];
						}
						
						$latest_query = new WP_Query( $args );
						?>
						<div class="ajax-posts new">
							<div class="tiles-grid swiper-container new">
								<ul class="swiper-wrapper new">
									<?php
									while ( $latest_query->have_posts() ) :
										$latest_query->the_post();
										?>
										<li class="swiper-slide">
											<?php crb_render_fragment( 'article_loop' ); ?>
										</li>
									<?php endwhile ?>
								</ul>
							</div><!-- /.tiles-grid -->
						</div>
						
						<?php
						$max_num_pages = $latest_query->max_num_pages;
						
						if ( intval( $max_num_pages ) > intval( $paged ) ) :
						?>
							<div class="section__actions">
								<a href="<?php echo $link; ?>page/<?php echo $paged + 1 ?>/" class="link-icon load-more-posts new">
									<?php
									crb_render_fragment( 'icons/logo-xs' );
									
									_e( 'Load More', 'crb' );
									?>
								</a>
							</div><!-- /.section__actions -->
						<?php endif ?>
					</div><!-- /.toggle__tab -->
				</div><!-- /.toggle__body -->
			</div><!-- /.toggle -->
		</div><!-- /.section__body -->
	</div><!-- /.shell -->
</section><!-- /.section-more -->