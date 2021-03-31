const { useState, useEffect } = wp.element;
const AddNotification = ( {streaksLabels, leagues, addNotification, setShowAddNew, showAddNew}) => {
	const [selectedLeague, setSelectedLeague] = useState([]);
	const [selectedTeam, setSelectedTeam] = useState([]);
	const [selectedNumberOfMatches, setSelectedNumberOfMatches] = useState('');
	const [selectedEvent, setSelectedEvent] = useState('');
	
	const [teams, setTeams] = useState([]);

	const loadTeams = async (event) => {
		const leagueID = event.target.value 
		const teamsResponse = await fetch (crb_theme_options.ajax_url + '?' + new URLSearchParams({
			action: 'get_league_teams_list',
			league_id: leagueID
		}),
		{
			method: 'GET'
		}
		).then(res => res.json())
		.then( data => {
			setTeams(data) 
			setSelectedLeague(leagueID)
			setSelectedTeam('any')
		})

	} 

	const saveNotification = async () => {
		const notificationResponse = await fetch (crb_theme_options.ajax_url + '?' + new URLSearchParams({
			action: 'add_user_notification',
			selectedTeam: selectedTeam,
			selectedNumberOfMatches: selectedNumberOfMatches,
			selectedEvent: selectedEvent,
			selectedLeague: selectedLeague
		}),
		{
			method: 'GET'
		}
		).then( res => res.json())
		.then( data => {
			if ( data.valid ) {
				addNotification(data.notification, data.message)
				setSelectedTeam('any');
				setSelectedLeague('any');
				setSelectedNumberOfMatches('');
				setSelectedEvent('');
			}
		})
	}

	let chooseLeagueHTML = 'Loading leagues...';
	let chooseTeamHTML = '';
	let chooseEventHTML = '';

	if ( leagues.length ) {
		chooseLeagueHTML = <p>
								<label>Choose a League</label>
								<select class="notification-leagues" onChange={loadTeams} >
									<option value="">Choose</option>
									{ leagues.map( (league) => {
										return <option value={league.term_id}>{league.name}</option> 
									  })
									}
								</select>
							</p>
	}

	if ( teams.length ) {
		chooseTeamHTML = <p>
							<label>Choose a team</label>
							<select class="notification-teams"
								multiselect 
								onChange={ (e) => setSelectedTeam( e.target.value )} 
								value={selectedTeam}
							>
								<option value="any">Any</option>
								{ teams.map( (team) => {
									return <option value={team.ID}>{team.post_title}</option> 
								  })
								}
							</select>
						</p>
	}

	if ( streaksLabels ) {
		chooseEventHTML = <p>
							<label>Choose event</label>
							<select class="number-of-matches" onChange={ (e) => setSelectedEvent(e.target.value)}>
								<option value="">Choose</option>
								{ Object.keys(streaksLabels).map( key => {
									return <option value={key}>{streaksLabels[key]}</option> 
								  })
								}
							</select>
						</p>
	}

	return (
		<div className="add-notification-section">
			{ !showAddNew ? (
				<button className="btn btn-add-new-notification" onClick={ () => {
						setShowAddNew(true)
						setTeams([]);
						setSelectedTeam('any');
						setSelectedLeague('any');
						setSelectedNumberOfMatches('');
						setSelectedEvent('');
					}}>
					Add New Notification
				</button>
			) : (
				<div>
					{chooseLeagueHTML}
					{chooseTeamHTML}
					<p>
						<label>Choose number of matches</label>
						<select class="notification-number-of-matches" onChange={ (e) => setSelectedNumberOfMatches(e.target.value) }>
							<option value="">Choose</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</p>
					{chooseEventHTML}
					{ !!selectedLeague && !!selectedTeam && !!selectedEvent && !!selectedNumberOfMatches ? (
						<div>
							<button className="btn" onClick={saveNotification}>
								Add
							</button>
							<button className="btn" onClick={ () => setShowAddNew(false)}>
								Cancel
							</button>
						</div>
					) : ''}
				</div>
			)}
		</div>
	);
}

export default AddNotification;