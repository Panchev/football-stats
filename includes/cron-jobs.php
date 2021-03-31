<?php

// add_action( 'template_redirect', 'crb_update_teams_fixtures' );
function crb_update_teams_fixtures() {
	global $football_api;

	$url = "https://api-football-v1.p.rapidapi.com/v2/leagueTable/891";
	$league_standings = $football_api->request( $url );

	echo '<pre>';
	print_r($league_standings);
	exit();

	exit;
}