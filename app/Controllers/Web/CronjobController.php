<?php
namespace App\Controllers\Web;

class CronjobController {

	public function __construct() {
		$this->register_cronjobs();
		add_action( 'crb_update_matches_information', array( $this, 'update_matches_information' ) );

		add_action( 'crb_calculate_team_stats', array( $this, 'calculate_team_stats' ) );
		add_action( 'crb_fix_broken_fixtures', array( $this, 'fix_broken_fixtures_info' ) );

	}

	public function register_cronjobs() {
		if ( !wp_next_scheduled( 'crb_update_matches_information' ) ) {
			wp_schedule_event( time(), 'hourly', 'crb_update_matches_information' );
		}
		if ( !wp_next_scheduled( 'crb_calculate_team_stats' ) ) {
			wp_schedule_event( time(), 'daily', 'crb_calculate_team_stats' );
		}

		if ( !wp_next_scheduled( 'crb_fix_broken_fixtures' ) ) {
			wp_schedule_event( time(), 'daily', 'crb_fix_broken_fixtures' );
		}
	}

	public function fix_broken_fixtures_info() {
		global $wpdb;
		$past_matches = $wpdb->get_results("SELECT 
												m.ID, 
												m.post_title, 
												pm.meta_value AS match_time, 
												score.meta_value AS match_score, 
												date_meta.meta_value AS match_date FROM $wpdb->posts m
												INNER JOIN $wpdb->postmeta AS pm ON ( m.ID = pm.post_id AND pm.meta_key = '_crb_match_timestamp' )
												INNER JOIN $wpdb->postmeta AS score ON ( m.ID = score.post_id AND score.meta_key = '_crb_match_score' )
												INNER JOIN $wpdb->postmeta AS date_meta ON ( m.ID = date_meta.post_id AND date_meta.meta_key = '_crb_match_date' )
												WHERE m.post_type = 'crb_football_match' 
													AND pm.meta_value < UNIX_TIMESTAMP() 
													AND score.meta_value = ''
												ORDER BY pm.meta_value ASC"
		);

		if ( !$past_matches ) {
			return;
		}

		foreach ( $past_matches as $match ) {		
			$match_object = new MatchController();
			$match_object->init( $match->ID );
			$match_object->update_match_additional_data();
		}
	}

	public function update_matches_information() {
		global $wpdb;
		$matches_to_update = $wpdb->get_results("SELECT m.ID, m.post_title, pm.meta_value AS match_time FROM $wpdb->posts m
												INNER JOIN $wpdb->postmeta AS pm ON ( m.ID = pm.post_id AND pm.meta_key = '_crb_match_timestamp' )
												WHERE m.post_type = 'crb_football_match' 
													AND ( ( pm.meta_value > UNIX_TIMESTAMP() AND pm.meta_value < UNIX_TIMESTAMP() + 172800 ) 
															OR
														  ( pm.meta_value < UNIX_TIMESTAMP() AND pm.meta_value > UNIX_TIMESTAMP() - 172800 )
														)
												ORDER BY pm.meta_value ASC"
		);

		if ( !$matches_to_update ) {
			return;
		}

		foreach ( $matches_to_update as $count => $match ) {
			$match_object = new MatchController();
			$match_object->init( $match->ID );
			$match_object->update_match_additional_data();
		}
	}


	public function calculate_team_stats() {
		global $wpdb;
		$teams = $wpdb->get_results( "SELECT t.ID, t.post_title FROM $wpdb->posts t WHERE t.post_type = 'crb_football_team'" );

		foreach ( $teams as $count => $team ) {
			$team_object = new TeamController();
			$team_object->init( $team->ID );
			$team_object->calculate_team_stats_based_on_past_matches();
		}

	}

	public function index() {
		

	}

}