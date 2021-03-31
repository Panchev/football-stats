<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;


Container::make( 'theme_options', __( 'Theme Options', 'crb' ) )
	->add_fields( array(
		Field::make( 'text', 'crb_profile_page_id', __( 'Profile Page ID', 'crb' ) )
	));
	
