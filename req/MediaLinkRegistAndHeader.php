<?php
/**
 * MediaLink
 * 
 * @package    MediaLink
 * @subpackage MediaLink registered in the database and generate header
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

class MediaLinkRegistAndHeader {

	/* ==================================================
	 * Settings register
	 * @since	1.1
	 */
	function register_settings(){

		if ( !get_option('medialink_all') ) {
			$all_tbl = array(
							'sort' => 'new',
							'effect_pc' => 'colorbox',
							'effect_sp' => 'swipebox',
							'display_pc' => 8, 	
							'display_sp' => 6,
							'image_show_size' => 'Full',
							'thumbnail' => '-'.get_option('thumbnail_size_w').'x'.get_option('thumbnail_size_h'),
							'include_cat' => '',
							'generate_rssfeed' => 'on',
							'rssname' => 'medialink_all_feed',
							'rssmax' => 10,
							'filesize_show' => 'Show',
							'stamptime_show' => 'Show',
							'categorylinks_show' => 'Show',
							'pagelinks_show' => 'Show',
							'sortlinks_show' => 'Show',
							'searchbox_show' => 'Show',
							'rssicon_show' => 'Show',
							'credit_show' => 'Show'
							);
			update_option( 'medialink_all', $all_tbl );
		}

		if ( !get_option('medialink_album') ) {
			$album_tbl = array(
							'sort' => 'new',
							'effect_pc' => 'colorbox',
							'effect_sp' => 'photoswipe',
							'suffix_pc' => 'all',
							'suffix_sp' => 'all',
							'display_pc' => 20, 	
							'display_sp' => 9,
							'image_show_size' => 'Full',
							'thumbnail' => '-'.get_option('thumbnail_size_w').'x'.get_option('thumbnail_size_h'),
							'include_cat' => '',
							'generate_rssfeed' => 'on',
							'rssname' => 'medialink_album_feed',
							'rssmax' => 10,
							'filesize_show' => 'Show',
							'stamptime_show' => 'Show',
							'categorylinks_show' => 'Show',
							'pagelinks_show' => 'Show',
							'sortlinks_show' => 'Show',
							'searchbox_show' => 'Show',
							'rssicon_show' => 'Show',
							'credit_show' => 'Show'
							);
			update_option( 'medialink_album', $album_tbl );
		}

		if ( !get_option('medialink_movie') ) {
			$movie_tbl = array(
							'sort' => 'new',
							'suffix_pc' => 'mp4',
							'suffix_pc2' => 'ogv',
							'suffix_flash' => 'mp4',
							'suffix_sp' => 'mp4',
							'display_pc' => 8,
							'display_sp' => 6,
							'thumbnail' => '',
							'include_cat' => '',
							'generate_rssfeed' => 'on',
							'rssname' => 'medialink_movie_feed',
							'rssmax' => 10,
							'container' => '512x384',
							'filesize_show' => 'Show',
							'stamptime_show' => 'Show',
							'categorylinks_show' => 'Show',
							'pagelinks_show' => 'Show',
							'sortlinks_show' => 'Show',
							'searchbox_show' => 'Show',
							'rssicon_show' => 'Show',
							'credit_show' => 'Show'
							);
			update_option( 'medialink_movie', $movie_tbl );
		}

		if ( !get_option('medialink_music') ) {
			$music_tbl = array(
							'sort' => 'new',
							'suffix_pc' => 'mp3',
							'suffix_pc2' => 'ogg',
							'suffix_flash' => 'mp3',
							'suffix_sp' => 'mp3',
							'display_pc' => 8,
							'display_sp' => 6,
							'thumbnail' => '',
							'include_cat' => '',
							'generate_rssfeed' => 'on',
							'rssname' => 'medialink_music_feed',
							'rssmax' => 10,
							'filesize_show' => 'Show',
							'stamptime_show' => 'Show',
							'categorylinks_show' => 'Show',
							'pagelinks_show' => 'Show',
							'sortlinks_show' => 'Show',
							'searchbox_show' => 'Show',
							'rssicon_show' => 'Show',
							'credit_show' => 'Show'
							);
			update_option( 'medialink_music', $music_tbl );
		}

		if ( !get_option('medialink_slideshow') ) {
			$slideshow_tbl = array(
								'sort' => 'new',
								'effect_pc' => 'nivoslider',
								'effect_sp' => 'nivoslider',
								'suffix_pc' => 'all',
								'suffix_sp' => 'all',
								'display_pc' => 10,
								'display_sp' => 10,
								'image_show_size' => 'Full',
								'thumbnail' => '-'.get_option('thumbnail_size_w').'x'.get_option('thumbnail_size_h'),
								'include_cat' => '',
								'generate_rssfeed' => 'on',
								'rssname' => 'medialink_slideshow_feed',
								'rssmax' => 10,
								'filesize_show' => 'Show',
								'stamptime_show' => 'Show',
								'categorylinks_show' => 'Hide',
								'pagelinks_show' => 'Hide',
								'sortlinks_show' => 'Hide',
								'searchbox_show' => 'Hide',
								'rssicon_show' => 'Hide',
								'credit_show' => 'Show'
							);
			update_option( 'medialink_slideshow', $slideshow_tbl );
		}

		if ( !get_option('medialink_document') ) {
			$document_tbl = array(
								'sort' => 'new',
								'suffix_pc' => 'all',
								'suffix_sp' => 'all',
								'display_pc' => 20,
								'display_sp' => 9,
								'thumbnail' => 'icon',
								'include_cat' => '',
								'generate_rssfeed' => 'on',
								'rssname' => 'medialink_document_feed',
								'rssmax' => 10,
								'filesize_show' => 'Show',
								'stamptime_show' => 'Show',
								'categorylinks_show' => 'Show',
								'pagelinks_show' => 'Show',
								'sortlinks_show' => 'Show',
								'searchbox_show' => 'Show',
								'rssicon_show' => 'Show',
								'credit_show' => 'Show'
							);
			update_option( 'medialink_document', $document_tbl );
		}

		if ( !get_option('medialink_exclude') ) {
			$exclude_tbl = array(
								'cat' => ''
							);
			update_option( 'medialink_exclude', $exclude_tbl );
		}

		if ( !get_option('medialink_css') ) {
			$css_tbl = array(
							'pc_listthumbsize' => '40x40',
							'pc_linkstrcolor' => '#000000',
							'pc_linkbackcolor' => '#f6efe2',
							'sp_navstrcolor' => '#000000',
							'sp_navbackcolor' => '#f6efe2',
							'sp_navpartitionlinecolor' => '#ffffff',
							'sp_listbackcolor' => '#ffffff',
							'sp_listarrowcolor' => '#e2a6a6',
							'sp_listpartitionlinecolor' => '#f6efe2'
							);
			update_option( 'medialink_css', $css_tbl );
		}

		if ( !get_option('medialink_useragent') ) {
			$useragent_tbl = array(
								'tb' => 'iPad|^.*Android.*Nexus(((?:(?!Mobile))|(?:(\s(7|10).+))).)*$|Kindle|Silk.*Accelerated|Sony.*Tablet|Xperia Tablet|Sony Tablet S|SAMSUNG.*Tablet|Galaxy.*Tab|SC-01C|SC-01D|SC-01E|SC-02D',
								'sp' => 'iPhone|iPod|Android.*Mobile|BlackBerry|IEMobile',
								'mb' => 'DoCoMo\/|KDDI-|UP\.Browser|SoftBank|Vodafone|J-PHONE|MOT-|WILLCOM|DDIPOCKET|PDXGW|emobile|ASTEL|L-mode'
							);
			update_option( 'medialink_useragent', $useragent_tbl );
		}

		if ( !get_option('medialink_colorbox') ) {
			$colorbox_tbl = array(
								'transition' => 'elastic',
								'speed' => 350,
								'title' => 'false',
								'rel' => 'grouped',
								'scalePhotos' => 'true',
								'scrolling' => 'true',
								'opacity' => 0.85,
								'open' => 'false',
								'returnFocus' => 'true',
								'trapFocus' => 'true',
								'fastIframe' => 'true',
								'preloading' => 'true',
								'overlayClose' => 'true',
								'escKey' => 'true',
								'arrowKey' => 'true',
								'loop' => 'true',
								'fadeOut' => 300,
								'closeButton' => 'true',
								'current' => 'image {current} of {total}',
								'previous' => 'previous',
								'next' => 'next',
								'close' => 'close',
								'width' => 'false',
								'height' => 'false',
								'innerWidth' => 'false',
								'innerHeight' => 'false',
								'initialWidth' => 300,
								'initialHeight' => 100,
								'maxWidth' => 'false',
								'maxHeight' => 'false',
								'slideshow' => 'true',
								'slideshowSpeed' => 2500,
								'slideshowAuto' => 'false',
								'slideshowStart' => 'start slideshow',
								'slideshowStop' => 'stop slideshow',
								'fixed' => 'false',
								'top' => 'false',
								'bottom' => 'false',
								'left' => 'false',
								'right' => 'false',
								'reposition' => 'true',
								'retinaImage' => 'false'
							);
			update_option( 'medialink_colorbox', $colorbox_tbl );
		}

		if ( !get_option('medialink_nivoslider') ) {
			$nivoslider_tbl = array(
								'effect' => 'random',
								'slices' => 15,
								'boxCols' => 8,
								'boxRows' => 4,
								'animSpeed' => 500,
								'pauseTime' => 3000,
								'startSlide' => 0,
								'directionNav' => 'true',
								'directionNavHide' => 'true',
								'pauseOnHover' => 'true',
								'manualAdvance' => 'false',
								'prevText' => 'Prev',
								'nextText' => 'Next',
								'randomStart' => 'false'
							);
			update_option( 'medialink_nivoslider', $nivoslider_tbl );
		}

		if ( !get_option('medialink_photoswipe') ) {
			$photoswipe_tbl = array(
								'fadeInSpeed' => 250,
								'fadeOutSpeed' => 500,
								'slideSpeed' => 250,
								'swipeThreshold' => 50,
								'swipeTimeThreshold' => 250,
								'loop' => 'true',
								'slideshowDelay' => 3000,
								'imageScaleMethod' => 'fit',
								'preventHide' => 'false',
								'backButtonHideEnabled' => 'true',
								'captionAndToolbarHide' => 'false',
								'captionAndToolbarHideOnSwipe' => 'true',
								'captionAndToolbarFlipPosition' => 'false',
								'captionAndToolbarAutoHideDelay' => 5000,
								'captionAndToolbarOpacity' => 0.8,
								'captionAndToolbarShowEmptyCaptions' => 'false'
							);
			update_option( 'medialink_photoswipe', $photoswipe_tbl );
		}

		if ( !get_option('medialink_swipebox') ) {
			$swipebox_tbl = array(
								'hideBarsDelay' => 3000
							);
			update_option( 'medialink_swipebox', $swipebox_tbl );
		}

	}

	/* ==================================================
	 * Add FeedLink
	 * @since	1.16
	 */
	function add_feedlink(){

		$wp_uploads = wp_upload_dir();
		$wp_uploads_path = str_replace('http://'.$_SERVER["SERVER_NAME"], '', $wp_uploads['baseurl']);
		$documentrootname = $_SERVER['DOCUMENT_ROOT'];
		$servername = 'http://'.$_SERVER['HTTP_HOST'];
		$xml_all = $wp_uploads_path.'/'.get_option('medialink_all')[rssname].'.xml';
		$xml_album = $wp_uploads_path.'/'.get_option('medialink_album')[rssname].'.xml';
		$xml_movie = $wp_uploads_path.'/'.get_option('medialink_movie')[rssname].'.xml';
		$xml_music = $wp_uploads_path.'/'.get_option('medialink_music')[rssname].'.xml';
		$xml_slideshow = $wp_uploads_path.'/'.get_option('medialink_slideshow')[rssname].'.xml';
		$xml_document = $wp_uploads_path.'/'.get_option('medialink_document')[rssname].'.xml';

		echo '<!-- Start Medialink feed -->'."\n";
		if (file_exists($documentrootname.$xml_all)) {
			$xml_all_data = simplexml_load_file($servername.$xml_all);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$servername.$xml_all.'" title="'.$xml_all_data->channel->title.'" />'."\n";
		}
		if (file_exists($documentrootname.$xml_album)) {
			$xml_album_data = simplexml_load_file($servername.$xml_album);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$servername.$xml_album.'" title="'.$xml_album_data->channel->title.'" />'."\n";
		}
		if (file_exists($documentrootname.$xml_movie)) {
			$xml_movie_data = simplexml_load_file($servername.$xml_movie);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$servername.$xml_movie.'" title="'.$xml_movie_data->channel->title.'" />'."\n";
		}
		if (file_exists($documentrootname.$xml_music)) {
			$xml_music_data = simplexml_load_file($servername.$xml_music);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$servername.$xml_music.'" title="'.$xml_music_data->channel->title.'" />'."\n";
		}
		if (file_exists($documentrootname.$xml_slideshow)) {
			$xml_slideshow_data = simplexml_load_file($servername.$xml_slideshow);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$servername.$xml_slideshow.'" title="'.$xml_slideshow_data->channel->title.'" />'."\n";
		}
		if (file_exists($documentrootname.$xml_document)) {
			$xml_document_data = simplexml_load_file($servername.$xml_document);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$servername.$xml_document.'" title="'.$xml_document_data->channel->title.'" />'."\n";
		}
		echo '<!-- End Medialink feed -->'."\n";

	}

	/* ==================================================
	 * Settings CSS
	 * @since	1.9
	 */
	function add_css(){

		$pc_listwidth = get_option('medialink_css')[pc_listwidth];
		list($listthumbsize_w, $listthumbsize_h) = explode('x', get_option('medialink_css')[pc_listthumbsize]);
		$pc_linkstrcolor = get_option('medialink_css')[pc_linkstrcolor];
		$pc_linkbackcolor = get_option('medialink_css')[pc_linkbackcolor];
		$sp_navstrcolor = get_option('medialink_css')[sp_navstrcolor];
		$sp_navbackcolor = get_option('medialink_css')[sp_navbackcolor];
		$sp_navpartitionlinecolor = get_option('medialink_css')[sp_navpartitionlinecolor];
		$sp_listbackcolor = get_option('medialink_css')[sp_listbackcolor];
		$sp_listarrowcolor = get_option('medialink_css')[sp_listarrowcolor];
		$sp_listpartitionlinecolor = get_option('medialink_css')[sp_listpartitionlinecolor];

	// CSS PC
$medialink_add_css_pc = <<<MEDIALINKADDCSSPC
<!-- Start Medialink CSS for PC -->
<style type="text/css">
#playlists-medialink li a { width: 100%; height: {$listthumbsize_h}px; }
#playlists-medialink img { width: {$listthumbsize_w}px; height: {$listthumbsize_h}px; }
#playlists-medialink li:hover {background: {$pc_linkbackcolor};}
#playlists-medialink a:hover {color: {$pc_linkstrcolor}; background: {$pc_linkbackcolor};}</style>
<!-- End Medialink CSS for PC -->
MEDIALINKADDCSSPC;

	// CSS SP
$medialink_add_css_sp = <<<MEDIALINKADDCSSSP
<!-- Start Medialink CSS for Smart Phone -->
<style type="text/css">
.g_nav li{ color: {$sp_navstrcolor}; background: {$sp_navbackcolor}; }
.g_nav li:not(:last-child){ border-right:1px solid {$sp_navpartitionlinecolor}; }
.g_nav li a{ color: {$sp_navstrcolor}; }
.list{ background: {$sp_listbackcolor}; }
.list ul li a:after{ border: 4px solid transparent; border-left-color: {$sp_listarrowcolor}; }
.list ul li:not(:last-child){ border-bottom:1px solid {$sp_listpartitionlinecolor}; }
.list ul li img{ width: {$listthumbsize_w}px; height: {$listthumbsize_h}px; }
</style>
<!-- End Medialink CSS for Smart Phone -->
MEDIALINKADDCSSSP;

		include_once dirname(__FILE__).'/../inc/MediaLink.php';
		$medialink = new MediaLink();
		$mode = $medialink->agent_check();

		if ( $mode === 'pc' ) {
			echo $medialink_add_css_pc;
		} else if ( $mode === 'sp') {
			echo $medialink_add_css_sp;
		}

	}

	/* ==================================================
	 * For IE
	 * @since	2.6
	 */
	function add_meta(){

$medialink_add_meta_ie_emulation = <<<MEDIALINKADDMETAIEEMULATION
<!-- Start Medialink meta -->
<meta http-equiv="x-ua-compatible" content="IE=9" />
<!-- End Medialink meta -->
MEDIALINKADDMETAIEEMULATION;

		include_once dirname(__FILE__).'/../inc/MediaLink.php';
		$medialink = new MediaLink();
		$mode = $medialink->agent_check();

		if ( $mode === 'pc' ) {
			echo $medialink_add_meta_ie_emulation;
		}

	}

	/* ==================================================
	 * Delete wp_options table of old version.
	 * @since	4.4
	 */
	function delete_old_versions_wp_options(){

		if ( get_option('medialink_album_sort') ) {

			$option_names = array(
							'medialink_all_sort',
							'medialink_album_sort',
							'medialink_movie_sort',
							'medialink_music_sort',
							'medialink_slideshow_sort',
							'medialink_document_sort',
							'medialink_all_effect_pc',
							'medialink_all_effect_sp',
							'medialink_album_effect_pc',
							'medialink_album_effect_sp',
							'medialink_slideshow_effect_pc',
							'medialink_slideshow_effect_sp',
							'medialink_album_suffix_pc',
							'medialink_album_suffix_sp',
							'medialink_movie_suffix_pc',
							'medialink_movie_suffix_pc2',
							'medialink_movie_suffix_flash',
							'medialink_movie_suffix_sp',
							'medialink_music_suffix_pc',
							'medialink_music_suffix_pc2',
							'medialink_music_suffix_flash',
							'medialink_music_suffix_sp',
							'medialink_slideshow_suffix_pc',
							'medialink_slideshow_suffix_sp',
							'medialink_document_suffix_pc',
							'medialink_document_suffix_sp',
							'medialink_all_display_pc',
							'medialink_all_display_sp',
							'medialink_album_display_pc',
							'medialink_album_display_sp',
							'medialink_movie_display_pc',
							'medialink_movie_display_sp',
							'medialink_music_display_pc',
							'medialink_music_display_sp',
							'medialink_slideshow_display_pc',
							'medialink_slideshow_display_sp',
							'medialink_document_display_pc',
							'medialink_document_display_sp',
							'medialink_all_image_show_size',
							'medialink_album_image_show_size',
							'medialink_slideshow_image_show_size',
							'medialink_movie_suffix_thumbnail',
							'medialink_music_suffix_thumbnail',
							'medialink_document_suffix_thumbnail',
							'medialink_all_include_cat',
							'medialink_album_include_cat',
							'medialink_movie_include_cat',
							'medialink_music_include_cat',
							'medialink_slideshow_include_cat',
							'medialink_document_include_cat',
							'medialink_exclude_cat',
							'medialink_all_generate_rssfeed',
							'medialink_album_generate_rssfeed',
							'medialink_movie_generate_rssfeed',
							'medialink_music_generate_rssfeed',
							'medialink_slideshow_generate_rssfeed',
							'medialink_document_generate_rssfeed',
							'medialink_all_rssname',
							'medialink_album_rssname',
							'medialink_movie_rssname',
							'medialink_music_rssname',
							'medialink_slideshow_rssname',
							'medialink_document_rssname',
							'medialink_all_rssmax',
							'medialink_album_rssmax',
							'medialink_movie_rssmax',
							'medialink_music_rssmax',
							'medialink_slideshow_rssmax',
							'medialink_document_rssmax',
							'medialink_movie_container',
							'medialink_css_listwidth',
							'medialink_css_pc_listwidth',
							'medialink_css_listthumbsize',
							'medialink_css_pc_listthumbsize',
							'medialink_css_pc_linkstrcolor',
							'medialink_css_pc_linkbackcolor',
							'medialink_css_sp_navstrcolor',
							'medialink_css_sp_navbackcolor',
							'medialink_css_sp_navpartitionlinecolor',
							'medialink_css_sp_listbackcolor',
							'medialink_css_sp_listarrowcolor',
							'medialink_css_sp_listpartitionlinecolor',
							'medialink_all_filesize_show',
							'medialink_all_stamptime_show',
							'medialink_all_categorylinks_show',
							'medialink_all_pagelinks_show',
							'medialink_all_sortlinks_show',
							'medialink_all_searchbox_show',
							'medialink_all_rssicon_show',
							'medialink_all_credit_show',
							'medialink_album_filesize_show',
							'medialink_album_stamptime_show',
							'medialink_album_categorylinks_show',
							'medialink_album_pagelinks_show',
							'medialink_album_sortlinks_show',
							'medialink_album_searchbox_show',
							'medialink_album_rssicon_show',
							'medialink_album_credit_show',
							'medialink_movie_filesize_show',
							'medialink_movie_stamptime_show',
							'medialink_movie_categorylinks_show',
							'medialink_movie_pagelinks_show',
							'medialink_movie_sortlinks_show',
							'medialink_movie_searchbox_show',
							'medialink_movie_rssicon_show',
							'medialink_movie_credit_show',
							'medialink_music_filesize_show',
							'medialink_music_stamptime_show',
							'medialink_music_categorylinks_show',
							'medialink_music_pagelinks_show',
							'medialink_music_sortlinks_show',
							'medialink_music_searchbox_show',
							'medialink_music_rssicon_show',
							'medialink_music_credit_show',
							'medialink_slideshow_filesize_show',
							'medialink_slideshow_stamptime_show',
							'medialink_slideshow_categorylinks_show',
							'medialink_slideshow_pagelinks_show',
							'medialink_slideshow_sortlinks_show',
							'medialink_slideshow_searchbox_show',
							'medialink_slideshow_rssicon_show',
							'medialink_slideshow_credit_show',
							'medialink_document_filesize_show',
							'medialink_document_stamptime_show',
							'medialink_document_categorylinks_show',
							'medialink_document_pagelinks_show',
							'medialink_document_sortlinks_show',
							'medialink_document_searchbox_show',
							'medialink_document_rssicon_show',
							'medialink_document_credit_show',
							'medialink_useragent_tb',
							'medialink_useragent_sp',
							'medialink_colorbox_transition',
							'medialink_colorbox_speed',
							'medialink_colorbox_title',
							'medialink_colorbox_scalePhotos',
							'medialink_colorbox_scrolling',
							'medialink_colorbox_opacity',
							'medialink_colorbox_open',
							'medialink_colorbox_returnFocus',
							'medialink_colorbox_trapFocus',
							'medialink_colorbox_fastIframe',
							'medialink_colorbox_preloading',
							'medialink_colorbox_overlayClose',
							'medialink_colorbox_escKey',
							'medialink_colorbox_arrowKey',
							'medialink_colorbox_loop',
							'medialink_colorbox_fadeOut',
							'medialink_colorbox_closeButton',
							'medialink_colorbox_current',
							'medialink_colorbox_previous',
							'medialink_colorbox_next',
							'medialink_colorbox_close',
							'medialink_colorbox_width',
							'medialink_colorbox_height',
							'medialink_colorbox_innerWidth',
							'medialink_colorbox_innerHeight',
							'medialink_colorbox_initialWidth',
							'medialink_colorbox_initialHeight',
							'medialink_colorbox_maxWidth',
							'medialink_colorbox_maxHeight',
							'medialink_colorbox_slideshow',
							'medialink_colorbox_slideshowSpeed',
							'medialink_colorbox_slideshowAuto',
							'medialink_colorbox_slideshowStart',
							'medialink_colorbox_slideshowStop',
							'medialink_colorbox_fixed',
							'medialink_colorbox_top',
							'medialink_colorbox_bottom',
							'medialink_colorbox_left',
							'medialink_colorbox_right',
							'medialink_colorbox_reposition',
							'medialink_colorbox_retinaImage',
							'medialink_nivoslider_effect',
							'medialink_nivoslider_slices',
							'medialink_nivoslider_boxCols',
							'medialink_nivoslider_boxRows',
							'medialink_nivoslider_animSpeed',
							'medialink_nivoslider_pauseTime',
							'medialink_nivoslider_startSlide',
							'medialink_nivoslider_directionNav',
							'medialink_nivoslider_directionNavHide',
							'medialink_nivoslider_pauseOnHover',
							'medialink_nivoslider_manualAdvance',
							'medialink_nivoslider_prevText',
							'medialink_nivoslider_nextText',
							'medialink_nivoslider_randomStart',
							'medialink_photoswipe_fadeInSpeed',
							'medialink_photoswipe_fadeOutSpeed',
							'medialink_photoswipe_slideSpeed',
							'medialink_photoswipe_swipeThreshold',
							'medialink_photoswipe_swipeTimeThreshold',
							'medialink_photoswipe_loop',
							'medialink_photoswipe_slideshowDelay',
							'medialink_photoswipe_imageScaleMethod',
							'medialink_photoswipe_preventHide',
							'medialink_photoswipe_backButtonHideEnabled',
							'medialink_photoswipe_captionAndToolbarHide',
							'medialink_photoswipe_captionAndToolbarHideOnSwipe',
							'medialink_photoswipe_captionAndToolbarFlipPosition',
							'medialink_photoswipe_captionAndToolbarAutoHideDelay',
							'medialink_photoswipe_captionAndToolbarOpacity',
							'medialink_photoswipe_captionAndToolbarShowEmptyCaptions',
							'medialink_swipebox_hideBarsDelay'
						);

			// For Single site
			if ( !is_multisite() ) {
				foreach( $option_names as $option_name ) {
				    delete_option( $option_name );
				}
			} else {
			// For Multisite
			    // For regular options.
			    global $wpdb;
			    $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
			    $original_blog_id = get_current_blog_id();
			    foreach ( $blog_ids as $blog_id ) {
			        switch_to_blog( $blog_id );
					foreach( $option_names as $option_name ) {
					    delete_option( $option_name );
					}
			    }
			    switch_to_blog( $original_blog_id );

			    // For site options.
				foreach( $option_names as $option_name ) {
				    delete_site_option( $option_name );  
				}
			}

		}
	}

}

?>