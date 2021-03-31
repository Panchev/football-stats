<?php
function crb_get_all_cpt_entries( $post_type = 'post' ) {
	global $wpdb;
	$results = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='$post_type' ORDER BY post_title ASC" );
	if ( !$results ) {
		return false;
	}
	$array_result = [];
	foreach ( $results as $entry ) {
		$array_result[$entry->ID] = $entry->post_title;
	}
	return $array_result;
}

function crb_get_team_object_by_team_api_id( $team_api_id ) {
	$team = get_posts([
		'post_type' => 'crb_football_team',
		'posts_per_page' => 1,
		'meta_value' => $team_api_id,
		'meta_key'   => '_crb_team_id'
	]);
	if ( !$team ) {
		return false;
	}
	return $team[0];
}

function crb_get_match_object_by_fixture_api_id( $fixture_api_id ) {
	$team = get_posts([
		'post_type' => 'crb_football_match',
		'posts_per_page' => 1,
		'meta_value' => $fixture_api_id,
		'meta_key'   => '_crb_match_id'
	]);
	if ( !$team ) {
		return false;
	}
	return $team[0];
}

function crb_get_league_object_by_league_api_id( $league_api_id ) {
	$league = get_terms([
		'taxonomy' => 'crb_league',
		'meta_value' => $league_api_id,
		'meta_key'   => '_crb_league_id'
	]);
	if ( !$league ) {
		return false;
	}
	return $league[0];
}

function crb_get_object_id_by_slug( $slug, $post_type ) {
	if ( $post = get_page_by_path( $slug, OBJECT, $post_type ) ) {
    	$id = $post->ID;
	} else {
    	$id = 0;
	}
	return $id;
}


function crb_get_unique_meta_values( $meta_key, $number = false ) {
	global $wpdb;
	$sql = "SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key='$meta_key'";
	if ( $number ) {
		$sql .= "  ORDER BY meta_value+0 ASC ";
	}
	$results = $wpdb->get_results( $sql );
	$results = wp_list_pluck( $results, 'meta_value' );
	return $results;
}

function crb_get_team_streaks_labels_and_keys() {
	return [
        'victory' => __( 'No Victory', 'crb' ),
        'draw'    => __( 'No Draw', 'crb' ),
        'loss'    => __( 'No Loss', 'crb' ),

        // Goals
        'scoring' => __( 'Not Scoring', 'crb' ),
        'conceding' => __( 'Not Conceding', 'crb' ),
        'goal_goal' => __( 'No goal/goal', 'crb' ),
        'over_1_5_goals' => __( 'No Over 1.5 Goals', 'crb' ),
        'over_2_5_goals' => __( 'No Over 2.5 Goals', 'crb' ),
        'over_3_5_goals' => __( 'No Over 3.5 Goals', 'crb' ),
        'under_1_5_goals' => __( 'No under 1.5 Goals', 'crb' ),
        'under_2_5_goals' => __( 'No under 2.5 Goals', 'crb' ),
        'under_3_5_goals' => __( 'No under 3.5 Goals', 'crb' ),

        // Corners
        'over_8_5_corners' => __( 'No Over 8.5 Corners', 'crb' ),
        'over_9_5_corners' => __( 'No Over 9.5 Corners', 'crb' ),
        'over_10_5_corners' => __( 'No Over 10.5 Corners', 'crb' ),
        'under_8_5_corners' => __( 'No under 8.5 Corners', 'crb' ),
        'under_9_5_corners' => __( 'No under 9.5 Corners', 'crb' ),
        'under_10_5_corners' => __( 'No under 10.5 Corners', 'crb' ),

        // Cards
        'over_3_5_cards' => __( 'No Over 3.5 Cards', 'crb' ),
        'over_4_5_cards' => __( 'No Over 4.5 Cards', 'crb' ),
        'over_5_5_cards' => __( 'No Over 5.5 Cards', 'crb' ),
        'under_3_5_cards' => __( 'No under 3.5 Cards', 'crb' ),
        'under_4_5_cards' => __( 'No under 4.5 Cards', 'crb' ),
        'under_5_5_cards' => __( 'No under 5.5 Cards', 'crb' ),
    ];

}

function crb_get_all_seasons() {
	$seasons = get_terms( [
		'taxonomy' => 'crb_season',
		'hide_empty' => false
	]);

	$result = [];
	foreach ( $seasons as $season ) {
		$result[$season->term_id] = $season->name;
	}
	return $result;
}