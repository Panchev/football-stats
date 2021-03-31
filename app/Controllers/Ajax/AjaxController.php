<?php
namespace App\Controllers\Ajax;

class AjaxController {

	function get_league_round_matches_html( $request ) {
		$round 	   = $request->get( 'round' );
		$league_id = $request->get( 'league_id' );

		$league = new \App\Controllers\Web\LeagueController();
		$league->init( $league_id );

		$round_matches = $league->get_league_round_matches( $round );

		return \WPEmerge\view( 'app/views/fragments/league-matches.php' )->with([
			'matches' => $round_matches,
			'round'	  => $round
		]);
	}

	function fetch_profile_init_data( $request ) {
		
		$profile = new \App\Controllers\Web\ProfileController();

		$notifications = $profile->get_user_notifications();
		$leagues = \App\Controllers\Web\LeagueController::get_all_leagues();
		$labels = crb_get_team_streaks_labels_and_keys();
		return \WPEmerge\json( [
			'leagues' => $leagues,
			'streaks_labels' => $labels,
			'notifications'  => $notifications,
		]);
	}

	function get_league_teams_list( $request ) {
		$league_id = $request->get( 'league_id' );
		$league = new \App\Controllers\Web\LeagueController();
		$league->init( $league_id );
		$league_teams = $league->get_all_league_teams();
		return \WPEmerge\json( $league_teams );
	}

	function add_user_notification( $request ) {
		$profile = new \App\Controllers\Web\ProfileController();
		$result = $profile->save_notification( $request );
		return \WPEmerge\json( $result );
	}

	function delete_user_notification( $request ) {
		$profile = new \App\Controllers\Web\ProfileController();
		$result = $profile->delete_notification( $request );
		return \WPEmerge\json( $result );
	}

	/*******************************************************************************************************************
														Leagues Admin 
	*******************************************************************************************************************/
	function get_all_leagues_list( $request ) {
		$leagues = get_terms( [
			'taxonomy' => 'crb_league',
			'parent'   => 0,
			'hide_empty' => false,
		]);
		foreach ( $leagues as &$league ) {
			$league_api_id = carbon_get_term_meta( $league->term_id, 'crb_league_id' );
			$league->league_api_id = $league_api_id;
			$league->active = 0;
			$league->seasons = [];

			$child_leagues = get_terms( [
				'taxonomy' => 'crb_league',
				'parent'   => $league->term_id,
				'hide_empty' => false, 
			]);

			if ( $child_leagues ) {
				$league->child_leagues = $child_leagues;
			}
		}

		return \WPEmerge\json( $leagues );
	}

	function get_league_seasons( $request ) {
		$league_id = $request->get( 'league_id' );
		$league = new \App\Controllers\Web\LeagueController();
		$league->init( $league_id );
		$seasons = $league->get_league_seasons();
		return \WPEmerge\json( $seasons );

	}

	function fetch_teams_by_league_id( $request ) {
		$league_api_id = $request->get( 'league_api_id' );
		$parent_league_id = $request->get( 'parent_league_id' );
		$league_name = $request->get('league_name');
		$season 	 = $request->get('season');

		$league = new \App\Controllers\Web\LeagueController();
		$league->init( $parent_league_id );

		$teams = $league->fetch_all_teams_for_league_id( $league_api_id, $league_name, $season );
		return \WPEmerge\json( $teams );
	}


	function fetch_matches_by_league_id( $request ) {
		$league_api_id = $request->get( 'league_api_id' );
		$parent_league_id = $request->get( 'parent_league_id' );
		$league_name = $request->get('league_name');
		$season 	 = $request->get('season');

		$league = new \App\Controllers\Web\LeagueController();
		$league->init( $parent_league_id );

		$matches = $league->fetch_all_matches_for_league_id( $league_api_id, $league_name, $season );
		// echo '<pre>';
		// print_r($matches);
		// echo '</pre>';
		return \WPEmerge\json( $teams );
	}
}