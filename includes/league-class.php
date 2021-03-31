<?php

class League {

	public $league_api_id; // This $league is the ID of the Football API league object .
	public $league_id; // This $league is the ID of the WordPress league object .

	function __construct( $league_id ) {
		$this->league_api_id = carbon_get_term_meta( $league_id, 'crb_league_id' );
		$this->league_id = $league_id;
	}

	public function import_league_matches_information() {

		$teams = $this->get_all_league_teams();
		foreach ( $teams as $t ) {
			$team = new Team( $t->ID, $this->league_id );
			$team->import_team_fixtures();
			$team->update_team_fixtures();
			$team->calculate_team_stats_based_on_past_matches();
		}
	}

	public function get_all_league_teams() {
		$teams = get_posts([
			'post_type' => 'crb_football_team',
			'posts_per_page' => -1,
			'tax_query' => [
				[
					'taxonomy' => 'crb_league',
					'field' => 'id',
					'terms' => $this->league_id
				]
			]
		]);
		return $teams;
	}

	public function get_all_league_past_matches() {
		$matches = get_posts([
			'post_type' => 'crb_football_match',
			'posts_per_page' => -1,
			'meta_query' => [
				'relation' => 'AND',
				[
					'key' => '_crb_match_status',
					'compare' => '=',
					'value' => 'FT',
				],
				[
					[
						'key' => '_crb_match_stats_updated',
						'compare' => '=',
						'value' => 'no'
					],					
				]
			],

			'tax_query' => [
				[
					'taxonomy' => 'crb_league',
					'field' => 'id',
					'terms' => $league_object->term_id
				]
			]
		]);
		return $matches;		
	}

	/*
		
	*/
	public function get_league_standings() {
		$teams = get_posts([
			'post_type' => 'crb_football_team',
			'posts_per_page' => -1,
			'orderby'		 => 'meta_value_num',
			'meta_key'		 =>	'_crb_team_league_points',
			'tax_query'		 => [
				[
					'taxonomy' => 'crb_league',
					'field' => 'id',
					'terms' => $this->league_id
				]
			]
		]);

		/*
	Field::make( 'text', 'crb_team_number_of_matches', __( 'Number of Matches', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_league_position', __( 'League Position', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_league_points', __( 'League Points', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_scored_goals', __( 'Scored Goals', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_conceded_goals', __( 'Conceded Goals', 'crb' ) )
			->set_width(50),

		// Full time
		Field::make( 'separator', 'crb_team_fulltime_separator', __( 'FULL TIME info', 'crb' ) ),
		Field::make( 'text', 'crb_team_wins', __( 'Wins', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_draws', __( 'Draws', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_losses', __( 'Losses', 'crb' ) )
			->set_width(33),

		Field::make( 'text', 'crb_team_home_wins', __( 'Home Wins', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_home_draws', __( 'Home Draws', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_home_losses', __( 'Home Losses', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_away_wins', __( 'Away Wins', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_away_draws', __( 'Away Draws', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_away_losses', __( 'Away Losses', 'crb' ) )
			->set_width(33),
		*/

		$standings_data = [];
		foreach ( $teams as $team ) {
			$scored_goals   = carbon_get_post_meta( $team->ID, 'crb_team_scored_goals' );
			$conceded_goals = carbon_get_post_meta( $team->ID, 'crb_team_conceded_goals' );
			$goal_difference = $scored_goals - $conceded_goals;

			$team_info = [
				'id'			  => $team->ID,
				'name'			  => $team->post_title,
				'points' 		  => carbon_get_post_meta( $team->ID, 'crb_team_league_points' ),
				'scored_goals'    => $scored_goals,
				'conceded_goals'  => $conceded_goals,
				'goal_difference' => $goal_difference,
				'wins'  		  => carbon_get_post_meta( $team->ID, 'crb_team_wins' ),
				'draws'  		  => carbon_get_post_meta( $team->ID, 'crb_team_draws' ),
				'losses'  		  => carbon_get_post_meta( $team->ID, 'crb_team_losses' ),
			];
			$standings_data[] = $team_info;
		}

		return $standings_data;
	}
}