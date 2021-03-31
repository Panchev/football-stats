<div class="section-article default-content">
	<?php
	$show_breadcrumbs = carbon_get_the_post_meta( 'crb_show_breadcrumbs' );
	if ( !empty( $show_breadcrumbs ) && $show_breadcrumbs === true ) {
		crb_render_fragment( 'breadcrumbs' );
	}
	?>
	
	<div class="shell">
		<div class="section__container">
			<div class="section__content">
				<div class="section__body">
					<div class="section__groups">
						<div class="section__group " id="test">
							<div class="group group--text">
								<div class="group__body">
									<article class="article-single ">
										<?php
										add_filter( 'the_content', 'wpautop' );
										the_content();
										remove_filter( 'the_content', 'wpautop' );
										?>
									</article><!-- /.article-single -->
								</div><!-- /.group__body -->
							</div><!-- /.group group-/-text -->
						</div><!-- /.section__group -->
					</div><!-- /.section__groups -->
				</div><!-- /.section__body -->
			</div><!-- /.section__content -->
		</div><!-- /.section__container -->
	</div><!-- /.shell -->
</div>