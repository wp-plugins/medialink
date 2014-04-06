<?php
/**
 * MediaLink
 * 
 * @package    MediaLink
 * @subpackage MediaLink Add Javascript
    Copyright (c) 2013- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; version 2 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

class MediaLinkAddJs {

	public $effect;

	/* ==================================================
	 * Add js
	 * @since	3.5
	 */
	function add_js(){

		if ( $this->effect === 'colorbox' ) {
			$colorbox_tbl = get_option('medialink_colorbox');
// JS
$medialink_add_js = <<<MEDIALINKADDJS1
<script type="text/javascript">
jQuery(function(){
	jQuery("a.medialink").colorbox({

MEDIALINKADDJS1;

			foreach( $colorbox_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$medialink_add_js .= str_repeat(' ', 8).$key.': "'.$value.'",'."\n";
				} else {
					$medialink_add_js .= str_repeat(' ', 8).$key.': '.$value.','."\n";
				}
			}
			$medialink_add_js = rtrim($medialink_add_js);
			$medialink_add_js = rtrim($medialink_add_js, ",");

$medialink_add_js .= <<<MEDIALINKADDJS2

	});
});
</script>
MEDIALINKADDJS2;
		} else if ( $this->effect === 'nivoslider' ) {
			$nivoslider_tbl = get_option('medialink_nivoslider');
// JS
$medialink_add_js = <<<MEDIALINKADDJS1
<script type="text/javascript">
jQuery(window).load(function() {
    jQuery('#slidernivo').nivoSlider({

MEDIALINKADDJS1;

			foreach( $nivoslider_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$medialink_add_js .= str_repeat(' ', 8).$key.': "'.$value.'",'."\n";
				} else {
					$medialink_add_js .= str_repeat(' ', 8).$key.': '.$value.','."\n";
				}
			}
			$medialink_add_js = rtrim($medialink_add_js);
			$medialink_add_js = rtrim($medialink_add_js, ",");

$medialink_add_js .= <<<MEDIALINKADDJS2

	});
});
</script>
MEDIALINKADDJS2;
		} else if ( $this->effect === 'photoswipe' ) {
			$photoswipe_tbl = get_option('medialink_photoswipe');
// JS
$medialink_add_js = <<<MEDIALINKADDJS1
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function(){
		Code.photoSwipe('a', '#Gallery');
		Code.PhotoSwipe.Current.setOptions({

MEDIALINKADDJS1;

			foreach( $photoswipe_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$medialink_add_js .= str_repeat(' ', 8).$key.': "'.$value.'",'."\n";
				} else {
					$medialink_add_js .= str_repeat(' ', 8).$key.': '.$value.','."\n";
				}
			}
			$medialink_add_js = rtrim($medialink_add_js);
			$medialink_add_js = rtrim($medialink_add_js, ",");

$medialink_add_js .= <<<MEDIALINKADDJS2

		});
	}, false);
</script>
MEDIALINKADDJS2;
		} else if ( $this->effect === 'swipebox' ) {
			$swipebox_tbl = get_option('medialink_swipebox');
// JS
$medialink_add_js = <<<MEDIALINKADDJS1
<script type="text/javascript">
jQuery(function() {
	jQuery(".swipebox").swipebox({

MEDIALINKADDJS1;

			foreach( $swipebox_tbl as $key => $value ) {
				if ( is_string($value) && $value <> 'true' && $value<> 'false' ) {
					$medialink_add_js .= str_repeat(' ', 8).$key.': "'.$value.'",'."\n";
				} else {
					$medialink_add_js .= str_repeat(' ', 8).$key.': '.$value.','."\n";
				}
			}
			$medialink_add_js = rtrim($medialink_add_js);
			$medialink_add_js = rtrim($medialink_add_js, ",");

$medialink_add_js .= <<<MEDIALINKADDJS2

	});
});
</script>
MEDIALINKADDJS2;
		}

		echo $medialink_add_js;

	}

}
