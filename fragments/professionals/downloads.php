<?php
$downloads_loop = new WP_Query( array(
	'post_type' => 'crb_download',
	'posts_per_page' => 50,
	'ignore_custom_sort' => true,
	'post__in' => crb_get_association_ids( $section['downloads_ids'] ),
	'orderby' => 'post__in',
) );
if ( ! $downloads_loop->have_posts() ) {
	return;
}
?>
<section class="section-downloads">
	<div class="shell">
		<?php if ( ! empty( $section['title'] ) ) : ?>
			<header class="section__head">
				<h3><?php echo esc_html( $section['title'] ); ?></h3>
			</header><!-- /.section__head -->
		<?php endif; ?>

		<div class="section__body">
			<div class="resources">
				<?php 
				crb_render_fragment( 'common/downloads', [
					'downloads_loop' => $downloads_loop
				] ); 
				?>
			</div><!-- /.resources -->
		</div><!-- /.section__body -->
		
		<?php if ( ! empty( $section['btn_label'] ) || ! empty( $section['btn_link'] ) ) : ?>
			<div class="section__actions">
				<a href="<?php echo esc_url( $section['btn_link'] ); ?>" class="btn btn--violet"><?php echo esc_html( $section['btn_label'] ); ?></a>
			</div><!-- /.section__actions -->
		<?php endif; ?>
	</div><!-- /.shell -->
</section><!-- /.section-downloads -->