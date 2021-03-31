<?php
/*
	Endpoints:

	Fixtures by team and league: https://api-football-v1.p.rapidapi.com/v2/fixtures/team/{team_id}/{league_id}
	Fixture/match info by Fixture id:  https://api-football-v1.p.rapidapi.com/v2/events/{fixture_id}
	Fixture/match stats by Fixture id: https://api-football-v1.p.rapidapi.com/v2/statistics/fixture/{fixture_id}

*/
class Crb_Import {

	public function __construct() {
		add_action( 'template_redirect', [ $this, 'import_functions' ] );
	}

	public function import_functions() {
		if ( isset( $_GET['crb_import_data'] ) ) {

			$team = new Team( $_GET['crb_import_data'], 8 );
			$team->calculate_team_stats_based_on_past_matches();
			
			// $team->import_team_fixtures();
			// $team->update_team_fixtures();

			// $league_id = $_GET['crb_import_league_data'];
			// $league = new League( $league_id );
			// $league->import_league_matches_information();

			// $team = new Team( $_GET['crb_import_data'], 8 );
			// echo '<pre>';
			// print_r($team);
			// echo '<pre>';
			
			
			exit;
		}
	}


	public function import_leagues() {
		$leagues_to_add = [ 'Premier League', 'Championship', 'Ligue 1', 'Serie A', 'Bundesliga 1', 'Eredivisie', 'Primera Division' ];
		$countries_to_add = [ 'England', 'Spain', 'France', 'Italy', 'Germany', 'Netherlands' ];
		$curl = curl_init();

		$this->curl_options[CURLOPT_URL] = "https://api-football-v1.p.rapidapi.com/v2/leagues";
		curl_setopt_array( $curl, $this->curl_options );

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ( $err ) {
			echo "cURL Error #:" . $err;
		} else {
			$leagues_info = json_decode( $response );
			// if ( $leagues_info ) {
			// 	$leagues = $leagues_info->api->leagues;
			// 	foreach ( $leagues as $league ) {
			// 		if ( in_array( $league->name, $leagues_to_add ) && $league->season == '2019' && in_array( $league->country, $countries_to_add ) ) {
			// 			echo '<br/>add: ' . $league->name . ' Season: ' . $league->season . ' Country: ' . $league->country . ' League ID: ' . $league->league_id;
			// 			$new_league_info = wp_insert_term( $league->name, 'crb_league' );

			// 			$new_league_id = $new_league_info['term_id'];

			// 			carbon_set_term_meta( $new_league_id, 'crb_league_id', $league->league_id );
			// 			carbon_set_term_meta( $new_league_id, 'crb_league_name', $league->name );
			// 			carbon_set_term_meta( $new_league_id, 'crb_league_image', $league->logo );

			// 			print_r($new_league_info);

			// 		}
			// 	}
			// }
			exit;
		}
	}


	

}

