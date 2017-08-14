<?php
/*================================================
#3 Load custom Blog Module 
================================================*/
function divi_child_theme_setup() {
	if ( class_exists('ET_Builder_Module')) {
		get_template_part( 'custom-modules/ccm' );
		$ccm = new WPC_ET_Builder_Module_Comments();
		remove_shortcode( 'et_pb_comments' );
		add_shortcode( 'et_pb_comments', array($ccm, '_shortcode_callback') );
	}
}
add_action('wp', 'divi_child_theme_setup', 9999);