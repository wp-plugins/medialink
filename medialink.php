<?php
/*
Plugin Name: MediaLink
Plugin URI: http://wordpress.org/plugins/medialink/
Version: 5.2
Description: MediaLink outputs as a gallery from the media library(image and music and video and document). Support the classification of the category.
Author: Katsushi Kawamori
Author URI: http://gallerylink.nyanko.org/medialink/
Domain Path: /languages
*/

/*  Copyright (c) 2013- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
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

	load_plugin_textdomain('medialink', false, basename( dirname( __FILE__ ) ) . '/languages' );

	define("MEDIALINK_PLUGIN_BASE_FILE", plugin_basename(__FILE__));

	require_once( dirname( __FILE__ ) . '/req/MediaLinkRegistAndHeader.php' );
	$medialinkregistandheader = new MediaLinkRegistAndHeader();
	add_action('admin_init', array($medialinkregistandheader, 'register_settings'));
	add_action('admin_init', array($medialinkregistandheader, 'delete_old_versions_wp_options'));
	add_action('wp_head', array($medialinkregistandheader, 'add_meta'), 0);
	add_action('wp_head', array($medialinkregistandheader, 'add_feedlink'));
	add_action('wp_head', array($medialinkregistandheader, 'add_css'));
	unset($medialinkregistandheader);

	require_once( dirname( __FILE__ ) . '/req/MediaLinkAdmin.php' );
	$medialinkadmin = new MediaLinkAdmin();
	add_action( 'admin_menu', array($medialinkadmin, 'plugin_menu'));
	add_filter( 'plugin_action_links', array($medialinkadmin, 'settings_link'), 10, 2 );
	unset($medialinkadmin);

	add_shortcode( 'medialink', 'medialink_func' );

	require_once( dirname( __FILE__ ) . '/req/MediaLinkWidgetItem.php' );
	add_action('widgets_init', create_function('', 'return register_widget("MediaLinkWidgetItem");'));

	require_once( dirname( __FILE__ ) . '/req/MediaLinkQuickTag.php' );
	$medialinkquicktag = new MediaLinkQuickTag();
	add_action('media_buttons', array($medialinkquicktag, 'add_quicktag_select'));
	add_action('admin_print_footer_scripts', array($medialinkquicktag, 'add_quicktag_button_js'));
	unset($medialinkquicktag);

/* ==================================================
 * Main
 */
function medialink_func( $atts, $html = NULL ) {

	include_once dirname(__FILE__).'/inc/MediaLink.php';
	$medialink = new MediaLink();

	extract(shortcode_atts(array(
        'set' => '',
        'sort' => '',
        'include_cat' => '',
        'suffix_pc' => '',
        'suffix_pc2' => '',
		'suffix_flash' => '',
        'suffix_sp' => '',
        'display_pc' => '',
        'display_sp' => '',
        'image_show_size' => '',
        'thumbnail'  => '',
        'exclude_cat' => '',
        'generate_rssfeed' => '',
        'rssname' => '',
        'rssmax'  => '',
        'filesize_show'  => '',
        'stamptime_show'  => '',
        'categorylinks_show'  => '',
        'pagelinks_show'  => '',
        'sortlinks_show'  => '',
        'searchbox_show'  => '',
        'rssicon_show'  => '',
        'credit_show'  => ''
	), $atts));

	$wp_uploads = wp_upload_dir();
	$wp_uploads_baseurl = $wp_uploads['baseurl'];
	$wp_uploads_path = str_replace('http://'.$_SERVER["SERVER_NAME"], '', $wp_uploads_baseurl);
	$topurl = $wp_uploads_path;

	if ( empty($set) ){
		$set = 'all';
	}
	$medialink->set = $set;

	$medialink_album = get_option('medialink_album');
	$medialink_all = get_option('medialink_all');
	$medialink_document = get_option('medialink_document');
	$medialink_exclude = get_option('medialink_exclude');
	$medialink_movie = get_option('medialink_movie');
	$medialink_music = get_option('medialink_music');
	$medialink_slideshow = get_option('medialink_slideshow');

	$rssdef = false;
	if ( $set === 'all' ){
		if( empty($sort) ) { $sort = $medialink_all['sort']; }
		$suffix_pattern_pc = $medialink->extpattern();
		$suffix_pattern_sp = $medialink->extpattern();
		$suffix_pattern_pc .= ','.strtoupper($medialink_movie['suffix_pc']).','.strtolower($medialink_movie['suffix_pc']);
		$suffix_movie_pc2 = $medialink_movie['suffix_pc2'];
		$suffix_movie_flash = $medialink_movie['suffix_flash'];
		$suffix_pattern_sp .= ','.strtoupper($medialink_movie['suffix_sp']).','.strtolower($medialink_movie['suffix_sp']);
		$suffix_pattern_pc .= ','.strtoupper($medialink_music['suffix_pc']).','.strtolower($medialink_music['suffix_pc']);
		$suffix_music_pc2 = $medialink_music['suffix_pc2'];
		$suffix_music_flash = $medialink_music['suffix_flash'];
		$suffix_pattern_sp .= ','.strtoupper($medialink_music['suffix_sp']).','.strtolower($medialink_music['suffix_sp']);
		if( empty($display_pc) ) { $display_pc = intval($medialink_all['display_pc']); }
		if( empty($display_sp) ) { $display_sp = intval($medialink_all['display_sp']); }
		if( empty($image_show_size) ) { $image_show_size = $medialink_all['image_show_size']; }
		if( empty($include_cat) ) { $include_cat = $medialink_all['include_cat']; }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = $medialink_all['generate_rssfeed']; }
		if( empty($rssname) ) {
			$rssname = $medialink_all['rssname'];
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval($medialink_all['rssmax']); }
		if( empty($filesize_show) ) { $filesize_show = $medialink_all['filesize_show']; }
		if( empty($stamptime_show) ) { $stamptime_show = $medialink_all['stamptime_show']; }
		if( empty($categorylinks_show) ) { $categorylinks_show = $medialink_all['categorylinks_show']; }
		if( empty($pagelinks_show) ) { $pagelinks_show = $medialink_all['pagelinks_show']; }
		if( empty($sortlinks_show) ) { $sortlinks_show = $medialink_all['sortlinks_show']; }
		if( empty($searchbox_show) ) { $searchbox_show = $medialink_all['searchbox_show']; }
		if( empty($rssicon_show) ) { $rssicon_show = $medialink_all['rssicon_show']; }
		if( empty($credit_show) ) { $credit_show = $medialink_all['credit_show']; }
	} else if ( $set === 'album' ){
		if( empty($sort) ) { $sort = $medialink_album['sort']; }
		if( empty($suffix_pc) ) {
			if ( $medialink_album['suffix_pc'] === 'all' ) {
				$suffix_pattern_pc = $medialink->extpattern();
			} else {
				$suffix_pattern_pc = strtoupper($medialink_album['suffix_pc']).','.strtolower($medialink_album['suffix_pc']);
			}
		} else {
			if ( $suffix_pc === 'all' ) {
				$suffix_pattern_pc = $medialink->extpattern();
			} else {
				$suffix_pattern_pc = strtoupper($suffix_pc).','.strtolower($suffix_pc);
			}
		}
		if( empty($suffix_sp) ) {
			if ( $medialink_album['suffix_sp'] === 'all' ) {
				$suffix_pattern_sp = $medialink->extpattern();
			} else {
				$suffix_pattern_sp = strtoupper($medialink_album['suffix_sp']).','.strtolower($medialink_album['suffix_sp']);
			}
		} else {
			if ( $suffix_sp === 'all' ) {
				$suffix_pattern_sp = $medialink->extpattern();
			} else {
				$suffix_pattern_sp = strtoupper($suffix_sp).','.strtolower($suffix_sp);
			}
		}
		if( empty($display_pc) ) { $display_pc = intval($medialink_album['display_pc']); }
		if( empty($display_sp) ) { $display_sp = intval($medialink_album['display_sp']); }
		if( empty($image_show_size) ) { $image_show_size = $medialink_album['image_show_size']; }
		if( empty($include_cat) ) { $include_cat = $medialink_album['include_cat']; }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = $medialink_album['generate_rssfeed']; }
		if( empty($rssname) ) {
			$rssname = $medialink_album['rssname'];
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval($medialink_album['rssmax']); }
		if( empty($filesize_show) ) { $filesize_show = $medialink_album['filesize_show']; }
		if( empty($stamptime_show) ) { $stamptime_show = $medialink_album['stamptime_show']; }
		if( empty($categorylinks_show) ) { $categorylinks_show = $medialink_album['categorylinks_show']; }
		if( empty($pagelinks_show) ) { $pagelinks_show = $medialink_album['pagelinks_show']; }
		if( empty($sortlinks_show) ) { $sortlinks_show = $medialink_album['sortlinks_show']; }
		if( empty($searchbox_show) ) { $searchbox_show = $medialink_album['searchbox_show']; }
		if( empty($rssicon_show) ) { $rssicon_show = $medialink_album['rssicon_show']; }
		if( empty($credit_show) ) { $credit_show = $medialink_album['credit_show']; }
	} else if ( $set === 'movie' ){
		if( empty($sort) ) { $sort = $medialink_movie['sort']; }
		if( empty($suffix_pc) ) {
			$suffix_pattern_pc = strtoupper($medialink_movie['suffix_pc']).','.strtolower($medialink_movie['suffix_pc']);
		} else {
			$suffix_pattern_pc = strtoupper($suffix_pc).','.strtolower($suffix_pc);
		}
		if( empty($suffix_pc2) ) { $suffix_pc2 = $medialink_movie['suffix_pc2']; }
		if( empty($suffix_flash) ) { $suffix_flash = $medialink_movie['suffix_flash']; }
		if( empty($suffix_sp) ) {
			$suffix_pattern_sp = strtoupper($medialink_movie['suffix_sp']).','.strtolower($medialink_movie['suffix_sp']);
		} else {
			$suffix_pattern_sp = strtoupper($suffix_sp).','.strtolower($suffix_sp);
		}
		if( empty($display_pc) ) { $display_pc = intval($medialink_movie['display_pc']); }
		if( empty($display_sp) ) { $display_sp = intval($medialink_movie['display_sp']); }
		if( empty($thumbnail) ) { $thumbnail = $medialink_movie['thumbnail']; }
		if( empty($include_cat) ) { $include_cat = $medialink_movie['include_cat']; }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = $medialink_movie['generate_rssfeed']; }
		if( empty($rssname) ) {
			$rssname = $medialink_movie['rssname'];
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval($medialink_movie['rssmax']); }
		if( empty($filesize_show) ) { $filesize_show = $medialink_movie['filesize_show']; }
		if( empty($stamptime_show) ) { $stamptime_show = $medialink_movie['stamptime_show']; }
		if( empty($categorylinks_show) ) { $categorylinks_show = $medialink_movie['categorylinks_show']; }
		if( empty($pagelinks_show) ) { $pagelinks_show = $medialink_movie['pagelinks_show']; }
		if( empty($sortlinks_show) ) { $sortlinks_show = $medialink_movie['sortlinks_show']; }
		if( empty($searchbox_show) ) { $searchbox_show = $medialink_movie['searchbox_show']; }
		if( empty($rssicon_show) ) { $rssicon_show = $medialink_movie['rssicon_show']; }
		if( empty($credit_show) ) { $credit_show = $medialink_movie['credit_show']; }
	} else if ( $set === 'music' ){
		if( empty($sort) ) { $sort = $medialink_music['sort']; }
		if( empty($suffix_pc) ) {
			$suffix_pattern_pc = strtoupper($medialink_music['suffix_pc']).','.strtolower($medialink_music['suffix_pc']);
		} else {
			$suffix_pattern_pc = strtoupper($suffix_pc).','.strtolower($suffix_pc);
		}
		if( empty($suffix_pc2) ) { $suffix_pc2 = $medialink_music['suffix_pc2']; }
		if( empty($suffix_flash) ) { $suffix_flash = $medialink_music['suffix_flash']; }
		if( empty($suffix_sp) ) {
			$suffix_pattern_sp = strtoupper($medialink_music['suffix_sp']).','.strtolower($medialink_music['suffix_sp']);
		} else {
			$suffix_pattern_sp = strtoupper($suffix_sp).','.strtolower($suffix_sp);
		}
		if( empty($display_pc) ) { $display_pc = intval($medialink_music['display_pc']); }
		if( empty($display_sp) ) { $display_sp = intval($medialink_music['display_sp']); }
		if( empty($thumbnail) ) { $thumbnail = $medialink_music['thumbnail']; }
		if( empty($include_cat) ) { $include_cat = $medialink_music['include_cat']; }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = $medialink_music['generate_rssfeed']; }
		if( empty($rssname) ) {
			$rssname = $medialink_music['rssname'];
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval($medialink_music['rssmax']); }
		if( empty($filesize_show) ) { $filesize_show = $medialink_music['filesize_show']; }
		if( empty($stamptime_show) ) { $stamptime_show = $medialink_music['stamptime_show']; }
		if( empty($categorylinks_show) ) { $categorylinks_show = $medialink_music['categorylinks_show']; }
		if( empty($pagelinks_show) ) { $pagelinks_show = $medialink_music['pagelinks_show']; }
		if( empty($sortlinks_show) ) { $sortlinks_show = $medialink_music['sortlinks_show']; }
		if( empty($searchbox_show) ) { $searchbox_show = $medialink_music['searchbox_show']; }
		if( empty($rssicon_show) ) { $rssicon_show = $medialink_music['rssicon_show']; }
		if( empty($credit_show) ) { $credit_show = $medialink_music['credit_show']; }
	} else if ( $set === 'slideshow' ){
		if( empty($sort) ) { $sort = $medialink_slideshow['sort']; }
		if( empty($suffix_pc) ) {
			if ( $medialink_slideshow['suffix_pc'] === 'all' ) {
				$suffix_pattern_pc = $medialink->extpattern();
			} else {
				$suffix_pattern_pc = strtoupper($medialink_slideshow['suffix_pc']).','.strtolower($medialink_slideshow['suffix_pc']);
			}
		} else {
			if ( $suffix_pc === 'all' ) {
				$suffix_pattern_pc = $medialink->extpattern();
			} else {
				$suffix_pattern_pc = strtoupper($suffix_pc).','.strtolower($suffix_pc);
			}
		}
		if( empty($suffix_sp) ) {
			if ( $medialink_slideshow['suffix_sp'] === 'all' ) {
				$suffix_pattern_sp = $medialink->extpattern();
			} else {
				$suffix_pattern_sp = strtoupper($medialink_slideshow['suffix_sp']).','.strtolower($medialink_slideshow['suffix_sp']);
			}
		} else {
			if ( $suffix_sp === 'all' ) {
				$suffix_pattern_sp = $medialink->extpattern();
			} else {
				$suffix_pattern_sp = strtoupper($suffix_sp).','.strtolower($suffix_sp);
			}
		}
		if( empty($display_pc) ) { $display_pc = intval($medialink_slideshow['display_pc']); }
		if( empty($display_sp) ) { $display_sp = intval($medialink_slideshow['display_sp']); }
		if( empty($image_show_size) ) { $image_show_size = $medialink_slideshow['image_show_size']; }
		if( empty($include_cat) ) { $include_cat = $medialink_slideshow['include_cat']; }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = $medialink_slideshow['generate_rssfeed']; }
		if( empty($rssname) ) {
			$rssname = $medialink_slideshow['rssname'];
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval($medialink_slideshow['rssmax']); }
		if( empty($filesize_show) ) { $filesize_show = $medialink_slideshow['filesize_show']; }
		if( empty($stamptime_show) ) { $stamptime_show = $medialink_slideshow['stamptime_show']; }
		if( empty($categorylinks_show) ) { $categorylinks_show = $medialink_slideshow['categorylinks_show']; }
		if( empty($pagelinks_show) ) { $pagelinks_show = $medialink_slideshow['pagelinks_show']; }
		if( empty($sortlinks_show) ) { $sortlinks_show = $medialink_slideshow['sortlinks_show']; }
		if( empty($searchbox_show) ) { $searchbox_show = $medialink_slideshow['searchbox_show']; }
		if( empty($rssicon_show) ) { $rssicon_show = $medialink_slideshow['rssicon_show']; }
		if( empty($credit_show) ) { $credit_show = $medialink_slideshow['credit_show']; }
	} else if ( $set === 'document' ){
		if( empty($sort) ) { $sort = $medialink_document['sort']; }
		if( empty($suffix_pc) ) {
			if ( $medialink_document['suffix_pc'] === 'all' ) {
				$suffix_pattern_pc = $medialink->extpattern();
			} else {
				$suffix_pattern_pc = strtoupper($medialink_document['suffix_pc']).','.strtolower($medialink_document['suffix_pc']);
			}
		} else {
			if ( $suffix_pc === 'all' ) {
				$suffix_pattern_pc = $medialink->extpattern();
			} else {
				$suffix_pattern_pc = strtoupper($suffix_pc).','.strtolower($suffix_pc);
			}
		}
		if( empty($suffix_sp) ) {
			if ( $medialink_document['suffix_sp'] === 'all' ) {
				$suffix_pattern_sp = $medialink->extpattern();
			} else {
				$suffix_pattern_sp = strtoupper($medialink_document['suffix_sp']).','.strtolower($medialink_document['suffix_sp']);
			}
		} else {
			if ( $suffix_sp === 'all' ) {
				$suffix_pattern_sp = $medialink->extpattern();
			} else {
				$suffix_pattern_sp = strtoupper($suffix_sp).','.strtolower($suffix_sp);
			}
		}
		if( empty($display_pc) ) { $display_pc = intval($medialink_document['display_pc']); }
		if( empty($display_sp) ) { $display_sp = intval($medialink_document['display_sp']); }
		if( empty($thumbnail) ) { $thumbnail = $medialink_document['thumbnail']; }
		if( empty($include_cat) ) { $include_cat = $medialink_document['include_cat']; }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = $medialink_document['generate_rssfeed']; }
		if( empty($rssname) ) {
			$rssname = $medialink_document['rssname'];
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval($medialink_document['rssmax']); }
		if( empty($filesize_show) ) { $filesize_show = $medialink_document['filesize_show']; }
		if( empty($stamptime_show) ) { $stamptime_show = $medialink_document['stamptime_show']; }
		if( empty($categorylinks_show) ) { $categorylinks_show = $medialink_document['categorylinks_show']; }
		if( empty($pagelinks_show) ) { $pagelinks_show = $medialink_document['pagelinks_show']; }
		if( empty($sortlinks_show) ) { $sortlinks_show = $medialink_document['sortlinks_show']; }
		if( empty($searchbox_show) ) { $searchbox_show = $medialink_document['searchbox_show']; }
		if( empty($rssicon_show) ) { $rssicon_show = $medialink_document['rssicon_show']; }
		if( empty($credit_show) ) { $credit_show = $medialink_document['credit_show']; }
	}
	if ( empty($exclude_cat) ) {
		$exclude_cat = $medialink_exclude['cat'];
	}

	$wp_path = str_replace('http://'.$_SERVER["SERVER_NAME"], '', get_bloginfo('wpurl')).'/';
	$server_root = $_SERVER['DOCUMENT_ROOT'];
	$document_root = $server_root.$topurl;

	$mode = NULL;
	$suffix = NULL;
	$display = NULL;
	$mode = $medialink->agent_check();
	if ( $mode === 'pc' ) {
		$suffix_pattern = $suffix_pattern_pc;
		$display = $display_pc;
	} else {
		$suffix_pattern = $suffix_pattern_sp;
		$display = $display_sp;
	}

	if ( $set === 'movie' || $set === 'music' ) {
		$suffix_pc2 =  '.'.$suffix_pc2;
		$suffix_flash = '.'.$suffix_flash;
	}

	$catparam = NULL;
	$fparam = NULL;
	$page = NULL;
	$search = NULL;
	if (!empty($_GET['mlcat'])){
		$catparam = urldecode($_GET['mlcat']);	//categories
	}
	if (!empty($_GET['f'])){
		$fparam = urldecode($_GET['f']);	//files
	}
	if (!empty($_GET['mlp'])){
		$page = $_GET['mlp'];				//pages
	}
	if (!empty($_GET['mls'])){
		$search = urldecode($_GET['mls']);	//search word
	}
	if (!empty($_GET['sort'])){
		$sort = $_GET['sort'];				//sort
	}
	$catparam = mb_convert_encoding($catparam, "UTF-8", "auto");
	$fparam = mb_convert_encoding($fparam, "UTF-8", "auto");
	$search = mb_convert_encoding($search, "UTF-8", "auto");

	$sortnamenew = __('New', 'medialink');
	$sortnameold = __('Old', 'medialink');
	$sortnamedes = __('Des', 'medialink');
	$sortnameasc = __('Asc', 'medialink');
	$searchbutton = __('Search', 'medialink');
	$categoryselectall = __('all', 'medialink');
	$categoryselectbutton = __('Select', 'medialink');

	$sortnamenew = mb_convert_encoding($sortnamenew, "UTF-8", "auto");
	$sortnameold = mb_convert_encoding($sortnameold, "UTF-8", "auto");
	$sortnamedes = mb_convert_encoding($sortnamedes, "UTF-8", "auto");
	$sortnameasc = mb_convert_encoding($sortnameasc, "UTF-8", "auto");
	$searchbutton = mb_convert_encoding($searchbutton, "UTF-8", "auto");
	$categoryselectall = mb_convert_encoding($categoryselectall, "UTF-8", "auto");
	$categoryselectbutton = mb_convert_encoding($categoryselectbutton, "UTF-8", "auto");

	$pluginurl = plugins_url($path='',$scheme=null);

	$medialink->thumbnail = $thumbnail;
	$medialink->include_cat = $include_cat;
	$medialink->exclude_cat = $exclude_cat;
	$medialink->image_show_size = $image_show_size;
	$medialink->generate_rssfeed = $generate_rssfeed;
	$medialink->search = $search;
	$medialink->catparam = $catparam;
	$medialink->topurl = $topurl;
	$medialink->wp_uploads_baseurl = $wp_uploads_baseurl;
	$medialink->wp_path = $wp_path;
	$medialink->pluginurl = $pluginurl;
	$medialink->document_root = $document_root;
	$medialink->mode = $mode;
	$medialink->rssname = $rssname;
	$medialink->rssmax = $rssmax;
	$medialink->sort = $sort;
	$medialink->filesize_show = $filesize_show;
	$medialink->stamptime_show = $stamptime_show;

	$files = array();
	$titles = array();
	$categories = array();
	$thumblinks = array();
	$largemediumlinks = array();
	$rssfiles = array();
	$rsstitles = array();
	$rssthumblinks = array();
	$rsslargemediumlinks = array();

	$sort_key = NULL;
	$sort_order = NULL;
	if ( $sort === 'new' || empty($sort) ) {
		$sort_key = 'date';
		$sort_order = 'DESC';
	} else if ($sort === 'old') {
		$sort_key = 'date';
		$sort_order = 'ASC';
	} else if ($sort === 'des') {
		$sort_key = 'title';
		$sort_order = 'DESC';
	} else if ($sort === 'asc') {
		$sort_key = 'title';
		$sort_order = 'ASC';
	}
	$medialink->sort_order = $sort_order;

	$suffix_patterns = explode(',',$suffix_pattern);
	foreach ( $suffix_patterns as $suffix ) {
		$postmimes[] = $medialink->mime_type('.'.$suffix);
	}
	$postmimes = array_unique($postmimes);
	$mimepattern_count = 0;
	$postmimepattern = NULL;
	foreach ( $postmimes as $postmime ) {
		if ( $mimepattern_count == 0 ) {
			$postmimepattern .= $postmime;
		} else {
			$postmimepattern .= ','.$postmime;
		}
		++ $mimepattern_count;
	}
	unset ( $suffix_patterns, $postmimes );

	$args = array(
		'post_type' => 'attachment',
		'post_mime_type' => $postmimepattern,
		'numberposts' => -1,
		'orderby' => $sort_key,
		'order' => $sort_order,
		's' => $search
		); 

	$attachments = get_posts($args);

	list($files, $titles, $thumblinks, $largemediumlinks, $categories, $rssfiles, $rsstitles, $rssthumblinks, $rsslargemediumlinks) = $medialink->scan_media($attachments);
	unset($attachments);

	$maxpage = ceil(count($files) / $display);
	if(empty($page)){
		$page = 1;
	}
	$medialink->page = $page;
	$medialink->maxpage = $maxpage;

	$beginfiles = 0;
	$endfiles = 0;
	if( $page == $maxpage){
		$beginfiles = $display * ( $page - 1 );
		$endfiles = count($files) - 1;
	}else{
		$beginfiles = $display * ( $page - 1 );
		$endfiles = ( $display * $page ) - 1;
	}

	$linkfiles = NULL;
	$titlename = NULL;
	if ($files) {
		for ( $i = $beginfiles; $i <= $endfiles; $i++ ) {
			$linkfile = $medialink->print_file($files[$i],$titles[$i],$thumblinks[$i],$largemediumlinks[$i]);
			$linkfiles = $linkfiles.$linkfile;
			if ( $files[$i] === '/'.$fparam ) {
				$titlename = $titles[$i];
			}
		}
	}

	$categories = array_unique($categories);
	$linkcategories = NULL;
	foreach ($categories as $linkcategory) {
		$linkcategory = mb_convert_encoding(str_replace($document_root."/", "", $linkcategory), "UTF-8", "auto");
		if($catparam === $linkcategory){
			$linkcategory = '<option value="'.$linkcategory.'" selected>'.$linkcategory.'</option>';
		}else{
			$linkcategory = '<option value="'.$linkcategory.'">'.$linkcategory.'</option>';
		}
		$linkcategories = $linkcategories.$linkcategory;
	}
	$categoryselectall = mb_convert_encoding($categoryselectall, "UTF-8", "auto");
	if(empty($catparam)){
		$linkcategory = '<option value="" selected>'.$categoryselectall.'</option>';
	}else{
		$linkcategory = '<option value="">'.$categoryselectall.'</option>';
	}
	$linkcategories = $linkcategories.$linkcategory;

	$linkpages = NULL;
	$linkpages = $medialink->print_pages();

	$servername = $_SERVER['HTTP_HOST'];
	$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	$query = $_SERVER['QUERY_STRING'];

	$currentcategory = $catparam;
	$selectedfilename = $titlename;

	$pagestr = '&mlp='.$page;

	$queryhead = $medialink->permlink_queryhead();

	$permlinkstrform = NULL;
	$scripturl = $scriptname;
	if( $queryhead <> '?' ){
		$perm_id = get_the_ID();
		if( is_page($perm_id) ) {
			$permlinkstrform = '<input type="hidden" name="page_id" value="'.$perm_id.'">';
		} else {
			$permlinkstrform = '<input type="hidden" name="p" value="'.$perm_id.'">';
		}
	}
	$scripturl .= $queryhead;

	$currentcategory_encode = urlencode($catparam);
	if ( empty($currentcategory) ){
		$scripturl .= $pagestr;
	}else{
		$scripturl .= "&mlcat=".$currentcategory_encode.$pagestr;
	}

	$fparam = mb_convert_encoding($fparam, "UTF-8", "auto");

	$prevfile = "";
	if (!empty($fparam)) {
		$prevfile = $topurl.'/'.str_replace("%2F","/",urlencode($fparam));
	}
	$prevfiles = explode('.', $prevfile);
	$prevfile_nosuffix = str_replace('.'.end($prevfiles), "", $prevfile);

	$sortnamenew = mb_convert_encoding($sortnamenew, "UTF-8", "auto");
	$sortnameold = mb_convert_encoding($sortnameold, "UTF-8", "auto");
	$sortnamedes = mb_convert_encoding($sortnamedes, "UTF-8", "auto");
	$sortnameasc = mb_convert_encoding($sortnameasc, "UTF-8", "auto");
	if( $mode === 'sp' ){
		$page_no_tag_left = '<a>';
		$page_no_tag_right = '</a>';
	} else {
		$page_no_tag_left = NULL;
		$page_no_tag_right = NULL;
	}
	if ( $sort === 'new' || empty($sort) ) {
		$sortlink_n = $page_no_tag_left.$sortnamenew.$page_no_tag_right;
		$sortlink_o = '<a href="'.$scripturl.'&sort=old">'.$sortnameold.'</a>';
		$sortlink_d = '<a href="'.$scripturl.'&sort=des">'.$sortnamedes.'</a>';
		$sortlink_a = '<a href="'.$scripturl.'&sort=asc">'.$sortnameasc.'</a>';
	} else if ($sort === 'old') {
		// old
		$sortlink_n = '<a href="'.$scripturl.'&sort=new">'.$sortnamenew.'</a>';
		$sortlink_o = $page_no_tag_left.$sortnameold.$page_no_tag_right;
		$sortlink_d = '<a href="'.$scripturl.'&sort=des">'.$sortnamedes.'</a>';
		$sortlink_a = '<a href="'.$scripturl.'&sort=asc">'.$sortnameasc.'</a>';
	} else if ($sort === 'des') {
		// des
		$sortlink_n = '<a href="'.$scripturl.'&sort=new">'.$sortnamenew.'</a>';
		$sortlink_o = '<a href="'.$scripturl.'&sort=old">'.$sortnameold.'</a>';
		$sortlink_d = $page_no_tag_left.$sortnamedes.$page_no_tag_right;
		$sortlink_a = '<a href="'.$scripturl.'&sort=asc">'.$sortnameasc.'</a>';
	} else if ($sort === 'asc') {
		// asc
		$sortlink_n = '<a href="'.$scripturl.'&sort=new">'.$sortnamenew.'</a>';
		$sortlink_o = '<a href="'.$scripturl.'&sort=old">'.$sortnameold.'</a>';
		$sortlink_d = '<a href="'.$scripturl.'&sort=des">'.$sortnamedes.'</a>';
		$sortlink_a = $page_no_tag_left.$sortnameasc.$page_no_tag_right;
	}
	if ( $mode === 'sp' ) {
		$sortlinks = '<li>'.$sortlink_n.'</li><li>'.$sortlink_o.'</li><li>'.$sortlink_d.'</li><li>'.$sortlink_a.'</li>';
	} else {
		$sortlinks = 'Sort:|'.$sortlink_n.'|'.$sortlink_o.'|'.$sortlink_d.'|'.$sortlink_a.'|';
	}

$categoryselectbox = <<<CATEGORYSELECTBOX
<form method="get" action="{$scriptname}">
{$permlinkstrform}
<select name="mlcat" onchange="submit(this.form)">
{$linkcategories}
</select>
</form>
CATEGORYSELECTBOX;

	$searchbutton = mb_convert_encoding($searchbutton, "UTF-8", "auto");
	$search = mb_convert_encoding($search, "UTF-8", "auto");
$searchform = <<<SEARCHFORM
<form method="get" action="{$scriptname}">
{$permlinkstrform}
<input type="hidden" name="mlcat" value="{$catparam}">
<input type="text" name="mls" value="{$search}">
<input type="submit" value="{$searchbutton}">
</form>
SEARCHFORM;

list($movie_container_w, $movie_container_h) = explode( 'x', $medialink_movie['container'] );

//MoviePlayerContainer
$movieplayercontainer = <<<MOVIEPLAYERCONTAINER
<div id="PlayerContainer-medialink">
<video controls style="border" height="{$movie_container_h}" width="{$movie_container_w}" autoplay onclick="this.play()">
<source src="{$prevfile}">
<source src="{$prevfile_nosuffix}{$suffix_pc2}">
<object>
<embed
  type="application/x-shockwave-flash"
  width="{$movie_container_w}"
  height="{$movie_container_h}"
  bgcolor="#000000"
  src="{$pluginurl}/medialink/flowplayer/flowplayer-3.2.15.swf"
  allowFullScreen="true"
  flashvars='config={
    "clip":{
      "url":"{$prevfile_nosuffix}{$suffix_flash}",
      "urlEncoding":true,
      "scaling":"fit",
      "autoPlay":true,
      "autoBuffering":true
    }
  }'
>
</object>
</video>
</div>
MOVIEPLAYERCONTAINER;

//MoviePlayerContainerIE9
$movieplayercontainerIE9 = <<<MOVIEPLAYERCONTAINERIE9
<div id="PlayerContainer-medialink">
<object>
<embed
  type="application/x-shockwave-flash"
  width="{$movie_container_w}"
  height="{$movie_container_h}"
  bgcolor="#000000"
  src="{$pluginurl}/medialink/flowplayer/flowplayer-3.2.15.swf"
  allowFullScreen="true"
  flashvars='config={
    "clip":{
      "url":"{$prevfile_nosuffix}{$suffix_flash}",
      "urlEncoding":true,
      "scaling":"fit",
      "autoPlay":true,
      "autoBuffering":true
    }
  }'
>
</object>
</div>
MOVIEPLAYERCONTAINERIE9;

//MusicPlayerContainer
$musicplayercontainer = <<<MUSICPLAYERCONTAINER
<div id="PlayerContainer-medialink">
<audio controls style="border" autoplay onclick="this.play()">
<source src="{$prevfile}">
<source src="{$prevfile_nosuffix}{$suffix_pc2}">
<div id="FlashContainer"></div>
</audio>
</div>
MUSICPLAYERCONTAINER;

//FlashMusicPlayer
$flashmusicplayer = <<<FLASHMUSICPLAYER
<script type="text/javascript">
jQuery(document).ready(
function () {
jQuery('#FlashContainer').flash(
{swf: '{$pluginurl}/medialink/player_mp3/player_mp3.swf',width: '200',height: '20',
flashvars: {
mp3: '{$prevfile_nosuffix}{$suffix_flash}',
autoplay: '1'},allowFullScreen: 'true',allowScriptAccess: 'always'});});
</script>
FLASHMUSICPLAYER;

	if ( $mode === 'pc' ) {
		wp_enqueue_style( 'pc for medialink',  $pluginurl.'/medialink/css/medialink.css' );
		wp_enqueue_script( 'jquery' );
		if ( $set === 'all' ){
			wp_enqueue_script( 'jQuery SWFObject', $pluginurl.'/medialink/jqueryswf/jquery.swfobject.1-1-1.min.js', null, '1.1.1' );
			if( !empty($selectedfilename) ) { $html .= '<h2>'.$selectedfilename.'</h2>'; }
		} else {
			if ( $set === 'music' ){
				wp_enqueue_script( 'jQuery SWFObject', $pluginurl.'/medialink/jqueryswf/jquery.swfobject.1-1-1.min.js', null, '1.1.1' );
			}
			if ( $set <> 'document' && !empty($selectedfilename) ){
				$html .= '<h2>'.$selectedfilename.'</h2>';
			}
		}
	} else if ( $mode === 'sp') {
		// for smartphone
		wp_enqueue_style( 'smartphone for medialink',  $pluginurl.'/medialink/css/medialink_sp.css' );
		wp_enqueue_script( 'jquery' );
	}

	$fparamexts = explode('.', $fparam);
	$fparamext = end($fparamexts);
	if ( !empty($fparam) ) {
		if ( $mode === 'pc' && wp_ext2type($fparamext) === 'video' ) {
			if(preg_match("/MSIE 9\.0/", $_SERVER['HTTP_USER_AGENT'])){
				$html .= $movieplayercontainerIE9;
			} else {
				$html .= $movieplayercontainer;
			}
		} else if ( $mode === 'pc' && wp_ext2type($fparamext) === 'audio' ) {
			$html .= $flashmusicplayer;
			$html .= $musicplayercontainer;
		}
	}

	$linkfiles_begin = NULL;
	$linkfiles_end = NULL;
	$categoryselectbox_begin = NULL;
	$categoryselectbox_end = NULL;
	$linkpages_begin = NULL;
	$linkpages_end = NULL;
	$sortlink_begin = NULL;
	$sortlink_end = NULL;
	$searchform_begin = NULL;
	$searchform_end = NULL;
	$rssfeeds_icon = NULL;
	if ( $set === 'album' || $set === 'slideshow' ){
		if ($mode === 'pc'){
			$linkfiles_begin = '<div class = "medialink">';
			$linkfiles_end = '</div><br clear=all>';
		} else if ($mode === 'sp'){
			$linkfiles_begin = '<div class="medialinkthumb">';
			$linkfiles_end = '</div>';
		}
		if ( $mode === 'pc' ) {
			$categoryselectbox_begin = '<div align="right">';
			$categoryselectbox_end = '</div>';
			$linkpages_begin = '<div align="center">';
			$linkpages_end = '</div>';
			$sortlink_begin = '<div align="right">';
			$sortlink_end = '</div>';
			$searchform_begin = '<div align="center">';
			$searchform_end = '</div>';
		} else if ( $mode === 'sp' ) {
			$categoryselectbox_begin = '<div>';
			$categoryselectbox_end = '</div>';
			$linkpages_begin = '<nav class="g_nav"><ul>';
			$linkpages_end = '</ul></nav>';
			$sortlink_begin = '<nav class="g_nav"><ul>';
			$sortlink_end = '</ul></nav>';
			$searchform_begin = '<div>';
			$searchform_end = '</div>';
		}
	}else{
		if ( $mode === 'pc' ) {
			$linkfiles_begin = '<div id="playlists-medialink">';
			$linkfiles_end = '</div><br clear="all">';
			$categoryselectbox_begin = '<div align="right">';
			$categoryselectbox_end = '</div>';
			$linkpages_begin = '<div align="center">';
			$linkpages_end = '</div>';
			$sortlink_begin = '<div align="right">';
			$sortlink_end = '</div>';
			$searchform_begin = '<div align="center">';
			$searchform_end = '</div>';
		} else if ( $mode === 'sp' ) {
			$linkfiles_begin = '<div class="list"><ul>';
			$linkfiles_end = '</ul></div>';
			$categoryselectbox_begin = '<div>';
			$categoryselectbox_end = '</div>';
			$linkpages_begin = '<nav class="g_nav"><ul>';
			$linkpages_end = '</ul></nav>';
			$sortlink_begin = '<nav class="g_nav"><ul>';
			$sortlink_end = '</ul></nav>';
			$searchform_begin = '<div>';
			$searchform_end = '</div>';
		}
	}

	$html .= $linkfiles_begin;
	$html .= $linkfiles;
	$html .= $linkfiles_end;

	if ( $categorylinks_show === 'Show' ) {
		$html .= $categoryselectbox_begin;
		$html .= $categoryselectbox;
		$html .= $categoryselectbox_end;
	}

	if ( $pagelinks_show === 'Show' ) {
		$html .= $linkpages_begin;
		$html .= $linkpages;
		$html .= $linkpages_end;
	}

	if ( $sortlinks_show === 'Show' ) {
		$html .= $sortlink_begin;
		$html .= $sortlinks;
		$html .= $sortlink_end;
	}

	if ( $searchbox_show === 'Show' ) {
		$html .= $searchform_begin;
		$html .= $searchform;
		$html .= $searchform_end;
	}

	// RSS Feeds
	if ($generate_rssfeed === 'on') {
		$xml_title =  get_bloginfo('name').' | '.get_the_title();

		$rssfeed_url = $topurl.'/'.$rssname.'.xml';
		if ( $set === "album" || $set === "slideshow" || $set === "document" ) {
			$rssfeeds_icon = '<div align="right"><a href="'.$rssfeed_url.'"><img src="'.$pluginurl.'/medialink/icon/rssfeeds.png"></a></div>';
		} else {
			$rssfeeds_icon = '<div align="right"><a href="'.$rssfeed_url.'"><img src="'.$pluginurl.'/medialink/icon/podcast.png"></a></div>';
		}
		if ( $mode === "pc" || $mode === "sp" ) {
			if ( $rssicon_show === 'Show' ) { $html .= $rssfeeds_icon; }
			if ( $rssdef === false ) {
				$html .= '<link rel="alternate" type="application/rss+xml" href="'.$rssfeed_url.'" title="'.$xml_title.'" />';
			}
		}
		if(!empty($rssfiles)){
			$medialink->rss_wirte($xml_title, $rssfiles, $rsstitles, $rssthumblinks, $rsslargemediumlinks);
		}
	}

	if ( $credit_show === 'Show' ) {
		$html .= '<div align = "right"><a href="http://wordpress.org/plugins/medialink/"><span style="font-size : xx-small">by MediaLink</span></a></div>';
	}

	$html = apply_filters( 'post_medialink', $html );

	return $html;

}

?>