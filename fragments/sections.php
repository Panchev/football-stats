<?php
if ( $sections = carbon_get_the_post_meta( 'crb_sections' ) ) {
	crb_render_page( $sections );
}