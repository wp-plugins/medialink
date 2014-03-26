<?php

class MediaLinkAddJs {

	public $effect;

	/* ==================================================
	 * Add js
	 * @since	3.5
	 */
	function add_js(){

		if ( $this->effect === 'colorbox' ) {
// JS
$medialink_add_js = <<<MEDIALINKADDJS
<script type="text/javascript">
jQuery(function(){
 jQuery("a.medialink").colorbox({
  rel:"grouped",
  slideshow: true,
  slideshowAuto: false
 });
});
</script>
MEDIALINKADDJS;
		} else if ( $this->effect === 'nivoslider' ) {
// JS
$medialink_add_js = <<<MEDIALINKADDJS
<script type="text/javascript">
jQuery(window).load(function() {
    jQuery('#slidernivo').nivoSlider();
});
</script>
MEDIALINKADDJS;
		} else if ( $this->effect === 'photoswipe' ) {
// JS
$medialink_add_js = <<<MEDIALINKADDJS
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function(){
		Code.photoSwipe('a', '#Gallery');
	}, false);
</script>
MEDIALINKADDJS;
		} else if ( $this->effect === 'swipebox' ) {
// JS
$medialink_add_js = <<<MEDIALINKADDJS
<script type="text/javascript">
jQuery(function() {
	jQuery(".swipebox").swipebox();
});
</script>
MEDIALINKADDJS;
		}

		echo $medialink_add_js;

	}

}
