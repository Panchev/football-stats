<ul class="resources-list" data-download_id>
	<?php while ( $downloads_loop->have_posts() ) : $downloads_loop->the_post(); ?>
		<?php
		$download = [
			'text' => esc_html( carbon_get_the_post_meta('crb_downlaod_text') ),
		];
		?>
		<li>
			<div class="resource">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="resource__image">
						<span>
							<?php the_post_thumbnail('crb_download_thumbnail_image_size'); ?>
						</span>
					</div><!-- /.resource__image -->
				<?php endif; ?>
			
				<div class="resource__content">
					<h5><?php the_title(); ?></h5>
					
					<?php if ( ! empty( $download['text'] ) ) : ?>
						<p>
							<?php echo $download['text']; ?>
						</p>
					<?php endif; ?>
					
					<p>
						<a class="download-btn" href="#" data-download="<?php the_ID(); ?>"><?php _e( 'Download', 'crb' ); ?></a>
					</p>
				</div><!-- /.resource__content -->
			</div><!-- /.resource -->
		</li>
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>
</ul>
<?php 
crb_render_fragment( 'common/downloads_popup', [
	'download' => [
		'form' => carbon_get_theme_option('crb_downloads_form')
	]
] ); 
?>