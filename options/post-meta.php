<?php
use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use Carbon_Fields\Block;

// Football team meta
Container::make( 'post_meta', __( 'Football Team Options', 'crb' ) )
	->where( 'post_type', 'IN', array( 'crb_football_team' ) )
	->add_fields( [
		Field::make( 'text', 'crb_team_id', __( 'ID', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_name', __( 'Name', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_number_of_matches', __( 'Number of Matches', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_league_position', __( 'League Position', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_league_points', __( 'League Points', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_scored_goals', __( 'Scored Goals', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_conceded_goals', __( 'Conceded Goals', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_goal_difference', __( 'Goal Difference', 'crb' ) )
			->set_width(33),

		// Full time
		Field::make( 'separator', 'crb_team_fulltime_separator', __( 'FULL TIME info', 'crb' ) ),
		Field::make( 'text', 'crb_team_wins', __( 'Wins', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_draws', __( 'Draws', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_losses', __( 'Losses', 'crb' ) )
			->set_width(33),

		Field::make( 'text', 'crb_team_home_wins', __( 'Home Wins', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_home_draws', __( 'Home Draws', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_home_losses', __( 'Home Losses', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_away_wins', __( 'Away Wins', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_away_draws', __( 'Away Draws', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_away_losses', __( 'Away Losses', 'crb' ) )
			->set_width(33),

		Field::make( 'text', 'crb_team_home_points', __( 'Home Points', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_home_league_position', __( 'Home League Position', 'crb' ) )
			->set_width(50),

		Field::make( 'text', 'crb_team_home_scored_goals', __( 'Home Goals', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_home_conceded_goals', __( 'Home Conceded Goals', 'crb' ) )
			->set_width(50),

		Field::make( 'text', 'crb_team_away_points', __( 'Away Points', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_away_league_position', __( 'Away League Position', 'crb' ) )
			->set_width(50),

		Field::make( 'text', 'crb_team_away_scored_goals', __( 'Away Goals', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_away_conceded_goals', __( 'Away Conceded Goals', 'crb' ) )
			->set_width(50),

		// HT
		Field::make( 'separator', 'crb_team_ht_separator', __( 'HALF TIME info', 'crb' ) ),
		Field::make( 'text', 'crb_team_ht_wins', __( 'HT Wins', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_ht_draws', __( 'HT Draws', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_ht_losses', __( 'HT Losses', 'crb' ) )
			->set_width(33),

		Field::make( 'text', 'crb_team_home_ht_wins', __( 'Home HT Wins', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_home_ht_draws', __( 'Home HT Draws', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_home_ht_losses', __( 'Home HT Losses', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_away_ht_wins', __( 'Away HT Wins', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_away_ht_draws', __( 'Away HT Draws', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_team_away_ht_losses', __( 'Away HT Losses', 'crb' ) )
			->set_width(33),

		// Goals
		Field::make( 'separator', 'crb_team_goals_separator', __( 'GOALS info', 'crb' ) ),
		Field::make( 'text', 'crb_team_2_5_over_matches', __( '2.5+ matches', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_3_5_over_matches', __( '3.5+ matches', 'crb' ) )
			->set_width(50),	
		Field::make( 'text', 'crb_team_2_5_under_matches', __( '-2.5 matches', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_3_5_under_matches', __( '-3.5 matches', 'crb' ) )
			->set_width(50),

		Field::make( 'separator', 'crb_team_cards_separator', __( 'CARDS / CORNERS info', 'crb' ) ),
		Field::make( 'text', 'crb_team_yellow_cards', __( 'Yellow Cards', 'crb' ) )
			->set_width(25),
		Field::make( 'text', 'crb_team_red_cards', __( 'Red Cards', 'crb' ) )
			->set_width(25),
		Field::make( 'text', 'crb_team_total_cards', __( 'Total Cards', 'crb' ) )
			->set_width(25),
		Field::make( 'text', 'crb_team_cards_per_match', __( 'Cards per match', 'crb' ) )
			->set_width(25),
		Field::make( 'text', 'crb_team_corners', __( 'Corners', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_team_corners_per_match', __( 'Corners per match', 'crb' ) )
			->set_width(50),

		// Matches Series
		Field::make( 'separator', 'crb_team_matches_series_separator', __( 'Matches Series', 'crb' ) ),
		Field::make( 'text', 'crb_matches_without_victory', __( 'Without a Victory', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_draw', __( 'Without a Draw', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_loss', __( 'Without a Loss', 'crb' ) )
			->set_width(33),

		// Goals
		Field::make( 'separator', 'crb_matches_goals_series', __( 'Goals', 'crb' ) ), 
		Field::make( 'text', 'crb_matches_without_scoring', __( 'Without scoring a goal ', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_matches_without_conceding', __( 'Without conceding a goal', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_matches_without_goal_goal', __( 'Without g/g', 'crb' ) ),
		Field::make( 'text', 'crb_matches_without_over_1_5_goals', __( 'Without Over 1.5', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_over_2_5_goals', __( 'Without Over 2.5', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_over_3_5_goals', __( 'Without Over 3.5', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_under_1_5_goals', __( 'Without Under 1.5', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_under_2_5_goals', __( 'Without Under 2.5', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_under_3_5_goals', __( 'Without Under 3.5', 'crb' ) )
			->set_width(33),

		// Corners
		Field::make( 'separator', 'crb_team_corners_section', __( 'Corners', 'crb' ) ),
		Field::make( 'text', 'crb_matches_without_over_8_5_corners', __( 'Without Over 8.5 Corners', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_over_9_5_corners', __( 'Without Over 9.5 Corners', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_over_10_5_corners', __( 'Without Over 10.5 Corners', 'crb' ) )
			->set_width(33),

		Field::make( 'text', 'crb_matches_without_under_8_5_corners', __( 'Without under 8.5 Corners', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_under_9_5_corners', __( 'Without under 9.5 Corners', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_under_10_5_corners', __( 'Without under 10.5 Corners', 'crb' ) )
			->set_width(33),

		// Cards
		Field::make( 'separator', 'crb_team_cards_section', __( 'Cards', 'crb' ) ),
		Field::make( 'text', 'crb_matches_without_over_3_5_cards', __( 'Without Over 3.5 Cards', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_over_4_5_cards', __( 'Without Over 4.5 Cards', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_over_5_5_cards', __( 'Without Over 5.5 Cards', 'crb' ) )
			->set_width(33),

		Field::make( 'text', 'crb_matches_without_under_3_5_cards', __( 'Without under 3.5 Cards', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_under_4_5_cards', __( 'Without under 4.5 Cards', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_matches_without_under_5_5_cards', __( 'Without under 5.5 Cards', 'crb' ) )
			->set_width(33),

	]);

// Football Match meta
Container::make( 'post_meta', __( 'Football Match Options', 'crb' ) )
	->where( 'post_type', '=', 'crb_football_match' )
	->add_fields( [
		Field::make( 'text', 'crb_match_id', __( 'ID', 'crb' ) ),
		Field::make( 'date', 'crb_match_date', __( 'Date', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_match_hour', __( 'Staring Hour', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_match_timestamp', __( 'Timestamp', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_match_round', __( 'Round', 'crb' ) ),
		Field::make( 'select', 'crb_match_status', __( 'Status', 'crb' ) )
			->add_options([
				'NS' => 'Not Started',
				'1H' => 'First Half',
				'HT' => 'Half Time',
				'2H' => 'Second Half',
				'FT' => 'Match Finished',
				'PST' => 'Postponed',
				'TBD' => 'Time to be defined'
			]),
		Field::make( 'select', 'crb_match_home_team', __( 'Home Team', 'crb' ) )
			->add_options( call_user_func('crb_get_all_cpt_entries', 'crb_football_team' ) )
			->set_width(50),
		Field::make( 'select', 'crb_match_away_team', __( 'Away Team', 'crb' ) )
			->add_options( call_user_func('crb_get_all_cpt_entries', 'crb_football_team' ) )
			->set_width(50),

		// Goals
		Field::make( 'separator', 'crb_matches_goals_section', __( 'Goals/Score', 'crb' ) ),
		Field::make( 'text', 'crb_match_home_goals', __( 'Home Team Goals', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_match_away_goals', __( 'Away Team Goals', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_match_home_ht_goals', __( 'Home Team HT Goals', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_match_away_ht_goals', __( 'Away Team HT Goals', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_match_score', __( 'Score', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_match_ht_score', __( 'HT Score', 'crb' ) )
			->set_width(50),

		// Corners
		Field::make( 'separator', 'crb_match_corners_section', __( 'Corners', 'crb' ) ),
		Field::make( 'text', 'crb_match_corners', __( 'Corners Number', 'crb' ) ),
		Field::make( 'text', 'crb_match_home_corners', __( 'Home Team Corners Number', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_match_away_corners', __( 'Away Team Corners Number', 'crb' ) )
			->set_width(50),

		// Cards
		Field::make( 'separator', 'crb_match_cards_section', __( 'Yellow/Red Cards', 'crb' ) ),	
		Field::make( 'text', 'crb_match_cards', __( 'Cards (Yellow/Red) Number', 'crb' ) ),
		Field::make( 'text', 'crb_match_yellow_cards', __( 'Yellow Cards Number', 'crb' ) ),
		Field::make( 'text', 'crb_match_red_cards', __( 'Red Cards Number', 'crb' ) ),

		Field::make( 'text', 'crb_match_home_cards', __( 'Home Team Cards', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_match_home_yellow_cards', __( 'Home Team Yellow Cards', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_match_home_red_cards', __( 'Home Team Red Cards', 'crb' ) )
			->set_width(33),

		Field::make( 'text', 'crb_match_away_cards', __( 'Away Team Cards', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_match_away_yellow_cards', __( 'Away Team Yellow Cards', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_match_away_red_cards', __( 'Away Team Red Cards', 'crb' ) )
			->set_width(33),

		// TBD
		Field::make( 'separator', 'crb_match_goalscorers_section', __( 'Goalscorers', 'crb' ) ),	
		Field::make( 'text', 'crb_match_goalscorers', __( 'Goalscorers', 'crb' ) ),

		Field::make( 'select', 'crb_match_stats_updated', __( 'Match Stats Updated', 'crb' ) )
			->set_options([
				'no' => 'No',
				'yes' => 'Yes'
			])
			->set_default_value('no')

	]);



// Football Player meta
Container::make( 'post_meta', __( 'Football Player Options', 'crb' ) )
	->where( 'post_type', 'IN', array( 'crb_football_player' ) )
	->add_fields( [
		Field::make( 'text', 'crb_player_id', __( 'ID', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_player_name', __( 'Name', 'crb' ) )
			->set_width(33),
		Field::make( 'text', 'crb_player_nickname', __( 'Nickname', 'crb' ) )
			->set_width(33),

		Field::make( 'text', 'crb_player_position', __( 'Position', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_player_nationality', __( 'Nationality', 'crb' ) )
			->set_width(50),
		Field::make( 'association', 'crb_player_team', __( 'Team', 'crb' ) )
			->set_types([
				[
					'type' => 'post',
					'post_type' => 'crb_football_team'
				]
			])
			->set_max(1),

		Field::make( 'text', 'crb_player_matches', __( 'Matches', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_player_goals', __( 'Goals', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_player_yellow_cards', __( 'Yellow Cards', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_player_red_cards', __( 'Red Cards', 'crb' ) )
			->set_width(50),

		Field::make( 'text', 'crb_player_matches_without_goal', __( 'Matches Without Goal', 'crb' ) )
			->set_width(50),
		Field::make( 'text', 'crb_player_matches_without_card', __( 'Matches Without Yellow Card', 'crb' ) )
			->set_width(50),

	]);

// Football league meta
Container::make( 'term_meta', __( 'League Options', 'crb' ) )
	->where( 'term_taxonomy', '=', 'crb_league' )
	->add_fields( [
		Field::make( 'text', 'crb_league_id', __( 'ID', 'crb' ) )
			->help_text( 'This is an unique ID.' ),
		Field::make( 'text', 'crb_league_name', __( 'Name', 'crb' ) ),
		Field::make( 'text', 'crb_league_image', __( 'Image', 'crb' ) ),
		Field::make( 'select', 'crb_league_season', __( 'Season', 'crb' ) )
			->add_options(crb_get_all_seasons())
	]);



// // Football league meta
// Container::make( 'user_meta', __( 'User  eta', 'crb' ) )
// 	->add_fields( [
// 		Field::make( 'textarea', 'crb_user_notifications', __( 'User Notifications' ) ),
// 	]);