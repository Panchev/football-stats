<?php
register_taxonomy(
	'crb_league',
	array( 'crb_football_player', 'crb_football_match', 'crb_football_team' ),
	array(
		'labels' => array(
			'name'              => __( 'Leagues', 'crb' ),
			'singular_name'     => __( 'League', 'crb' ),
			'search_items'      => __( 'Search Leagues', 'crb' ),
			'all_items'         => __( 'All Leagues', 'crb' ),
			'parent_item'       => __( 'Parent League', 'crb' ),
			'parent_item_colon' => __( 'Parent League:', 'crb' ),
			'view_item'         => __( 'View League', 'crb' ),
			'edit_item'         => __( 'Edit League', 'crb' ),
			'update_item'       => __( 'Update League', 'crb' ),
			'add_new_item'      => __( 'Add New League', 'crb' ),
			'new_item_name'     => __( 'New League Name', 'crb' ),
			'menu_name'         => __( 'Leagues', 'crb' ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'league' ),
	)
);


register_taxonomy(
	'crb_season',
	array( 'crb_football_player', 'crb_football_match', 'crb_football_team' ),
	array(
		'labels' => array(
			'name'              => __( 'Seasons', 'crb' ),
			'singular_name'     => __( 'Season', 'crb' ),
			'search_items'      => __( 'Search Seasons', 'crb' ),
			'all_items'         => __( 'All Seasons', 'crb' ),
			'parent_item'       => __( 'Parent Season', 'crb' ),
			'parent_item_colon' => __( 'Parent Season:', 'crb' ),
			'view_item'         => __( 'View Season', 'crb' ),
			'edit_item'         => __( 'Edit Season', 'crb' ),
			'update_item'       => __( 'Update Season', 'crb' ),
			'add_new_item'      => __( 'Add New Season', 'crb' ),
			'new_item_name'     => __( 'New Season Name', 'crb' ),
			'menu_name'         => __( 'Seasons', 'crb' ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'show_in_rest'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'season' ),
	)
);