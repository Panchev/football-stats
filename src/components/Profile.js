const { useState, useEffect } = wp.element;
import AddNotification from './AddNotification';
import NotificationsList from './NotificationsList';

const Profile = () => {

	const [notifications, setNotifications] = useState([]);
	const [leagues, setLeagues] = useState([])
	const [streaksLabels, setStreaksLabels] = useState([]);
	const [message, setMessage] = useState(false);
	const [showAddNew, setShowAddNew] = useState(false)

	useEffect( async () => {
		const response = await fetch(crb_theme_options.ajax_url + '?' + new URLSearchParams({
			action: 'fetch_profile_init_data'
		}), 
		{
			method: 'GET',
		}
		).then(res => res.json())
		.then( data => {
			setLeagues(data.leagues);
			setStreaksLabels(data.streaks_labels);
			setNotifications(data.notifications);
		})
	}, []);

	const deleteNotification = async(id, isParentNotification) => {
		const response = await fetch(crb_theme_options.ajax_url + '?' + new URLSearchParams({
			action: 'delete_user_notification',
			notification_id: id,
			is_parent: isParentNotification
		}), 
		{
			method: 'POST',
		}
		).then(res => res.json())
		.then( data => {
			if ( data.valid ) {
				let newNotifications = notifications.filter( notification => notification.ID != id );
				setNotifications(newNotifications)
			}

			showMessage(data.message);
		})
	}

	const addNotification = (notification, message) => {
		const newNotifications = [...notifications, notification];

		console.log(notification);
		console.log(newNotifications);

		setNotifications(newNotifications)
		showMessage(message);
		setShowAddNew(false)
	}

	const showMessage = (message) => {
		setMessage(message);
		setTimeout(() => {
			setMessage(false)
		}, 1500)
	} 

	return (
		<div class="profile-content">
			<h2>Profile</h2>
			{ !!message ? <p className="notification-message">{message}</p> : '' }
			<NotificationsList 
				streaksLabels={streaksLabels} 
				notifications={notifications} 
				deleteNotification={deleteNotification}
			/>

			<AddNotification 
				streaksLabels={streaksLabels} 
				leagues={leagues} 
				addNotification={addNotification} 
				setShowAddNew={setShowAddNew} 
				showAddNew={showAddNew}
			/>
		</div>
	);
}

export default Profile;