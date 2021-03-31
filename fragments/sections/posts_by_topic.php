<?php
if ( !empty( $crb_topics ) ) {
	crb_render_fragment( 'articles', array( 'main_query' => false, 'term_id' =>  array_shift( $crb_topics )['id'] ) );
}