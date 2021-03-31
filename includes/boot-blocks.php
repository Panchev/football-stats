<?php
/**
 * Register custom Gutenberg Blocks styles.
 *
 * @return void
 */
function crb_register_blocks_styles() {
	$template_dir = get_template_directory_uri();

	$enabled_blocks = crb_get_enabled_blocks();

	foreach ( $enabled_blocks as $block_name ) {
		crb_enqueue_style(
			'crb-block-' . $block_name,
			$template_dir . crb_assets_bundle( 'css/block-' . $block_name . '.css' )
		);
	}
}
add_action( 'crb_register_block_styles', 'crb_register_blocks_styles' );

/**
 * Register custom Gutenberg Blocks.
 *
 * @return void
 */
function crb_register_blocks() {
	do_action( 'crb_register_block_styles' );

	$enabled_blocks = crb_get_enabled_blocks();

	foreach ( $enabled_blocks as $block_name ) {
		include_once CRB_THEME_DIR . 'blocks/' . $block_name . '/block.php';
	}
}
add_action( 'carbon_fields_register_fields', 'crb_register_blocks' );
