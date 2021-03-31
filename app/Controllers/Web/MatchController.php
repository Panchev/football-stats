<?php
namespace App\Controllers\Web;

class MatchController {

	public $match_api_id; // This $match_api_id is the ID of the Match in the Football API database.
	public $match_id; // This $match_id is the ID of the WordPress match object.

	public $league_api_id; // This id of the Football API league object
	public $league_id; // The term id of the WordPress league object
	public $league_name; // The name of the WordPress league term

	function init( $match_id ) {
		$this->match_api_id = carbon_get_post_meta( $match_id, 'crb_match_id' );
		$this->match_id = $match_id;

		$league_info = wp_get_post_terms( $match_id, 'crb_league' );
		if ( $league_info ) {
			$league = $league_info[0];
			$this->league_api_id = carbon_get_term_meta( $league->term_id, 'crb_league_id' );
			$this->league_id = $league->term_id;
			$this->league_name = $league->name;
		}
	}

	/*
		Get the result of the match
		- home win ( 1 )
		- draw ( x )
		- away win ( 2 )
	*/
	function get_match_result() {
		$home_team_goals = carbon_get_post_meta( $this->match_id, 'crb_match_home_goals' );
		$away_team_goals = carbon_get_post_meta( $this->match_id, 'crb_match_away_goals' );

		if ( $home_team_goals > $away_team_goals ) {
			return 1;
		} elseif ( $home_team_goals == $away_team_goals ) {
			return 'x';
		} else {
			return 2;
		}
	}


	/*
		Get the result of the match for the $team_id
		- win ( W )
		- draw ( D )
		- lose ( L )
	*/
	function get_match_result_for_team( $team_id ) {
		$home_team_id = carbon_get_post_meta( $this->match_id, 'crb_match_home_team' );
		$is_home_team = $home_team_id == $team_id ? true : false;

		$match_result = $this->get_match_result();
		if ( $match_result == 'x' ) {
			return 'X';
		} elseif ( $is_home_team ) {
			if ( $match_result == 1 ) {
				return 'W';
			} else {
				return 'L';
			}
		} else {
			if ( $match_result == 1 ) {
				return 'L';
			} else {
				return 'W';
			}
		}
	}

	/*
		Import fixture additional data:
		- corners
		- goals
		- cards
		- goalscorers
	*/
	public function update_match_additional_data() {

		$url = "https://api-football-v1.p.rapidapi.com/v2/fixtures/id/" . $this->match_api_id;
		global $football_api;

		$match_data = $football_api->request( $url );
		$match_data = $match_data->api->fixtures[0];

		$match_date = $match_data->event_date;
		$match_date = explode( 'T', $match_date );
		$match_date = $match_date[0];
		$match_status = $match_data->statusShort;

		// Status update
		carbon_set_post_meta( $this->match_id, 'crb_match_status', $match_status );


		// Check match start hour and fix it if necessary
		$match_hour = carbon_get_post_meta( $this->match_id, 'crb_match_hour' );
		if ( $match_hour == '00:00' ) {
			$updated_match_hour = date( 'H:i', $match_data->event_timestamp );
			carbon_set_post_meta( $this->match_id, 'crb_match_hour', $updated_match_hour );
		}

		/* 
			Update goals, corners, cards data only if the match has already started
		*/
		if ( $match_status !== 'NS' && $match_status !== 'PST' && $match_status !== 'TBD' ) {

			$home_team = crb_get_team_object_by_team_api_id( $match_data->homeTeam->team_id );
			$away_team = crb_get_team_object_by_team_api_id( $match_data->awayTeam->team_id );

			$home_team_id = $home_team->ID;
			$away_team_id = $away_team->ID;


			// Goals update
			$goals_home_team = $match_data->goalsHomeTeam;
			$goals_away_team = $match_data->goalsAwayTeam;
			$score_ft = $match_data->score->fulltime;

			carbon_set_post_meta( $this->match_id, 'crb_match_home_goals', $goals_home_team );
			carbon_set_post_meta( $this->match_id, 'crb_match_away_goals', $goals_away_team );
			carbon_set_post_meta( $this->match_id, 'crb_match_score', $score_ft );

			// HT goals update
			$ht_score = $match_data->score->halftime;
			$ht_modified_score = explode( '-', $ht_score );
			$home_team_ht_goals = $ht_modified_score[0];
			$away_team_ht_goals = $ht_modified_score[1];

			carbon_set_post_meta( $this->match_id, 'crb_match_home_ht_goals', $home_team_ht_goals );
			carbon_set_post_meta( $this->match_id, 'crb_match_away_ht_goals', $away_team_ht_goals );
			carbon_set_post_meta( $this->match_id, 'crb_match_ht_score', $ht_score );

			// Corners update
			$corners_info = $match_data->statistics->{'Corner Kicks'};
			$total_match_corners = $corners_info->home + $corners_info->away;
			carbon_set_post_meta( $this->match_id, 'crb_match_home_corners', $corners_info->home );
			carbon_set_post_meta( $this->match_id, 'crb_match_away_corners', $corners_info->away );
			carbon_set_post_meta( $this->match_id, 'crb_match_corners', $total_match_corners );

			// Cards update
			$yellow_cards = $match_data->statistics->{'Yellow Cards'};
			if ( !$yellow_cards ) {
				$yellow_cards = new \stdClass();
			}
			if ( !isset( $yellow_cards->home ) ) {
				$yellow_cards->home = 0;
			}

			if ( !isset( $yellow_cards->away ) ) {
				$yellow_cards->away = 0;
			}

			$total_yellow_cards = $yellow_cards->home + $yellow_cards->away;
			carbon_set_post_meta( $this->match_id, 'crb_match_yellow_cards', $total_yellow_cards );
			carbon_set_post_meta( $this->match_id, 'crb_match_home_yellow_cards', $yellow_cards->home );
			carbon_set_post_meta( $this->match_id, 'crb_match_away_yellow_cards', $yellow_cards->away );

			$red_cards = $match_data->statistics->{'Red Cards'};
			if ( !$red_cards ) {
				$red_cards = new \stdClass();
			}
			if ( !$red_cards->home || !isset( $red_cards->home ) ) {
				$red_cards->home = 0;
			}
			if ( !$red_cards->away || !isset( $red_cards->away ) ) {
				$red_cards->away = 0;
			}

			$total_red_cards = $red_cards->home + $red_cards->away;
			carbon_set_post_meta( $this->match_id, 'crb_match_red_cards', $total_red_cards );
			carbon_set_post_meta( $this->match_id, 'crb_match_home_red_cards', $red_cards->home );
			carbon_set_post_meta( $this->match_id, 'crb_match_away_red_cards', $red_cards->away );

			carbon_set_post_meta( $this->match_id, 'crb_match_cards', $total_red_cards + $total_yellow_cards );
			carbon_set_post_meta( $this->match_id, 'crb_match_home_cards', $yellow_cards->home + $red_cards->home );
			carbon_set_post_meta( $this->match_id, 'crb_match_away_cards', $yellow_cards->away + $red_cards->away );
		}
		
		if ( $match_status !== 'PST' ) {
			carbon_set_post_meta( $this->match_id, 'crb_match_stats_updated', 'yes' );
		}

	}

	public function get_match_stats() {
		$match_date = carbon_get_post_meta( $this->match_id, 'crb_match_date' );
		$match_date = date( 'F d, Y', strtotime( $match_date ) );

		$home_team_id = carbon_get_post_meta( $this->match_id, 'crb_match_home_team' );
		$away_team_id = carbon_get_post_meta( $this->match_id, 'crb_match_away_team' );

		$match_data = [
			'match_id'			 => $this->match_id,
			'match_link'		 => get_permalink( $this->match_id ),
			'date'				 => date( 'd M', strtotime( $match_date ) ),
			'status'			 => carbon_get_post_meta( $this->match_id, 'crb_match_status' ),
			'home_team_id' 		 => $home_team_id,
			'away_team_id' 		 => $away_team_id,
			'home_team_name' 	 => get_the_title( $home_team_id ),
			'away_team_name' 	 => get_the_title( $away_team_id ),
			'match_score' 		 => carbon_get_post_meta( $this->match_id, 'crb_match_score' ),
			'match_ht_score' 	 => carbon_get_post_meta( $this->match_id, 'crb_match_ht_score' ),
			// Goals
			'home_team_goals' 	 => carbon_get_post_meta( $this->match_id, 'crb_match_home_goals' ),
			'home_team_ht_goals' => carbon_get_post_meta( $this->match_id, 'crb_match_home_ht_goals' ),
			'away_team_goals' 	 => carbon_get_post_meta( $this->match_id, 'crb_match_away_goals' ),
			'away_team_ht_goals' => carbon_get_post_meta( $this->match_id, 'crb_match_away_ht_goals' ),
			// Corners
			'corners'			 => carbon_get_post_meta( $this->match_id, 'crb_match_corners' ),
			'home_corners'	   	 => carbon_get_post_meta( $this->match_id, 'crb_match_home_corners' ),
			'away_corners'		 => carbon_get_post_meta( $this->match_id, 'crb_match_away_corners' ),
			// Cards
			'cards'			  	 => carbon_get_post_meta( $this->match_id, 'crb_match_cards' ),
			'yellow_cards'	  	 => carbon_get_post_meta( $this->match_id, 'crb_match_yellow_cards' ),
			'red_cards'		  	 => carbon_get_post_meta( $this->match_id, 'crb_match_red_cards' ),
			'home_team_cards' 	 => carbon_get_post_meta( $this->match_id, 'crb_match_home_cards' ),
			'away_team_cards' 	 => carbon_get_post_meta( $this->match_id, 'crb_match_away_cards' )
		];

		return $match_data;
	}

	public static function get_structured_matches_stats( $matches ) {
		$new_matches = [];
		foreach ( $matches as $match ) {
			$match_object = new MatchController();
			$match_object->init( $match->ID );
			$match_data = $match_object->get_match_stats();
			$new_matches[] = $match_data;
		}
		return $new_matches;
	}

	public function show_match_stats( $request, $view, $match_slug ) {

		$match_id = crb_get_object_id_by_slug( $match_slug, 'crb_football_match' );
		$this->init( $match_id );
		$league = new LeagueController();
		$league->init( $this->league_id );

		$league_standings = $league->get_league_standings();
		$match_data = $this->get_match_stats();

		return \WPEmerge\view( 'app/views/match_result.php' )->with([
			'standings' => $league_standings,
			'match_data' => $match_data
		]);
	}
}