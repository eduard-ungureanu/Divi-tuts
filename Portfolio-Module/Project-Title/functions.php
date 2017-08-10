<?php
/*================================================
#3 Load custom Blog Module 
================================================*/
function divi_child_theme_setup() {
	if ( class_exists('ET_Builder_Module')) {
		get_template_part( 'custom-modules/cpm' );
		$cpm = new WPC_ET_Builder_Module_Portfolio();
		remove_shortcode( 'et_pb_portfolio' );
		add_shortcode( 'et_pb_portfolio', array($cpm, '_shortcode_callback') );
	}
}
add_action('wp', 'divi_child_theme_setup', 9999);