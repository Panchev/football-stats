import React, {useEffect, useState} from 'react';
import LeaguesLeftMenu from './LeaguesLeftMenu';
import MainContent from './MainContent';

const LeaguesApp = (props) => {
  const [leagues, setLeagues] = useState([]);
  const [activeLeague, setActiveLeague] = useState(false);

  useEffect( () => {
  	fetchLeagues();
  }, []);

  const fetchLeagues = async () => {
  	const result = await fetch( crb_theme_options.ajax_url + '?' + new URLSearchParams({
		action: 'admin_get_leagues_list',
	}));
  	const data = await result.json();
  	setLeagues(data);
  }

  const changeActiveLeague = (id) => {
  	const newLeagues = leagues.map( (league) => {
  		league.active = league.term_id == id ? 1 : 0;
  		if ( league.active ) {
  			setActiveLeague(league)
  		}
  		return league;
  	});
  }

  const addLeagueSeasons = (league_id, seasons) => {
  	const newLeagues = leagues.map( (league) => {
  		if ( league.term_id == league_id ) {
  			league.seasons = seasons;
  		}
  		return league;
  	})
  	setLeagues(newLeagues)
  }
  
  return (
    <div className="admin-leagues">
    	<LeaguesLeftMenu leagues={leagues} changeActiveLeague={changeActiveLeague} />
    	<MainContent league={activeLeague} addLeagueSeasons={addLeagueSeasons}/>
    </div>
  )
}

export default LeaguesApp;