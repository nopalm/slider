<?php

function simpleSlider( $atts ) {
	$attributes = shortcode_atts( array(
		'title' => false,
		'limit' => 4,
	), $atts );
	
	ob_start();

	// include template with the arguments (The $args parameter was added in v5.5.0)
	get_template_part( 'template-parts/wpdocs-the-shortcode-template', null, $attributes );

	return ob_get_clean();

}
add_shortcode( 'simpleSlider', 'simpleSlider' );