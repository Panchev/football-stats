<?php

class Team {

	public $team_id; // This $team_id is the ID of the WordPress team object .
	public $team_api_id; // This $team_id is the ID of team in the Football API database
	
	public $league_api_id; // This id of the Football API league object
	public $league_id; // The term id of the WordPress league object

	function __construct( $team_id, $league_id = null ) {
		$this->team_api_id = carbon_get_post_meta( $team_id, 'crb_team_id' );
		$this->team_id = $team_id;

		$league_info = wp_get_post_terms( $team_id, 'crb_league' );
		if ( $league_info ) {
			$league = $league_info[0];
			$this->league_api_id = carbon_get_term_meta( $league->term_id, 'crb_league_id' );
			$this->league_id = $league->term_id;
		}
	}

	/*
		Update the additional data for all imported fixtures of this team
	*/
	public function update_team_fixtures() {
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
				],

				[
					'relation' => 'OR',
					[
						'key' => '_crb_match_home_team',
						'compare' => '=',
						'value' => $this->team_id,
					],
					[
						'key' => '_crb_match_away_team',
						'compare' => '=',
						'value' => $this->team_id,
					]
				]
			],

			'tax_query' => [
				[
					'taxonomy' => 'crb_league',
					'field' => 'id',
					'terms' => $this->league_id
				]
			]
		]);

		foreach ( $matches as $match_object ) {
			$match = new CrbMatch( $match_object->ID );
			$match->update_match_additional_data();
		}

	}

	public function import_team_fixtures() {
		
		$url = "https://api-football-v1.p.rapidapi.com/v2/fixtures/team/" . $this->team_api_id . '/' . $this->league_api_id;

		global $football_api;
		$team_fixtures = $football_api->request( $url );

		$fixtures = $team_fixtures->api->fixtures;

		// Add all fixtures ( matches ) to the databases
		foreach ( $fixtures as $count => $fixture ) {
			usleep( 150000 );
			$match_api_id = $fixture->fixture_id;

			// Check if the fixture is not already in the database. If so, do not add it again.
			$match_exists = crb_get_match_object_by_fixture_api_id( $match_api_id );
			if ( $match_exists ) {
				echo '<br/>Match exists: ' . $match_api_id;
				continue;
			}
			$match_date = $fixture->event_date;
			$match_date = explode( 'T', $match_date );
			$match_date = $match_date[0];
			$match_status = $fixture->statusShort;

			$home_team = crb_get_team_object_by_team_api_id( $fixture->homeTeam->team_id );
			$away_team = crb_get_team_object_by_team_api_id( $fixture->awayTeam->team_id );

			$goals_home_team = $fixture->goalsHomeTeam;
			$goals_away_team = $fixture->goalsAwayTeam;

			$score_ft = $fixture->score->fulltime;



			$home_team_id = $home_team->ID;
			$away_team_id = $away_team->ID;

			$home_team_name = $home_team->post_title;
			$away_team_name = $away_team->post_title;			

			$match_id = wp_insert_post( [
				'post_type'   => 'crb_football_match',
				'post_status' => 'publish',
				'post_title'  => $home_team_name . ' - ' . $away_team_name,
				'post_content' => ''
			]);				

			if ( !is_wp_error( $match_id ) ) {

				// set the league of the match
				wp_set_post_terms( $match_id, [ $this->league_id ], 'crb_league' );
				carbon_set_post_meta( $match_id, 'crb_match_stats_updated', 'no' );
				carbon_set_post_meta( $match_id, 'crb_match_status', $match_status );

				carbon_set_post_meta( $match_id, 'crb_match_id', $match_api_id );
				carbon_set_post_meta( $match_id, 'crb_match_date', $match_date );
				carbon_set_post_meta( $match_id, 'crb_match_status', $match_status );
				carbon_set_post_meta( $match_id, 'crb_match_home_team', $home_team_id );
				carbon_set_post_meta( $match_id, 'crb_match_away_team', $away_team_id );
				carbon_set_post_meta( $match_id, 'crb_match_home_goals', $goals_home_team );
				carbon_set_post_meta( $match_id, 'crb_match_away_goals', $goals_away_team );
				carbon_set_post_meta( $match_id, 'crb_match_score', $score_ft );

			}
		}
	}

	public function get_past_fixtures() {
		$team_fixtures = new WP_Query([
			'posts_per_page' => -1,
			'post_type' => 'crb_football_match',
			'meta_query' => [
				'relation' => 'AND',
				[
					[
						'key' 	  => '_crb_match_stats_updated',
						'value'   => 'yes',
						'compare' => '='
					],
					[
						'relation' => 'OR',
						[
							'key' 	  => '_crb_match_home_team',
							'value'   => $this->team_id,
							'compare' => '='
						],
						[
							'key' 	  => '_crb_match_away_team',
							'value'   => $this->team_id,
							'compare' => '='
						]
					]
				]
			]
		]);

		return $team_fixtures;

	}

	public function calculate_team_stats_based_on_past_matches() {

		$team_fixtures = $this->get_past_fixtures();
		
		$number_of_matches = 0;
		$league_points     = 0;
		$scored_goals 	   = 0;
		$conceded_goals    = 0;
		$corners_number    = 0;
		$cards_number 	   = 0;
		$yellow_cards_number = 0;
		$red_cards_number    = 0;

		$wins = [
			'home' => 0,
			'away' => 0,
			'home_ht' => 0,
			'away_ht' => 0
		];
		$draws = [
			'home' => 0,
			'away' => 0,
			'home_ht' => 0,
			'away_ht' => 0
		];

		$losses = [
			'home' => 0,
			'away' => 0,
			'home_ht' => 0,
			'away_ht' => 0
		];

		$goals_info = [
			'2.5+' => 0,
			'2.5-' => 0,
			'3.5+' => 0,
			'3.5-' => 0,
		];

		// Series data
		$no_win = 0;
		$no_draw = 0;
		$no_loss = 0;

		$no_goal_goal = 0;
		$no_scored_goal = 0;
		$no_conceded_goal = 0;

		$no_under_goals = [ 
			'1_5' => 0,
			'2_5' => 0, 
			'3_5' => 0 
		];

		$no_over_goals = [ 
			'1_5' => 0,
			'2_5' => 0, 
			'3_5' => 0 
		];

		$no_over_corners = [
			'8_5' => 0,
			'9_5' => 0,
			'10_5'=> 0
		];

		$no_under_corners = [
			'8_5' => 0,
			'9_5' => 0,
			'10_5'=> 0
		];

		$no_over_cards = [
			'3_5' => 0,
			'4_5' => 0,
			'5_5' => 0,
		];

		$no_under_cards = [
			'3_5' => 0,
			'4_5' => 0,
			'5_5' => 0,
		];

		while ( $team_fixtures->have_posts() ) {
			$team_fixtures->the_post();

			$is_home_team = true;

			$home_team_id = carbon_get_the_post_meta( 'crb_match_home_team' );
			$away_team_id = carbon_get_the_post_meta( 'crb_match_away_team' );

			$score = carbon_get_the_post_meta( 'crb_match_score' );

			if ( $home_team_id != $this->team_id ) {
				$is_home_team = false;
			}

			$number_of_matches++;

			$match_home_goals = carbon_get_the_post_meta( 'crb_match_home_goals' );
			$match_away_goals = carbon_get_the_post_meta( 'crb_match_away_goals' );

			$match_home_ht_goals = carbon_get_the_post_meta( 'crb_match_home_ht_goals' );
			$match_away_ht_goals = carbon_get_the_post_meta( 'crb_match_away_ht_goals' );

			$match_total_goals = $match_home_goals + $match_away_goals;
			
			// HT/FT result
			if ( $is_home_team ) {

				// If the team is at home
				$scored_goals += $match_home_goals;
				$conceded_goals += $match_away_goals;			

				$team_scored_goals = $match_home_goals;
				$team_conceded_goals = $match_away_goals;	

				// FT
				if ( $match_home_goals > $match_away_goals ) {
					$wins['home']++;
					$league_points += 3;
					$no_win = 0;
					$no_draw++;
					$no_loss++;
				} elseif ( $match_home_goals == $match_away_goals ) {
					$draws['home']++;
					$league_points += 1;
					$no_draw = 0;
					$no_win++;
					$no_loss++;
				} else {
					$losses['home']++;
					$no_loss = 0;
					$no_draw++;
					$no_win++;
				}

				// HT
				if ( $match_home_ht_goals > $match_away_ht_goals ) {
					$wins['home_ht']++;
				} elseif ( $match_home_ht_goals == $match_away_ht_goals ) {
					$draws['home_ht']++;
				} else {
					$losses['home_ht']++;
				}
			} else {
				// If the team is a guest

				$scored_goals += $match_away_goals;
				$conceded_goals += $match_home_goals;

				$team_scored_goals = $match_away_goals;
				$team_conceded_goals = $match_home_goals;	

				// FT
				if ( $match_away_goals > $match_home_goals ) {
					$wins['away']++;
					$league_points += 3;
					$no_win = 0;
					$no_draw++;
					$no_loss++;
				} elseif ( $match_home_goals == $match_away_goals ) {
					$draws['away']++;
					$league_points += 1;
					$no_draw = 0;
					$no_win++;
					$no_loss++;
				} else {
					$losses['away']++;
					$no_loss = 0;
					$no_draw++;
					$no_win++;
				}

				// HT
				if ( $match_away_ht_goals > $match_home_ht_goals ) {
					$wins['away_ht']++;
				} elseif ( $match_home_ht_goals == $match_away_ht_goals ) {
					$draws['away_ht']++;
				} else {
					$losses['away_ht']++;
				}
			}

			echo '<br/>conceded goals: ' . $team_conceded_goals;

			if ( $team_scored_goals == 0 ) {
				$no_scored_goal++;
			} else {
				$no_scored_goal = 0;
			}

			if ( $team_conceded_goals == 0 ) {
				$no_conceded_goal++;
			} else {
				$no_conceded_goal = 0;
			}

			// Total goals number
			if ( $match_total_goals > 2 ) {

				$no_under_goals['1_5']++;
				$no_under_goals['2_5']++;

				$no_over_goals['2_5'] = 0;
				$no_over_goals['1_5'] = 0;

				$goals_info['2.5+']++;
				if ( $match_total_goals > 3 ) {
					$no_under_goals['3_5']++;
					$no_over_goals['3_5'] = 0;
					$goals_info['3.5+']++;
				} else { // 3 goals
					$goals_info['3.5-']++;

					$no_under_goals['3_5'] = 0;
					$no_over_goals['3_5']++;

				}
			} else {
				$goals_info['2.5-']++;
				$goals_info['3.5-']++;

				$no_over_goals['3_5']++;
				$no_over_goals['2_5']++;

				$no_under_goals['3_5'] = 0;
				$no_under_goals['2_5'] = 0;

				if ( $match_total_goals === 2 ) {
					$no_over_goals['1_5'] = 0;
					$no_under_goals['1_5']++;
					
				} else { // 1 or 0 goals
					$no_over_goals['1_5']++;
					$no_under_goals['1_5'] = 0;
				}
			}

			// Corners number
			$corners = carbon_get_the_post_meta( 'crb_match_corners' );
			$corners_number += $corners;

			if ( $corners < 9 ) {

				$no_under_corners['8_5'] = 0;
				$no_under_corners['9_5'] = 0;
				$no_under_corners['10_5'] = 0;

				$no_over_corners['8_5']++;
				$no_over_corners['9_5']++;
				$no_over_corners['10_5']++;

			} elseif ( $corners == 9 ) {

				$no_under_corners['8_5']++;
				$no_under_corners['9_5'] = 0;
				$no_under_corners['10_5'] = 0;

				$no_over_corners['8_5'] = 0;
				$no_over_corners['9_5']++;
				$no_over_corners['10_5']++;

			} elseif ( $corners == 10 ) {

				$no_under_corners['8_5']++;
				$no_under_corners['9_5']++;
				$no_under_corners['10_5'] = 0;

				$no_over_corners['8_5'] = 0;
				$no_over_corners['9_5'] = 0;
				$no_over_corners['10_5']++;
				
			}  else { // 10.5+ corners
				$no_under_corners['8_5']++;
				$no_under_corners['9_5']++;
				$no_under_corners['10_5']++;

				$no_over_corners['8_5'] = 0;
				$no_over_corners['9_5'] = 0;
				$no_over_corners['10_5'] = 0;
			}

			// Cards

			$yellow_cards = carbon_get_the_post_meta( 'crb_match_yellow_cards' );
			$red_cards    = carbon_get_the_post_meta( 'crb_match_red_cards' );
			$cards 		  = carbon_get_the_post_meta( 'crb_match_cards' ); 

			$yellow_cards_number += $yellow_cards;
			$red_cards_number 	 += $red_cards;
			$cards_number 		 += $cards;


			echo '<br/>' . get_the_title( $home_team_id ) . ' ' . $match_home_goals . ':' . $match_away_goals . ' ' . get_the_title( $away_team_id );
			echo '<br/> Corners: '. $corners;
			echo '<br/> Cards: '. $cards;
			echo '<br/><br/><br/>';


			if ( $cards < 4 ) {

				$no_under_cards['3_5'] = 0;
				$no_under_cards['4_5'] = 0;
				$no_under_cards['5_5'] = 0;

				$no_over_cards['3_5']++;
				$no_over_cards['4_5']++;
				$no_over_cards['5_5']++;

			} elseif ( $cards < 5 ) {

				$no_under_cards['3_5']++;
				$no_under_cards['4_5'] = 0;
				$no_under_cards['5_5'] = 0;

				$no_over_cards['3_5'] = 0;
				$no_over_cards['4_5']++;
				$no_over_cards['5_5']++;

			} elseif ( $cards < 6 ) {

				$no_under_cards['3_5']++;
				$no_under_cards['4_5']++;
				$no_under_cards['5_5'] = 0;

				$no_over_cards['3_5'] = 0;
				$no_over_cards['4_5'] = 0;
				$no_over_cards['5_5']++;

			} else { // 5.5+ cards

				$no_under_cards['3_5']++;
				$no_under_cards['4_5']++;
				$no_under_cards['5_5']++;

				$no_over_cards['3_5'] = 0;
				$no_over_cards['4_5'] = 0;
				$no_over_cards['5_5'] = 0;

			}

		}

		$total_wins = $wins['home'] + $wins['away'];
		$total_draws = $draws['home'] + $draws['away'];
		$total_losses = $losses['home'] + $losses['away'];

		$total_ht_wins = $wins['home_ht'] + $wins['away_ht'];
		$total_ht_draws = $draws['home_ht'] + $draws['away_ht'];
		$total_ht_losses = $losses['home_ht'] + $losses['away_ht'];


		carbon_set_post_meta( $this->team_id, 'crb_team_number_of_matches', $number_of_matches );
		carbon_set_post_meta( $this->team_id, 'crb_team_league_points', $league_points );
		carbon_set_post_meta( $this->team_id, 'crb_team_scored_goals', $scored_goals );
		carbon_set_post_meta( $this->team_id, 'crb_team_conceded_goals', $conceded_goals );

		// FT results update
		carbon_set_post_meta( $this->team_id, 'crb_team_wins', $total_wins );
		carbon_set_post_meta( $this->team_id, 'crb_team_draws', $total_draws );
		carbon_set_post_meta( $this->team_id, 'crb_team_losses', $total_losses );
		carbon_set_post_meta( $this->team_id, 'crb_team_ht_wins', $total_ht_wins );
		carbon_set_post_meta( $this->team_id, 'crb_team_ht_losses', $total_ht_losses );
		carbon_set_post_meta( $this->team_id, 'crb_team_ht_draws', $total_ht_draws );

		// HT results update
		foreach ( [ $wins, $draws, $losses] as $count => $result ) {
			if ( !$count ) {
				$result_type = 'wins';
			} elseif ( $count == 1 ) {
				$result_type = 'draws';
			} else {
				$result_type = 'losses';
			}
			foreach ( $result as $key => $res ) {
				carbon_set_post_meta( $this->team_id, 'crb_team_' . $key . '_' . $result_type, $res );
			}
		}

		// Goals update
		carbon_set_post_meta( $this->team_id, 'crb_team_2_5_over_matches', $goals_info['2.5+'] ); 
		carbon_set_post_meta( $this->team_id, 'crb_team_3_5_over_matches', $goals_info['3.5+'] ); 
		carbon_set_post_meta( $this->team_id, 'crb_team_2_5_under_matches', $goals_info['2.5-'] ); 
		carbon_set_post_meta( $this->team_id, 'crb_team_3_5_under_matches', $goals_info['3.5-'] ); 

		// Corners / Cards update
		carbon_set_post_meta( $this->team_id, 'crb_team_yellow_cards', $yellow_cards_number );
		carbon_set_post_meta( $this->team_id, 'crb_team_red_cards', $red_cards_number );
		carbon_set_post_meta( $this->team_id, 'crb_team_total_cards', $cards_number );
		carbon_set_post_meta( $this->team_id, 'crb_team_cards_per_match', $cards_number / $number_of_matches );

		carbon_set_post_meta( $this->team_id, 'crb_team_corners', $corners_number );
		carbon_set_post_meta( $this->team_id, 'crb_team_corners_per_match', $corners_number / $number_of_matches );

		// Update series

		// FT result series
		carbon_set_post_meta( $this->team_id, 'crb_matches_without_victory', $no_win );
		carbon_set_post_meta( $this->team_id, 'crb_matches_without_draw', $no_draw );
		carbon_set_post_meta( $this->team_id, 'crb_matches_without_loss', $no_loss );

		carbon_set_post_meta( $this->team_id, 'crb_matches_without_scoring', $no_scored_goal );
		carbon_set_post_meta( $this->team_id, 'crb_matches_without_conceding', $no_conceded_goal );

		$stats = [
			'goals' => [
				'under' => $no_under_goals,
				'over'	=> $no_over_goals
			],
			'corners' => [
				'under' => $no_under_corners,
				'over'	=> $no_over_corners
			],
			'cards' => [
				'under' => $no_under_cards,
				'over'	=> $no_over_cards
			],
		];

		// Update goals, cards and corners series post meta
		foreach ( $stats as $key => $stats_data ) {
			foreach ( $stats_data as $over_or_under => $stats_array ) {
				foreach( $stats_array as $stat_key => $value ) {
					$option_key = 'crb_matches_without_' . $over_or_under . '_' . $stat_key . '_' . $key;
					// echo '<br/>update: ' . $option_key . ', value: ' . $value . ', post id: ' . $this->team_id;
					carbon_set_post_meta( $this->team_id, $option_key, $value );
				}
			}
		}
		wp_reset_query();
	}

	function get_team_meta( $key ) {
		return carbon_get_post_meta( $this->$team_id, 'crb_' . $key );
	}

	/**
	*	Get the fixture ( Matches ) of a match.
	*	@past - If true, then return all past fixtures. If false, then return all future fixtures
	*/
	function get_team_fixtures( $past = false ) {
		if ( $past ) {
			$compare = '=';
		} else {
			$compare = '!=';
		}
		$fixtures_args = [
			'post_type' 	 => 'crb_football_match',
			'posts_per_page' => -1,
			'meta_query'	 => [
				[
					'key'     => '_crb_match_status',
					'value'   => 'FT',
					'compare' => $compare
				],
				[
					'relation' => 'OR',
					[
						'key' => '_crb_match_home_team',
						'compare' => '=',
						'value' => $this->team_id,
					],
					[
						'key' => '_crb_match_away_team',
						'compare' => '=',
						'value' => $this->team_id,
					]
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

		$fixtures = get_posts( $fixtures_args );
		echo '<pre>';
		print_r($fixtures);
		exit;
	}
}