<?php
extract( $fields );
$class_outer = '';
$class_inner = '';
if ( !empty( $white_background ) ) {
	$class_outer = 'section__group--next';
	$class_inner = 'article-single--white';
}
?>

<div class="<?php echo $class_outer; ?>" >
	<div class="group group--text">
		<?php if ( !empty( $title ) ) : ?>
			<header class="group__head">
				<h3><?php esc_html_e( $title ); ?></h3>
			</header><!-- /.group__head -->
		<?php
		endif;

		if ( !empty( $content ) ) :
		?>
			<article class="article-single <?php echo $class_inner; ?>">
				<?php echo crb_content( $content ); ?>
			</article><!-- /.article-single -->
		<?php endif ?>
	</div><!-- /.group group-/-text -->
</div><!-- /.section__group -->