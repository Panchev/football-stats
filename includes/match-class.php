<?php
class CrbMatch {
	public $match_api_id; // This $match_api_id is the ID of the Match in the Football API database.
	public $match_id; // This $match_id is the ID of the WordPress match object .

	public function __construct( $match_id ) {
		$this->match_api_id = carbon_get_post_meta( $match_id, 'crb_match_id' );
		$this->match_id = $match_id;
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

		$goals_home_team = $match_data->goalsHomeTeam;
		$goals_away_team = $match_data->goalsAwayTeam;

		$score_ft = $match_data->score->fulltime;

		$home_team = crb_get_team_object_by_team_api_id( $match_data->homeTeam->team_id );
		$away_team = crb_get_team_object_by_team_api_id( $match_data->awayTeam->team_id );

		$home_team_id = $home_team->ID;
		$away_team_id = $away_team->ID;

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
		$total_yellow_cards = $yellow_cards->home + $yellow_cards->away;
		carbon_set_post_meta( $this->match_id, 'crb_match_yellow_cards', $total_yellow_cards );
		carbon_set_post_meta( $this->match_id, 'crb_match_home_yellow_cards', $yellow_cards->home );
		carbon_set_post_meta( $this->match_id, 'crb_match_away_yellow_cards', $yellow_cards->away );

		$red_cards = $match_data->statistics->{'Red Cards'};
		if ( !$red_cards->home ) {
			$red_cards->home = 0;
		}
		if ( !$red_cards->away ) {
			$red_cards->away = 0;
		}

		$total_red_cards = $red_cards->home + $red_cards->away;
		carbon_set_post_meta( $this->match_id, 'crb_match_red_cards', $total_red_cards );
		carbon_set_post_meta( $this->match_id, 'crb_match_home_red_cards', $red_cards->home );
		carbon_set_post_meta( $this->match_id, 'crb_match_away_red_cards', $red_cards->away );

		carbon_set_post_meta( $this->match_id, 'crb_match_cards', $total_red_cards + $total_yellow_cards );
		carbon_set_post_meta( $this->match_id, 'crb_match_home_cards', $yellow_cards->home + $red_cards->home );
		carbon_set_post_meta( $this->match_id, 'crb_match_away_cards', $yellow_cards->away + $red_cards->away );
		
		carbon_set_post_meta( $this->match_id, 'crb_match_stats_updated', 'yes' );
	}
}