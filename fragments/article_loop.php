<?php exit('oooo'); ?>
<div class="tile-article">
	<a href="<?php the_permalink(); ?>" class="tile__link"></a>
	
	<?php
	if ( empty( $term_id ) ) {
		if ( !empty( $terms = wp_get_post_terms( get_the_id(), 'category' ) ) ) {
			$term_id = $terms[0]->term_id;
		} else {
			$term_id = 0;
		}
	}
	$class = '';
	if ( !empty( $color = carbon_get_term_meta( $term_id, 'crb_intro_color' ) ) ) {
		$class = 'tile__image--' . $color;
	}

	$term_image = carbon_get_term_meta( $term_id, 'crb_thumb' );
	?>
	<div class="tile__image <?php echo $class; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="tile__image-inner" style="background-image: url(<?php echo get_the_post_thumbnail_url( get_the_id(), 'large' ); ?>)"></div><!-- /.tile__image-inner -->
		<?php elseif ( $term_image ) : ?>
			<div class="tile__image-inner tile__image-topic-icon" style="background-image: url(<?php echo wp_get_attachment_image_url( $term_image, 'medium' ); ?>)"></div><!-- /.tile__image-inner -->
		<?php endif; ?>
	</div><!-- /.tile__image -->

	<header class="tile__head">
		<?php if ( $types = wp_get_post_terms( get_the_id(), 'crb_type' ) ) : ?>
			<h6><?php esc_html_e( $types[0]->name ); ?></h6>
		<?php else : ?>
			<h6><?php the_time( 'd/n/y' ) ?></h6>
		<?php endif ?>

		<h5><?php the_title(); ?></h5>
		
		<?php
		if ( !empty( $excerpt = get_post_field( 'post_excerpt', get_the_id() ) ) ) {
			echo crb_content( $excerpt );
		}
		?>
	</header><!-- /.tile__head -->
	
	<?php
	$categories = wp_get_post_terms( get_the_id(), 'category' );
	if ( !empty( $categories = wp_list_filter( $categories, array( 'slug' => 'uncategorized' ),'NOT' ) ) ) :
		?>
		<footer class="tile__foot">
			<h6><?php esc_html_e( array_shift( $categories )->name ); ?></h6>
		</footer><!-- /.tile__foot -->
	<?php endif ?>
</div><!-- /.tile-article -->