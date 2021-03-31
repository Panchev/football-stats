const { render, useState } = wp.element;
import Profile from './components/Profile';
import LeaguesApp from './components/Admin/LeaguesApp';

if ( document.getElementById('profile-app') ) {
	render(<Profile />, document.getElementById(`profile-app`));
}

if ( document.getElementById('leagues-admin-app') ) {
	render( <LeaguesApp />, document.getElementById('leagues-admin-app'))
}