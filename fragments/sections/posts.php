<?php
if ( !empty( $posts ) ) {
	crb_render_fragment( 'articles', array( 'main_query' => false, 'post__in' =>  wp_list_pluck( $posts, 'id' ) ) );
}