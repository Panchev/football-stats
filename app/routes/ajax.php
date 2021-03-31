<?php
/**
  * Web Routes.
  */
use WPEmerge\Facades\Route;

Route::get()->where( 'ajax', 'get_league_round_matches', true, true )->handle( 'AjaxController@get_league_round_matches_html' );

// Profile view ajax requests
Route::get()->where( 'ajax', 'fetch_profile_init_data', true, true )
			->handle('AjaxController@fetch_profile_init_data');

Route::get()->where( 'ajax', 'get_league_teams_list', true, true )
			->handle( 'AjaxController@get_league_teams_list' );

Route::get()->where( 'ajax', 'add_user_notification', true, true )
			->handle( 'AjaxController@add_user_notification' );


Route::post()->where( 'ajax', 'delete_user_notification', true, true )
			->handle( 'AjaxController@delete_user_notification' );


// Leagues Admin
Route::get()->where( 'ajax', 'admin_get_leagues_list', true, true )
			->handle( 'AjaxController@get_all_leagues_list' );

Route::get()->where( 'ajax', 'admin_get_league_seasons', true, true )
			->handle( 'AjaxController@get_league_seasons', true, true );

Route::get()->where( 'ajax', 'fetch_teams_by_league_id', true, true )
			->handle( 'AjaxController@fetch_teams_by_league_id', true, true );

Route::get()->where( 'ajax', 'fetch_matches_by_league_id', true, true )
			->handle( 'AjaxController@fetch_matches_by_league_id', true, true );

