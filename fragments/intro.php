<?php
$color = carbon_get_the_post_meta( 'crb_intro_color' );
$url = '';
$class = 'no-image';
if ( !empty( $image = carbon_get_the_post_meta( 'crb_intro_image' ) ) ) {
	$url = wp_get_attachment_image_url( $image, 'full' );
	$class = '';
} elseif ( is_home() && !empty( $image = carbon_get_post_meta( intval( get_option( 'page_for_posts' ) ), 'crb_intro_image' ) ) ) {
	$url = wp_get_attachment_image_url( $image, 'full' );
	$class = '';
}

if ( is_home() && !empty( $blog_color = carbon_get_post_meta( intval( get_option( 'page_for_posts' ) ), 'crb_intro_color' ) ) ) {
	$color = $blog_color;
}

$intro_color_style = '';
if ( $intro_color = carbon_get_the_post_meta( 'crb_intro_color_select' ) ) :
	$intro_color_style = 'style="background-color: ' . $intro_color . '"';
	?>

		<style>
			.intro__content .intro__entry .intro__actions a { border-color: <?php echo $intro_color; ?>; }
			.intro__content .intro__entry .intro__actions a:hover { color: <?php echo $intro_color; ?>; }
		</style>
	<?php
endif;
?>

<div class="intro intro--<?php echo $color; ?> <?php echo $class; ?>" <?php echo $intro_color_style; ?>>
	<?php if ( ! empty( $url ) ) : ?>
		<div class="intro__image" style="background-image: url(<?php echo $url; ?>)"></div><!-- /.intro__image -->
	<?php endif; ?>

	<div class="intro__content">
		<div class="intro__entry">
			<?php
			if ( empty( $title = carbon_get_the_post_meta( 'crb_intro_title' ) ) ) {
				$title = crb_get_title();
			}

			$style = '';
			if ( !empty( $color = carbon_get_the_post_meta( 'crb_intro_text_color' ) ) ) {
				$style = 'style="color: ' . $color . '"';
			}
			?>
			<div class="intro__head">
				<?php if ( !empty( $title ) ) : ?>
					<h1 <?php echo $style; ?>><?php echo nl2br( $title ); ?></h1>
				<?php endif; ?>
			</div><!-- /.intro__head -->


				<?php if ( !empty( $content = carbon_get_the_post_meta( 'crb_intro_content' ) ) ) : ?>
					<div class="intro__body" <?php echo $style; ?>>
						<?php echo crb_content( $content ); ?>
					</div><!-- /.intro__body -->
				<?php endif;  ?>

			<?php if ( !empty( $show_form = carbon_get_the_post_meta( 'crb_show_intro_form' ) ) && $show_form === true ) : ?>
				<div class="intro__body">
					<?php crb_render_fragment( 'search' ); ?>
				</div><!-- /.intro__body -->
			<?php
			endif;

			$text = carbon_get_the_post_meta( 'crb_intro_button_text' );
			$link = carbon_get_the_post_meta( 'crb_intro_button_link' );

			if ( $text && $link ) :
				$target = '';
				$new_tab = carbon_get_the_post_meta( 'crb_intro_button_new_tab' );
				if ( !empty( $new_tab ) && $new_tab === true ) {
					$target = 'target="_blank"';
				}
				?>
				<div class="intro__actions">
					<a href="<?php echo esc_url( $link ); ?>" class="intro__btn"><?php esc_html_e( $text ); ?></a>
				</div><!-- /.intro__actions -->
			<?php endif ?>
		</div><!-- /.intro__entry -->
	</div><!-- /.intro__content -->
</div><!-- /.intro -->