<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

/**
 * Get the bootstrap!
 */
if ( file_exists(  get_template_directory() . '/inc/meta/init.php' ) ) {
	require_once  get_template_directory() . '/inc/meta/init.php';
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function cmb2_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

add_filter( 'cmb2_meta_boxes', 'cmb2_page_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_page_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_wpc_';

	/**
	 * Sample metabox to demonstrate each field type included template-grid-page
	 */

	// $meta_boxes['grid_page_metabox'] = array(
	// 	'id'            => 'grid_page_metabox',
	// 	'title'         => __( 'Grid Page Settings', 'law16' ),
	// 	'show_on' => array( 'page-template', 'template-grid-page', 'grid_page_metabox' ),
	// 	'object_types'  => array( 'page', ), // Post type
	// 	'context'       => 'normal',
	// 	'priority'      => 'high',
	// 	'show_names'    => true, // Show field names on the left
	// 	'show_on'    => array( 'key' => 'page-template', 'value' => 'template-grid-page.php' /* homepage ID */ ),
	// 	'fields'        => array(

	// 		array(
	// 		    'name' => '',
	// 		    'desc' => 'Use this metabox setting to displays all child pages of this page with featured images in a grid. It’s perfect for your Case Studies, Team, or Services page for instance.',
	// 		    'type' => 'title',
	// 		    'id' => $prefix . 'grid_intro'
	// 		),
	// 		array(
	// 			'name'    => __( 'Grid Columns', 'law16' ),
	// 			'desc'    => __( 'How many column it should show?', 'law16' ),
	// 			'id'      => $prefix . 'grid_column',
	// 			'type'    => 'select',
	// 			'default' => '3',
	// 			'options' => array(
	// 				'2' => __( 'Two Columns', 'law16' ),
	// 				'3' => __( 'Three Columns', 'law16' ),
	// 				'4' => __( 'Four Columns', 'law16' ),
	// 			),
	// 		),

	// 	),
	// );

	$meta_boxes['page_metabox'] = array(
		'id'            => 'page_metabox',
		'title'         => __( 'Page Settings', 'law16' ),
		'object_types'  => array( 'page', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		'fields'        => array(
			array(
				'name'    => __( 'Page Layout', 'law16' ),
				'desc'    => __( 'Set the page layout, inherit from Theme Option by default.', 'law16' ),
				'id'      => $prefix . 'page_layout',
				'type'    => 'select',
				'default' => 'sidebar-default',
				'options' => array(
					'sidebar-default' => __( 'Default, inherit from theme option', 'law16' ),
					'right-sidebar'   => __( 'Right Sidebar', 'law16' ),
					'left-sidebar'    => __( 'Left Sidebar', 'law16' ),
					'no-sidebar'      => __( 'No Sidebar', 'law16' ),
					'full-screen'     => __( 'Full Screen', 'law16' ),
				),
			),
			array(
				'name'    => __( 'Hide page title?', 'law16' ),
				'desc'    => __( 'Check this box to hide page title.', 'law16' ),
				'id'      => $prefix . 'hide_page_title',
				'type'    => 'checkbox'
			),
			array(
				'name'    => __( 'Hide breadcrumb?', 'law16' ),
				'desc'    => __( 'Check this box to hide breadcrumb for this page.', 'law16' ),
				'id'      => $prefix . 'hide_breadcrumb',
				'type'    => 'checkbox'
			),
			array(
				'name'    => __( 'Enable Page Header?', 'law16' ),
				'desc'    => __( 'Check this box to enable page header.', 'law16' ),
				'id'      => $prefix . 'enable_page_header',
				'type'    => 'checkbox'
			),
			array(
				'name' => __( 'Page Header Title', 'law16' ),
				'desc' => __( 'Enter in the page header title here, accept simple HTML code.', 'law16' ),
				'id'   => $prefix . 'header_title',
				'type' => 'textarea_code'
			),
			array(
				'name' => __( 'Page Header Subtitle', 'law16' ),
				'desc' => __( 'Enter in the page header subtitle here.', 'law16' ),
				'id'   => $prefix . 'header_subtitle',
				'type' => 'text_medium'
			),
			array(
				'name'    => __( 'Text Alignment', 'law16' ),
				'desc'    => __( 'Choose how you would like your header text to be aligned', 'law16' ),
				'id'      => $prefix . 'header_alignment',
				'type'    => 'radio_inline',
				'default' => 'left',
				'options' => array(
					'left'   => __( 'Left', 'law16' ),
					'center' => __( 'Center', 'law16' ),
					'right'  => __( 'Right', 'law16' ),
				),
			),
			array(
				'name' => __( 'Page Header Image', 'law16' ),
				'desc' => __( 'The image should be between 1500px - 2000px wide and have a minimum height of 500px for best results.', 'law16' ),
				'id'   => $prefix . 'header_bg',
				'type' => 'file',
			),
			// array(
			// 	'name' => __( 'Page Header Height', 'law16' ),
			// 	'desc' => __( 'Your header hight in px. <strong>ee.g. 500</strong>', 'law16' ),
			// 	'id'   => $prefix . 'header_height',
			// 	'type' => 'text_small',
			// 	// 'repeatable' => true,
			// ),
			array(
				'name'    => __( 'Page Header Padding Top', 'law16' ),
				'desc'    => __( 'Your header padding top in px. <strong>ee.g. 200</strong>, default is 60', 'law16' ),
				'id'      => $prefix . 'header_padding_top',
				'type'    => 'text_small',
				'default' => '60'
				// 'repeatable' => true,
			),
			array(
				'name'    => __( 'Page Header Padding Bottom', 'law16' ),
				'desc'    => __( 'Your header padding bottom in px. <strong>ee.g. 200</strong>, default is 60', 'law16' ),
				'id'      => $prefix . 'header_padding_bottom',
				'type'    => 'text_small',
				'default' => '60'
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Parallax Header?', 'law16' ),
				'desc' => __( 'Check this box to have a parallax scroll effect.', 'law16' ),
				'id'   => $prefix . 'header_parallax',
				'type' => 'checkbox'
			),
			array(
				'name'    => __( 'Page Header Background Color', 'law16' ),
				'desc'    => __( 'Set header background color if not using background image.', 'law16' ),
				'id'      => $prefix . 'header_bg_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
			array(
				'name'    => __( 'Text Color', 'law16' ),
				'desc'    => __( 'Set header text color.', 'law16' ),
				'id'      => $prefix . 'header_text_color',
				'type'    => 'colorpicker',
				'default' => '#222222'
			),

		),
	);

	return $meta_boxes;
}
