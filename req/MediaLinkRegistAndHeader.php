<?php

class MediaLinkRegistAndHeader {

	/* ==================================================
	 * Settings register
	 * @since	1.1
	 */
	function register_settings(){
		register_setting( 'medialink-settings-group', 'medialink_album_sort');
		register_setting( 'medialink-settings-group', 'medialink_movie_sort');
		register_setting( 'medialink-settings-group', 'medialink_music_sort');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_sort');
		register_setting( 'medialink-settings-group', 'medialink_document_sort');
		register_setting( 'medialink-settings-group', 'medialink_album_effect_pc');
		register_setting( 'medialink-settings-group', 'medialink_album_effect_sp');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_effect_pc');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_effect_sp');
		register_setting( 'medialink-settings-group', 'medialink_album_suffix_pc');
		register_setting( 'medialink-settings-group', 'medialink_album_suffix_sp');
		register_setting( 'medialink-settings-group', 'medialink_movie_suffix_pc');
		register_setting( 'medialink-settings-group', 'medialink_movie_suffix_pc2');
		register_setting( 'medialink-settings-group', 'medialink_movie_suffix_flash');
		register_setting( 'medialink-settings-group', 'medialink_movie_suffix_sp');
		register_setting( 'medialink-settings-group', 'medialink_music_suffix_pc');
		register_setting( 'medialink-settings-group', 'medialink_music_suffix_pc2');
		register_setting( 'medialink-settings-group', 'medialink_music_suffix_flash');
		register_setting( 'medialink-settings-group', 'medialink_music_suffix_sp');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_suffix_pc');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_suffix_sp');
		register_setting( 'medialink-settings-group', 'medialink_document_suffix_pc');
		register_setting( 'medialink-settings-group', 'medialink_document_suffix_sp');
		register_setting( 'medialink-settings-group', 'medialink_album_display_pc', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_album_display_sp', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_movie_display_pc', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_movie_display_sp', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_music_display_pc', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_music_display_sp', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_display_pc', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_display_sp', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_document_display_pc', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_document_display_sp', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_album_image_show_size');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_image_show_size');
		register_setting( 'medialink-settings-group', 'medialink_movie_suffix_thumbnail');
		register_setting( 'medialink-settings-group', 'medialink_music_suffix_thumbnail');
		register_setting( 'medialink-settings-group', 'medialink_document_suffix_thumbnail');
		register_setting( 'medialink-settings-group', 'medialink_album_include_cat');
		register_setting( 'medialink-settings-group', 'medialink_movie_include_cat');
		register_setting( 'medialink-settings-group', 'medialink_music_include_cat');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_include_cat');
		register_setting( 'medialink-settings-group', 'medialink_document_include_cat');
		register_setting( 'medialink-settings-group', 'medialink_exclude_cat');
		register_setting( 'medialink-settings-group', 'medialink_album_generate_rssfeed');
		register_setting( 'medialink-settings-group', 'medialink_movie_generate_rssfeed');
		register_setting( 'medialink-settings-group', 'medialink_music_generate_rssfeed');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_generate_rssfeed');
		register_setting( 'medialink-settings-group', 'medialink_document_generate_rssfeed');
		register_setting( 'medialink-settings-group', 'medialink_album_rssname');
		register_setting( 'medialink-settings-group', 'medialink_movie_rssname');
		register_setting( 'medialink-settings-group', 'medialink_music_rssname');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_rssname');
		register_setting( 'medialink-settings-group', 'medialink_document_rssname');
		register_setting( 'medialink-settings-group', 'medialink_album_rssmax', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_movie_rssmax', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_music_rssmax', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_rssmax', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_document_rssmax', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_movie_container');
		register_setting( 'medialink-settings-group', 'medialink_css_listthumbsize');
		register_setting( 'medialink-settings-group', 'medialink_css_pc_listwidth', 'intval');
		register_setting( 'medialink-settings-group', 'medialink_css_pc_linkstrcolor');
		register_setting( 'medialink-settings-group', 'medialink_css_pc_linkbackcolor');
		register_setting( 'medialink-settings-group', 'medialink_css_sp_navstrcolor');
		register_setting( 'medialink-settings-group', 'medialink_css_sp_navbackcolor');
		register_setting( 'medialink-settings-group', 'medialink_css_sp_navpartitionlinecolor');
		register_setting( 'medialink-settings-group', 'medialink_css_sp_listbackcolor');
		register_setting( 'medialink-settings-group', 'medialink_css_sp_listarrowcolor');
		register_setting( 'medialink-settings-group', 'medialink_css_sp_listpartitionlinecolor');
		register_setting( 'medialink-settings-group', 'medialink_album_categorylinks_show');
		register_setting( 'medialink-settings-group', 'medialink_album_pagelinks_show');
		register_setting( 'medialink-settings-group', 'medialink_album_sortlinks_show');
		register_setting( 'medialink-settings-group', 'medialink_album_searchbox_show');
		register_setting( 'medialink-settings-group', 'medialink_album_rssicon_show');
		register_setting( 'medialink-settings-group', 'medialink_album_credit_show');
		register_setting( 'medialink-settings-group', 'medialink_movie_categorylinks_show');
		register_setting( 'medialink-settings-group', 'medialink_movie_pagelinks_show');
		register_setting( 'medialink-settings-group', 'medialink_movie_sortlinks_show');
		register_setting( 'medialink-settings-group', 'medialink_movie_searchbox_show');
		register_setting( 'medialink-settings-group', 'medialink_movie_rssicon_show');
		register_setting( 'medialink-settings-group', 'medialink_movie_credit_show');
		register_setting( 'medialink-settings-group', 'medialink_music_categorylinks_show');
		register_setting( 'medialink-settings-group', 'medialink_music_pagelinks_show');
		register_setting( 'medialink-settings-group', 'medialink_music_sortlinks_show');
		register_setting( 'medialink-settings-group', 'medialink_music_searchbox_show');
		register_setting( 'medialink-settings-group', 'medialink_music_rssicon_show');
		register_setting( 'medialink-settings-group', 'medialink_music_credit_show');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_categorylinks_show');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_pagelinks_show');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_sortlinks_show');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_searchbox_show');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_rssicon_show');
		register_setting( 'medialink-settings-group', 'medialink_slideshow_credit_show');
		register_setting( 'medialink-settings-group', 'medialink_document_categorylinks_show');
		register_setting( 'medialink-settings-group', 'medialink_document_pagelinks_show');
		register_setting( 'medialink-settings-group', 'medialink_document_sortlinks_show');
		register_setting( 'medialink-settings-group', 'medialink_document_searchbox_show');
		register_setting( 'medialink-settings-group', 'medialink_document_rssicon_show');
		register_setting( 'medialink-settings-group', 'medialink_document_credit_show');
		register_setting( 'medialink-settings-group', 'medialink_useragent_tb');
		register_setting( 'medialink-settings-group', 'medialink_useragent_sp');
		add_option('medialink_album_sort', 'new');
		add_option('medialink_movie_sort', 'new');
		add_option('medialink_music_sort', 'new');
		add_option('medialink_slideshow_sort', 'new');
		add_option('medialink_document_sort', 'new');
		add_option('medialink_album_effect_pc', 'colorbox');
		add_option('medialink_album_effect_sp', 'photoswipe');
		add_option('medialink_slideshow_effect_pc', 'nivoslider');
		add_option('medialink_slideshow_effect_sp', 'nivoslider');
		add_option('medialink_album_suffix_pc', 'jpg');
		add_option('medialink_album_suffix_sp', 'jpg');
		add_option('medialink_movie_suffix_pc', 'mp4');
		add_option('medialink_movie_suffix_pc2', 'ogv');
		add_option('medialink_movie_suffix_flash', 'mp4');
		add_option('medialink_movie_suffix_sp', 'mp4');
		add_option('medialink_music_suffix_pc', 'mp3');
		add_option('medialink_music_suffix_pc2', 'ogg');
		add_option('medialink_music_suffix_flash', 'mp3');
		add_option('medialink_music_suffix_sp', 'mp3');
		add_option('medialink_slideshow_suffix_pc', 'jpg');
		add_option('medialink_slideshow_suffix_sp', 'jpg');
		add_option('medialink_document_suffix_pc', 'pdf');
		add_option('medialink_document_suffix_sp', 'pdf');
		add_option('medialink_album_display_pc', 20); 	
		add_option('medialink_album_display_sp', 9); 	
		add_option('medialink_movie_display_pc', 8); 	
		add_option('medialink_movie_display_sp', 6); 	
		add_option('medialink_music_display_pc', 8); 	
		add_option('medialink_music_display_sp', 6); 	
		add_option('medialink_slideshow_display_pc', 10); 	
		add_option('medialink_slideshow_display_sp', 10); 	
		add_option('medialink_document_display_pc', 20);
		add_option('medialink_document_display_sp', 9);
		add_option('medialink_album_image_show_size', 'Full');
		add_option('medialink_slideshow_image_show_size', 'Full');
		add_option('medialink_movie_suffix_thumbnail', 'gif');
		add_option('medialink_music_suffix_thumbnail', 'gif');
		add_option('medialink_document_suffix_thumbnail', '');
		add_option('medialink_album_include_cat', '');
		add_option('medialink_movie_include_cat', '');
		add_option('medialink_music_include_cat', '');
		add_option('medialink_slideshow_include_cat', '');
		add_option('medialink_document_include_cat', '');
		add_option('medialink_exclude_cat', '');
		add_option('medialink_album_generate_rssfeed', 'on');
		add_option('medialink_movie_generate_rssfeed', 'on');
		add_option('medialink_music_generate_rssfeed', 'on');
		add_option('medialink_slideshow_generate_rssfeed', 'on');
		add_option('medialink_document_generate_rssfeed', 'on');
		add_option('medialink_album_rssname', 'medialink_album_feed');
		add_option('medialink_movie_rssname', 'medialink_movie_feed');
		add_option('medialink_music_rssname', 'medialink_music_feed');
		add_option('medialink_slideshow_rssname', 'medialink_slideshow_feed');
		add_option('medialink_document_rssname', 'medialink_document_feed');
		add_option('medialink_album_rssmax', 10);
		add_option('medialink_movie_rssmax', 10);
		add_option('medialink_music_rssmax', 10);
		add_option('medialink_slideshow_rssmax', 10);
		add_option('medialink_document_rssmax', 10);
		add_option('medialink_movie_container', '512x384');
		add_option('medialink_css_pc_listwidth', 400);
		add_option('medialink_css_pc_listthumbsize', '50x35');
		add_option('medialink_css_pc_linkstrcolor', '#000000');
		add_option('medialink_css_pc_linkbackcolor', '#f6efe2');
		add_option('medialink_css_sp_navstrcolor', '#000000');
		add_option('medialink_css_sp_navbackcolor', '#f6efe2');
		add_option('medialink_css_sp_navpartitionlinecolor', '#ffffff');
		add_option('medialink_css_sp_listbackcolor', '#ffffff');
		add_option('medialink_css_sp_listarrowcolor', '#e2a6a6');
		add_option('medialink_css_sp_listpartitionlinecolor', '#f6efe2');
		add_option('medialink_album_categorylinks_show', 'Show');
		add_option('medialink_album_pagelinks_show', 'Show');
		add_option('medialink_album_sortlinks_show', 'Show');
		add_option('medialink_album_searchbox_show', 'Show');
		add_option('medialink_album_rssicon_show', 'Show');
		add_option('medialink_album_credit_show', 'Show');
		add_option('medialink_movie_categorylinks_show', 'Show');
		add_option('medialink_movie_pagelinks_show', 'Show');
		add_option('medialink_movie_sortlinks_show', 'Show');
		add_option('medialink_movie_searchbox_show', 'Show');
		add_option('medialink_movie_rssicon_show', 'Show');
		add_option('medialink_movie_credit_show', 'Show');
		add_option('medialink_music_categorylinks_show', 'Show');
		add_option('medialink_music_pagelinks_show', 'Show');
		add_option('medialink_music_sortlinks_show', 'Show');
		add_option('medialink_music_searchbox_show', 'Show');
		add_option('medialink_music_rssicon_show', 'Show');
		add_option('medialink_music_credit_show', 'Show');
		add_option('medialink_slideshow_categorylinks_show', 'Hide');
		add_option('medialink_slideshow_pagelinks_show', 'Hide');
		add_option('medialink_slideshow_sortlinks_show', 'Hide');
		add_option('medialink_slideshow_searchbox_show', 'Hide');
		add_option('medialink_slideshow_rssicon_show', 'Hide');
		add_option('medialink_slideshow_credit_show', 'Show');
		add_option('medialink_document_categorylinks_show', 'Show');
		add_option('medialink_document_pagelinks_show', 'Show');
		add_option('medialink_document_sortlinks_show', 'Show');
		add_option('medialink_document_searchbox_show', 'Show');
		add_option('medialink_document_rssicon_show', 'Show');
		add_option('medialink_document_credit_show', 'Show');
		add_option('medialink_useragent_tb','iPad|^.*Android.*Nexus(((?:(?!Mobile))|(?:(\s(7|10).+))).)*$|Kindle|Silk.*Accelerated|Sony.*Tablet|Xperia Tablet|Sony Tablet S|SAMSUNG.*Tablet|Galaxy.*Tab|SC-01C|SC-01D|SC-01E|SC-02D');
		add_option('medialink_useragent_sp', 'iPhone|iPod|Android.*Mobile|BlackBerry|IEMobile');
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
		$xml_album = $wp_uploads_path.'/'.get_option('medialink_album_rssname').'.xml';
		$xml_movie = $wp_uploads_path.'/'.get_option('medialink_movie_rssname').'.xml';
		$xml_music = $wp_uploads_path.'/'.get_option('medialink_music_rssname').'.xml';
		$xml_slideshow = $wp_uploads_path.'/'.get_option('medialink_slideshow_rssname').'.xml';
		$xml_document = $wp_uploads_path.'/'.get_option('medialink_document_rssname').'.xml';

		echo '<!-- Start Medialink feed -->'."\n";
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

		$pc_listwidth = get_option('medialink_css_pc_listwidth');
		list($listthumbsize_w, $listthumbsize_h) = explode('x', get_option('medialink_css_listthumbsize'));
		$pc_linkstrcolor = get_option('medialink_css_pc_linkstrcolor');
		$pc_linkbackcolor = get_option('medialink_css_pc_linkbackcolor');
		$sp_navstrcolor = get_option('medialink_css_sp_navstrcolor');
		$sp_navbackcolor = get_option('medialink_css_sp_navbackcolor');
		$sp_navpartitionlinecolor = get_option('medialink_css_sp_navpartitionlinecolor');
		$sp_listbackcolor = get_option('medialink_css_sp_listbackcolor');
		$sp_listarrowcolor = get_option('medialink_css_sp_listarrowcolor');
		$sp_listpartitionlinecolor = get_option('medialink_css_sp_listpartitionlinecolor');

	// CSS PC
$medialink_add_css_pc = <<<MEDIALINKADDCSSPC
<!-- Start Medialink CSS for PC -->
<style type="text/css">
#playlists-medialink { width: {$pc_listwidth}px; }
#playlists-medialink li { width: {$pc_listwidth}px; }
#playlists-medialink li a { width: {$pc_listwidth}px; height: {$pc_listthumbsize_h}px; }
#playlists-medialink img { width: {$listthumbsize_w}px; height: {$listthumbsize_h}px; }
* html #playlists-medialink li a { width: {$pc_listwidth}px; }
#playlists-medialink li:hover {background: {$pc_linkbackcolor};}
#playlists-medialink li a:hover {color: {$pc_linkstrcolor}; background: {$pc_linkbackcolor};}
</style>
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

}

?>