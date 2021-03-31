import Notification from './Notification';
const NotificationsList = ( { notifications, deleteNotification, streaksLabels} ) => {
	return (
		<div>
			{ !notifications.length ? ( 
				<h5>Currently, you do not have any notifications. You can use the "Add New Notification" button.</h5>
			) : ( 
				<div className="profile-notifications">
					<p>You have {notifications.length} notifications</p>
					<ul className="profile-notifications-header">
						<li>Team</li>
						<li>Event</li>
						<li>Matches required</li>
						<li>Matches so far</li>
						<li></li>
					</ul>
					<ul className="profile-notifications-list">
						{ notifications.map( notification => {
							return notification.team_id != '0' ? (
									<Notification 
										streaksLabels={streaksLabels}
										notification={notification} 
										deleteNotification={deleteNotification}
									/>) : (
										<React.Fragment>
											<Notification 
												streaksLabels={streaksLabels}
												notification={notification} 
												deleteNotification={deleteNotification}
												isParent
											/>

											{notification.sub_notifications.map( subnotification => {
												return <Notification 
													streaksLabels={streaksLabels}
													notification={subnotification} 
													deleteNotification={deleteNotification}
													isSubnotification
												/>
											})}
										</React.Fragment>
									)
								
						})}
					</ul>
				</div>
			)}
		</div>
	)
}
export default NotificationsList;