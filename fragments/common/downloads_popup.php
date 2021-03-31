<?php
if ( ! array_filter( $download ) ) {
	return;
}
?>
<div id="download" class="mfp-hide">
	<div class="download">
		<header class="download__head">
			<div class="download__head-image">
				<img src="" alt="">
			</div><!-- /.download__head-image -->
			
			<h5></h5>
		</header><!-- /.download__head -->
		
		<?php if ( ! empty( $download['form'] ) ) : ?>
			<div class="download__body">
				<div class="form-download">
					<?php crb_render_gform( $download['form'], true, array('display_title' => true)); ?>
				</div><!-- /.form-download -->
			</div><!-- /.download__body -->
		<?php endif; ?>
	</div><!-- /.download -->
</div><!-- /.mfp-hide -->