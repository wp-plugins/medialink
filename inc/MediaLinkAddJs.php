<?php

class MediaLinkAddJs {

	public $effect;

	/* ==================================================
	 * Add js
	 * @since	3.5
	 */
	function add_js(){

		if ( $this->effect === 'colorbox' ) {
			$transition = get_option('medialink_colorbox_transition');
			$speed = get_option('medialink_colorbox_speed');
			$title = get_option('medialink_colorbox_title');
			$scalePhotos = get_option('medialink_colorbox_scalePhotos');
			$scrolling = get_option('medialink_colorbox_scrolling');
			$opacity = get_option('medialink_colorbox_opacity');
			$open = get_option('medialink_colorbox_open');
			$returnFocus = get_option('medialink_colorbox_returnFocus');
			$trapFocus = get_option('medialink_colorbox_trapFocus');
			$fastIframe = get_option('medialink_colorbox_fastIframe');
			$preloading = get_option('medialink_colorbox_preloading');
			$overlayClose = get_option('medialink_colorbox_overlayClose');
			$escKey = get_option('medialink_colorbox_escKey');
			$arrowKey = get_option('medialink_colorbox_arrowKey');
			$loop = get_option('medialink_colorbox_loop');
			$fadeOut = get_option('medialink_colorbox_fadeOut');
			$closeButton = get_option('medialink_colorbox_closeButton');
			$current = get_option('medialink_colorbox_current');
			$previous = get_option('medialink_colorbox_previous');
			$next = get_option('medialink_colorbox_next');
			$close = get_option('medialink_colorbox_close');
			$width = get_option('medialink_colorbox_width');
			$height = get_option('medialink_colorbox_height');
			$innerWidth = get_option('medialink_colorbox_innerWidth');
			$innerHeight = get_option('medialink_colorbox_innerHeight');
			$initialWidth = get_option('medialink_colorbox_initialWidth');
			$initialHeight = get_option('medialink_colorbox_initialHeight');
			$maxWidth = get_option('medialink_colorbox_maxWidth');
			$maxHeight = get_option('medialink_colorbox_maxHeight');
			$slideshow = get_option('medialink_colorbox_slideshow');
			$slideshowSpeed = get_option('medialink_colorbox_slideshowSpeed');
			$slideshowAuto = get_option('medialink_colorbox_slideshowAuto');
			$slideshowStart = get_option('medialink_colorbox_slideshowStart');
			$slideshowStop = get_option('medialink_colorbox_slideshowStop');
			$fixed = get_option('medialink_colorbox_fixed');
			$top = get_option('medialink_colorbox_top');
			$bottom = get_option('medialink_colorbox_bottom');
			$left = get_option('medialink_colorbox_left');
			$right = get_option('medialink_colorbox_right');
			$reposition = get_option('medialink_colorbox_reposition');
			$retinaImage = get_option('medialink_colorbox_retinaImage');
// JS
$medialink_add_js = <<<MEDIALINKADDJS
<script type="text/javascript">
jQuery(function(){
	jQuery("a.medialink").colorbox({
		transition: "{$transition}",
		speed: {$speed},
		title: {$title},
		rel: "grouped",
		scalePhotos: {$scalePhotos},
		scrolling: {$scrolling},
		opacity: {$opacity},
		open: {$open},
		returnFocus: {$returnFocus},
		trapFocus: {$trapFocus},
		fastIframe: {$fastIframe},
		preloading: {$preloading},
		overlayClose: {$overlayClose},
		escKey: {$escKey},
		arrowKey: {$arrowKey},
		loop: {$loop},
		fadeOut: {$fadeOut},
		closeButton: {$closeButton},
		current: "{$current}",
		previous: "{$previous}",
		next: "{$next}",
		close: "{$close}",
		width: {$width},
		height: {$height},
		innerWidth: {$innerWidth},
		innerHeight: {$innerHeight},
		initialWidth: {$initialWidth},
		initialHeight: {$initialHeight},
		maxWidth: {$maxWidth},
		maxHeight: {$maxHeight},
		slideshow: {$slideshow},
		slideshowSpeed: {$slideshowSpeed},
		slideshowAuto: {$slideshowAuto},
		slideshowStart: "{$slideshowStart}",
		slideshowStop: "{$slideshowStop}",
		fixed: {$fixed},
		top: {$top},
		bottom: {$bottom},
		left: {$left},
		right: {$right},
		reposition: {$reposition},
		retinaImage: {$retinaImage}
	});
});
</script>
MEDIALINKADDJS;
		} else if ( $this->effect === 'nivoslider' ) {
			$effect = get_option('medialink_nivoslider_effect');
			$slices = get_option('medialink_nivoslider_slices');
			$boxCols = get_option('medialink_nivoslider_boxCols');
			$boxRows = get_option('medialink_nivoslider_boxRows');
			$animSpeed = get_option('medialink_nivoslider_animSpeed');
			$pauseTime = get_option('medialink_nivoslider_pauseTime');
			$startSlide = get_option('medialink_nivoslider_startSlide');
			$directionNav = get_option('medialink_nivoslider_directionNav');
			$directionNavHide = get_option('medialink_nivoslider_directionNavHide');
			$pauseOnHover = get_option('medialink_nivoslider_pauseOnHover');
			$manualAdvance = get_option('medialink_nivoslider_manualAdvance');
			$prevText = get_option('medialink_nivoslider_prevText');
			$nextText = get_option('medialink_nivoslider_nextText');
			$randomStart = get_option('medialink_nivoslider_randomStart');
// JS
$medialink_add_js = <<<MEDIALINKADDJS
<script type="text/javascript">
jQuery(window).load(function() {
    jQuery('#slidernivo').nivoSlider({
		effect: '{$effect}',
		slices: {$slices},
		boxCols: {$boxCols},
		boxRows: {$boxRows},
		animSpeed: {$animSpeed},
		pauseTime: {$pauseTime},
		startSlide: {$startSlide},
		directionNav: {$directionNav},
		directionNavHide: {$directionNavHide},
		pauseOnHover: {$pauseOnHover},
		manualAdvance: {$manualAdvance},
		prevText: '{$prevText}',
		nextText: '{$nextText}',
		randomStart: {$randomStart}
	});
});
</script>
MEDIALINKADDJS;
		} else if ( $this->effect === 'photoswipe' ) {
			$fadeInSpeed = get_option('medialink_photoswipe_fadeInSpeed');
			$fadeOutSpeed = get_option('medialink_photoswipe_fadeOutSpeed');
			$slideSpeed = get_option('medialink_photoswipe_slideSpeed');
			$swipeThreshold = get_option('medialink_photoswipe_swipeThreshold');
			$swipeTimeThreshold = get_option('medialink_photoswipe_swipeTimeThreshold');
			$loop = get_option('medialink_photoswipe_loop');
			$slideshowDelay = get_option('medialink_photoswipe_slideshowDelay');
			$imageScaleMethod = get_option('medialink_photoswipe_imageScaleMethod');
			$preventHide = get_option('medialink_photoswipe_preventHide');
			$backButtonHideEnabled = get_option('medialink_photoswipe_backButtonHideEnabled');
			$captionAndToolbarHide = get_option('medialink_photoswipe_captionAndToolbarHide');
			$captionAndToolbarHideOnSwipe = get_option('medialink_photoswipe_captionAndToolbarHideOnSwipe');
			$captionAndToolbarFlipPosition = get_option('medialink_photoswipe_captionAndToolbarFlipPosition');
			$captionAndToolbarAutoHideDelay = get_option('medialink_photoswipe_captionAndToolbarAutoHideDelay');
			$captionAndToolbarOpacity = get_option('medialink_photoswipe_captionAndToolbarOpacity');
			$captionAndToolbarShowEmptyCaptions = get_option('medialink_photoswipe_captionAndToolbarShowEmptyCaptions');
// JS
$medialink_add_js = <<<MEDIALINKADDJS
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function(){
		Code.photoSwipe('a', '#Gallery');
		Code.PhotoSwipe.Current.setOptions({
			fadeInSpeed: {$fadeInSpeed},
			fadeOutSpeed: {$fadeOutSpeed},
			slideSpeed: {$slideSpeed},
			swipeThreshold: {$swipeThreshold},
			swipeTimeThreshold: {$swipeTimeThreshold},
			loop: {$loop},
			slideshowDelay: {$slideshowDelay},
			imageScaleMethod: "{$imageScaleMethod}",
			preventHide: {$preventHide},
			backButtonHideEnabled: {$backButtonHideEnabled},
			captionAndToolbarHide: {$captionAndToolbarHide},
			captionAndToolbarHideOnSwipe: {$captionAndToolbarHideOnSwipe},
			captionAndToolbarFlipPosition: {$captionAndToolbarFlipPosition},
			captionAndToolbarAutoHideDelay: {$captionAndToolbarAutoHideDelay},
			captionAndToolbarOpacity: {$captionAndToolbarOpacity},
			captionAndToolbarShowEmptyCaptions: {$captionAndToolbarShowEmptyCaptions}
		});
	}, false);
</script>
MEDIALINKADDJS;
		} else if ( $this->effect === 'swipebox' ) {
			$hideBarsDelay = get_option('medialink_swipebox_hideBarsDelay');
// JS
$medialink_add_js = <<<MEDIALINKADDJS
<script type="text/javascript">
jQuery(function() {
	jQuery(".swipebox").swipebox({
		hideBarsDelay : {$hideBarsDelay}
	});
});
</script>
MEDIALINKADDJS;
		}

		echo $medialink_add_js;

	}

}
