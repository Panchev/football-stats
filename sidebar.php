<div class="sidebar">
	<ul class="widgets">
		<?php
		$page_ID = crb_get_page_context();
		$sidebar = '';

		# If $page_ID is present, check for custom sidebar
		if ( ! empty( $page_ID ) ) {
			$sidebar = carbon_get_post_meta( $page_ID, 'crb_custom_sidebar' );
		}

		# If sidebar is not set or the $page_ID is not present, assign 'default-sidebar'
		if ( empty( $sidebar ) ) {
			$sidebar = 'default-sidebar';
		}

		dynamic_sidebar( $sidebar );
		?>
	</ul><!-- /.widgets -->
</div><!-- /.sidebar -->