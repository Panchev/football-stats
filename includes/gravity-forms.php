<?php
/**
 * Functions, related to the Gravity Forms plugin
 */

// Add a field type class to each field
add_filter( 'gform_field_css_class', 'crb_custom_gforms_classes', 10, 3 );
function crb_custom_gforms_classes( $classes, $field, $form ) {
	$classes .= ' gfield--' . $field['type'] . ' gfield--' . $field['size'];

	return $classes;
}

// Get all available gravity forms
function crb_get_forms() {
	$forms_ids = array();

	if ( class_exists( 'RGFormsModel' ) ) {
		$forms = RGFormsModel::get_forms( null, 'title' );
		foreach ( $forms as $form ) {
			$forms_ids[ $form->id ] = $form->title;
		}
	}

	// crb_gravity_form_options filter - allows you to modify the form list
	// you can use it to add a "No Form" option
	$form_ids = apply_filters( 'crb_gravity_form_options', $forms_ids );

	return $forms_ids;
}

// Render a gravity form. This is just a shortcut for `gravity_form()` function without
// the crazy arguments list and all available options.
function crb_render_gform( $id, $is_ajax = false, $args = array() ) {
	if ( ! function_exists( 'gravity_form' ) || empty( $id ) ) {
		return;
	}

	// using a shared auto-increment tabindex
	static $gform_tabindex;
	if ( empty( $gform_tabindex ) ) {
		$gform_tabindex = 1;
	}

	// use generated tabindex only if no tabindex is specified
	// step to increment the starting tabindex of the next form
	$step = apply_filters( 'carbon_gform_tabindex_step', 500 );

	// Tabindex backward compatibility
	if ( is_numeric( $args ) ) {
		$args = array(
			'tabindex' => $args,
		);
	}

	$tabindex = $gform_tabindex;
	$gform_tabindex += $step;

	$args = wp_parse_args( $args, array(
		'display_title' => false,
		'display_description' => false,
		'display_inactive' => false,
		'field_values' => null,
		'tabindex' => $tabindex,
	) );

	// render the form
	gravity_form(
		$id,
		$args['display_title'], // display_title
		$args['display_description'], // display_description
		$args['display_inactive'], // display_inactive
		$args['field_values'], // field_values
		$is_ajax,
		$args['tabindex']
	);
}

// Disable the confirmation anchor
// http://www.gravityhelp.com/documentation/page/Gform_confirmation_anchor
add_filter( 'gform_confirmation_anchor', '__return_false' );

// Display an "Add Form" button above rich text fields on all custom field containers
// http://www.gravityhelp.com/documentation/page/Gform_display_add_form_button
add_filter( 'gform_display_add_form_button', '__return_true' );


// Replace the ajax spinner image
add_filter( 'gform_ajax_spinner_url', 'crb_gform_ajax_spinner_url', 10, 2 );
function crb_gform_ajax_spinner_url( $image_src, $form ) {
	return get_bloginfo( 'stylesheet_directory' ) . './resources/images/spinner.svg';
}
