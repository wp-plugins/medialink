<?php

class MediaLinkAdmin {

	/* ==================================================
	 * Add a "Settings" link to the plugins page
	 * @since	1.0
	 */
	function settings_link( $links, $file ) {
		static $this_plugin;
		if ( empty($this_plugin) ) {
			$this_plugin = MEDIALINK_PLUGIN_BASE_FILE;
		}
		if ( $file == $this_plugin ) {
			$links[] = '<a href="'.admin_url('options-general.php?page=MediaLink').'">'.__( 'Settings').'</a>';
		}
			return $links;
	}

	/* ==================================================
	 * Settings page
	 * @since	1.0
	 */
	function plugin_menu() {
		add_options_page( 'MediaLink Options', 'MediaLink', 'manage_options', 'MediaLink', array($this, 'plugin_options') );
	}


	/* ==================================================
	 * Settings page
	 * @since	1.0
	 */
	function plugin_options() {

		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		$pluginurl = plugins_url($path='',$scheme=null);

		wp_enqueue_style( 'jquery-ui-tabs', $pluginurl.'/medialink/css/jquery-ui.css' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-tabs-in', $pluginurl.'/medialink/js/jquery-ui-tabs-in.js' );

		?>

		<div class="wrap">
		<h2>MediaLink</h2>


	<div id="tabs">
	  <ul>
	    <li><a href="#tabs-1"><?php _e('How to use', 'medialink'); ?></a></li>
	    <li><a href="#tabs-2"><?php _e('Settings'); ?>1</a></li>
		<li><a href="#tabs-3"><?php _e('Settings'); ?>2</a></li>
		<li><a href="#tabs-4"><?php _e('Settings'); ?>3</a></li>
		<li><a href="#tabs-5"><?php _e('Caution:'); ?></a></li>
	<!--
		<li><a href="#tabs-6">FAQ</a></li>
	 -->
	  </ul>
	  <div id="tabs-1">
		<h2><?php _e('(In the case of image) Easy use', 'medialink'); ?></h2>
		<p><?php _e('Please add new Page. Please write a short code in the text field of the Page. Please go in Text mode this task.', 'medialink'); ?></p>
		<p>&#91;medialink set='album'&#93;</p>
		<p><?php _e('When you view this Page, it is displayed in album mode. This is the result of the search of the media library. The Settings> Media, determine the size of the thumbnail. The default value of MediaLink, width 80, height 80. Please set its value. In the Media> Add New, please drag and drop the image. You view the Page again. Should see the image to the Page.', 'medialink'); ?></p>
		<p><?php _e('In addition, you want to place add an attribute like this in the short code.', 'medialink'); ?></p>
		<p>&#91;medialink set='slideshow'&#93</p>
		<?php _e('When you view this Page, it is displayed in slideshow mode.', 'medialink'); ?></p>
		
		<p><div><strong><?php _e('Customization 1', 'medialink'); ?></strong></div>
		<?php _e('MediaLink is also handles video and music and document. If you are dealing with music and video and document, please add the following attributes to the short code.', 'medialink'); ?>
		<p><div><?php _e("Video set = 'movie'", 'medialink'); ?></div>
		<div><?php _e("Music set = 'music'", 'medialink'); ?></div>
		<div><?php _e("Document set = 'document'", 'medialink'); ?></div>
		<p>
		<?php _e("If you want to display in a mix of data, please specify the following attributes to the short code.", 'medialink'); ?>
		<p><div><?php _e("Mix of data set = 'all'", 'medialink'); ?></div>
		<p><div><?php _e('* (WordPress > Settings > General Timezone) Please specify your area other than UTC. For accurate time display of RSS feed.', 'medialink'); ?></div>
		<p><div><?php _e('* When you move to (WordPress > Appearance > Widgets), there is a widget MediaLinkRssFeed. If you place you can set this to display the sidebar link the RSS feed.', 'medialink'); ?></div></p>

		<table border="1"><div><strong><?php _e('Customization 2', 'medialink'); ?></strong></div>
		<div><strong><?php _e('Below, I shows the default values and various attributes of the short code.', 'medialink'); ?></strong></div>
		<tbody>
		<tr>
		<td align="center" valign="middle">
		<?php _e('Attribute', 'medialink'); ?>
		</td>
		<td colspan="6" align="center" valign="middle">
		<?php _e('Default'); ?>
		</td>
		<td align="center" valign="middle">
		<?php _e('Description'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>set</b></td>
		<td align="center" valign="middle">all</td>
		<td align="center" valign="middle">album</td>
		<td align="center" valign="middle">movie</td>
		<td align="center" valign="middle">music</td>
		<td align="center" valign="middle">slideshow</td>
		<td align="center" valign="middle">document</td>
		<td align="left" valign="middle">
		<?php _e('Next only six. all(all data), album(image), movie(video), music(music), slideshow(image), document(document)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>sort</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_sort') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_sort') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_sort') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_sort') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_sort') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_sort') ?></td>
		<td align="left" valign="middle">
		<?php _e('Type of Sort', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>effect_pc</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_effect_pc') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_effect_pc') ?></td>
		<td colspan="2" bgcolor="#dddddd"></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_effect_pc') ?></td>
		<td bgcolor="#dddddd"></td>
		<td align="left" valign="middle">
		<?php _e('Effects of PC. If you want to use the Lightbox, please install a plugin that is compatible to the Lightbox. I would recommend some plugins below.', 'medialink'); ?>
		<div>
		<a href ="http://wordpress.org/plugins/wp-jquery-lightbox/" target="_blank"><b><span style="color:red">WP jQuery Lightbox</span></b><a>
		<a href ="http://wordpress.org/plugins/fancybox-for-wordpress/" target="_blank"><b><span style="color:darkorange">FancyBox for WordPress</span></b><a>
		<a href ="http://wordpress.org/plugins/simple-colorbox/" target="_blank"><b><span style="color:blue">Simple Colorbox</span></b><a>
		<a href ="http://wordpress.org/plugins/wp-slimbox2/" target="_blank"><b><span style="color:green">WP-Slimbox2</span></b><a>
		</div>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>effect_sp</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_effect_sp') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_effect_sp') ?></td>
		<td colspan="2" bgcolor="#dddddd"></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_effect_sp') ?></td>
		<td bgcolor="#dddddd"></td>
		<td align="left" valign="middle">
		<?php _e('Effects of Smartphone', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>suffix_pc</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_suffix_pc').','.get_option('medialink_movie_suffix_pc').','.get_option('medialink_music_suffix_pc').','.get_option('medialink_document_suffix_pc') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_suffix_pc') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_pc') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_suffix_pc') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_suffix_pc') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_suffix_pc') ?></td>
		<td align="left" valign="middle">
		<?php _e('extension of PC.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>suffix_pc2</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_pc2').','.get_option('medialink_music_suffix_pc2') ?></td>
		<td bgcolor="#dddddd"></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_pc2') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_suffix_pc2') ?></td>
		<td colspan="2" bgcolor="#dddddd"></td>
		<td align="left" valign="middle">
		<?php _e('second extension on the PC. Second candidate when working with html5', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>suffix_flash</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_flash').','.get_option('medialink_music_suffix_flash') ?></td>
		<td align="center" valign="middle" bgcolor="#dddddd"></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_flash') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_suffix_flash') ?></td>
		<td colspan="2" bgcolor="#dddddd"></td>
		<td align="left" valign="middle">
		<?php _e('Flash extension on the PC. Flash Player to be used when a HTML5 player does not work.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>suffix_sp</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_suffix_sp').','.get_option('medialink_movie_suffix_sp').','.get_option('medialink_music_suffix_sp').','.get_option('medialink_document_suffix_sp') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_suffix_sp') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_sp') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_suffix_sp') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_suffix_sp') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_suffix_sp') ?></td>
		<td align="left" valign="middle">
		<?php _e('extension of Smartphone', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>display_pc</b></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_all_display_pc')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_album_display_pc')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_movie_display_pc')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_music_display_pc')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_slideshow_display_pc')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_document_display_pc')) ?></td>
		<td align="left" valign="middle">
		<?php _e('File Display per page(PC)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>display_sp</b></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_all_display_sp')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_album_display_sp')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_movie_display_sp')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_music_display_sp')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_slideshow_display_sp')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_document_display_sp')) ?></td>
		<td align="left" valign="middle">
		<?php _e('File Display per page(Smartphone)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>image_show_size</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_image_show_size') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_image_show_size') ?></td>
		<td colspan="2" bgcolor="#dddddd"></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_image_show_size') ?></td>
		<td bgcolor="#dddddd"></td>
		<td align="left" valign="middle">
		<?php _e('Size of the image display. (Media Settings > Image Size)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>thumbnail</b></td>
		<td align="center" valign="middle">-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?></td>
		<td align="center" valign="middle">-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_thumbnail') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_suffix_thumbnail') ?></td>
		<td align="center" valign="middle">-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_suffix_thumbnail') ?></td>
		<td align="left" valign="middle">
		<?php _e('(album, slideshow) thumbnail suffix name. (movie, music, document) The icon is displayed if you specify icon. The thumbnail no display if you do not specify anything.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>include_cat</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_include_cat') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_include_cat') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_include_cat') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_include_cat') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_include_cat') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_include_cat') ?></td>
		<td align="left" valign="middle">
		<?php _e('Category you want to include. Only one.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>exclude_cat</b></td>
		<td colspan="6" align="center" valign="middle"><?php echo get_option('medialink_exclude_cat') ?></td>
		<td align="left" valign="middle">
		<?php _e('Category you want to exclude. More than one, specified separated by |.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>generate_rssfeed</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_generate_rssfeed') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_generate_rssfeed') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_generate_rssfeed') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_generate_rssfeed') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_generate_rssfeed') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_generate_rssfeed') ?></td>
		<td align="left" valign="middle">
		<?php _e('Generation of RSS feed.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>rssname</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_rssname') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_rssname') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_rssname') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_rssname') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_rssname') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_rssname') ?></td>
		<td align="left" valign="middle">
		<?php _e('The name of the RSS feed file (Use to widget)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>rssmax</b></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_all_rssmax')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_album_rssmax')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_movie_rssmax')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_music_rssmax')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_slideshow_rssmax')) ?></td>
		<td align="center" valign="middle"><?php echo intval(get_option('medialink_document_rssmax')) ?></td>
		<td align="left" valign="middle">
		<?php _e('Syndication feeds show the most recent (Use to widget)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>filesize_show</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_filesize_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_filesize_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_filesize_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_filesize_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_filesize_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_filesize_show') ?></td>
		<td align="left" valign="middle">
		<?php _e('File size', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>stamptime_show</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_stamptime_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_stamptime_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_stamptime_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_stamptime_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_stamptime_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_stamptime_show') ?></td>
		<td align="left" valign="middle">
		<?php _e('Date Time', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>categorylinks_show</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_categorylinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_categorylinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_categorylinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_categorylinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_categorylinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_categorylinks_show') ?></td>
		<td align="left" valign="middle">
		<?php _e('Selectbox of categories.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>pagelinks_show</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_pagelinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_pagelinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_pagelinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_pagelinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_pagelinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_pagelinks_show') ?></td>
		<td align="left" valign="middle">
		<?php _e('Navigation of page.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>sortlinks_show</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_sortlinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_sortlinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_sortlinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_sortlinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_sortlinks_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_sortlinks_show') ?></td>
		<td align="left" valign="middle">
		<?php _e('Navigation of sort.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>searchbox_show</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_searchbox_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_searchbox_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_searchbox_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_searchbox_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_searchbox_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_searchbox_show') ?></td>
		<td align="left" valign="middle">
		<?php _e('Search box', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>rssicon_show</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_rssicon_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_rssicon_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_rssicon_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_rssicon_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_rssicon_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_rssicon_show') ?></td>
		<td align="left" valign="middle">
		<?php _e('RSS Icon', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>credit_show</b></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_all_credit_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_album_credit_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_credit_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_credit_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_credit_show') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_credit_show') ?></td>
		<td align="left" valign="middle">
		<?php _e('Credit', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle" colspan="8">
		<b><?php _e('Alias read extension : ', 'medialink'); ?></b>
		jpg=(jpg|jpeg|jpe) mp4=(mp4|m4v) mp3=(mp3|m4a|m4b) ogg=(ogg|oga) xls=(xla|xlt|xlw) ppt=(pot|pps)
		</td>
		</tr>

		</tbody>
		</table>
	  </div>

	<form method="post" action="options.php">
	  <div id="tabs-2">
		<div class="wrap">

			<?php settings_fields('medialink-settings-group'); ?>

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<h2><?php _e('The default value for the short code attribute', 'medialink') ?></h2>	
			<table border="1" bgcolor="#dddddd">
			<tbody>
				<tr>
					<td align="center" valign="middle"><?php _e('Attribute', 'medialink'); ?></td>
					<td align="center" valign="middle" colspan=6><?php _e('Default'); ?></td>
					<td align="center" valign="middle"><?php _e('Description'); ?></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>set</b></td>
					<td align="center" valign="middle">all</td>
					<td align="center" valign="middle">album</td>
					<td align="center" valign="middle">movie</td>
					<td align="center" valign="middle">music</td>
					<td align="center" valign="middle">slideshow</td>
					<td align="center" valign="middle">document</td>
					<td align="left" valign="middle">
					<?php _e('Next only six. all(all data), album(image), movie(video), music(music), slideshow(image), document(document)', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>sort</b></td>
					<td align="center" valign="middle">
					<?php $target_all_sort = get_option('medialink_all_sort'); ?>
					<select id="medialink_all_sort" name="medialink_all_sort">
						<option <?php if ('new' == $target_all_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_all_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_all_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_all_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>					<td align="center" valign="middle">
					<?php $target_album_sort = get_option('medialink_album_sort'); ?>
					<select id="medialink_album_sort" name="medialink_album_sort">
						<option <?php if ('new' == $target_album_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_album_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_album_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_album_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_sort = get_option('medialink_movie_sort'); ?>
					<select id="medialink_movie_sort" name="medialink_movie_sort">
						<option <?php if ('new' == $target_movie_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_movie_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_movie_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_movie_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_sort = get_option('medialink_music_sort'); ?>
					<select id="medialink_music_sort" name="medialink_music_sort">
						<option <?php if ('new' == $target_music_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_music_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_music_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_music_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_sort = get_option('medialink_slideshow_sort'); ?>
					<select id="medialink_slideshow_sort" name="medialink_slideshow_sort">
						<option <?php if ('new' == $target_slideshow_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_slideshow_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_slideshow_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_slideshow_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_sort = get_option('medialink_document_sort'); ?>
					<select id="medialink_document_sort" name="medialink_document_sort">
						<option <?php if ('new' == $target_document_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_document_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_document_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_document_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>
					<td align="left" valign="middle">
						<?php _e('Type of Sort', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>effect_pc</b></td>
					<td align="center" valign="middle">
					<?php $target_all_effect_pc = get_option('medialink_all_effect_pc'); ?>
					<select id="medialink_all_effect_pc" name="medialink_all_effect_pc">
						<option <?php if ('colorbox' == $target_all_effect_pc)echo 'selected="selected"'; ?>>colorbox</option>
						<option <?php if ('Lightbox' == $target_all_effect_pc)echo 'selected="selected"'; ?>>Lightbox</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_effect_pc = get_option('medialink_album_effect_pc'); ?>
					<select id="medialink_album_effect_pc" name="medialink_album_effect_pc">
						<option <?php if ('colorbox' == $target_album_effect_pc)echo 'selected="selected"'; ?>>colorbox</option>
						<option <?php if ('Lightbox' == $target_album_effect_pc)echo 'selected="selected"'; ?>>Lightbox</option>
					</select>
					</td>
					<td colspan="2"></td>
					<td align="center" valign="middle">
					<?php $target_slideshow_effect_pc = get_option('medialink_slideshow_effect_pc'); ?>
					<select id="medialink_slideshow_effect_pc" name="medialink_slideshow_effect_pc">
						<option <?php if ('nivoslider' == $target_slideshow_effect_pc)echo 'selected="selected"'; ?>>nivoslider</option>
					</select>
					<td></td>
					<td align="left" valign="middle">
						<?php _e('Effects of PC. If you want to use the Lightbox, please install a plugin that is compatible to the Lightbox. I would recommend some plugins below.', 'medialink'); ?>
						<div>
						<a href ="http://wordpress.org/plugins/wp-jquery-lightbox/" target="_blank"><b><span style="color:red">WP jQuery Lightbox</span></b><a>
						<a href ="http://wordpress.org/plugins/fancybox-for-wordpress/" target="_blank"><b><span style="color:darkorange">FancyBox for WordPress</span></b><a>
						<a href ="http://wordpress.org/plugins/simple-colorbox/" target="_blank"><b><span style="color:blue">Simple Colorbox</span></b><a>
						<a href ="http://wordpress.org/plugins/wp-slimbox2/" target="_blank"><b><span style="color:green">WP-Slimbox2</span></b><a>
						</div>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>effect_sp</b></td>
					<td align="center" valign="middle">
					<?php $target_all_effect_sp = get_option('medialink_all_effect_sp'); ?>
					<select id="medialink_all_effect_sp" name="medialink_all_effect_sp">
						<option <?php if ('swipebox' == $target_all_effect_sp)echo 'selected="selected"'; ?>>swipebox</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_effect_sp = get_option('medialink_album_effect_sp'); ?>
					<select id="medialink_album_effect_sp" name="medialink_album_effect_sp">
						<option <?php if ('photoswipe' == $target_album_effect_sp)echo 'selected="selected"'; ?>>photoswipe</option>
						<option <?php if ('swipebox' == $target_album_effect_sp)echo 'selected="selected"'; ?>>swipebox</option>
					</select>
					</td>
					<td colspan="2"></td>
					<td align="center" valign="middle">
					<?php $target_slideshow_effect_sp = get_option('medialink_slideshow_effect_sp'); ?>
					<select id="medialink_slideshow_effect_sp" name="medialink_slideshow_effect_sp">
						<option <?php if ('nivoslider' == $target_slideshow_effect_sp)echo 'selected="selected"'; ?>>nivoslider</option>
					</select>
					</td>
					<td></td>
					<td align="left" valign="middle">
						<?php _e('Effects of Smartphone', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>suffix_pc</b></td>
					<td align="center" valign="middle"><?php echo get_option('medialink_album_suffix_pc').','.get_option('medialink_movie_suffix_pc').','.get_option('medialink_music_suffix_pc').','.get_option('medialink_document_suffix_pc') ?></td>
					<td align="center" valign="middle">
					<?php $target_album_suffix_pc = get_option('medialink_album_suffix_pc'); ?>
					<select id="medialink_album_suffix_pc" name="medialink_album_suffix_pc">
						<?php
							$exts = $this->exts('image');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_album_suffix_pc)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_suffix_pc = get_option('medialink_movie_suffix_pc'); ?>
					<select id="medialink_movie_suffix_pc" name="medialink_movie_suffix_pc">
						<?php
							$exts = $this->exts('video');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_movie_suffix_pc)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_suffix_pc = get_option('medialink_music_suffix_pc'); ?>
					<select id="medialink_music_suffix_pc" name="medialink_music_suffix_pc">
						<?php
							$exts = $this->exts('audio');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_music_suffix_pc)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_suffix_pc = get_option('medialink_slideshow_suffix_pc'); ?>
					<select id="medialink_slideshow_suffix_pc" name="medialink_slideshow_suffix_pc">
						<?php
							$exts = $this->exts('image');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_slideshow_suffix_pc)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_suffix_pc = get_option('medialink_document_suffix_pc'); ?>
					<select id="medialink_document_suffix_pc" name="medialink_document_suffix_pc">
						<?php
							$exts = $this->exts('document');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_pc)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
							$exts = $this->exts('spreadsheet');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_pc)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
							$exts = $this->exts('interactive');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_pc)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
							$exts = $this->exts('text');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_pc)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
							$exts = $this->exts('archive');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_pc)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
							$exts = $this->exts('code');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_pc)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="left" valign="middle">
						<?php _e('extension of PC.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>suffix_pc2</b></td>
					<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_pc2').','.get_option('medialink_music_suffix_pc2') ?></td>
					<td></td>
					<td align="center" valign="middle">
					<?php $target_movie_suffix_pc2 = get_option('medialink_movie_suffix_pc2'); ?>
					<select id="medialink_movie_suffix_pc2" name="medialink_movie_suffix_pc2">
						<?php
							$exts = $this->exts('video');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_movie_suffix_pc2)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_suffix_pc2 = get_option('medialink_music_suffix_pc2'); ?>
					<select id="medialink_music_suffix_pc2" name="medialink_music_suffix_pc2">
						<?php
							$exts = $this->exts('audio');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_music_suffix_pc2)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td colspan="2"></td>
					<td align="left" valign="middle">
						<?php _e('second extension on the PC. Second candidate when working with html5', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>suffix_flash</b></td>
					<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_flash').','.get_option('medialink_music_suffix_flash') ?></td>
					<td></td>
					<td align="center" valign="middle">
					<?php $target_movie_suffix_flash = get_option('medialink_movie_suffix_flash'); ?>
					<select id="medialink_movie_suffix_flash" name="medialink_movie_suffix_flash">
						<option <?php if ('mp4' == $target_movie_suffix_flash)echo 'selected="selected"'; ?>>mp4</option>
						<option <?php if ('flv' == $target_movie_suffix_flash)echo 'selected="selected"'; ?>>flv</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_suffix_flash = get_option('medialink_music_suffix_flash'); ?>
					<select id="medialink_music_suffix_flash" name="medialink_music_suffix_flash">
						<option <?php if ('mp3' == $target_music_suffix_flash)echo 'selected="selected"'; ?>>mp3</option>
					</select>
					</td>
					<td colspan="2"></td>
					<td align="left" valign="middle">
						<?php _e('Flash extension on the PC. Flash Player to be used when a HTML5 player does not work.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>suffix_sp</b></td>
					<td align="center" valign="middle"><?php echo get_option('medialink_album_suffix_sp').','.get_option('medialink_movie_suffix_sp').','.get_option('medialink_music_suffix_sp').','.get_option('medialink_document_suffix_sp') ?></td>
					<td align="center" valign="middle">
					<?php $target_album_suffix_sp = get_option('medialink_album_suffix_sp'); ?>
					<select id="medialink_album_suffix_sp" name="medialink_album_suffix_sp">
						<?php
							$exts = $this->exts('image');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_album_suffix_sp)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_suffix_sp = get_option('medialink_movie_suffix_sp'); ?>
					<select id="medialink_movie_suffix_sp" name="medialink_movie_suffix_sp">
						<?php
							$exts = $this->exts('video');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_movie_suffix_sp)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_suffix_sp = get_option('medialink_music_suffix_sp'); ?>
					<select id="medialink_music_suffix_sp" name="medialink_music_suffix_sp">
						<?php
							$exts = $this->exts('audio');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_music_suffix_sp)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_suffix_sp = get_option('medialink_slideshow_suffix_sp'); ?>
					<select id="medialink_slideshow_suffix_sp" name="medialink_slideshow_suffix_sp">
						<?php
							$exts = $this->exts('image');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_slideshow_suffix_sp)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_suffix_sp = get_option('medialink_document_suffix_sp'); ?>
					<select id="medialink_document_suffix_sp" name="medialink_document_suffix_sp">
						<?php
							$exts = $this->exts('document');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_sp)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
							$exts = $this->exts('spreadsheet');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_sp)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
							$exts = $this->exts('interactive');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_sp)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
							$exts = $this->exts('text');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_sp)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
							$exts = $this->exts('archive');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_sp)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
							$exts = $this->exts('code');
							foreach ( $exts as $ext ) {
								?>
								<option <?php if ($ext == $target_document_suffix_sp)echo 'selected="selected"'; ?>><?php echo $ext ?></option>
								<?php
							}
						?>
					</select>
					</td>
					<td align="left" valign="middle">
						<?php _e('extension of Smartphone', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>display_pc</b></td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_all_display_pc" name="medialink_all_display_pc" value="<?php echo intval(get_option('medialink_all_display_pc')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_display_pc" name="medialink_album_display_pc" value="<?php echo intval(get_option('medialink_album_display_pc')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_display_pc" name="medialink_movie_display_pc" value="<?php echo intval(get_option('medialink_movie_display_pc')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_display_pc" name="medialink_music_display_pc" value="<?php echo intval(get_option('medialink_music_display_pc')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_display_pc" name="medialink_slideshow_display_pc" value="<?php echo intval(get_option('medialink_slideshow_display_pc')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_display_pc" name="medialink_document_display_pc" value="<?php echo intval(get_option('medialink_document_display_pc')) ?>" size="3" />
					</td>
					<td align="left" valign="middle">
						<?php _e('File Display per page(PC)', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>display_sp</b></td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_all_display_sp" name="medialink_all_display_sp" value="<?php echo intval(get_option('medialink_all_display_sp')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_display_sp" name="medialink_album_display_sp" value="<?php echo intval(get_option('medialink_album_display_sp')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_display_sp" name="medialink_movie_display_sp" value="<?php echo intval(get_option('medialink_movie_display_sp')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_display_sp" name="medialink_music_display_sp" value="<?php echo intval(get_option('medialink_music_display_sp')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_display_sp" name="medialink_slideshow_display_sp" value="<?php echo intval(get_option('medialink_slideshow_display_sp')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_display_sp" name="medialink_document_display_sp" value="<?php echo intval(get_option('medialink_document_display_sp')) ?>" size="3" />
					</td>
					<td align="left" valign="middle">
						<?php _e('File Display per page(Smartphone)', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>image_show_size</b></td>
					<td align="center" valign="middle">
					<?php $target_all_image_show_size = get_option('medialink_all_image_show_size'); ?>
					<select id="medialink_all_image_show_size" name="medialink_all_image_show_size">
						<option <?php if ('Full' == $target_all_image_show_size)echo 'selected="selected"'; ?>>Full</option>
						<option <?php if ('Medium' == $target_all_image_show_size)echo 'selected="selected"'; ?>>Medium</option>
						<option <?php if ('Large' == $target_all_image_show_size)echo 'selected="selected"'; ?>>Large</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_image_show_size = get_option('medialink_album_image_show_size'); ?>
					<select id="medialink_album_image_show_size" name="medialink_album_image_show_size">
						<option <?php if ('Full' == $target_album_image_show_size)echo 'selected="selected"'; ?>>Full</option>
						<option <?php if ('Medium' == $target_album_image_show_size)echo 'selected="selected"'; ?>>Medium</option>
						<option <?php if ('Large' == $target_album_image_show_size)echo 'selected="selected"'; ?>>Large</option>
					</select>
					</td>
					<td colspan="2"></td>
					<td align="center" valign="middle">
					<?php $target_slideshow_image_show_size = get_option('medialink_slideshow_image_show_size'); ?>
					<select id="medialink_slideshow_image_show_size" name="medialink_slideshow_image_show_size">
						<option <?php if ('Full' == $target_slideshow_image_show_size)echo 'selected="selected"'; ?>>Full</option>
						<option <?php if ('Medium' == $target_slideshow_image_show_size)echo 'selected="selected"'; ?>>Medium</option>
						<option <?php if ('Large' == $target_slideshow_image_show_size)echo 'selected="selected"'; ?>>Large</option>
					</select>
					</td>
					<td></td>
					<td align="left" valign="middle">
						<?php _e('Size of the image display. (Media Settings > Image Size)', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>thumbnail</b></td>
					<td align="center" valign="middle">
						-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?>
					</td>
					<td align="center" valign="middle">
						-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_suffix_thumbnail = get_option('medialink_movie_suffix_thumbnail'); ?>
					<select id="medialink_movie_suffix_thumbnail" name="medialink_movie_suffix_thumbnail">
						<option <?php if ('' == $target_movie_suffix_thumbnail)echo 'selected="selected"'; ?>></option>
						<option <?php if ('icon' == $target_movie_suffix_thumbnail)echo 'selected="selected"'; ?>>icon</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_suffix_thumbnail = get_option('medialink_music_suffix_thumbnail'); ?>
					<select id="medialink_music_suffix_thumbnail" name="medialink_music_suffix_thumbnail">
						<option <?php if ('' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>></option>
						<option <?php if ('icon' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>>icon</option>
					</select>
					</td>
					<td align="center" valign="middle">
						-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_suffix_thumbnail = get_option('medialink_document_suffix_thumbnail'); ?>
					<select id="medialink_document_suffix_thumbnail" name="medialink_document_suffix_thumbnail">
						<option <?php if ('' == $target_document_suffix_thumbnail)echo 'selected="selected"'; ?>></option>
						<option <?php if ('icon' == $target_document_suffix_thumbnail)echo 'selected="selected"'; ?>>icon</option>
					</select>
					</td>
					<td align="left" valign="middle">
						<?php _e('(album, slideshow) thumbnail suffix name. (movie, music, document) The icon is displayed if you specify icon. The thumbnail no display if you do not specify anything.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>include_cat</b></td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_all_include_cat" name="medialink_all_include_cat" value="<?php echo get_option('medialink_all_include_cat') ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_include_cat" name="medialink_album_include_cat" value="<?php echo get_option('medialink_album_include_cat') ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_include_cat" name="medialink_movie_include_cat" value="<?php echo get_option('medialink_movie_include_cat') ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_include_cat" name="medialink_music_include_cat" value="<?php echo get_option('medialink_music_include_cat') ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_include_cat" name="medialink_slideshow_include_cat" value="<?php echo get_option('medialink_slideshow_include_cat') ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_include_cat" name="medialink_document_include_cat" value="<?php echo get_option('medialink_document_include_cat') ?>" size="15" />
					</td>
					<td align="left" valign="middle">
						<?php _e('Category you want to include. Only one.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>exclude_cat</b></td>
					<td align="center" valign="middle" colspan="6">
						<input type="text" id="medialink_exclude_cat" name="medialink_exclude_cat" value="<?php echo get_option('medialink_exclude_cat') ?>" size="100" />
					</td>
					<td align="left" valign="middle">
						<?php _e('Category you want to exclude. More than one, specified separated by |.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>generate_rssfeed</b></td>
					<td align="center" valign="middle">
					<?php $target_all_generate_rssfeed = get_option('medialink_all_generate_rssfeed'); ?>
					<select id="medialink_all_generate_rssfeed" name="medialink_all_generate_rssfeed">
						<option <?php if ('on' == $target_all_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_all_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_generate_rssfeed = get_option('medialink_album_generate_rssfeed'); ?>
					<select id="medialink_album_generate_rssfeed" name="medialink_album_generate_rssfeed">
						<option <?php if ('on' == $target_album_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_album_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_generate_rssfeed = get_option('medialink_movie_generate_rssfeed'); ?>
					<select id="medialink_movie_generate_rssfeed" name="medialink_movie_generate_rssfeed">
						<option <?php if ('on' == $target_movie_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_movie_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_generate_rssfeed = get_option('medialink_music_generate_rssfeed'); ?>
					<select id="medialink_music_generate_rssfeed" name="medialink_music_generate_rssfeed">
						<option <?php if ('on' == $target_music_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_music_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_generate_rssfeed = get_option('medialink_slideshow_generate_rssfeed'); ?>
					<select id="medialink_slideshow_generate_rssfeed" name="medialink_slideshow_generate_rssfeed">
						<option <?php if ('on' == $target_slideshow_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_slideshow_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_generate_rssfeed = get_option('medialink_document_generate_rssfeed'); ?>
					<select id="medialink_document_generate_rssfeed" name="medialink_document_generate_rssfeed">
						<option <?php if ('on' == $target_document_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_document_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('Generation of RSS feed.', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>rssname</b></td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_all_rssname" name="medialink_all_rssname" value="<?php echo get_option('medialink_all_rssname') ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_rssname" name="medialink_album_rssname" value="<?php echo get_option('medialink_album_rssname') ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_rssname" name="medialink_movie_rssname" value="<?php echo get_option('medialink_movie_rssname') ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_rssname" name="medialink_music_rssname" value="<?php echo get_option('medialink_music_rssname') ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_rssname" name="medialink_slideshow_rssname" value="<?php echo get_option('medialink_slideshow_rssname') ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_rssname" name="medialink_document_rssname" value="<?php echo get_option('medialink_document_rssname') ?>" size="15" />
					</td>
					<td align="left" valign="middle">
						<?php _e('The name of the RSS feed file (Use to widget)', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>rssmax</b></td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_all_rssmax" name="medialink_all_rssmax" value="<?php echo intval(get_option('medialink_all_rssmax')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_rssmax" name="medialink_album_rssmax" value="<?php echo intval(get_option('medialink_album_rssmax')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_rssmax" name="medialink_movie_rssmax" value="<?php echo intval(get_option('medialink_movie_rssmax')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_rssmax" name="medialink_music_rssmax" value="<?php echo intval(get_option('medialink_music_rssmax')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_rssmax" name="medialink_slideshow_rssmax" value="<?php echo intval(get_option('medialink_slideshow_rssmax')) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_rssmax" name="medialink_document_rssmax" value="<?php echo intval(get_option('medialink_document_rssmax')) ?>" size="3" />
					</td>
					<td align="left" valign="middle">
						<?php _e('Syndication feeds show the most recent (Use to widget)', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>filesize_show</b></td>
					<td align="center" valign="middle">
					<?php $target_all_filesize_show = get_option('medialink_all_filesize_show'); ?>
					<select id="medialink_all_filesize_show" name="medialink_all_filesize_show">
						<option <?php if ('Show' == $target_all_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_filesize_show = get_option('medialink_album_filesize_show'); ?>
					<select id="medialink_album_filesize_show" name="medialink_album_filesize_show">
						<option <?php if ('Show' == $target_album_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_filesize_show = get_option('medialink_movie_filesize_show'); ?>
					<select id="medialink_movie_filesize_show" name="medialink_movie_filesize_show">
						<option <?php if ('Show' == $target_movie_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_filesize_show = get_option('medialink_music_filesize_show'); ?>
					<select id="medialink_music_filesize_show" name="medialink_music_filesize_show">
						<option <?php if ('Show' == $target_music_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_filesize_show = get_option('medialink_slideshow_filesize_show'); ?>
					<select id="medialink_slideshow_filesize_show" name="medialink_slideshow_filesize_show">
						<option <?php if ('Show' == $target_slideshow_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_filesize_show = get_option('medialink_document_filesize_show'); ?>
					<select id="medialink_document_filesize_show" name="medialink_document_filesize_show">
						<option <?php if ('Show' == $target_document_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_document_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('File size', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>stamptime_show</b></td>
					<td align="center" valign="middle">
					<?php $target_all_stamptime_show = get_option('medialink_all_stamptime_show'); ?>
					<select id="medialink_all_stamptime_show" name="medialink_all_stamptime_show">
						<option <?php if ('Show' == $target_all_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_stamptime_show = get_option('medialink_album_stamptime_show'); ?>
					<select id="medialink_album_stamptime_show" name="medialink_album_stamptime_show">
						<option <?php if ('Show' == $target_album_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_stamptime_show = get_option('medialink_movie_stamptime_show'); ?>
					<select id="medialink_movie_stamptime_show" name="medialink_movie_stamptime_show">
						<option <?php if ('Show' == $target_movie_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_stamptime_show = get_option('medialink_music_stamptime_show'); ?>
					<select id="medialink_music_stamptime_show" name="medialink_music_stamptime_show">
						<option <?php if ('Show' == $target_music_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_stamptime_show = get_option('medialink_slideshow_stamptime_show'); ?>
					<select id="medialink_slideshow_stamptime_show" name="medialink_slideshow_stamptime_show">
						<option <?php if ('Show' == $target_slideshow_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_stamptime_show = get_option('medialink_document_stamptime_show'); ?>
					<select id="medialink_document_stamptime_show" name="medialink_document_stamptime_show">
						<option <?php if ('Show' == $target_document_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_document_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('Date Time', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>categorylinks_show</b></td>
					<td align="center" valign="middle">
					<?php $target_all_categorylinks_show = get_option('medialink_all_categorylinks_show'); ?>
					<select id="medialink_all_categorylinks_show" name="medialink_all_categorylinks_show">
						<option <?php if ('Show' == $target_all_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_categorylinks_show = get_option('medialink_album_categorylinks_show'); ?>
					<select id="medialink_album_categorylinks_show" name="medialink_album_categorylinks_show">
						<option <?php if ('Show' == $target_album_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_categorylinks_show = get_option('medialink_movie_categorylinks_show'); ?>
					<select id="medialink_movie_categorylinks_show" name="medialink_movie_categorylinks_show">
						<option <?php if ('Show' == $target_movie_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_categorylinks_show = get_option('medialink_music_categorylinks_show'); ?>
					<select id="medialink_music_categorylinks_show" name="medialink_music_categorylinks_show">
						<option <?php if ('Show' == $target_music_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_categorylinks_show = get_option('medialink_slideshow_categorylinks_show'); ?>
					<select id="medialink_slideshow_categorylinks_show" name="medialink_slideshow_categorylinks_show">
						<option <?php if ('Show' == $target_slideshow_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_categorylinks_show = get_option('medialink_document_categorylinks_show'); ?>
					<select id="medialink_document_categorylinks_show" name="medialink_document_categorylinks_show">
						<option <?php if ('Show' == $target_document_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_document_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('Selectbox of categories.', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>pagelinks_show</b></td>
					<td align="center" valign="middle">
					<?php $target_all_pagelinks_show = get_option('medialink_all_pagelinks_show'); ?>
					<select id="medialink_all_pagelinks_show" name="medialink_all_pagelinks_show">
						<option <?php if ('Show' == $target_all_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_pagelinks_show = get_option('medialink_album_pagelinks_show'); ?>
					<select id="medialink_album_pagelinks_show" name="medialink_album_pagelinks_show">
						<option <?php if ('Show' == $target_album_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_pagelinks_show = get_option('medialink_movie_pagelinks_show'); ?>
					<select id="medialink_movie_pagelinks_show" name="medialink_movie_pagelinks_show">
						<option <?php if ('Show' == $target_movie_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_pagelinks_show = get_option('medialink_music_pagelinks_show'); ?>
					<select id="medialink_music_pagelinks_show" name="medialink_music_pagelinks_show">
						<option <?php if ('Show' == $target_music_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_pagelinks_show = get_option('medialink_slideshow_pagelinks_show'); ?>
					<select id="medialink_slideshow_pagelinks_show" name="medialink_slideshow_pagelinks_show">
						<option <?php if ('Show' == $target_slideshow_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_pagelinks_show = get_option('medialink_document_pagelinks_show'); ?>
					<select id="medialink_document_pagelinks_show" name="medialink_document_pagelinks_show">
						<option <?php if ('Show' == $target_document_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_document_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('Navigation of page.', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>sortlinks_show</b></td>
					<td align="center" valign="middle">
					<?php $target_all_sortlinks_show = get_option('medialink_all_sortlinks_show'); ?>
					<select id="medialink_all_sortlinks_show" name="medialink_all_sortlinks_show">
						<option <?php if ('Show' == $target_all_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_sortlinks_show = get_option('medialink_album_sortlinks_show'); ?>
					<select id="medialink_album_sortlinks_show" name="medialink_album_sortlinks_show">
						<option <?php if ('Show' == $target_album_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_sortlinks_show = get_option('medialink_movie_sortlinks_show'); ?>
					<select id="medialink_movie_sortlinks_show" name="medialink_movie_sortlinks_show">
						<option <?php if ('Show' == $target_movie_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_sortlinks_show = get_option('medialink_music_sortlinks_show'); ?>
					<select id="medialink_music_sortlinks_show" name="medialink_music_sortlinks_show">
						<option <?php if ('Show' == $target_music_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_sortlinks_show = get_option('medialink_slideshow_sortlinks_show'); ?>
					<select id="medialink_slideshow_sortlinks_show" name="medialink_slideshow_sortlinks_show">
						<option <?php if ('Show' == $target_slideshow_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_sortlinks_show = get_option('medialink_document_sortlinks_show'); ?>
					<select id="medialink_document_sortlinks_show" name="medialink_document_sortlinks_show">
						<option <?php if ('Show' == $target_document_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_document_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('Navigation of sort.', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>searchbox_show</b></td>
					<td align="center" valign="middle">
					<?php $target_all_searchbox_show = get_option('medialink_all_searchbox_show'); ?>
					<select id="medialink_all_searchbox_show" name="medialink_all_searchbox_show">
						<option <?php if ('Show' == $target_all_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_searchbox_show = get_option('medialink_album_searchbox_show'); ?>
					<select id="medialink_album_searchbox_show" name="medialink_album_searchbox_show">
						<option <?php if ('Show' == $target_album_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_searchbox_show = get_option('medialink_movie_searchbox_show'); ?>
					<select id="medialink_movie_searchbox_show" name="medialink_movie_searchbox_show">
						<option <?php if ('Show' == $target_movie_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_searchbox_show = get_option('medialink_music_searchbox_show'); ?>
					<select id="medialink_music_searchbox_show" name="medialink_music_searchbox_show">
						<option <?php if ('Show' == $target_music_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_searchbox_show = get_option('medialink_slideshow_searchbox_show'); ?>
					<select id="medialink_slideshow_searchbox_show" name="medialink_slideshow_searchbox_show">
						<option <?php if ('Show' == $target_slideshow_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_searchbox_show = get_option('medialink_document_searchbox_show'); ?>
					<select id="medialink_document_searchbox_show" name="medialink_document_searchbox_show">
						<option <?php if ('Show' == $target_document_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_document_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('Search box', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>rssicon_show</b></td>
					<td align="center" valign="middle">
					<?php $target_all_rssicon_show = get_option('medialink_all_rssicon_show'); ?>
					<select id="medialink_all_rssicon_show" name="medialink_all_rssicon_show">
						<option <?php if ('Show' == $target_all_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_rssicon_show = get_option('medialink_album_rssicon_show'); ?>
					<select id="medialink_album_rssicon_show" name="medialink_album_rssicon_show">
						<option <?php if ('Show' == $target_album_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_rssicon_show = get_option('medialink_movie_rssicon_show'); ?>
					<select id="medialink_movie_rssicon_show" name="medialink_movie_rssicon_show">
						<option <?php if ('Show' == $target_movie_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_rssicon_show = get_option('medialink_music_rssicon_show'); ?>
					<select id="medialink_music_rssicon_show" name="medialink_music_rssicon_show">
						<option <?php if ('Show' == $target_music_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_rssicon_show = get_option('medialink_slideshow_rssicon_show'); ?>
					<select id="medialink_slideshow_rssicon_show" name="medialink_slideshow_rssicon_show">
						<option <?php if ('Show' == $target_slideshow_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_rssicon_show = get_option('medialink_document_rssicon_show'); ?>
					<select id="medialink_document_rssicon_show" name="medialink_document_rssicon_show">
						<option <?php if ('Show' == $target_document_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_document_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('RSS Icon', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>credit_show</b></td>
					<td align="center" valign="middle">
					<?php $target_all_credit_show = get_option('medialink_all_credit_show'); ?>
					<select id="medialink_all_credit_show" name="medialink_all_credit_show">
						<option <?php if ('Show' == $target_all_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_credit_show = get_option('medialink_album_credit_show'); ?>
					<select id="medialink_album_credit_show" name="medialink_album_credit_show">
						<option <?php if ('Show' == $target_album_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_credit_show = get_option('medialink_movie_credit_show'); ?>
					<select id="medialink_movie_credit_show" name="medialink_movie_credit_show">
						<option <?php if ('Show' == $target_movie_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_credit_show = get_option('medialink_music_credit_show'); ?>
					<select id="medialink_music_credit_show" name="medialink_music_credit_show">
						<option <?php if ('Show' == $target_music_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_credit_show = get_option('medialink_slideshow_credit_show'); ?>
					<select id="medialink_slideshow_credit_show" name="medialink_slideshow_credit_show">
						<option <?php if ('Show' == $target_slideshow_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_credit_show = get_option('medialink_document_credit_show'); ?>
					<select id="medialink_document_credit_show" name="medialink_document_credit_show">
						<option <?php if ('Show' == $target_document_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_document_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('Credit', 'medialink') ?>
					</td>
				</tr>
				<tr>
				<td align="center" valign="middle" colspan="8">
				<b><?php _e('Alias read extension : ', 'medialink'); ?></b>
				jpg=(jpg|jpeg|jpe) mp4=(mp4|m4v) mp3=(mp3|m4a|m4b) ogg=(ogg|oga) xls=(xla|xlt|xlw) ppt=(pot|pps)
				</td>
				</tr>
			</tbody>
			</table>
			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>
		</div>
	  </div>

	  <div id="tabs-3">
		<div class="wrap">

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<h2><?php _e('The default value for the display size and display color.', 'medialink') ?></h2>	
			<table border="1" bgcolor="#dddddd">
			<tbody>
				<tr>
					<td align="center" valign="middle" colspan="4"><b>PC</b></td>
					<td align="center" valign="middle" colspan="4"><b>Smartphone</b></td>
					<td></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>all</b></td>
					<td align="center" valign="middle"><b>movie</b></td>
					<td align="center" valign="middle"><b>music</b></td>
					<td align="center" valign="middle"><b>document</b></td>
					<td align="center" valign="middle"><b>all</b></td>
					<td align="center" valign="middle"><b>movie</b></td>
					<td align="center" valign="middle"><b>music</b></td>
					<td align="center" valign="middle"><b>document</b></td>
					<td align="center" valign="middle"><b><?php _e('Description'); ?></b></td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="2">
					<?php $target_movie_container = get_option('medialink_movie_container'); ?>
					<select id="medialink_movie_container" name="medialink_movie_container">
						<option <?php if ('256x144' == $target_movie_container)echo 'selected="selected"'; ?>>256x144</option>
						<option <?php if ('320x240' == $target_movie_container)echo 'selected="selected"'; ?>>320x240</option>
						<option <?php if ('384x288' == $target_movie_container)echo 'selected="selected"'; ?>>384x288</option>
						<option <?php if ('448x336' == $target_movie_container)echo 'selected="selected"'; ?>>448x336</option>
						<option <?php if ('512x288' == $target_movie_container)echo 'selected="selected"'; ?>>512x288</option>
						<option <?php if ('512x384' == $target_movie_container)echo 'selected="selected"'; ?>>512x384</option>
						<option <?php if ('576x432' == $target_movie_container)echo 'selected="selected"'; ?>>576x432</option>
						<option <?php if ('640x480' == $target_movie_container)echo 'selected="selected"'; ?>>640x480</option>
						<option <?php if ('704x528' == $target_movie_container)echo 'selected="selected"'; ?>>704x528</option>
						<option <?php if ('768x432' == $target_movie_container)echo 'selected="selected"'; ?>>768x432</option>
						<option <?php if ('768x576' == $target_movie_container)echo 'selected="selected"'; ?>>768x576</option>
						<option <?php if ('832x624' == $target_movie_container)echo 'selected="selected"'; ?>>832x624</option>
						<option <?php if ('896x672' == $target_movie_container)echo 'selected="selected"'; ?>>896x672</option>
						<option <?php if ('960x720' == $target_movie_container)echo 'selected="selected"'; ?>>960x720</option>
						<option <?php if ('1024x576' == $target_movie_container)echo 'selected="selected"'; ?>>1024x576</option>
						<option <?php if ('1280x720' == $target_movie_container)echo 'selected="selected"'; ?>>1280x720</option>
					</select>
					</td>
					<td colspan="6"></td>
					<td align="left" valign="middle">
					<?php _e('Size of the movie container.', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="8">
					<?php $target_css_listthumbsize = get_option('medialink_css_listthumbsize'); ?>
					<select id="medialink_css_listthumbsize" name="medialink_css_listthumbsize">
						<option <?php if ('40x40' == $target_css_listthumbsize)echo 'selected="selected"'; ?>>40x40</option>
						<option <?php if ('60x60' == $target_css_listthumbsize)echo 'selected="selected"'; ?>>60x60</option>
						<option <?php if ('80x80' == $target_css_listthumbsize)echo 'selected="selected"'; ?>>80x80</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('Size of the thumbnail size for Video and Music', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_pc_linkbackcolor" name="medialink_css_pc_linkbackcolor" value="<?php echo get_option('medialink_css_pc_linkbackcolor') ?>" size="10" />
					</td>
					<td colspan="4"></td>
					<td align="left" valign="middle">
					<?php _e('Background color', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_pc_linkstrcolor" name="medialink_css_pc_linkstrcolor" value="<?php echo get_option('medialink_css_pc_linkstrcolor') ?>" size="10" />
					</td>
					<td colspan="4"></td>
					<td align="left" valign="middle">
					<?php _e('Text color', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_listarrowcolor" name="medialink_css_sp_listarrowcolor" value="<?php echo get_option('medialink_css_sp_listarrowcolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Color of the arrow', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_listbackcolor" name="medialink_css_sp_listbackcolor" value="<?php echo get_option('medialink_css_sp_listbackcolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the list', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_listpartitionlinecolor" name="medialink_css_sp_listpartitionlinecolor" value="<?php echo get_option('medialink_css_sp_listpartitionlinecolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the partition line in the list', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_navbackcolor" name="medialink_css_sp_navbackcolor" value="<?php echo get_option('medialink_css_sp_navbackcolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the navigation', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_navpartitionlinecolor" name="medialink_css_sp_navpartitionlinecolor" value="<?php echo get_option('medialink_css_sp_navpartitionlinecolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the partition line in the navigation', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_navstrcolor" name="medialink_css_sp_navstrcolor" value="<?php echo get_option('medialink_css_sp_navstrcolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Text color navigation', 'medialink') ?>
					</td>
				</tr>
			</tbody>
			</table>

			<h2><?php _e('The default value for User Agent.', 'medialink') ?></h2>	
			<table border="1" bgcolor="#dddddd">
			<tbody>
				<tr>
					<td align="center" valign="middle"><?php _e('Generate html', 'medialink'); ?></td>
					<td align="center" valign="middle"><?php _e('Default'); ?></td>
					<td align="center" valign="middle"><?php _e('Description'); ?></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><?php _e('for Pc or Tablet', 'medialink'); ?></td>
					<td align="center" valign="middle">
						<textarea id="medialink_useragent_tb" name="medialink_useragent_tb" rows="4" cols="120"><?php echo get_option('medialink_useragent_tb') ?></textarea>

					</td>
					<td align="left" valign="middle" rowspan="2"><?php _e('| Specify separated by. Regular expression is possible.', 'medialink'); ?></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><?php _e('for Smartphone', 'medialink'); ?></td>
					<td align="center" valign="middle">
						<textarea id="medialink_useragent_sp" name="medialink_useragent_sp" rows="4" cols="120"><?php echo get_option('medialink_useragent_sp') ?></textarea>

					</td>
				</tr>
			</tbody>
			</table>

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>
		</div>
	  </div>
	  <div id="tabs-4">
		<div class="wrap">

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<h2><?php _e('The default value for effects.', 'medialink') ?></h2>	
			<table border="1" bgcolor="#dddddd">
			<tbody>
				<tr>
					<td align="center" valign="middle" colspan="2">colorbox(<a href="http://www.jacklmoore.com/colorbox/" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</td>
					<td align="center" valign="middle" colspan="2">nivoslider(<a href="http://docs.dev7studios.com/jquery-plugins/nivo-slider" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</td>
					<td align="center" valign="middle" colspan="2">photoswipe(<a href="https://github.com/dimsemenov/PhotoSwipe/blob/master/README.md" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</td>
					<td align="center" valign="middle" colspan="2">swipebox(<a href="http://brutaldesign.github.io/swipebox/" target="_blank"><font color="red"><?php _e('Description'); ?></font></a>)</td>
				</tr>
				<tr>
					<td align="center" valign="middle">transition</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_transition = get_option('medialink_colorbox_transition'); ?>
					<select id="medialink_colorbox_transition" name="medialink_colorbox_transition">
						<option <?php if ('elastic' == $target_colorbox_transition)echo 'selected="selected"'; ?>>elastic</option>
						<option <?php if ('fade' == $target_colorbox_transition)echo 'selected="selected"'; ?>>fade</option>
						<option <?php if ('none' == $target_colorbox_transition)echo 'selected="selected"'; ?>>none</option>
					</select>
					</td>
					<td align="center" valign="middle">effect</td>
					<td align="center" valign="middle">
					<?php $target_nivoslider_effect = get_option('medialink_nivoslider_effect'); ?>
					<select id="medialink_nivoslider_effect" name="medialink_nivoslider_effect">
						<option <?php if ('random' == $target_nivoslider_effect)echo 'selected="selected"'; ?>>random</option>
						<option <?php if ('fold' == $target_nivoslider_effect)echo 'selected="selected"'; ?>>fold</option>
						<option <?php if ('fade' == $target_nivoslider_effect)echo 'selected="selected"'; ?>>fade</option>
						<option <?php if ('sliceDown' == $target_nivoslider_effect)echo 'selected="selected"'; ?>>sliceDown</option>
					</select>
					</td>
					<td align="center" valign="middle">fadeInSpeed</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_photoswipe_fadeInSpeed" name="medialink_photoswipe_fadeInSpeed" value="<?php echo get_option('medialink_photoswipe_fadeInSpeed') ?>" size="10" />
					</td>
					<td align="center" valign="middle">hideBarsDelay</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_swipebox_hideBarsDelay" name="medialink_swipebox_hideBarsDelay" value="<?php echo get_option('medialink_swipebox_hideBarsDelay') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">speed</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_speed" name="medialink_colorbox_speed" value="<?php echo get_option('medialink_colorbox_speed') ?>" size="10" />
					</td>
					<td align="center" valign="middle">slices</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_nivoslider_slices" name="medialink_nivoslider_slices" value="<?php echo get_option('medialink_nivoslider_slices') ?>" size="10" />
					</td>
					<td align="center" valign="middle">fadeOutSpeed</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_photoswipe_fadeOutSpeed" name="medialink_photoswipe_fadeOutSpeed" value="<?php echo get_option('medialink_photoswipe_fadeOutSpeed') ?>" size="10" />
					</td>
					<td colspan="2" rowspan="40"></td>
				</tr>
				<tr>
					<td align="center" valign="middle">title</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_title" name="medialink_colorbox_title" value="<?php echo get_option('medialink_colorbox_title') ?>" size="10" />
					</td>
					<td align="center" valign="middle">boxCols</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_nivoslider_boxCols" name="medialink_nivoslider_boxCols" value="<?php echo get_option('medialink_nivoslider_boxCols') ?>" size="10" />
					</td>
					<td align="center" valign="middle">slideSpeed</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_photoswipe_slideSpeed" name="medialink_photoswipe_slideSpeed" value="<?php echo get_option('medialink_photoswipe_slideSpeed') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">scalePhotos</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_scalePhotos = get_option('medialink_colorbox_scalePhotos'); ?>
					<select id="medialink_colorbox_scalePhotos" name="medialink_colorbox_scalePhotos">
						<option <?php if ('true' == $target_colorbox_scalePhotos)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_scalePhotos)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">boxRows</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_nivoslider_boxRows" name="medialink_nivoslider_boxRows" value="<?php echo get_option('medialink_nivoslider_boxRows') ?>" size="10" />
					</td>
					<td align="center" valign="middle">swipeThreshold</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_photoswipe_swipeThreshold" name="medialink_photoswipe_swipeThreshold" value="<?php echo get_option('medialink_photoswipe_swipeThreshold') ?>" size="10" />
					</td>
				<tr>
					<td align="center" valign="middle">scrolling</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_scrolling = get_option('medialink_colorbox_scrolling'); ?>
					<select id="medialink_colorbox_scrolling" name="medialink_colorbox_scrolling">
						<option <?php if ('true' == $target_colorbox_scrolling)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_scrolling)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">animSpeed</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_nivoslider_animSpeed" name="medialink_nivoslider_animSpeed" value="<?php echo get_option('medialink_nivoslider_animSpeed') ?>" size="10" />
					</td>
					<td align="center" valign="middle">swipeTimeThreshold</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_photoswipe_swipeTimeThreshold" name="medialink_photoswipe_swipeTimeThreshold" value="<?php echo get_option('medialink_photoswipe_swipeTimeThreshold') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">opacity</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_opacity" name="medialink_colorbox_opacity" value="<?php echo get_option('medialink_colorbox_opacity') ?>" size="10" />
					</td>
					<td align="center" valign="middle">pauseTime</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_nivoslider_pauseTime" name="medialink_nivoslider_pauseTime" value="<?php echo get_option('medialink_nivoslider_pauseTime') ?>" size="10" />
					</td>
					<td align="center" valign="middle">loop</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_loop = get_option('medialink_photoswipe_loop'); ?>
					<select id="medialink_photoswipe_loop" name="medialink_photoswipe_loop">
						<option <?php if ('true' == $target_photoswipe_loop)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_loop)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">open</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_open = get_option('medialink_colorbox_open'); ?>
					<select id="medialink_colorbox_open" name="medialink_colorbox_open">
						<option <?php if ('true' == $target_colorbox_open)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_open)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">startSlide</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_nivoslider_startSlide" name="medialink_nivoslider_startSlide" value="<?php echo get_option('medialink_nivoslider_startSlide') ?>" size="10" />
					</td>
					<td align="center" valign="middle">slideshowDelay</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_photoswipe_slideshowDelay" name="medialink_photoswipe_slideshowDelay" value="<?php echo get_option('medialink_photoswipe_slideshowDelay') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">returnFocus</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_returnFocus = get_option('medialink_colorbox_returnFocus'); ?>
					<select id="medialink_colorbox_returnFocus" name="medialink_colorbox_returnFocus">
						<option <?php if ('true' == $target_colorbox_returnFocus)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_returnFocus)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">directionNav</td>
					<td align="center" valign="middle">
					<?php $target_nivoslider_directionNav = get_option('medialink_nivoslider_directionNav'); ?>
					<select id="medialink_nivoslider_directionNav" name="medialink_nivoslider_directionNav">
						<option <?php if ('true' == $target_nivoslider_directionNav)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_nivoslider_directionNav)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">imageScaleMethod</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_imageScaleMethod = get_option('medialink_photoswipe_imageScaleMethod'); ?>
					<select id="medialink_photoswipe_imageScaleMethod" name="medialink_photoswipe_imageScaleMethod">
						<option <?php if ('fit' == $target_photoswipe_imageScaleMethod)echo 'selected="selected"'; ?>>fit</option>
						<option <?php if ('fitNoUpscale' == $target_photoswipe_imageScaleMethod)echo 'selected="selected"'; ?>>fitNoUpscale</option>
						<option <?php if ('zoom' == $target_photoswipe_imageScaleMethod)echo 'selected="selected"'; ?>>zoom</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">trapFocus</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_trapFocus = get_option('medialink_colorbox_trapFocus'); ?>
					<select id="medialink_colorbox_trapFocus" name="medialink_colorbox_trapFocus">
						<option <?php if ('true' == $target_colorbox_trapFocus)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_trapFocus)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">directionNavHide</td>
					<td align="center" valign="middle">
					<?php $target_nivoslider_directionNavHide = get_option('medialink_nivoslider_directionNavHide'); ?>
					<select id="medialink_nivoslider_directionNavHide" name="medialink_nivoslider_directionNavHide">
						<option <?php if ('true' == $target_nivoslider_directionNavHide)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_nivoslider_directionNavHide)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">preventHide</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_preventHide = get_option('medialink_photoswipe_preventHide'); ?>
					<select id="medialink_photoswipe_preventHide" name="medialink_photoswipe_preventHide">
						<option <?php if ('true' == $target_photoswipe_preventHide)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_preventHide)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">fastIframe</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_fastIframe = get_option('medialink_colorbox_fastIframe'); ?>
					<select id="medialink_colorbox_fastIframe" name="medialink_colorbox_fastIframe">
						<option <?php if ('true' == $target_colorbox_fastIframe)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_fastIframe)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">pauseOnHover</td>
					<td align="center" valign="middle">
					<?php $target_nivoslider_pauseOnHover = get_option('medialink_nivoslider_pauseOnHover'); ?>
					<select id="medialink_nivoslider_pauseOnHover" name="medialink_nivoslider_pauseOnHover">
						<option <?php if ('true' == $target_nivoslider_pauseOnHover)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_nivoslider_pauseOnHover)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">backButtonHideEnabled</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_backButtonHideEnabled = get_option('medialink_photoswipe_backButtonHideEnabled'); ?>
					<select id="medialink_photoswipe_backButtonHideEnabled" name="medialink_photoswipe_backButtonHideEnabled">
						<option <?php if ('true' == $target_photoswipe_backButtonHideEnabled)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_backButtonHideEnabled)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">preloading</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_preloading = get_option('medialink_colorbox_preloading'); ?>
					<select id="medialink_colorbox_preloading" name="medialink_colorbox_preloading">
						<option <?php if ('true' == $target_colorbox_preloading)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_preloading)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">manualAdvance</td>
					<td align="center" valign="middle">
					<?php $target_nivoslider_manualAdvance = get_option('medialink_nivoslider_manualAdvance'); ?>
					<select id="medialink_nivoslider_manualAdvance" name="medialink_nivoslider_manualAdvance">
						<option <?php if ('true' == $target_nivoslider_manualAdvance)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_nivoslider_manualAdvance)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">captionAndToolbarHide</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_captionAndToolbarHide = get_option('medialink_photoswipe_captionAndToolbarHide'); ?>
					<select id="medialink_photoswipe_captionAndToolbarHide" name="medialink_photoswipe_captionAndToolbarHide">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarHide)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarHide)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">overlayClose</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_overlayClose = get_option('medialink_colorbox_overlayClose'); ?>
					<select id="medialink_colorbox_overlayClose" name="medialink_colorbox_overlayClose">
						<option <?php if ('true' == $target_colorbox_overlayClose)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_overlayClose)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">prevText</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_nivoslider_prevText" name="medialink_nivoslider_prevText" value="<?php echo get_option('medialink_nivoslider_prevText') ?>" size="10" />
					</td>
					<td align="center" valign="middle">captionAndToolbarHideOnSwipe</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_captionAndToolbarHideOnSwipe = get_option('medialink_photoswipe_captionAndToolbarHideOnSwipe'); ?>
					<select id="medialink_photoswipe_captionAndToolbarHideOnSwipe" name="medialink_photoswipe_captionAndToolbarHideOnSwipe">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarHideOnSwipe)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarHideOnSwipe)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">escKey</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_escKey = get_option('medialink_colorbox_escKey'); ?>
					<select id="medialink_colorbox_escKey" name="medialink_colorbox_escKey">
						<option <?php if ('true' == $target_colorbox_escKey)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_escKey)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">nextText</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_nivoslider_nextText" name="medialink_nivoslider_nextText" value="<?php echo get_option('medialink_nivoslider_nextText') ?>" size="10" />
					</td>
					<td align="center" valign="middle">captionAndToolbarFlipPosition</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_captionAndToolbarFlipPosition = get_option('medialink_photoswipe_captionAndToolbarFlipPosition'); ?>
					<select id="medialink_photoswipe_captionAndToolbarFlipPosition" name="medialink_photoswipe_captionAndToolbarFlipPosition">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarFlipPosition)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarFlipPosition)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">arrowKey</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_arrowKey = get_option('medialink_colorbox_arrowKey'); ?>
					<select id="medialink_colorbox_arrowKey" name="medialink_colorbox_arrowKey">
						<option <?php if ('true' == $target_colorbox_arrowKey)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_arrowKey)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">randomStart</td>
					<td align="center" valign="middle">
					<?php $target_nivoslider_randomStart = get_option('medialink_nivoslider_randomStart'); ?>
					<select id="medialink_nivoslider_randomStart" name="medialink_nivoslider_randomStart">
						<option <?php if ('true' == $target_nivoslider_randomStart)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_nivoslider_randomStart)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td align="center" valign="middle">captionAndToolbarAutoHideDelay</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_photoswipe_captionAndToolbarAutoHideDelay" name="medialink_photoswipe_captionAndToolbarAutoHideDelay" value="<?php echo get_option('medialink_photoswipe_captionAndToolbarAutoHideDelay') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">loop</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_loop = get_option('medialink_colorbox_loop'); ?>
					<select id="medialink_colorbox_loop" name="medialink_colorbox_loop">
						<option <?php if ('true' == $target_colorbox_loop)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_loop)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td colspan="2" rowspan="27"></td>
					<td align="center" valign="middle">captionAndToolbarOpacity</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_photoswipe_captionAndToolbarOpacity" name="medialink_photoswipe_captionAndToolbarOpacity" value="<?php echo get_option('medialink_photoswipe_captionAndToolbarOpacity') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">fadeOut</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_fadeOut" name="medialink_colorbox_fadeOut" value="<?php echo get_option('medialink_colorbox_fadeOut') ?>" size="10" />
					</td>
					<td align="center" valign="middle">captionAndToolbarShowEmptyCaptions</td>
					<td align="center" valign="middle">
					<?php $target_photoswipe_captionAndToolbarShowEmptyCaptions = get_option('medialink_photoswipe_captionAndToolbarShowEmptyCaptions'); ?>
					<select id="medialink_photoswipe_captionAndToolbarShowEmptyCaptions" name="medialink_photoswipe_captionAndToolbarShowEmptyCaptions">
						<option <?php if ('true' == $target_photoswipe_captionAndToolbarShowEmptyCaptions)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_photoswipe_captionAndToolbarShowEmptyCaptions)echo 'selected="selected"'; ?>>false</option>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">closeButton</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_closeButton = get_option('medialink_colorbox_closeButton'); ?>
					<select id="medialink_colorbox_closeButton" name="medialink_colorbox_closeButton">
						<option <?php if ('true' == $target_colorbox_closeButton)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_closeButton)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
					<td colspan="2" rowspan="25"></td>
				</tr>
				<tr>
					<td align="center" valign="middle">current</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_current" name="medialink_colorbox_current" value="<?php echo get_option('medialink_colorbox_current') ?>" size="30" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">previous</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_previous" name="medialink_colorbox_previous" value="<?php echo get_option('medialink_colorbox_previous') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">next</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_next" name="medialink_colorbox_next" value="<?php echo get_option('medialink_colorbox_next') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">close</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_close" name="medialink_colorbox_close" value="<?php echo get_option('medialink_colorbox_close') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">width</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_width" name="medialink_colorbox_width" value="<?php echo get_option('medialink_colorbox_width') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">height</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_height" name="medialink_colorbox_height" value="<?php echo get_option('medialink_colorbox_height') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">innerWidth</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_innerWidth" name="medialink_colorbox_innerWidth" value="<?php echo get_option('medialink_colorbox_innerWidth') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">innerHeight</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_innerHeight" name="medialink_colorbox_innerHeight" value="<?php echo get_option('medialink_colorbox_innerHeight') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">initialWidth</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_initialWidth" name="medialink_colorbox_initialWidth" value="<?php echo get_option('medialink_colorbox_initialWidth') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">initialHeight</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_initialHeight" name="medialink_colorbox_initialHeight" value="<?php echo get_option('medialink_colorbox_initialHeight') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">maxWidth</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_maxWidth" name="medialink_colorbox_maxWidth" value="<?php echo get_option('medialink_colorbox_maxWidth') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">maxHeight</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_maxHeight" name="medialink_colorbox_maxHeight" value="<?php echo get_option('medialink_colorbox_maxHeight') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">slideshow</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_slideshow = get_option('medialink_colorbox_slideshow'); ?>
					<select id="medialink_colorbox_slideshow" name="medialink_colorbox_slideshow">
						<option <?php if ('true' == $target_colorbox_slideshow)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_slideshow)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">slideshowSpeed</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_slideshowSpeed" name="medialink_colorbox_slideshowSpeed" value="<?php echo get_option('medialink_colorbox_slideshowSpeed') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">slideshowAuto</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_slideshowAuto = get_option('medialink_colorbox_slideshowAuto'); ?>
					<select id="medialink_colorbox_slideshowAuto" name="medialink_colorbox_slideshowAuto">
						<option <?php if ('true' == $target_colorbox_slideshowAuto)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_slideshowAuto)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">slideshowStart</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_slideshowStart" name="medialink_colorbox_slideshowStart" value="<?php echo get_option('medialink_colorbox_slideshowStart') ?>" size="20" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">slideshowStop</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_slideshowStop" name="medialink_colorbox_slideshowStop" value="<?php echo get_option('medialink_colorbox_slideshowStop') ?>" size="20" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">fixed</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_fixed = get_option('medialink_colorbox_fixed'); ?>
					<select id="medialink_colorbox_fixed" name="medialink_colorbox_fixed">
						<option <?php if ('true' == $target_colorbox_fixed)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_fixed)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">top</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_top" name="medialink_colorbox_top" value="<?php echo get_option('medialink_colorbox_top') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">bottom</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_bottom" name="medialink_colorbox_bottom" value="<?php echo get_option('medialink_colorbox_bottom') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">left</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_left" name="medialink_colorbox_left" value="<?php echo get_option('medialink_colorbox_left') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">right</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_colorbox_right" name="medialink_colorbox_right" value="<?php echo get_option('medialink_colorbox_right') ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">reposition</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_reposition = get_option('medialink_colorbox_reposition'); ?>
					<select id="medialink_colorbox_reposition" name="medialink_colorbox_reposition">
						<option <?php if ('true' == $target_colorbox_reposition)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_reposition)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">retinaImage</td>
					<td align="center" valign="middle">
					<?php $target_colorbox_retinaImage = get_option('medialink_colorbox_retinaImage'); ?>
					<select id="medialink_colorbox_retinaImage" name="medialink_colorbox_retinaImage">
						<option <?php if ('true' == $target_colorbox_retinaImage)echo 'selected="selected"'; ?>>true</option>
						<option <?php if ('false' == $target_colorbox_retinaImage)echo 'selected="selected"'; ?>>false</option>
					</select>
					</td>
				</tr>
			</tbody>
			</table>

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

		</div>
	  </div>

	  <div id="tabs-5">
		<div class="wrap">
	<h3><?php _e('The to playback of video and music, that such as the next, .htaccess may be required to the directory containing the data file by the environment.', 'medialink') ?></h3>
	<textarea rows="23" cols="100">
AddType video/mp4 mp4 m4v
AddType video/webm webm
AddType video/ogg ogv
AddType video/x-flv flv
AddType audio/mpeg mp3 m4a m4b
AddType audio/ogg ogg oga
AddType audio/midi mid midi
AddType application/pdf pdf
AddType application/msword doc
AddType application/vnd.ms-excel xla xls xlt xlw
AddType application/vnd.openxmlformats-officedocument.wordprocessingml.document docx
AddType application/vnd.openxmlformats-officedocument.spreadsheetml.sheet xlsx
AddType application/vnd.ms-powerpoint pot pps ppt
AddType application/vnd.openxmlformats-officedocument.presentationml.presentation pptx
AddType application/vnd.ms-powerpoint.presentation.macroEnabled.12 pptm
AddType application/vnd.openxmlformats-officedocument.presentationml.slideshow ppsx
AddType application/vnd.ms-powerpoint.slideshow.macroEnabled.12 ppsm
AddType application/vnd.openxmlformats-officedocument.presentationml.template potx
AddType application/vnd.ms-powerpoint.template.macroEnabled.12 potm
AddType application/vnd.ms-powerpoint.addin.macroEnabled.12 ppam
AddType application/vnd.openxmlformats-officedocument.presentationml.slide sldx
AddType application/vnd.ms-powerpoint.slide.macroEnabled.12 sldm
	</textarea>

		</div>
	  </div>

	<!--
	  <div id="tabs-6">
		<div class="wrap">
		<h2>FAQ</h2>

		</div>
	  </div>
	-->

	</form>
	</div>

		</div>
		<?php
	}

	/* ==================================================
	 * @param	string	$ext2type
	 * @return	array	$exts
	 * @since	3.2
	 */
	function exts($ext2type){

		$mimes = wp_get_mime_types();

		foreach ($mimes as $ext => $mime) {
			if( strpos($ext,  '|') <> FALSE ) {
				$extstmp = explode('|', $ext );
				foreach ( $extstmp as $exttmp ) {
					if ( wp_ext2type($exttmp) === $ext2type ) {
						$exts[] = $exttmp;
					}
				}
			} else {
				if ( wp_ext2type($ext) === $ext2type ) {
					$exts[] = $ext;
				}
			}
		}

		return $exts;

	}

}

?>