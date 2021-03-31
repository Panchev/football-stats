<?php
namespace App\Controllers\Web;

class LeagueController {

	public $league_api_id; // This $league is the ID of the Football API league object .
	public $league_id; // This $league is the ID of the WordPress league object.

	public function init( $league_id ) {
		$this->league_api_id = carbon_get_term_meta( $league_id, 'crb_league_id' );
		$this->league_id = $league_id;

		// global $football_api;
		// echo 'league id: ' . $this->league_api_id;
		// // $league_url = "https://api-football-v1.p.rapidapi.com/v2/leagues/league/" . $this->league_api_id;
		// $league_url = "https://api-football-v1.p.rapidapi.com/v2/leagues/country/england";
		// $league_info = $football_api->request( $league_url );
		// echo '<pre>';
		// print_r($league_info);
		// echo '</pre>';
		// exit;
	}

	public static function get_all_leagues() {
		$leagues = get_terms([
			'taxonomy' => 'crb_league',
			'hide_empty' => false,
		]);
		return $leagues;
	}

	public function import_all_leagues_teams() {

		global $football_api;
		$leagues = get_terms([
			'taxonomy' => 'crb_league',
			'hide_empty' => false
		]);

		if ( !$leagues ) {
			return;
		}
		foreach ( $leagues as $count => $league ) {
			$league_id = carbon_get_term_meta( $league->term_id, 'crb_league_id' );
			if ( $league_id ) {
				$league_url = "https://api-football-v1.p.rapidapi.com/v2/teams/league/" . $league_id;
				$league_info = $football_api->request( $league_url );

				$teams = $league_info->api->teams;

				foreach ( $teams as $team ) {
					$team_id = wp_insert_post([
						'post_type' => 'crb_football_team',
						'post_title' => $team->name,
						'post_status' => 'publish',
						'post_content' => ''
					]);

					if ( !is_wp_error( $team_id ) ) {
						carbon_set_post_meta( $team_id, 'crb_team_id', $team->team_id );
						carbon_set_post_meta( $team_id, 'crb_team_name', $team->name );							
						wp_set_post_terms( $team_id, [ $league->term_id ], 'crb_league' );
					}
				}
			}
		}

	}

	public function import_league_matches_information( $league_id = false ) {

		if ( !$league_id ) {
			$league_id = $this->league_id;
		}

		$teams = $this->get_all_league_teams( $league_id );

		foreach ( $teams as $count => $t ) {

			if ( $count == 1 ) {
				break;
			}	

			echo '<br/>Updating ' . $t->post_title;
			$team = new TeamController();
			$team->init( $t->ID, $league_id );
			$team->import_team_fixtures();
			// $team->update_team_fixtures();
			// $team->calculate_team_stats_based_on_past_matches();
		}
	}


	public function get_all_league_teams( $league_id = false ) {
		if ( !$league_id ) {
			$league_id = $this->league_id;
		}
		$teams = get_posts([
			'post_type' => 'crb_football_team',
			'posts_per_page' => -1,
			'tax_query' => [
				[
					'taxonomy' => 'crb_league',
					'field' => 'id',
					'terms' => $league_id
				]
			]
		]);
		return $teams;
	}

	public function get_league_past_matches( $number_of_matches = -1 ) {

		$args = [
			'post_type' 	 => 'crb_football_match',
			'posts_per_page' => $number_of_matches,
			'orderby' 		 => 'meta_value',
			'meta_key' 		 => '_crb_match_date',
			'order'	  		 => 'DESC',
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
						'value' => 'yes'
					],					
				]
			],

			'tax_query' => [
				[
					'taxonomy' => 'crb_league',
					'field' => 'id',
					'terms' => $this->league_id
				]
			]
		];

		$matches = get_posts( $args );
		$matches = MatchController::get_structured_matches_stats( $matches );
		return $matches;		
	}


	public function get_all_league_matches() {
		$args = [
			'post_type' 	 => 'crb_football_match',
			'posts_per_page' => -1,
			'orderby' 		 => 'meta_value',
			'meta_key' 		 => '_crb_match_date',
			'order'	  		 => 'DESC',
			'tax_query' => [
				[
					'taxonomy' => 'crb_league',
					'field' => 'id',
					'terms' => $this->league_id
				]
			]
		];

		$matches = get_posts( $args );
		$matches = MatchController::get_structured_matches_stats( $matches );
		return $matches;		
	}


	public function get_league_round_matches( $round, $number_of_matches = -1 ) {
		$args = [
			'post_type' 	 => 'crb_football_match',
			'posts_per_page' => $number_of_matches,
			'orderby' 		 => 'meta_value',
			'meta_key' 		 => '_crb_match_date',
			'order'	  		 => 'DESC',
			'meta_query' => [
				'relation' => 'AND',
				[
					'key' => '_crb_match_round',
					'compare' => '=',
					'value' => $round
				],					
			],

			'tax_query' => [
				[
					'taxonomy' => 'crb_league',
					'field' => 'id',
					'terms' => $this->league_id
				]
			]
		];

		$matches = get_posts( $args );
		$matches = MatchController::get_structured_matches_stats( $matches );
		return $matches;		
	}

	/*
		Get the teams with the most streaks for different categories
		- win
		- draw
		- loss
		- g/g
		- corners
		etc.
	*/
	public function get_league_teams_ordered_by_stats( $stats ) {
		global $wpdb;
		$ordered_teams = $wpdb->get_results("
			SELECT pm.meta_value+0 AS value, 
				   pm.meta_key,
				   teams.ID, 
				   teams.post_title AS team,
				   leagues.name AS league

			FROM $wpdb->posts AS teams
			INNER JOIN $wpdb->postmeta AS pm ON ( teams.ID = pm.post_id )
			INNER JOIN $wpdb->term_relationships AS tr ON ( tr.object_id = teams.ID )
			INNER JOIN $wpdb->terms AS leagues ON ( leagues.term_id = tr.term_taxonomy_id )
			WHERE leagues.term_id = $this->league_id
				AND teams.post_type = 'crb_football_team'
				AND pm.meta_key = '$stats'
			ORDER BY value DESC
		");
		return $ordered_teams;
	}

	/*
		Return the upcoming matches of this league
		By default, return only fixture in the next 7 days.
	*/
	public function get_league_future_matches( $days = 14 ) {

		$current_date = date('Y-m-d');
		if ( $days == 'all' ) {
			$max_date = '2040-01-01';
		} else {
			$max_date = date( 'Y-m-d', strtotime( "+" . $days . ' days' ) );
		}

		$args = [
			'post_type' => 'crb_football_match',
			'posts_per_page' => -1,
			'orderby'		 => 'meta_value',
			'order'			 => 'ASC',
			'meta_key'		 => '_crb_match_timestamp',
			'meta_query' => [
				'relation' => 'AND',
				[
					'key' => '_crb_match_status',
					'compare' => '!=',
					'value' => 'FT',
				],
				[
					'relation' => 'AND',
					[
						'key' => '_crb_match_date',
						'compare' => '>',
						'value' => $current_date,
						'type'	=> 'DATE'
					],
					[
						'key' => '_crb_match_date',
						'compare' => '<',
						'value' => $max_date,
						'type'	=> 'DATE'
					],

				]
			],

			'tax_query' => [
				[
					'taxonomy' => 'crb_league',
					'field' => 'id',
					'terms' => $this->league_id
				]
			]
		];

		$matches = get_posts( $args );
		$matches = MatchController::get_structured_matches_stats( $matches );
		return $matches;		
	}

	/*
		
	*/
	public function get_league_standings( $type = 'overall' ) {

		$meta_query = [];
		$order_by = 'meta_value_num';

		if ( $type === 'corners') {
			$meta_key = '_crb_team_corners_per_match';
		} elseif ( $type === 'cards' ) {
			$meta_key = '_crb_team_cards_per_match';
		} elseif ( $type === 'overall' ) { 
			$meta_query = [
				'relation' => 'AND',
		        'meta_points' => array(
		            'key' => '_crb_team_league_points',
		            'compare' => 'EXISTS', // Optional,
		            'type' => 'NUMERIC'
		        ),
		        'meta_goal_difference' => array(
		            'key' => '_crb_team_goal_difference',
		            'compare' => 'EXISTS', // Optional
		            'type' => 'NUMERIC'
		        ), 
			];
			$meta_key = '';
			$order_by = [
				'meta_points' => 'DESC',
				'meta_goal_difference' => 'DESC'
			];
		} else {
			$meta_key = '_crb_team_' . $type . '_points';
		}

		$args = [
			'post_type' => 'crb_football_team',
			'posts_per_page' => -1,
			'orderby'		 => $order_by,
			'meta_key'		 =>	$meta_key,
			'tax_query'		 => [
				[
					'taxonomy' => 'crb_league',
					'field' => 'id',
					'terms' => $this->league_id
				]
			],
			'meta_query' => $meta_query
		];

		$teams = get_posts( $args );

		$standings_data = [];
		foreach ( $teams as $team ) {
			$team_object = new TeamController();
			$team_object->init( $team->ID );

			$team_form = $team_object->get_team_form();

			if ( $type === 'cards' ) {

				$yellow_cards = carbon_get_post_meta( $team->ID, 'crb_team_yellow_cards' );
				$red_cards 	  = carbon_get_post_meta( $team->ID, 'crb_team_red_cards' );
				$total_cards  = carbon_get_post_meta( $team->ID, 'crb_team_total_cards' );
				$cards_per_match = carbon_get_post_meta( $team->ID, 'crb_team_cards_per_match' );
				$number = carbon_get_post_meta( $team->ID, 'crb_team_number_of_matches' );
				$team_info = [
					'id'			  => $team->ID,
					'name'			  => $team->post_title,
					'number'		  => $number,
					'yellow_cards' 	  => $yellow_cards,
					'red_cards'	   	  => $red_cards,
					'total_cards'  	  => $total_cards,
					'cards_per_match' => round( $cards_per_match, 2 )
				];

			} elseif ( $type === 'corners' ) {

				$total_corners 	   = carbon_get_post_meta( $team->ID, 'crb_team_corners' );
				$corners_per_match = carbon_get_post_meta( $team->ID, 'crb_team_corners_per_match' );
				$number = carbon_get_post_meta( $team->ID, 'crb_team_number_of_matches' );
				$team_info = [
					'id'			  	=> $team->ID,
					'name'			  	=> $team->post_title,
					'number'		  	=> $number,
					'total_corners' 	=> $total_corners,
					'corners_per_match' => round( $corners_per_match, 2 )
				];

			} else { 

				if ( $type === 'overall' ) {
					$wins   = carbon_get_post_meta( $team->ID, 'crb_team_wins' );
					$draws  = carbon_get_post_meta( $team->ID, 'crb_team_draws' );
					$losses = carbon_get_post_meta( $team->ID, 'crb_team_losses' );
					$scored_goals   = carbon_get_post_meta( $team->ID, 'crb_team_scored_goals' );
					$conceded_goals = carbon_get_post_meta( $team->ID, 'crb_team_conceded_goals' );
					$number = carbon_get_post_meta( $team->ID, 'crb_team_number_of_matches' );
					$points = carbon_get_post_meta( $team->ID, 'crb_team_league_points' );
				} else {
					$wins = carbon_get_post_meta( $team->ID, 'crb_team_' . $type . '_wins' );
					$draws = carbon_get_post_meta( $team->ID, 'crb_team_' . $type . '_draws' );
					$losses = carbon_get_post_meta( $team->ID, 'crb_team_' . $type . '_losses' );
					$scored_goals   = carbon_get_post_meta( $team->ID, 'crb_team_' . $type . '_scored_goals' );
					$conceded_goals = carbon_get_post_meta( $team->ID, 'crb_team_' . $type. '_conceded_goals' );
					$points = carbon_get_post_meta( $team->ID, 'crb_team_' . $type . '_points' );
					$number = $wins + $draws + $losses;
					$team_form = '';
				}

				$goal_difference = $scored_goals - $conceded_goals;
				if ( $goal_difference > 0 ) {
					$goal_difference = '+' . $goal_difference;
				}		

				$team_info = [
					'id'			  => $team->ID,
					'name'			  => $team->post_title,
					'number'		  => $number,
					'points' 		  => $points,
					'wins'			  => $wins,
					'draws'			  => $draws,
					'losses'		  => $losses,
					'scored_goals'    => $scored_goals,
					'conceded_goals'  => $conceded_goals,
					'goal_difference' => $goal_difference,				
					'form' 			  => $team_form
				];
			}


			$standings_data[] = $team_info;


		}
		return $standings_data;
	}
  
	public function get_current_screen( $url ) {
		$words = explode( '/', $url );
		return $words[count($words) - 1];
	}



	public function show_league_stats( $request, $view, $league_slug ) {
		global $wp;
		$league = get_term_by( 'slug', $league_slug, 'crb_league' );
		$this->init( $league->term_id );
		// if ( isset( $_GET['crb_update'] ) ) {
		// 	$this->import_league_matches_information();
		// 	exit;
		// }

		$upcoming_matches = $this->get_league_future_matches();

		// Group the matches by date
		$upcoming_matches_grouped_by_date = [];
		foreach ( $upcoming_matches as $match ) {
			$upcoming_matches_grouped_by_date[$match['date']][] = $match;
		}

		$template_data = [
			'league_name' 	   => $league->name,
			'upcoming_matches' => $upcoming_matches_grouped_by_date,
		];

		$current_screen = 'standings';
		if ( isset( $wp->query_vars['page_type'] ) ) {
			$current_screen = $wp->query_vars['page_type'];
		}

		if ( $current_screen === 'standings' ) {
			
			if ( isset( $wp->query_vars['standings_type'] ) ) {
				$standings_type = $wp->query_vars['standings_type'];
				$standings = $this->get_league_standings( $standings_type );

			} else {
				$standings_type = 'overall';
				$standings = $this->get_league_standings();
			}
			$template_data['standings'] = $standings;
			$template_data['current_screen'] = 'standings';
			$template_data['standings_type'] = $standings_type;
		}

		if ( $current_screen === 'matches' ) {
			$latest_matches = $this->get_league_past_matches( 10 );
			$template_data['matches'] 		 = $latest_matches;
			$template_data['current_screen'] = 'matches';
			$template_data['league_rounds']  = crb_get_unique_meta_values( '_crb_match_round', true );
		}

		if ( $current_screen === 'consecutive-matches-data' ) {
			$consecutive_matches_data = $this->get_consecutive_matches_data_for_all_teams();
			$template_data['consecutive_matches_data'] = $consecutive_matches_data;
		}


		return \WPEmerge\view( 'app/views/league_overview.php' )->with( $template_data );

	}

	public function get_league_team_ids() {
		global $wpdb;
		$team_ids = $wpdb->get_results("
			SELECT teams.ID,
				   teams.post_title AS team
			FROM $wpdb->posts AS teams
			INNER JOIN $wpdb->term_relationships AS tr ON ( tr.object_id = teams.ID )
			INNER JOIN $wpdb->terms AS leagues ON ( leagues.term_id = tr.term_taxonomy_id )
			WHERE leagues.term_id = $this->league_id
				AND teams.post_type = 'crb_football_team'
			ORDER BY team ASC
		");
		return $team_ids;
	}

	public function get_consecutive_matches_data_for_all_teams() {
		$teams = $this->get_league_team_ids();
		foreach ( $teams as $team ) {

			$team_object = new TeamController();
			$team_object->init( $team->ID );		
			$team->matches_data = $team_object->get_team_series_data();

		}
		return $teams;
	}


	/**********************************************************************************
	 									Admin area
	/***********************************************************************************/
	
	public function get_league_seasons() {
		global $football_api;
		$seasons_url = "https://api-football-v1.p.rapidapi.com/v2/leagues/seasonsAvailable/" . $this->league_api_id;
		$seasons_info = $football_api->request( $seasons_url );

		if ( $seasons_info ) {
			$result = [];
			$seasons = $seasons_info->api->leagues;
			foreach ( $seasons as $league ) {
				$result[] = [
					'league_id' => $league->league_id,
					'name'		=> $league->name,
					'season'	=> $league->season
				];
			}
			return $result;
		} else {
			return false;
		}
	}

	public function fetch_all_teams_for_league_id( $league_api_id, $league_name, $season ) {
		global $football_api;

		/*
			Check if the season term exists. If not, add it
		*/
		$season_term = get_term_by( 'slug', $season, 'crb_season' );
		if ( $season_term ) {
			$season_id = $season_term->term_id;
		} else {
			$season_object = wp_insert_term( $season, 'crb_season', [] );
			$season_id = $season_object['term_id'];
		}

		/* 
			Check if the league term exists. If not, first add it as a child of the parent league.
		*/ 
		$subleague = get_terms( [
			'taxonomy' => 'crb_league',
			'hide_empty' => false,
			'meta_query' => [
				[
					'key' 	  => '_crb_league_id',
					'value'   => $league_api_id,
					'compare' => '='
				]
			]
		]);

		// Create the league as a term
		if ( !$subleague ) {
			// $parent_league = get_term_by( 'id', $this->league_id, 'crb_league' );
			$subleague = wp_insert_term( $league_name, 'crb_league', [
				'parent' => $this->league_id
			]);

			if ( !is_wp_error( $subleague ) ) {
				carbon_set_term_meta( $subleague['term_id'], 'crb_league_id', $league_api_id );
			}

			$subleague_id = $subleague['term_id'];
		} else {
			$subleague_id = $subleague[0]->term_id;
		}

		$teams_url = "https://api-football-v1.p.rapidapi.com/v2/teams/league/" . $league_api_id;
		$teams_info = $football_api->request( $teams_url );

		if ( $teams_info ) {			

			foreach ( $teams_info->api->teams as $count => $team ) {
				// Check if the team exists. If so
				$team_object = get_posts([
					'post_type' => 'crb_football_team',
					'meta_query' => [
						[
							'key' => '_crb_team_id',
							'value' => $team->team_id,
							'compare' => '='
						]
					]
				]);

				if ( !$team_object ) {
					$team_object_id = wp_insert_post( [
						'post_type'  => 'crb_football_team',
						'post_title' => $team->name,
						'post_content' => '',
						'post_status'  => 'publish',
						'post_name' => sanitize_title( $team->name ),
					]);
					if ( !is_wp_error( $team_object_id ) ) {

						echo '<br/>Added: ' . $team->name;
						carbon_set_post_meta( $team_object_id, 'crb_team_id', $team->team_id );
						carbon_set_post_meta( $team_object_id, 'crb_team_name', $team->name );
					}
				} else {
					$team_object_id = $team_object[0]->ID;
				}

				// Set the subleague as term
				wp_set_post_terms( $team_object_id, [$subleague_id, $this->league_id], 'crb_league', true );

				// Set the season as term
				wp_set_post_terms( $team_object_id, [$season_id], 'crb_season', true );

			}
		}

		exit('test');
	}


	public function fetch_all_matches_for_league_id( $league_api_id, $league_name, $season ) {
		global $football_api;

		/*
			Check if the season term exists. If not, add it
		*/
		$season_term = get_term_by( 'slug', $season, 'crb_season' );
		if ( $season_term ) {
			$season_id = $season_term->term_id;
		} else {
			$season_object = wp_insert_term( $season, 'crb_season', [] );
			$season_id = $season_object['term_id'];
		}

		/* 
			Check if the league term exists. If not, first add it as a child of the parent league.
		*/ 
		$subleague = get_terms( [
			'taxonomy' => 'crb_league',
			'hide_empty' => false,
			'meta_query' => [
				[
					'key' 	  => '_crb_league_id',
					'value'   => $league_api_id,
					'compare' => '='
				]
			]
		]);

		// Create the league as a term
		if ( !$subleague ) {
			// $parent_league = get_term_by( 'id', $this->league_id, 'crb_league' );
			$subleague = wp_insert_term( $league_name, 'crb_league', [
				'parent' => $this->league_id
			]);

			if ( !is_wp_error( $subleague ) ) {
				carbon_set_term_meta( $subleague['term_id'], 'crb_league_id', $league_api_id );
			}

			$subleague_id = $subleague['term_id'];
		} else {
			$subleague_id = $subleague[0]->term_id;
		}


		echo 'subleague id: ' . $subleague_id;
		$this->import_league_matches_information( $subleague_id );
		exit;
		// $fixtures_url = "https://api-football-v1.p.rapidapi.com/v2/fixtures/league/" . $league_api_id;

		// echo $fixtures_url;


		// $fixtures_info = $football_api->request( $fixtures_url );


		echo '<pre>';
		print_r($fixtures_info);
		echo '</pre>';
		exit;


		// if ( $teams_info ) {			

		// 	foreach ( $teams_info->api->teams as $count => $team ) {
		// 		// Check if the team exists. If so
		// 		$team_object = get_posts([
		// 			'post_type' => 'crb_football_team',
		// 			'meta_query' => [
		// 				[
		// 					'key' => '_crb_team_id',
		// 					'value' => $team->team_id,
		// 					'compare' => '='
		// 				]
		// 			]
		// 		]);

		// 		if ( !$team_object ) {
		// 			$team_object_id = wp_insert_post( [
		// 				'post_type'  => 'crb_football_team',
		// 				'post_title' => $team->name,
		// 				'post_content' => '',
		// 				'post_status'  => 'publish',
		// 				'post_name' => sanitize_title( $team->name ),
		// 			]);
		// 			if ( !is_wp_error( $team_object_id ) ) {

		// 				echo '<br/>Added: ' . $team->name;
		// 				carbon_set_post_meta( $team_object_id, 'crb_team_id', $team->team_id );
		// 				carbon_set_post_meta( $team_object_id, 'crb_team_name', $team->name );
		// 			}
		// 		} else {
		// 			$team_object_id = $team_object[0]->ID;
		// 		}

		// 		// Set the subleague as term
		// 		wp_set_post_terms( $team_object_id, [$subleague_id, $this->league_id], 'crb_league', true );

		// 		// Set the season as term
		// 		wp_set_post_terms( $team_object_id, [$season_id], 'crb_season', true );

		// 	}
		// }

		exit('test');
	}
}