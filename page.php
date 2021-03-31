<?php
get_header();
the_post();
?>

<div class="main">
	<?php
	crb_render_fragment( 'intro' );
	crb_render_fragment( 'sections/content' );
	crb_render_fragment( 'sections' );
	//crb_render_fragment( 'slider-articles' );
	crb_render_fragment( 'callout' );
	?>
</div><!-- /.main -->

<?php get_footer();
