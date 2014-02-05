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
		<div id="icon-options-general" class="icon32"><br /></div><h2>MediaLink</h2>


	<div id="tabs">
	  <ul>
	    <li><a href="#tabs-1"><?php _e('How to use', 'medialink'); ?></a></li>
	    <li><a href="#tabs-2"><?php _e('Settings'); ?></a></li>
	<!--
		<li><a href="#tabs-3">FAQ</a></li>
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
		<p><div><?php _e('* (WordPress > Settings > General Timezone) Please specify your area other than UTC. For accurate time display of RSS feed.', 'medialink'); ?></div>
		<p><div><?php _e('* When you move to (WordPress > Appearance > Widgets), there is a widget MediaLinkRssFeed. If you place you can set this to display the sidebar link the RSS feed.', 'medialink'); ?></div></p>

		<table border="1"><div><strong><?php _e('Customization 2', 'medialink'); ?></strong></div>
		<div><strong><?php _e('Below, I shows the default values and various attributes of the short code.', 'medialink'); ?></strong></div>
		<tbody>
		<tr>
		<td align="center" valign="middle">
		<?php _e('Attribute', 'medialink'); ?>
		</td>
		<td colspan="5" align="center" valign="middle">
		<?php _e('Default'); ?>
		</td>
		<td align="center" valign="middle">
		<?php _e('Description'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>set</b></td>
		<td align="center" valign="middle">album</td>
		<td align="center" valign="middle">movie</td>
		<td align="center" valign="middle">music</td>
		<td align="center" valign="middle">slideshow</td>
		<td align="center" valign="middle">document</td>
		<td align="left" valign="middle">
		<?php _e('Next only five. album(image), movie(video), music(music), slideshow(image), document(document)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>sort</b></td>
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
		<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_thumbnail') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_music_suffix_thumbnail') ?></td>
		<td align="center" valign="middle">-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?></td>
		<td align="center" valign="middle"><?php echo get_option('medialink_document_suffix_thumbnail') ?></td>
		<td align="left" valign="middle">
		<?php _e('(album, slideshow) default thumbnail suffix name of WordPress. (movie, music) specify an extension for the thumbnail of the title the same name as the file you want to view, but if the thumbnail is not found, display the icon. The thumbnail no display if you do not specify anything. (document) The icon is displayed if you specify icon. The thumbnail no display if you do not specify anything.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>include_cat</b></td>
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
		<td colspan="5" align="center" valign="middle"><?php echo get_option('medialink_exclude_cat') ?></td>
		<td align="left" valign="middle">
		<?php _e('Category you want to exclude. More than one, specified separated by |.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle"><b>generate_rssfeed</b></td>
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
		<td align="center" valign="middle"><b>categorylinks_show</b></td>
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
		<td align="center" valign="middle" colspan="7">
		<b><?php _e('Alias read extension : ', 'medialink'); ?></b>
		jpg=(jpg|jpeg|jpe) mp4=(mp4|m4v) mp3=(mp3|m4a|m4b) ogg=(ogg|oga) xls=(xla|xlt|xlw) ppt=(pot|pps)
		</td>
		</tr>

		</tbody>
		</table>
	  </div>

	  <div id="tabs-2">
		<div class="wrap">
		<h2><?php _e('The default value for the short code attribute', 'medialink') ?></h2>	
		<form method="post" action="options.php">
			<?php settings_fields('medialink-settings-group'); ?>
			<table border="1" bgcolor="#dddddd">
			<tbody>
				<tr>
					<td align="center" valign="middle"><?php _e('Attribute', 'medialink'); ?></td>
					<td align="center" valign="middle" colspan=5><?php _e('Default'); ?></td>
					<td align="center" valign="middle"><?php _e('Description'); ?></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>set</b></td>
					<td align="center" valign="middle">album</td>
					<td align="center" valign="middle">movie</td>
					<td align="center" valign="middle">music</td>
					<td align="center" valign="middle">slideshow</td>
					<td align="center" valign="middle">document</td>
					<td align="left" valign="middle">
					<?php _e('Next only five. album(image), movie(video), music(music), slideshow(image), document(document)', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>sort</b></td>
					<td align="center" valign="middle">
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
					<?php $target_album_effect_pc = get_option('medialink_album_effect_pc'); ?>
					<select id="medialink_album_effect_pc" name="medialink_album_effect_pc">
						<option <?php if ('colorbox' == $target_album_effect_pc)echo 'selected="selected"'; ?>>colorbox</option>
						<option <?php if ('nivoslider' == $target_album_effect_pc)echo 'selected="selected"'; ?>>nivoslider</option>
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
					<?php $target_album_effect_sp = get_option('medialink_album_effect_sp'); ?>
					<select id="medialink_album_effect_sp" name="medialink_album_effect_sp">
						<option <?php if ('nivoslider' == $target_album_effect_sp)echo 'selected="selected"'; ?>>nivoslider</option>
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
					<td align="center" valign="middle">
					<?php $target_album_suffix_pc = get_option('medialink_album_suffix_pc'); ?>
					<select id="medialink_album_suffix_pc" name="medialink_album_suffix_pc">
						<option <?php if ('jpg' == $target_album_suffix_pc)echo 'selected="selected"'; ?>>jpg</option>
						<option <?php if ('png' == $target_album_suffix_pc)echo 'selected="selected"'; ?>>png</option>
						<option <?php if ('gif' == $target_album_suffix_pc)echo 'selected="selected"'; ?>>gif</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_suffix_pc = get_option('medialink_movie_suffix_pc'); ?>
					<select id="medialink_movie_suffix_pc" name="medialink_movie_suffix_pc">
						<option <?php if ('mp4' == $target_movie_suffix_pc)echo 'selected="selected"'; ?>>mp4</option>
						<option <?php if ('ogv' == $target_movie_suffix_pc)echo 'selected="selected"'; ?>>ogv</option>
						<option <?php if ('webm' == $target_movie_suffix_pc)echo 'selected="selected"'; ?>>webm</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_suffix_pc = get_option('medialink_music_suffix_pc'); ?>
					<select id="medialink_music_suffix_pc" name="medialink_music_suffix_pc">
						<option <?php if ('mp3' == $target_music_suffix_pc)echo 'selected="selected"'; ?>>mp3</option>
						<option <?php if ('ogg' == $target_music_suffix_pc)echo 'selected="selected"'; ?>>ogg</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_suffix_pc = get_option('medialink_slideshow_suffix_pc'); ?>
					<select id="medialink_slideshow_suffix_pc" name="medialink_slideshow_suffix_pc">
						<option <?php if ('jpg' == $target_slideshow_suffix_pc)echo 'selected="selected"'; ?>>jpg</option>
						<option <?php if ('png' == $target_slideshow_suffix_pc)echo 'selected="selected"'; ?>>png</option>
						<option <?php if ('gif' == $target_slideshow_suffix_pc)echo 'selected="selected"'; ?>>gif</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_suffix_pc = get_option('medialink_document_suffix_pc'); ?>
					<select id="medialink_document_suffix_pc" name="medialink_document_suffix_pc">
						<option <?php if ('pdf' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>pdf</option>
						<option <?php if ('doc' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>doc</option>
						<option <?php if ('docx' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>docx</option>
						<option <?php if ('xls' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>xls</option>
						<option <?php if ('xlsx' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>xlsx</option>
						<option <?php if ('xlsa' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>xlsa</option>
						<option <?php if ('xlst' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>xlst</option>
						<option <?php if ('xlsw' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>xlsw</option>
						<option <?php if ('pot' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>pot</option>
						<option <?php if ('pps' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>pps</option>
						<option <?php if ('ppt' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>ppt</option>
						<option <?php if ('pptx' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>pptx</option>
						<option <?php if ('pptm' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>pptm</option>
						<option <?php if ('ppsx' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>ppsx</option>
						<option <?php if ('ppsm' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>ppsm</option>
						<option <?php if ('potx' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>potx</option>
						<option <?php if ('potm' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>potm</option>
						<option <?php if ('ppam' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>ppam</option>
						<option <?php if ('sldx' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>sldx</option>
						<option <?php if ('sldm' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>sldm</option>
					</select>
					</td>
					<td align="left" valign="middle">
						<?php _e('extension of PC.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>suffix_pc2</b></td>
					<td>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_suffix_pc2 = get_option('medialink_movie_suffix_pc2'); ?>
					<select id="medialink_movie_suffix_pc2" name="medialink_movie_suffix_pc2">
						<option <?php if ('ogv' == $target_movie_suffix_pc2)echo 'selected="selected"'; ?>>ogv</option>
						<option <?php if ('webm' == $target_movie_suffix_pc2)echo 'selected="selected"'; ?>>webm</option>
						<option <?php if ('mp4' == $target_movie_suffix_pc2)echo 'selected="selected"'; ?>>mp4</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_suffix_pc2 = get_option('medialink_music_suffix_pc2'); ?>
					<select id="medialink_music_suffix_pc2" name="medialink_music_suffix_pc2">
						<option <?php if ('ogg' == $target_music_suffix_pc2)echo 'selected="selected"'; ?>>ogg</option>
						<option <?php if ('mp3' == $target_music_suffix_pc2)echo 'selected="selected"'; ?>>mp3</option>
					</select>
					</td>
					<td colspan="2"></td>
					<td align="left" valign="middle">
						<?php _e('second extension on the PC. Second candidate when working with html5', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>suffix_flash</b></td>
					<td>
					</td>
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
					<td align="center" valign="middle">
					<?php $target_album_suffix_sp = get_option('medialink_album_suffix_sp'); ?>
					<select id="medialink_album_suffix_sp" name="medialink_album_suffix_sp">
						<option <?php if ('jpg' == $target_album_suffix_sp)echo 'selected="selected"'; ?>>jpg</option>
						<option <?php if ('png' == $target_album_suffix_sp)echo 'selected="selected"'; ?>>png</option>
						<option <?php if ('gif' == $target_album_suffix_sp)echo 'selected="selected"'; ?>>gif</option>
						<option <?php if ('bmp' == $target_album_suffix_sp)echo 'selected="selected"'; ?>>bmp</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_suffix_sp = get_option('medialink_movie_suffix_sp'); ?>
					<select id="medialink_movie_suffix_sp" name="medialink_movie_suffix_sp">
						<option <?php if ('mp4' == $target_movie_suffix_sp)echo 'selected="selected"'; ?>>mp4</option>
						<option <?php if ('ogv' == $target_movie_suffix_sp)echo 'selected="selected"'; ?>>ogv</option>
						<option <?php if ('webm' == $target_movie_suffix_sp)echo 'selected="selected"'; ?>>webm</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_suffix_sp = get_option('medialink_music_suffix_sp'); ?>
					<select id="medialink_music_suffix_sp" name="medialink_music_suffix_sp">
						<option <?php if ('mp3' == $target_music_suffix_sp)echo 'selected="selected"'; ?>>mp3</option>
						<option <?php if ('ogg' == $target_music_suffix_sp)echo 'selected="selected"'; ?>>ogg</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_suffix_sp = get_option('medialink_slideshow_suffix_sp'); ?>
					<select id="medialink_slideshow_suffix_sp" name="medialink_slideshow_suffix_sp">
						<option <?php if ('jpg' == $target_slideshow_suffix_sp)echo 'selected="selected"'; ?>>jpg</option>
						<option <?php if ('png' == $target_slideshow_suffix_sp)echo 'selected="selected"'; ?>>png</option>
						<option <?php if ('gif' == $target_slideshow_suffix_sp)echo 'selected="selected"'; ?>>gif</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_suffix_sp = get_option('medialink_document_suffix_sp'); ?>
					<select id="medialink_document_suffix_sp" name="medialink_document_suffix_sp">
						<option <?php if ('pdf' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>pdf</option>
						<option <?php if ('doc' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>doc</option>
						<option <?php if ('docx' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>docx</option>
						<option <?php if ('xls' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>xls</option>
						<option <?php if ('xlsx' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>xlsx</option>
						<option <?php if ('xlsa' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>xlsa</option>
						<option <?php if ('xlst' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>xlst</option>
						<option <?php if ('xlsw' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>xlsw</option>
						<option <?php if ('pot' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>pot</option>
						<option <?php if ('pps' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>pps</option>
						<option <?php if ('ppt' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>ppt</option>
						<option <?php if ('pptx' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>pptx</option>
						<option <?php if ('pptm' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>pptm</option>
						<option <?php if ('ppsx' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>ppsx</option>
						<option <?php if ('ppsm' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>ppsm</option>
						<option <?php if ('potx' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>potx</option>
						<option <?php if ('potm' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>potm</option>
						<option <?php if ('ppam' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>ppam</option>
						<option <?php if ('sldx' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>sldx</option>
						<option <?php if ('sldm' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>sldm</option>
					</select>
					</td>
					<td align="left" valign="middle">
						<?php _e('extension of Smartphone', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>display_pc</b></td>
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
					<?php $target_movie_suffix_thumbnail = get_option('medialink_movie_suffix_thumbnail'); ?>
					<select id="medialink_movie_suffix_thumbnail" name="medialink_movie_suffix_thumbnail">
						<option <?php if ('' == $target_movie_suffix_thumbnail)echo 'selected="selected"'; ?>></option>
						<option <?php if ('gif' == $target_movie_suffix_thumbnail)echo 'selected="selected"'; ?>>gif</option>
						<option <?php if ('jpg' == $target_movie_suffix_thumbnail)echo 'selected="selected"'; ?>>jpg</option>
						<option <?php if ('png' == $target_movie_suffix_thumbnail)echo 'selected="selected"'; ?>>png</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_suffix_thumbnail = get_option('medialink_music_suffix_thumbnail'); ?>
					<select id="medialink_music_suffix_thumbnail" name="medialink_music_suffix_thumbnail">
						<option <?php if ('' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>></option>
						<option <?php if ('gif' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>>gif</option>
						<option <?php if ('jpg' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>>jpg</option>
						<option <?php if ('png' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>>png</option>
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
						<?php _e('(album, slideshow) default thumbnail suffix name of WordPress. (movie, music) specify an extension for the thumbnail of the title the same name as the file you want to view, but if the thumbnail is not found, display the icon. The thumbnail no display if you do not specify anything. (document) The icon is displayed if you specify icon. The thumbnail no display if you do not specify anything.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>include_cat</b></td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_include_cat" name="medialink_album_include_cat" value="<?php echo get_option('medialink_album_include_cat') ?>" size="20" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_include_cat" name="medialink_movie_include_cat" value="<?php echo get_option('medialink_movie_include_cat') ?>" size="20" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_include_cat" name="medialink_music_include_cat" value="<?php echo get_option('medialink_music_include_cat') ?>" size="20" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_include_cat" name="medialink_slideshow_include_cat" value="<?php echo get_option('medialink_slideshow_include_cat') ?>" size="20" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_include_cat" name="medialink_document_include_cat" value="<?php echo get_option('medialink_document_include_cat') ?>" size="20" />
					</td>
					<td align="left" valign="middle">
						<?php _e('Category you want to include. Only one.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>exclude_cat</b></td>
					<td align="center" valign="middle" colspan="5">
						<input type="text" id="medialink_exclude_cat" name="medialink_exclude_cat" value="<?php echo get_option('medialink_exclude_cat') ?>" size="100" />
					</td>
					<td align="left" valign="middle">
						<?php _e('Category you want to exclude. More than one, specified separated by |.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>generate_rssfeed</b></td>
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
						<input type="text" id="medialink_album_rssname" name="medialink_album_rssname" value="<?php echo get_option('medialink_album_rssname') ?>" size="25" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_rssname" name="medialink_movie_rssname" value="<?php echo get_option('medialink_movie_rssname') ?>" size="25" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_rssname" name="medialink_music_rssname" value="<?php echo get_option('medialink_music_rssname') ?>" size="25" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_rssname" name="medialink_slideshow_rssname" value="<?php echo get_option('medialink_slideshow_rssname') ?>" size="25" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_rssname" name="medialink_document_rssname" value="<?php echo get_option('medialink_document_rssname') ?>" size="25" />
					</td>
					<td align="left" valign="middle">
						<?php _e('The name of the RSS feed file (Use to widget)', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>rssmax</b></td>
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
					<td align="center" valign="middle"><b>categorylinks_show</b></td>
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
				<td align="center" valign="middle" colspan="6">
				<b><?php _e('Alias read extension : ', 'medialink'); ?></b>
				jpg=(jpg|jpeg|jpe) mp4=(mp4|m4v) mp3=(mp3|m4a|m4b) ogg=(ogg|oga) xls=(xla|xlt|xlw) ppt=(pot|pps)
				</td>
				</tr>
			</tbody>
			</table>

			<h2><?php _e('The default value for other.', 'medialink') ?></h2>	
			<table border="1" bgcolor="#dddddd">
			<tbody>
				<tr>
					<td align="center" valign="middle" colspan="2"><b>PC</b></td>
					<td align="center" valign="middle" colspan="2"><b>Smartphone</b></td>
					<td></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><b>movie</b></td>
					<td align="center" valign="middle"><b>music</b></td>
					<td align="center" valign="middle"><b>movie</b></td>
					<td align="center" valign="middle"><b>music</b></td>
					<td align="center" valign="middle"><b><?php _e('Description'); ?></b></td>
				</tr>
				<tr>
					<td align="center" valign="middle">
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
					<td colspan="3"></td>
					<td align="left" valign="middle">
					<?php _e('Size of the movie container.', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="4">
					<?php $target_css_listthumbsize = get_option('medialink_css_listthumbsize'); ?>
					<select id="medialink_css_listthumbsize" name="medialink_css_listthumbsize">
						<option <?php if ('50x35' == $target_css_listthumbsize)echo 'selected="selected"'; ?>>50x35</option>
						<option <?php if ('60x40' == $target_css_listthumbsize)echo 'selected="selected"'; ?>>60x40</option>
						<option <?php if ('80x55' == $target_css_listthumbsize)echo 'selected="selected"'; ?>>80x55</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('Size of the thumbnail size for Video and Music', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="2">
						<input type="text" id="medialink_css_pc_linkbackcolor" name="medialink_css_pc_linkbackcolor" value="<?php echo get_option('medialink_css_pc_linkbackcolor') ?>" size="10" />
					</td>
					<td colspan="2"></td>
					<td align="left" valign="middle">
					<?php _e('Background color', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="2">
						<input type="text" id="medialink_css_pc_linkstrcolor" name="medialink_css_pc_linkstrcolor" value="<?php echo get_option('medialink_css_pc_linkstrcolor') ?>" size="10" />
					</td>
					<td colspan="2"></td>
					<td align="left" valign="middle">
					<?php _e('Text color', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="2">
						<input type="text" id="medialink_css_pc_listwidth" name="medialink_css_pc_listwidth" value="<?php echo intval(get_option('medialink_css_pc_listwidth')) ?>" size="4" />
					</td>
					<td colspan="2"></td>
					<td align="left" valign="middle">
					<?php _e('Width of the list', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td align="center" valign="middle" colspan="2">
						<input type="text" id="medialink_css_sp_listarrowcolor" name="medialink_css_sp_listarrowcolor" value="<?php echo get_option('medialink_css_sp_listarrowcolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Color of the arrow', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td align="center" valign="middle" colspan="2">
						<input type="text" id="medialink_css_sp_listbackcolor" name="medialink_css_sp_listbackcolor" value="<?php echo get_option('medialink_css_sp_listbackcolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the list', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td align="center" valign="middle" colspan="2">
						<input type="text" id="medialink_css_sp_listpartitionlinecolor" name="medialink_css_sp_listpartitionlinecolor" value="<?php echo get_option('medialink_css_sp_listpartitionlinecolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the partition line in the list', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td align="center" valign="middle" colspan="2">
						<input type="text" id="medialink_css_sp_navbackcolor" name="medialink_css_sp_navbackcolor" value="<?php echo get_option('medialink_css_sp_navbackcolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the navigation', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td align="center" valign="middle" colspan="2">
						<input type="text" id="medialink_css_sp_navpartitionlinecolor" name="medialink_css_sp_navpartitionlinecolor" value="<?php echo get_option('medialink_css_sp_navpartitionlinecolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the partition line in the navigation', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td align="center" valign="middle" colspan="2">
						<input type="text" id="medialink_css_sp_navstrcolor" name="medialink_css_sp_navstrcolor" value="<?php echo get_option('medialink_css_sp_navstrcolor') ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Text color navigation', 'medialink') ?>
					</td>
				</tr>
			</tbody>
			</table>

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>

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
	  <div id="tabs-3">
		<div class="wrap">
		<h2>FAQ</h2>

		</div>
	  </div>
	-->

	</div>

		</div>
		<?php
	}

}

?>