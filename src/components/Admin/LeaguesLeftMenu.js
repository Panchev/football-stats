import React from 'react';

const LeaguesLeftMenu = ({leagues, changeActiveLeague}) => {
  return (
    <div className="admin-leagues-left-menu">
    	<ul>
    		{leagues.map(league => {
    			return (
    				<li onClick={ () => changeActiveLeague(league.term_id) }>{league.name}</li>
    			)
    		})}
    	</ul>
   	</div>
  )
}

export default LeaguesLeftMenu;