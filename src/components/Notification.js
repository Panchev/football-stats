import cx from 'classnames';

const Notification = ( { notification, deleteNotification, streaksLabels, isParent, isSubnotification } ) => {
	const {ID, team_name, event, number_of_matches, actual_number_of_matches, league_name} = notification;
	const isParentNotification = isParent ? 1 : 0;
	return <li key={ID} className={cx({
		'active' : parseInt(actual_number_of_matches) >= parseInt(number_of_matches),
		'parent-notification' : isParent,
		'sub-notification' : isSubnotification
	})}>
			<span>{isParent ? `Any In ${league_name}` : team_name}</span>
			<span>{streaksLabels[event]}</span>
			<span>{number_of_matches}</span>
			<span>{actual_number_of_matches}</span>
			<span>
				<button className="btn" onClick={() => deleteNotification(ID, isParentNotification)} >Delete</button>
				<button className="btn" onClick={ () => console.log('test') }>Modify</button>
			</span>
	</li>
}
export default Notification;