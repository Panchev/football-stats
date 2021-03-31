import React from 'react';

const LeagueSeasons = ({league}) => {

  const fetchTeams = async (season, leagueName) => {
  	const teams = await fetch( crb_theme_options.ajax_url + '?' + new URLSearchParams({
		action: 'fetch_teams_by_league_id',
		league_api_id: season.league_id,
		parent_league_id: league.term_id,
		league_name: leagueName,
		season: season.season
	}));
  	const data = await teams.json();
  }

  const fetchMatches = async (season, leagueName) => {
  	const matches = await fetch( crb_theme_options.ajax_url + '?' + new URLSearchParams({
		action: 'fetch_matches_by_league_id',
		league_api_id: season.league_id,
		parent_league_id: league.term_id,
		league_name: leagueName,
		season: season.season
	}));
  	const data = await matches.json();
  	console.log(data);
  }
  return (
    <div className="league-seasons">
    	<ul>
	    	{league.seasons.map( (season) => {
	    		
	    		let leagueName = `${season.name} ( Season ${season.season}-${season.season+1} )`;
	    		return (
	    			<li key={season.league_id}>
	    				<span>{leagueName}</span>
	    				{}
	    				<p>
	    					<button onClick={() => fetchTeams(season, leagueName) }>Fetch teams</button>
	    					<button onClick={() => fetchMatches(season, leagueName) }>Fetch matches</button>
	    				</p>
	    			</li>
	    		)
	    	})}
	    </ul>
    </div>
  )
}

export default LeagueSeasons;