<?php
if ( empty( $section['content'] ) ) {
	return;
}
?>
<section class="section-text">
	<div class="shell">
		<div class="section__content">
			<p>
				<?php echo esc_html( $section['content'] ); ?>
			</p>
		</div><!-- /.section__content -->
	</div><!-- /.shell -->
</section><!-- /.section-text -->