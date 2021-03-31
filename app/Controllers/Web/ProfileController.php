<?php
namespace App\Controllers\Web;

class ProfileController {
	function init() {
		return \WPEmerge\view( 'app/views/profile.php' );
	}

	function get_user_notifications( $user_id = false ) {
		if ( !$user_id ) {
			global $current_user;
			$user_id = $current_user->ID;
		}
		global $wpdb;
		$notifications_table = $wpdb->prefix . 'notifications';
		// Get all notifications, except the subnotifications
		$notifications = $wpdb->get_results( "SELECT * FROM $notifications_table WHERE user_id=$user_id AND parent_notification_id IS NULL" );
		if ( $notifications ) {
			foreach ( $notifications as &$notification ) {

				// If the notification is a Parent notification ( if it has subnotifications ), then add the subnotifications too
				if ( $notification->team_id == 0 ) {
					$league_term = get_term_by( 'id', $notification->league_id, 'crb_league' );
					$notification->league_name = $league_term->name;

					$subnotifications = $wpdb->get_results("SELECT * FROM $notifications_table WHERE parent_notification_id = $notification->ID" );
					$notification->sub_notifications = [];
					foreach ( $subnotifications as $subnotification ) {
						$subnotification->team_name = get_the_title( $subnotification->team_id );
						$team = new \App\Controllers\Web\TeamController();
						$team->init( $subnotification->team_id );
						$subnotification->actual_number_of_matches = $team->get_team_number_of_matches_streak( $subnotification->event );
						$notification->sub_notifications[] = $subnotification;

					}
				} else {
					$notification->team_name = get_the_title( $notification->team_id );
					$team = new \App\Controllers\Web\TeamController();
					$team->init( $notification->team_id );
					$notification->actual_number_of_matches = $team->get_team_number_of_matches_streak( $notification->event );
				}
			}
		}
		return $notifications;
	}

	function save_notification( $request) {
		global $current_user;
		global $wpdb;
		$team = $request->get('selectedTeam');
		$number_of_matches = $request->get('selectedNumberOfMatches');
		$event = $request->get('selectedEvent');
		$league = $request->get('selectedLeague');

		$notifications_table = $wpdb->prefix . 'notifications';

		if ( $team !== 'any' ) {
			// Check if the notification already exists
			$check_notification = $wpdb->get_results( "SELECT ID FROM $notifications_table 
					WHERE user_id=$current_user->ID
					AND league_id = $league
					AND team_id = $team
					AND number_of_matches = $number_of_matches
					AND event = '$event'" );

			if ( $check_notification ) {
				return [
					'notification_id' => $check_notification[0]->ID,
					'valid' => 0,
					'message' => 'This notification already exists in your list.'
				];
			}
		}

		/* 
			If the team is 'any', then add a notification with team_id = 0.
			Then add notifications for any team in the league, using the upper entry ID as parent_notification_id
		*/
		if ( $team === 'any' ) {
			$wpdb->query( "INSERT INTO $notifications_table 
				(user_id, league_id, team_id, event, number_of_matches, type)
				VALUES($current_user->ID, $league, 0, '$event', $number_of_matches, 'user') ");
			$league_object = new \App\Controllers\Web\LeagueController();
			$league_object->init( $league );
			$league_term = get_term_by( 'id', $league, 'crb_league' ); 
			
			$league_teams = $league_object->get_league_team_ids();
			$parent_notification_id = $wpdb->insert_id;

			$result = [
				'valid' => 1,
				'message' => 'The notification has been added to your list.',
				'notification' => [
					'ID' => $parent_notification_id,
					'user_id' => $current_user->ID,
					'league_id' => $league,
					'league_name' => $league_term->name, 
					'team_id'	=> 0,
					'team_name' => '',
					'event'		=> $event,
					'number_of_matches' => $number_of_matches,
					'actual_number_of_matches' => '',
					'type'		=> 'user',
					'sub_notifications' => []
				],
			];

			foreach ( $league_teams as $team ) {
				$wpdb->query( "INSERT INTO $notifications_table 
					(parent_notification_id, user_id, league_id, team_id, event, number_of_matches, type)
					VALUES($parent_notification_id, $current_user->ID, $league, $team->ID, '$event', $number_of_matches, 'user') ");
				$result['notification']['sub_notifications'][] = [
					'ID' => $wpdb->insert_id,
					'user_id' => $current_user->ID,
					'league_id' => $league,
					'team_id'	=> $team->ID,
					'team_name' => $team->team,
					'event'		=> $event,
					'number_of_matches' => $number_of_matches,
					'actual_number_of_matches' => carbon_get_post_meta( $team->ID, 'crb_matches_without_' . $event ),
					'type'		=> 'user'
				];
			}
		} else {
			// Add the notification 
			$wpdb->query( "INSERT INTO $notifications_table 
					(user_id, league_id, team_id, event, number_of_matches, type)
					VALUES($current_user->ID, $league, $team, '$event', $number_of_matches, 'user') ");
			$result = [
				'valid' => 1,
				'message' => 'The notification has been added to your list.',
				'notification' => [
					'ID' => $wpdb->insert_id,
					'user_id' => $current_user->ID,
					'league_id' => $league,
					'team_id'	=> $team,
					'team_name' => get_the_title( $team ),
					'event'		=> $event,
					'number_of_matches' => $number_of_matches,
					'actual_number_of_matches' => carbon_get_post_meta( $team, 'crb_matches_without_' . $event ),
					'type'		=> 'user'
				]
			];
		}
		return $result;
	}

	function delete_notification( $request ) {
		global $current_user;
		global $wpdb;
		$notifications_table = $wpdb->prefix . 'notifications';
		$notification_id = $request->get('notification_id');
		$is_parent = $request->get('is_parent');
		$wpdb->query("DELETE FROM $notifications_table WHERE ID = $notification_id " );

		// If a parent notification, delete the subnotifications too
		if ( $is_parent ) {
			$wpdb->query("DELETE FROM $notifications_table WHERE parent_notification_id = $notification_id" );
		}

		return [
			'valid' => 1,
			'message' => 'The notification has been properly deleted.'
		];
	}
}