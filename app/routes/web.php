<?php

/**
  * Web Routes.
  */

use WPEmerge\Facades\Route;

Route::get()->url( '/' )->handle( 'App\Controllers\Web\HomePageController@index' );

// League View
Route::get()->url( '/league/{league_slug}' )->handle( 'LeagueController@show_league_stats' );
Route::get()->url( '/league/{league_slug}/matches' )->handle( 'LeagueController@show_league_stats' );
Route::get()->url( '/league/{league_slug}/consecutive-matches-data' )->handle( 'LeagueController@show_league_stats' );
Route::get()->url( '/league/{league_slug}/standings/{home_away}' )->handle( 'LeagueController@show_league_stats' );
Route::get()->url( '/profile' )->handle( 'ProfileController@init' );
Route::get()->url( '/fix' )->handle( 'FixController@init' );

// Match Views
Route::get()->url( '/match/{match_id}' )->handle( 'MatchController@show_match_stats' );

// Team View
Route::get()->url( '/team/{team_id}' )->handle( 'TeamController@show_team_overview' );

