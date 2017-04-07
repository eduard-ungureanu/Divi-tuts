<script>
function swap_title_image(){
	var cta = jQuery('.wpc-cta');
	cta.each(function(){
		var cta_wrapper = jQuery(this).find('.et_pb_promo_description'),
			cta_title = jQuery(this).find('h2'),
			cta_image = jQuery(this).find('h1');
		cta_title.detach();
		cta_image.detach();
		cta_wrapper.prepend(cta_image);
		cta_wrapper.append(cta_title);
	});
}
setTimeout(swap_title_image, 100);
</script>
