<?php
/**
 * Returns the blocks config.
 *
 * @return array
 */
function crb_get_blocks_config() {
	$config_location = CRB_THEME_DIR . '/blocks/blocks.json';

	if ( ! file_exists( $config_location ) ) {
		return [];
	}

	return json_decode( file_get_contents( $config_location ), true );
}

/**
 * Returns an array of all enabled blocks.
 *
 * @return array
 */
function crb_get_enabled_blocks() {
	$config = crb_get_blocks_config();

	return array_keys( array_filter( $config, function ( $is_block_enabled ) {
		return $is_block_enabled;
	} ) );
}
