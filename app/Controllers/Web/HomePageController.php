<?php
namespace App\Controllers\Web;

class HomePageController {

	public function index() {

		$leagues = LeagueController::get_all_leagues();
		$leagues_info = [];

		foreach ( $leagues as &$league ) {
			$league_object = new LeagueController();
			$league_object->init( $league->term_id );

			// Get the matches from the last 10 days 
			$latest_matches = $league_object->get_league_past_matches( 10 );

			// Get the future matches in the next 10 days
			$upcoming_matches = $league_object->get_league_future_matches( 10 );

			$league->latest_matches = $latest_matches;
			$league->upcoming_matches = $upcoming_matches;
		}
		
		/*	
			For each league, 
		*/	
		$upcoming_matches = [];

		foreach ( $leagues as $l ) {
			$league_object = new LeagueController( $l->term_id );
			$league_matches = $league_object->get_league_future_matches();
			if ( $league_matches ) {
				$upcoming_matches = array_merge( $upcoming_matches, $league_matches );
			}
		}

		return \WPEmerge\view( 'app/views/homepage.php' )->with([
			'upcoming_matches' => $upcoming_matches,
			'leagues' => $leagues
		]);
	}
}