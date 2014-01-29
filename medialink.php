<?php
/*
Plugin Name: MediaLink
Plugin URI: http://wordpress.org/plugins/medialink/
Version: 2.7
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
	add_action('wp_head', array($medialinkregistandheader, 'add_meta'), 0);
	add_action('wp_head', array($medialinkregistandheader, 'add_feedlink'));
	add_action('wp_head', array($medialinkregistandheader, 'add_css'));
	unset($medialinkregistandheader);

	add_action( 'wp_head', wp_enqueue_script('jquery') );

	require_once( dirname( __FILE__ ) . '/req/MediaLinkAdmin.php' );
	$medialinkadmin = new MediaLinkAdmin();
	add_action( 'admin_menu', array($medialinkadmin, 'plugin_menu'));
	add_filter( 'plugin_action_links', array($medialinkadmin, 'settings_link'), 10, 2 );
	unset($medialinkadmin);

	add_shortcode( 'medialink', 'medialink_func' );

	require_once( dirname( __FILE__ ) . '/req/MediaLinkWidgetItem.php' );
	add_action('widgets_init', create_function('', 'return register_widget("MediaLinkWidgetItem");'));

/* ==================================================
 * Main
 */
function medialink_func( $atts, $html = NULL ) {

	include_once dirname(__FILE__).'/inc/MediaLink.php';
	$medialink = new MediaLink();

	extract(shortcode_atts(array(
        'set' => '',
        'sort' => '',
        'effect_pc' => '',
        'effect_sp' => '',
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

	$rssdef = false;
	if ( $set === 'album' ){
		if( empty($sort) ) { $sort = get_option('medialink_album_sort'); }
		if( empty($effect_pc) ) { $effect_pc = get_option('medialink_album_effect_pc'); }
		if( empty($effect_sp) ) { $effect_sp = get_option('medialink_album_effect_sp'); }
		if( empty($suffix_pc) ) { $suffix_pc = get_option('medialink_album_suffix_pc'); }
		if( empty($suffix_sp) ) { $suffix_sp = get_option('medialink_album_suffix_sp'); }
		if( empty($display_pc) ) { $display_pc = intval(get_option('medialink_album_display_pc')); }
		if( empty($display_sp) ) { $display_sp = intval(get_option('medialink_album_display_sp')); }
		if( empty($image_show_size) ) { $image_show_size = get_option('medialink_album_image_show_size'); }
		if( empty($include_cat) ) { $include_cat = get_option('medialink_album_include_cat'); }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = get_option('medialink_album_generate_rssfeed'); }
		if( empty($rssname) ) {
			$rssname = get_option('medialink_album_rssname');
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval(get_option('medialink_album_rssmax')); }
		if( empty($categorylinks_show) ) { $categorylinks_show = get_option('medialink_album_categorylinks_show'); }
		if( empty($pagelinks_show) ) { $pagelinks_show = get_option('medialink_album_pagelinks_show'); }
		if( empty($sortlinks_show) ) { $sortlinks_show = get_option('medialink_album_sortlinks_show'); }
		if( empty($searchbox_show) ) { $searchbox_show = get_option('medialink_album_searchbox_show'); }
		if( empty($rssicon_show) ) { $rssicon_show = get_option('medialink_album_rssicon_show'); }
		if( empty($credit_show) ) { $credit_show = get_option('medialink_album_credit_show'); }
	} else if ( $set === 'movie' ){
		if( empty($sort) ) { $sort = get_option('medialink_movie_sort'); }
		if( empty($suffix_pc) ) { $suffix_pc = get_option('medialink_movie_suffix_pc'); }
		if( empty($suffix_pc2) ) { $suffix_pc2 = get_option('medialink_movie_suffix_pc2'); }
		if( empty($suffix_flash) ) { $suffix_flash = get_option('medialink_movie_suffix_flash'); }
		if( empty($suffix_sp) ) { $suffix_sp = get_option('medialink_movie_suffix_sp'); }
		if( empty($display_pc) ) { $display_pc = intval(get_option('medialink_movie_display_pc')); }
		if( empty($display_sp) ) { $display_sp = intval(get_option('medialink_movie_display_sp')); }
		if( empty($thumbnail) ) { $thumbnail = get_option('medialink_movie_suffix_thumbnail'); }
		if( empty($include_cat) ) { $include_cat = get_option('medialink_movie_include_cat'); }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = get_option('medialink_movie_generate_rssfeed'); }
		if( empty($rssname) ) {
			$rssname = get_option('medialink_movie_rssname');
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval(get_option('medialink_movie_rssmax')); }
		if( empty($categorylinks_show) ) { $categorylinks_show = get_option('medialink_movie_categorylinks_show'); }
		if( empty($pagelinks_show) ) { $pagelinks_show = get_option('medialink_movie_pagelinks_show'); }
		if( empty($sortlinks_show) ) { $sortlinks_show = get_option('medialink_movie_sortlinks_show'); }
		if( empty($searchbox_show) ) { $searchbox_show = get_option('medialink_movie_searchbox_show'); }
		if( empty($rssicon_show) ) { $rssicon_show = get_option('medialink_movie_rssicon_show'); }
		if( empty($credit_show) ) { $credit_show = get_option('medialink_movie_credit_show'); }
	} else if ( $set === 'music' ){
		if( empty($sort) ) { $sort = get_option('medialink_music_sort'); }
		if( empty($suffix_pc) ) { $suffix_pc = get_option('medialink_music_suffix_pc'); }
		if( empty($suffix_pc2) ) { $suffix_pc2 = get_option('medialink_music_suffix_pc2'); }
		if( empty($suffix_flash) ) { $suffix_flash = get_option('medialink_music_suffix_flash'); }
		if( empty($suffix_sp) ) { $suffix_sp = get_option('medialink_music_suffix_sp'); }
		if( empty($display_pc) ) { $display_pc = intval(get_option('medialink_music_display_pc')); }
		if( empty($display_sp) ) { $display_sp = intval(get_option('medialink_music_display_sp')); }
		if( empty($thumbnail) ) { $thumbnail = get_option('medialink_music_suffix_thumbnail'); }
		if( empty($include_cat) ) { $include_cat = get_option('medialink_music_include_cat'); }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = get_option('medialink_music_generate_rssfeed'); }
		if( empty($rssname) ) {
			$rssname = get_option('medialink_music_rssname');
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval(get_option('medialink_music_rssmax')); }
		if( empty($categorylinks_show) ) { $categorylinks_show = get_option('medialink_music_categorylinks_show'); }
		if( empty($pagelinks_show) ) { $pagelinks_show = get_option('medialink_music_pagelinks_show'); }
		if( empty($sortlinks_show) ) { $sortlinks_show = get_option('medialink_music_sortlinks_show'); }
		if( empty($searchbox_show) ) { $searchbox_show = get_option('medialink_music_searchbox_show'); }
		if( empty($rssicon_show) ) { $rssicon_show = get_option('medialink_music_rssicon_show'); }
		if( empty($credit_show) ) { $credit_show = get_option('medialink_music_credit_show'); }
	} else if ( $set === 'slideshow' ){
		if( empty($sort) ) { $sort = get_option('medialink_slideshow_sort'); }
		if( empty($effect_pc) ) { $effect_pc = get_option('medialink_slideshow_effect_pc'); }
		if( empty($effect_sp) ) { $effect_sp = get_option('medialink_slideshow_effect_sp'); }
		if( empty($suffix_pc) ) { $suffix_pc = get_option('medialink_slideshow_suffix_pc'); }
		if( empty($suffix_sp) ) { $suffix_sp = get_option('medialink_slideshow_suffix_sp'); }
		if( empty($display_pc) ) { $display_pc = intval(get_option('medialink_slideshow_display_pc')); }
		if( empty($display_sp) ) { $display_sp = intval(get_option('medialink_slideshow_display_sp')); }
		if( empty($image_show_size) ) { $image_show_size = get_option('medialink_slideshow_image_show_size'); }
		if( empty($include_cat) ) { $include_cat = get_option('medialink_slideshow_include_cat'); }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = get_option('medialink_slideshow_generate_rssfeed'); }
		if( empty($rssname) ) {
			$rssname = get_option('medialink_slideshow_rssname');
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval(get_option('medialink_slideshow_rssmax')); }
		if( empty($categorylinks_show) ) { $categorylinks_show = get_option('medialink_slideshow_categorylinks_show'); }
		if( empty($pagelinks_show) ) { $pagelinks_show = get_option('medialink_slideshow_pagelinks_show'); }
		if( empty($sortlinks_show) ) { $sortlinks_show = get_option('medialink_slideshow_sortlinks_show'); }
		if( empty($searchbox_show) ) { $searchbox_show = get_option('medialink_slideshow_searchbox_show'); }
		if( empty($rssicon_show) ) { $rssicon_show = get_option('medialink_slideshow_rssicon_show'); }
		if( empty($credit_show) ) { $credit_show = get_option('medialink_slideshow_credit_show'); }
	} else if ( $set === 'document' ){
		if( empty($sort) ) { $sort = get_option('medialink_document_sort'); }
		if( empty($suffix_pc) ) { $suffix_pc = get_option('medialink_document_suffix_pc'); }
		if( empty($suffix_sp) ) { $suffix_sp = get_option('medialink_document_suffix_sp'); }
		if( empty($display_pc) ) { $display_pc = intval(get_option('medialink_document_display_pc')); }
		if( empty($display_sp) ) { $display_sp = intval(get_option('medialink_document_display_sp')); }
		if( empty($thumbnail) ) { $thumbnail = get_option('medialink_document_suffix_thumbnail'); }
		if( empty($include_cat) ) { $include_cat = get_option('medialink_document_include_cat'); }
		if( empty($generate_rssfeed) ) { $generate_rssfeed = get_option('medialink_document_generate_rssfeed'); }
		if( empty($rssname) ) {
			$rssname = get_option('medialink_document_rssname');
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval(get_option('medialink_document_rssmax')); }
		if( empty($categorylinks_show) ) { $categorylinks_show = get_option('medialink_document_categorylinks_show'); }
		if( empty($pagelinks_show) ) { $pagelinks_show = get_option('medialink_document_pagelinks_show'); }
		if( empty($sortlinks_show) ) { $sortlinks_show = get_option('medialink_document_sortlinks_show'); }
		if( empty($searchbox_show) ) { $searchbox_show = get_option('medialink_document_searchbox_show'); }
		if( empty($rssicon_show) ) { $rssicon_show = get_option('medialink_document_rssicon_show'); }
		if( empty($credit_show) ) { $credit_show = get_option('medialink_document_credit_show'); }
	}
	if ( empty($exclude_cat) ) {
		$exclude_cat = get_option('medialink_exclude_cat');
	}

	$wp_path = str_replace('http://'.$_SERVER["SERVER_NAME"], '', get_bloginfo('wpurl')).'/';
	$document_root = str_replace($wp_path, '', str_replace("\\", "/", ABSPATH)).$topurl;

	$mode = NULL;
	$suffix = NULL;
	$display = NULL;
	$mode = $medialink->agent_check();
	if ( $mode === 'pc' ) {
		$effect = $effect_pc;
		$suffix = $suffix_pc;
		$display = $display_pc;
	} else {
		$effect = $effect_sp;
		$suffix = $suffix_sp;
		$display = $display_sp;
	}
	$suffix = '.'.$suffix;
	if ( $set === 'movie' || $set === 'music' ) {
		$suffix_pc2 =  '.'.$suffix_pc2;
		$suffix_flash = '.'.$suffix_flash;
		if( !empty($thumbnail) ) {
			$thumbnail = '.'.$thumbnail;
		}
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

	$displayprev = mb_convert_encoding($displayprev, "UTF-8", "auto");
	$displaynext = mb_convert_encoding($displaynext, "UTF-8", "auto");
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
	$medialink->set = $set;
	$medialink->mode = $mode;
	$medialink->effect = $effect;
	$medialink->rssname = $rssname;
	$medialink->rssmax = $rssmax;
	$medialink->sort = $sort;

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

	$args = array(
		'post_type' => 'attachment',
		'post_mime_type' => $medialink->mime_type($suffix),
		'numberposts' => -1,
		'orderby' => $sort_key,
		'order' => $sort_order,
		's' => $search,
		'post_status' => null,
		'post_parent' => $post->ID
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

	$permlinkstrform = NULL;
	$permalinkstruct = NULL;
	$permalinkstruct = get_option('permalink_structure');
	$scripturl = $scriptname;
	if( empty($permalinkstruct) ){
		$perm_id = get_the_ID();
		$scripturl .= '?page_id='.$perm_id;
		$permlinkstrform = '<input type="hidden" name="page_id" value="'.$perm_id.'">';
	} else {
		$scripturl .= '?';
	}

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
	$prevfile_nosuffix = str_replace($suffix, "", $prevfile);

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

list($movie_container_w, $movie_container_h) = explode( 'x', get_option('medialink_movie_container') );

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
		if ( $set === 'album' || $set === 'slideshow'){
			if ($effect === 'nivoslider'){
				// for Nivo Slider
				wp_enqueue_style( 'nivoslider-theme-def',  $pluginurl.'/medialink/nivo-slider/themes/default/default.css' );
				wp_enqueue_style( 'nivoslider-theme-light',  $pluginurl.'/medialink/nivo-slider/themes/light/light.css' );
				wp_enqueue_style( 'nivoslider-theme-dark',  $pluginurl.'/medialink/nivo-slider/themes/dark/dark.css' );
				wp_enqueue_style( 'nivoslider-theme-bar',  $pluginurl.'/medialink/nivo-slider/themes/bar/bar.css' );
				wp_enqueue_style( 'nivoslider',  $pluginurl.'/medialink/nivo-slider/nivo-slider.css' );
				wp_enqueue_script( 'nivoslider', $pluginurl.'/medialink/nivo-slider/jquery.nivo.slider.pack.js', null, '3.2');
				wp_enqueue_script( 'nivoslider-in', $pluginurl.'/medialink/js/nivoslider-in.js' );
			} else if ($effect === 'colorbox'){
				// for COLORBOX
				wp_enqueue_style( 'colorbox',  $pluginurl.'/medialink/colorbox/colorbox.css' );
				wp_enqueue_script( 'colorbox', $pluginurl.'/medialink/colorbox/jquery.colorbox-min.js', null, '1.3.20.1');
				wp_enqueue_script( 'colorbox-in', $pluginurl.'/medialink/js/colorbox-in.js' );
			}
		} else {
			if ( $set === 'music' ){
				wp_enqueue_script( 'jQuery SWFObject', $pluginurl.'/medialink/jqueryswf/jquery.swfobject.1-1-1.min.js', null, '1.1.1' );
			}
			if ( $set <> 'document' ){
				$html .= '<h2>'.$selectedfilename.'</h2>';
			}
		}
	} else if ( $mode === 'sp') {
		if ( $set === 'album' || $set === 'slideshow'){
			if ($effect === 'nivoslider'){
				// for Nivo Slider
				wp_enqueue_style( 'nivoslider-theme-def',  $pluginurl.'/medialink/nivo-slider/themes/default/default.css' );
				wp_enqueue_style( 'nivoslider-theme-light',  $pluginurl.'/medialink/nivo-slider/themes/light/light.css' );
				wp_enqueue_style( 'nivoslider-theme-dark',  $pluginurl.'/medialink/nivo-slider/themes/dark/dark.css' );
				wp_enqueue_style( 'nivoslider-theme-bar',  $pluginurl.'/medialink/nivo-slider/themes/bar/bar.css' );
				wp_enqueue_style( 'nivoslider',  $pluginurl.'/medialink/nivo-slider/nivo-slider.css' );
				wp_enqueue_script( 'nivoslider', $pluginurl.'/medialink/nivo-slider/jquery.nivo.slider.pack.js', null, '3.2');
				wp_enqueue_script( 'nivoslider-in', $pluginurl.'/medialink/js/nivoslider-in.js' );
			} else if ($effect === 'photoswipe'){
				// for PhotoSwipe
				wp_enqueue_style( 'photoswipe-style',  $pluginurl.'/medialink/photoswipe/examples/styles.css' );
				wp_enqueue_style( 'photoswipe',  $pluginurl.'/medialink/photoswipe/photoswipe.css' );
				wp_enqueue_script( 'klass' , $pluginurl.'/medialink/photoswipe/lib/klass.min.js', null, '1.0' );
				wp_enqueue_script( 'photoswipe' , $pluginurl.'/medialink/photoswipe/code.photoswipe.jquery-3.0.4.min.js', null, '3.0.4' );
				wp_enqueue_script( 'photoswipe-in', $pluginurl.'/medialink/js/photoswipe-in.js' );
			} else {
				wp_enqueue_style( 'photoswipe-style',  $pluginurl.'/medialink/photoswipe/examples/styles.css' );
			}
		}
		// for smartphone
		wp_enqueue_style( 'smartphone for medialink',  $pluginurl.'/medialink/css/medialink_sp.css' );
	}

	if ( $mode === 'pc' && $set === 'movie' ) {
		if(preg_match("/MSIE 9\.0/", $_SERVER['HTTP_USER_AGENT'])){
			$html .= $movieplayercontainerIE9;
		} else {
			$html .= $movieplayercontainer;
		}
	} else if ( $mode === 'pc' && $set === 'music' ) {
		$html .= $flashmusicplayer;
		$html .= $musicplayercontainer;
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
	if ( preg_match( "/jpg|jpeg|jpe|gif|png|bmp|tif|tiff|ico/i", $suffix) ){
		if ($effect === 'nivoslider'){
			// for Nivo Slider
			$linkfiles_begin = '<div class="slider-wrapper theme-default"><div class="slider-wrapper"><div id="slidernivo" class="nivoSlider">';
			$linkfiles_end = '</div></div></div><br clear=all>';
		} else if ($effect === 'colorbox' && $mode ==='pc'){
			// for COLORBOX
			$linkfiles_begin = '<ul class = "medialink">';
			$linkfiles_end = '</ul><br clear=all>';
		} else if ($effect === 'photoswipe' && $mode === 'sp'){
			// for PhotoSwipe
			$linkfiles_begin = '<div id="Gallery" class="gallery">';
			$linkfiles_end = '</div>';
		} else if ($effect === 'Lightbox' && $mode === 'pc'){
			// for Lightbox
			$linkfiles_begin = '<div class = "medialink">';
			$linkfiles_end = '</div><br clear=all>';
		} else {
			if ($mode === 'pc'){
				$linkfiles_begin = '<div class = "medialink">';
				$linkfiles_end = '</div><br clear=all>';
			} else if ($mode === 'sp'){
				$linkfiles_begin = '<div class="gallery">';
				$linkfiles_end = '</div>';
			}
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

	return $html;

}

?>