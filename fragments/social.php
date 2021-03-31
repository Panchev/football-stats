<?php 
$social_icons = crb_socials_array(); 
$stream_opts = [
    "ssl" => [
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ]
];?>
<ul>
	<?php
	foreach ( $social_icons as $social_icon ) :
		if ( $social_icon_link = carbon_get_theme_option( 'crb_link_' . $social_icon ) ) :
			
			$file_url = CRB_THEME_DIR . 'resources/images/ico-' . $social_icon . '.svg';  ?>
			<li>
				<a href="<?php echo esc_url( $social_icon_link ) ?>" target="_blank">
					<?php echo file_get_contents( $file_url, false, stream_context_create( $stream_opts ) ) ?>
				</a>
			</li>
		<?php
		endif;
	endforeach;
	?>
</ul>