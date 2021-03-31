import React from 'react';
import LeagueSeasons from './LeagueSeasons';

const MainContent = ( {league, addLeagueSeasons} ) => {

  const fetchSeasons = async () => {
  	const seasons = await fetch( crb_theme_options.ajax_url + '?' + new URLSearchParams({
		action: 'admin_get_league_seasons',
		league_id: league.term_id
	}));

	const data = await seasons.json();
	if ( data ) {
		addLeagueSeasons( league.term_id, data );
	}
  }

  let showFetchSeasonsBtn = typeof(league.seasons) !== 'undefined' && !league.seasons.length;
  let hasSeasons = typeof(league.seasons) !== 'undefined' && league.seasons.length;

  return (
    <div className="admin-leagues-main-content">
    	Active league : {league.name}

    	{ typeof(league.child_leagues) !== 'undefined' ? (
	    	<ul className="child-leagues-list">
	    		{ league.child_leagues.map( (league) => {
	    			return (
	    				<li key={league.term_id}>{league.name}</li>
	    			)
	    		})}
	    	</ul>
	    ) : '' }
    	<ul className="league-actions">
    		{ showFetchSeasonsBtn ? ( <li onClick={ () => fetchSeasons() }>Fetch Available Seasons</li> ) : '' }
    	</ul>
    	{ hasSeasons ? <LeagueSeasons league={league}/> : '' }
    </div>
  )
}

export default MainContent;