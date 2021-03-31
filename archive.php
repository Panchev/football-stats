<?php
get_header();
$term_id = get_queried_object_id();

if ( empty( $color = carbon_get_term_meta( $term_id, 'crb_intro_color' ) ) ) {
	$color = 'blue';
}

crb_set_term_views( $term_id );
?>

<div class="main main--<?php echo $color; ?>">
	<div class="intro-secondary">
		<div class="shell">
			<div class="intro__container">
				<div class="intro__content">
					<div class="intro__entry">
						<header class="intro__head">
							<?php if ( !empty( $title = carbon_get_term_meta( $term_id, 'crb_intro_title' ) ) ) : ?>
								<h2><?php echo strtoupper( $title ); ?></h2>
							<?php else : ?>
								<h2><?php echo strtoupper( crb_get_title() ); ?></h2>
							<?php endif ?>
							
							<?php if ( !empty( $video = carbon_get_term_meta( $term_id, 'crb_intro_video' ) ) ) : ?>
								<a href="<?php echo $video; ?>" class="btn-play" mfp-video></a>
							<?php endif ?>
						</header><!-- /.intro__head -->
						
						<?php if ( !empty( $content = carbon_get_term_meta( $term_id, 'crb_intro_content' ) ) ) : ?>
							<div class="intro__body">
								<?php echo crb_content( $content ); ?>
							</div><!-- /.intro__body -->
						<?php endif ?>
					</div><!-- /.intro__entry -->
				</div><!-- /.intro__content -->
				
				<div class="intro__image">
					<?php
					if ( !empty( $image = carbon_get_term_meta( $term_id, 'crb_intro_image' ) ) ) {
						echo wp_get_attachment_image( $image, 'medium-large' );
					}
					?>
				</div><!-- /.intro__image -->
			</div><!-- /.intro__container -->
		</div><!-- /.shell -->
	</div><!-- /.intro-secondary -->

	<section class="section-details">
		<?php
		$show_breadcrumbs = carbon_get_term_meta( $term_id, 'crb_show_breadcrumbs' );
		if ( !empty( $show_breadcrumbs ) && $show_breadcrumbs === true ) {
			crb_render_fragment( 'breadcrumbs' );
		}
		?>
			
		<div class="section__container">
			<div class="shell">
				<?php
				$additional_tabs = carbon_get_term_meta( $term_id, 'crb_additional_tabs' );
				if ( !empty( $additional_tabs ) ) :
				?>
					<header class="section__head">
						<nav class="nav-tabs">
							<ul>
								<?php
								$show_posts = carbon_get_term_meta( $term_id, 'crb_show_posts_tab' );
								if ( !empty( $show_posts ) && $show_posts === true ) :
									if ( empty( $tab_title = carbon_get_term_meta( $term_id, 'crb_posts_tab_title' ) ) ) {
										$tab_title = 'Posts';
									}
									?>
									<li class="current">
										<a href="#posts"><?php echo $tab_title; ?></a>
									</li>
								<?php
								endif;
								
								if ( !empty( $additional_tabs ) ) :
									foreach ( $additional_tabs as $count => $tab ) :
										$tab_class =  !$show_posts && !$count ? 'current' : ''; ?>
										<li class="<?php echo $tab_class; ?>">
											<a href="#<?php echo sanitize_title_with_dashes( $tab['title_top'] ); ?>"><?php esc_html_e( $tab['title_top'] ); ?></a>
										</li>
									<?php
									endforeach;
								endif;
								?>
							</ul>
						</nav><!-- /.nav-tabs -->
					</header><!-- /.section__head -->
				<?php endif ?>

				<div class="section__body">
					<?php
					$show_posts = carbon_get_term_meta( $term_id, 'crb_show_posts_tab' );
					if ( !empty( $show_posts ) && $show_posts === true ) :
						?>
						<div id="posts" class="section__tab active">
							<?php if ( !empty( $tab_title ) ) : ?>
								<header class="section__tab-head">
									<h5><?php esc_html_e( $tab_title ); ?></h5><!-- /.section__title -->
								</header>
							<?php endif ?>
							
							<div class="section__tab-body">
								<?php
								$post__in = array();
								if ( !empty( $selected_posts = carbon_get_term_meta( $term_id, 'crb_select_posts' ) ) ) {
									$post__in = wp_list_pluck( $selected_posts, 'id' );
								}
								
								crb_render_fragment( 'articles', array( 'main_query' => true, 'term_id' =>  $term_id, 'post__in' => $post__in ) );
								?>
								
								<a href="#" class="section__tab-close">Close</a>
							</div>
						</div>
						
					<?php
					endif;
					
					if ( !empty( $additional_tabs ) ) :
						foreach ( $additional_tabs as $count => $tab ) :
							
							$tab_class = !$show_posts && !$count ? 'active' : ''; 
							?>
							<div id="<?php echo sanitize_title_with_dashes( $tab['title_top'] ); ?>" class="section__tab <?php echo $tab_class; ?>">
								<header class="section__tab-head">
									<h5><?php esc_html_e( $tab['title_top'] ); ?></h5>
								</header><!-- /.section__tab-head -->
								
								<div class="section__tab-body">
									<?php
									if ( !empty( $tab['crb_sections'] ) ) {
										crb_render_page( $tab['crb_sections'] );
									}
									?>

									<a href="#" class="section__tab-close">Close</a>
								</div><!-- /.section__tab-body -->
							</div><!-- /.section__tab -->
						<?php
						endforeach;
					endif;
					?>
				</div><!-- /.section__body -->
				
				<?php
				$title = carbon_get_term_meta( $term_id, 'crb_alert_title' );
				$content = carbon_get_term_meta( $term_id, 'crb_alert_content' );
				$button_text = carbon_get_term_meta( $term_id, 'crb_alert_button_text' );
				$button_link = carbon_get_term_meta( $term_id, 'crb_alert_button_link' );
				$button_new_tab = carbon_get_term_meta( $term_id, 'crb_alert_button_new_tab' );
				
				if ( !empty( $title ) || !empty( $content ) ) :
				?>
					<footer class="section__foot">
						<?php
						if ( empty( $color = carbon_get_term_meta( $term_id, 'crb_alert_color' ) ) ) {
							$color = 'red';
						}
						
						$icon = 'ico-info.svg';
						if ( $color === 'red' ) {
							$icon = 'ico-warning.svg';
						}
						?>
						<div class="box box--<?php echo $color; ?>">
							<div class="box__image">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/resources/images/<?php echo $icon; ?>" alt="">
							</div><!-- /.box__image -->

							<header class="box__head">
								<?php if ( !empty( $title ) ) : ?>
									<h5><?php esc_html_e( $title ); ?></h5>
								<?php
								endif;
								
								if ( !empty( $content ) ) {
									echo crb_content( $content );
								}
								?>
							</header><!-- /.box__head -->
						
							<?php
							if ( !empty( $button_text ) && !empty( $button_link ) ) :
								$target = '';
								if ( !empty( $button_new_tab ) && $button_new_tab === true ) {
									$target = 'target="_blank"';
								}
								?>
								<footer class="box__foot">
									<a href="<?php echo esc_url( $button_link ); ?>" class="btn btn--sm btn--<?php echo $color; ?>" <?php echo $target ?>><?php esc_html_e( $button_text ); ?></a>
								</footer><!-- /.box__foot -->
							<?php endif ?>
						</div><!-- /.box box-/-red -->
					</footer><!-- /.section__foot -->
				<?php endif ?>
			</div><!-- /.shell -->
		</div><!-- /.section__container -->
	</section><!-- /.section-details -->
	
	<?php crb_render_fragment( 'callout' ); ?>
</div><!-- /.main -->

<?php get_footer();
