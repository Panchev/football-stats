<?php get_header(); ?>

<div class="main">
	<?php
	crb_render_fragment( 'intro' );
	
	if ( have_posts() ) :
		crb_render_fragment( 'sections/trending_and_latest_posts' );
	else :
	?>
		<section class="section-more" style="padding-top: 0;">
			<div class="shell">
				
				<div class="section__body">
					<div class="toggle">
						<div class="toggle__body">
							<div id="trending-posts" class="toggle__tab active">
								<div class="ajax-posts trending">
									<p style="text-align: center;">
										<?php
										if ( is_category() ) { // If this is a category archive
											printf( __( "Sorry, but there aren't any posts in the %s category yet.", 'crb' ), single_cat_title( '', false ) );
										} else if ( is_date() ) { // If this is a date archive
											_e( "Sorry, but there aren't any posts with this date.", 'crb' );
										} else if ( is_author() ) { // If this is a category archive
											$userdata = get_user_by( 'id', get_queried_object_id() );
											printf( __( "Sorry, but there aren't any posts by %s yet.", 'crb' ), $userdata->display_name );
										} else if ( is_search() ) { // If this is a search
											_e( 'No posts found. Try a different search?', 'crb' );
										} else {
											_e( 'No posts found.', 'crb' );
										}
										?>
									</p>
									<div class="intro__body" style="max-width: 500px; margin: 0 auto; text-align: left;">
										<?php crb_render_fragment( 'search' ); ?>
									</div><!-- /.intro__body -->
								</div>
							</div><!-- /.toggle__tab -->
						</div><!-- /.toggle__body -->
					</div><!-- /.toggle -->
				</div><!-- /.section__body -->
			</div><!-- /.shell -->
		</section>
	<?php endif; ?>

</div><!-- /.main -->

<?php get_footer();
