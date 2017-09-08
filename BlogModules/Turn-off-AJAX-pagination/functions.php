/*================================================
#3 Load custom Blog Module
================================================*/
function divi_child_theme_setup() {
	get_template_part( 'custom-modules/cbm' );
	$cbm = new WPC_ET_Builder_Module_Blog();
	remove_shortcode( 'et_pb_blog' );
	add_shortcode( 'et_pb_blog', array($cbm, '_shortcode_callback') );
}
add_action('et_builder_ready', 'divi_child_theme_setup' );
