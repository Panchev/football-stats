<?php extract( $fields ); ?>

<div class="group group--info">
	<?php if ( !empty( $title ) ) : ?>
		<header class="group__head">
			<h3><?php esc_html_e( $title ); ?></h3>
		</header><!-- /.group__head -->
	<?php endif ?>

	<div class="info">
		<div class="info__pros">
			<?php echo crb_content( $column_left ); ?>
		</div><!-- /.info__pros -->

		<div class="info__cons">
			<?php echo crb_content( $column_right ); ?>
		</div><!-- /.info__cons -->
	</div><!-- /.info -->
</div><!-- /.group group-/-info-->
