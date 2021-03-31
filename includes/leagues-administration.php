<?php

add_action( 'admin_menu', 'crb_add_admin_pages' );
function crb_add_admin_pages() {
	add_menu_page( __( 'Leagues Administration', 'crb' ), __( 'Leagues Administration', 'crb' ),
			'edit_posts',
			'league-admin',
			'crb_add_leagues_admin_page',
		);
}
function crb_add_leagues_admin_page() {
	$leagues = get_terms( [
		'taxonomy' => 'crb_league',
		'parent'   => 0,
		'hide_empty' => false,
	]);

	?>
	<div id="leagues-admin-app"></div>
	<?php
}