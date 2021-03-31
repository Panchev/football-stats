<?php
namespace App\Controllers\Web;

class FixController {
	function init() {

		// $leagues = [ 'bundesliga-1' ];

		// foreach ( $leagues as $league ) {
		// 	$matches = get_posts([
		// 		'post_type' => 'crb_football_team',
		// 		'posts_per_page' => 600,
		// 		'tax_query' => [
		// 			[
		// 				'taxonomy' => 'crb_league',
		// 				'terms'    => $league,
		// 				'field'	   => 'slug'
		// 			]
		// 		]
		// 	]);

		// 	foreach ( $matches as $match ) {
		// 		$league = wp_get_post_terms( $match->ID, 'crb_league' );
		// 		$league_child = get_terms( [
		// 			'taxonomy' => 'crb_league',
		// 			'hide_empty' => false,
		// 			'parent'   => $league[0]->term_id
		// 		]);
		// 		wp_set_post_terms( $match->ID, [$league_child[0]->term_id], 'crb_league', true );
			
		// 	}
		// }


		// Set all entries to 2020 season

		// $test_season = get_term_by('slug', '2020', 'crb_season' );
		// // echo '<pre>';
		// // print_r($test_season);
		// // echo '</pre>';
		// // exit;

		// $teams = get_posts([
		// 	'post_type' => [ 'crb_football_team', 'crb_football_match'],
		// 	'posts_per_page' => -1,
		// ]);

		// foreach ( $teams as $team ) {
		// 	wp_set_post_terms( $team->ID, [9], 'crb_season', true );
		// }

		// echo '<pre>';
		// print_r($teams);
		// echo '</pre>';
		// exit;

		exit('test');
	}

}