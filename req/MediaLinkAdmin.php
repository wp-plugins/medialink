<?php
/**
 * MediaLink
 * 
 * @package    MediaLink
 * @subpackage MediaLink Management screen
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
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-tabs-in', $pluginurl.'/medialink/js/jquery-ui-tabs-in.js' );

		if( !empty($_POST) ) { $this->options_updated(); }
		$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH).'?page=MediaLink';

		$medialink_album = get_option('medialink_album');
		$medialink_all = get_option('medialink_all');
		$medialink_colorbox = get_option('medialink_colorbox');
		$medialink_css = get_option('medialink_css');
		$medialink_document = get_option('medialink_document');
		$medialink_exclude = get_option('medialink_exclude');
		$medialink_movie = get_option('medialink_movie');
		$medialink_music = get_option('medialink_music');
		$medialink_nivoslider = get_option('medialink_nivoslider');
		$medialink_photoswipe = get_option('medialink_photoswipe');
		$medialink_slideshow = get_option('medialink_slideshow');
		$medialink_swipebox = get_option('medialink_swipebox');
		$medialink_useragent = get_option('medialink_useragent');

		?>

		<div class="wrap">
		<h2>MediaLink</h2>

	<div id="tabs">
	  <ul>
	    <li><a href="#tabs-1"><?php _e('How to use', 'medialink'); ?></a></li>
	    <li><a href="#tabs-2"><?php _e('Settings'); ?>1</a></li>
		<li><a href="#tabs-3"><?php _e('Settings'); ?>2</a></li>
		<li><a href="#tabs-4"><?php _e('Effect of Images', 'medialink'); ?></a></li>
		<li><a href="#tabs-5"><?php _e('Caution:'); ?></a></li>
	<!--
		<li><a href="#tabs-5">FAQ</a></li>
	 -->
	  </ul>
	  <div id="tabs-1">
		<h2><?php _e('(In the case of image) Easy use', 'medialink'); ?></h2>
		<p><?php _e('Please add new Page. Please write a short code in the text field of the Page. Please go in Text mode this task.', 'medialink'); ?></p>
		<p><code>&#91;medialink set='album'&#93;</code></p>
		<p><?php _e('When you view this Page, it is displayed in album mode. This is the result of the search of the media library. The Settings> Media, determine the size of the thumbnail. The default value of MediaLink, width 80, height 80. Please set its value. In the Media> Add New, please drag and drop the image. You view the Page again. Should see the image to the Page.', 'medialink'); ?></p>

		<p><?php _e('Support the classification of the category. Use the caption of the media library, and are classified.', 'medialink'); ?></p>

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

		<div><strong><?php _e('Customization 2', 'medialink'); ?></strong></div>
		<div><strong><?php _e('Below, I shows the default values and various attributes of the short code.', 'medialink'); ?></strong></div>
		<table border="1" class="wp-list-table widefat fixed">
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
		<td align="center" valign="middle">set</td>
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
		<td align="center" valign="middle">sort</td>
		<td align="center" valign="middle"><?php echo $medialink_all['sort'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['sort'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['sort'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['sort'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['sort'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['sort'] ?></td>
		<td align="left" valign="middle">
		<?php _e('Type of Sort', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">suffix_pc</td>
		<td align="left" valign="top" rowspan="4" width="180"><?php _e("Audio's suffix and Video's suffix is following to the setting(set='music',set='movie'). Other than that, read all the data.", 'medialink'); ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['suffix_pc'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['suffix_pc'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['suffix_pc'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['suffix_pc'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['suffix_pc'] ?></td>
		<td align="left" valign="middle">
		<?php _e('extension of PC.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">suffix_pc2</td>
		<td></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['suffix_pc2'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['suffix_pc2'] ?></td>
		<td colspan="2"></td>
		<td align="left" valign="middle">
		<?php _e('second extension on the PC. Second candidate when working with html5', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">suffix_flash</td>
		<td align="center" valign="middle"></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['suffix_flash'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['suffix_flash'] ?></td>
		<td colspan="2"></td>
		<td align="left" valign="middle">
		<?php _e('Flash extension on the PC. Flash Player to be used when a HTML5 player does not work.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">suffix_sp</td>
		<td align="center" valign="middle"><?php echo $medialink_album['suffix_sp'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['suffix_sp'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['suffix_sp'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['suffix_sp'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['suffix_sp'] ?></td>
		<td align="left" valign="middle">
		<?php _e('extension of Smartphone', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">display_pc</td>
		<td align="center" valign="middle"><?php echo intval($medialink_all['display_pc']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_album['display_pc']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_movie['display_pc']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_music['display_pc']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_slideshow['display_pc']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_document['display_pc']) ?></td>
		<td align="left" valign="middle">
		<?php _e('File Display per page(PC)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">display_sp</td>
		<td align="center" valign="middle"><?php echo intval($medialink_all['display_sp']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_album['display_sp']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_movie['display_sp']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_music['display_sp']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_slideshow['display_sp']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_document['display_sp']) ?></td>
		<td align="left" valign="middle">
		<?php _e('File Display per page(Smartphone)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">image_show_size</td>
		<td align="center" valign="middle"><?php echo $medialink_all['image_show_size'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['image_show_size'] ?></td>
		<td colspan="2"></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['image_show_size'] ?></td>
		<td></td>
		<td align="left" valign="middle">
		<?php _e('Size of the image display. (Media Settings > Image Size)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">thumbnail</td>
		<td align="center" valign="middle">-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?></td>
		<td align="center" valign="middle">-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['thumbnail'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['thumbnail'] ?></td>
		<td align="center" valign="middle">-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['thumbnail'] ?></td>
		<td align="left" valign="middle">
		<?php _e('(album, slideshow) thumbnail suffix name. (movie, music, document) The icon is displayed if you specify icon. The thumbnail no display if you do not specify anything.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">include_cat</td>
		<td align="center" valign="middle"><?php echo $medialink_all['include_cat'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['include_cat'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['include_cat'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['include_cat'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['include_cat'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['include_cat'] ?></td>
		<td align="left" valign="middle">
		<?php _e('Category you want to include. Only one.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">exclude_cat</td>
		<td colspan="6" align="center" valign="middle"><?php echo $medialink_exclude['cat'] ?></td>
		<td align="left" valign="middle">
		<?php _e('Category you want to exclude. More than one, specified separated by |.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">generate_rssfeed</td>
		<td align="center" valign="middle"><?php echo $medialink_all['generate_rssfeed'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['generate_rssfeed'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['generate_rssfeed'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['generate_rssfeed'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['generate_rssfeed'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['generate_rssfeed'] ?></td>
		<td align="left" valign="middle">
		<?php _e('Generation of RSS feed.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">rssname</td>
		<td align="center" valign="middle"><?php echo $medialink_all['rssname'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['rssname'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['rssname'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['rssname'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['rssname'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['rssname'] ?></td>
		<td align="left" valign="middle">
		<?php _e('The name of the RSS feed file (Use to widget)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">rssmax</td>
		<td align="center" valign="middle"><?php echo intval($medialink_all['rssmax']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_album['rssmax']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_movie['rssmax']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_music['rssmax']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_slideshow['rssmax']) ?></td>
		<td align="center" valign="middle"><?php echo intval($medialink_document['rssmax']) ?></td>
		<td align="left" valign="middle">
		<?php _e('Syndication feeds show the most recent (Use to widget)', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">filesize_show</td>
		<td align="center" valign="middle"><?php echo $medialink_all['filesize_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['filesize_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['filesize_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['filesize_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['filesize_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['filesize_show'] ?></td>
		<td align="left" valign="middle">
		<?php _e('File size', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">stamptime_show</td>
		<td align="center" valign="middle"><?php echo $medialink_all['stamptime_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['stamptime_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['stamptime_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['stamptime_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['stamptime_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['stamptime_show'] ?></td>
		<td align="left" valign="middle">
		<?php _e('Date Time', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">categorylinks_show</td>
		<td align="center" valign="middle"><?php echo $medialink_all['categorylinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['categorylinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['categorylinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['categorylinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['categorylinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['categorylinks_show'] ?></td>
		<td align="left" valign="middle">
		<?php _e('Selectbox of categories.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">pagelinks_show</td>
		<td align="center" valign="middle"><?php echo $medialink_all['pagelinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['pagelinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['pagelinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['pagelinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['pagelinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['pagelinks_show'] ?></td>
		<td align="left" valign="middle">
		<?php _e('Navigation of page.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">sortlinks_show</td>
		<td align="center" valign="middle"><?php echo $medialink_all['sortlinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['sortlinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['sortlinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['sortlinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['sortlinks_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['sortlinks_show'] ?></td>
		<td align="left" valign="middle">
		<?php _e('Navigation of sort.', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">searchbox_show</td>
		<td align="center" valign="middle"><?php echo $medialink_all['searchbox_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['searchbox_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['searchbox_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['searchbox_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['searchbox_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['searchbox_show'] ?></td>
		<td align="left" valign="middle">
		<?php _e('Search box', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">rssicon_show</td>
		<td align="center" valign="middle"><?php echo $medialink_all['rssicon_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['rssicon_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['rssicon_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['rssicon_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['rssicon_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['rssicon_show'] ?></td>
		<td align="left" valign="middle">
		<?php _e('RSS Icon', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle">credit_show</td>
		<td align="center" valign="middle"><?php echo $medialink_all['credit_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_album['credit_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_movie['credit_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_music['credit_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_slideshow['credit_show'] ?></td>
		<td align="center" valign="middle"><?php echo $medialink_document['credit_show'] ?></td>
		<td align="left" valign="middle">
		<?php _e('Credit', 'medialink'); ?>
		</td>
		</tr>

		<tr>
		<td align="center" valign="middle" colspan="8">
		<?php _e('Alias read extension : ', 'medialink'); ?>
		jpg=(jpg|jpeg|jpe) mp4=(mp4|m4v) mp3=(mp3|m4a|m4b) ogg=(ogg|oga) xls=(xla|xlt|xlw) ppt=(pot|pps)
		</td>
		</tr>

		</tbody>
		</table>
	  </div>

	<form method="post" action="<?php echo $scriptname; ?>">
	  <div id="tabs-2">
		<div class="wrap">

			<p class="submit">
			  <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
			</p>

			<h2><?php _e('The default value for the short code attribute', 'medialink') ?></h2>	
			<table border="1" class="wp-list-table widefat fixed">
			<tbody>
				<tr>
					<td align="center" valign="middle"><?php _e('Attribute', 'medialink'); ?></td>
					<td align="center" valign="middle" colspan=6><?php _e('Default'); ?></td>
					<td align="center" valign="middle"><?php _e('Description'); ?></td>
				</tr>
				<tr>
					<td align="center" valign="middle">set</td>
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
					<td align="center" valign="middle">sort</td>
					<td align="center" valign="middle">
					<?php $target_all_sort = $medialink_all['sort']; ?>
					<select id="medialink_all_sort" name="medialink_all_sort">
						<option <?php if ('new' == $target_all_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_all_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_all_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_all_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>					<td align="center" valign="middle">
					<?php $target_album_sort = $medialink_album['sort']; ?>
					<select id="medialink_album_sort" name="medialink_album_sort">
						<option <?php if ('new' == $target_album_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_album_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_album_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_album_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_sort = $medialink_movie['sort']; ?>
					<select id="medialink_movie_sort" name="medialink_movie_sort">
						<option <?php if ('new' == $target_movie_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_movie_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_movie_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_movie_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_sort = $medialink_music['sort']; ?>
					<select id="medialink_music_sort" name="medialink_music_sort">
						<option <?php if ('new' == $target_music_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_music_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_music_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_music_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_sort = $medialink_slideshow['sort']; ?>
					<select id="medialink_slideshow_sort" name="medialink_slideshow_sort">
						<option <?php if ('new' == $target_slideshow_sort)echo 'selected="selected"'; ?>>new</option>
						<option <?php if ('old' == $target_slideshow_sort)echo 'selected="selected"'; ?>>old</option>
						<option <?php if ('des' == $target_slideshow_sort)echo 'selected="selected"'; ?>>des</option>
						<option <?php if ('asc' == $target_slideshow_sort)echo 'selected="selected"'; ?>>asc</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_sort = $medialink_document['sort']; ?>
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
					<td align="center" valign="middle">suffix_pc</td>
					<td align="left" valign="top" rowspan="4" width="180"><?php _e("Audio's suffix and Video's suffix is following to the setting(set='music',set='movie'). Other than that, read all the data.", 'medialink'); ?></td>
					<td align="center" valign="middle">
					<?php $target_album_suffix_pc = $medialink_album['suffix_pc']; ?>
					<select id="medialink_album_suffix_pc" name="medialink_album_suffix_pc">
						<option <?php if ('all' == $target_album_suffix_pc)echo 'selected="selected"'; ?>>all</option>
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
					<?php $target_movie_suffix_pc = $medialink_movie['suffix_pc']; ?>
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
					<?php $target_music_suffix_pc = $medialink_music['suffix_pc']; ?>
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
					<?php $target_slideshow_suffix_pc = $medialink_slideshow['suffix_pc']; ?>
					<select id="medialink_slideshow_suffix_pc" name="medialink_slideshow_suffix_pc">
						<option <?php if ('all' == $target_slideshow_suffix_pc)echo 'selected="selected"'; ?>>all</option>
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
					<?php $target_document_suffix_pc = $medialink_document['suffix_pc']; ?>
					<select id="medialink_document_suffix_pc" name="medialink_document_suffix_pc">
						<option <?php if ('all' == $target_document_suffix_pc)echo 'selected="selected"'; ?>>all</option>
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
					<td align="center" valign="middle">suffix_pc2</td>
					<td></td>
					<td align="center" valign="middle">
					<?php $target_movie_suffix_pc2 = $medialink_movie['suffix_pc2']; ?>
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
					<?php $target_music_suffix_pc2 = $medialink_music['suffix_pc2']; ?>
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
					<td align="center" valign="middle">suffix_flash</td>
					<td></td>
					<td align="center" valign="middle">
					<?php $target_movie_suffix_flash = $medialink_movie['suffix_flash']; ?>
					<select id="medialink_movie_suffix_flash" name="medialink_movie_suffix_flash">
						<option <?php if ('mp4' == $target_movie_suffix_flash)echo 'selected="selected"'; ?>>mp4</option>
						<option <?php if ('flv' == $target_movie_suffix_flash)echo 'selected="selected"'; ?>>flv</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_suffix_flash = $medialink_music['suffix_flash']; ?>
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
					<td align="center" valign="middle">suffix_sp</td>
					<td align="center" valign="middle">
					<?php $target_album_suffix_sp = $medialink_album['suffix_sp']; ?>
					<select id="medialink_album_suffix_sp" name="medialink_album_suffix_sp">
						<option <?php if ('all' == $target_album_suffix_sp)echo 'selected="selected"'; ?>>all</option>
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
					<?php $target_movie_suffix_sp = $medialink_movie['suffix_sp']; ?>
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
					<?php $target_music_suffix_sp = $medialink_music['suffix_sp']; ?>
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
					<?php $target_slideshow_suffix_sp = $medialink_slideshow['suffix_sp']; ?>
					<select id="medialink_slideshow_suffix_sp" name="medialink_slideshow_suffix_sp">
						<option <?php if ('all' == $target_slideshow_suffix_sp)echo 'selected="selected"'; ?>>all</option>
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
					<?php $target_document_suffix_sp = $medialink_document['suffix_sp']; ?>
					<select id="medialink_document_suffix_sp" name="medialink_document_suffix_sp">
						<option <?php if ('all' == $target_document_suffix_sp)echo 'selected="selected"'; ?>>all</option>
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
					<td align="center" valign="middle">display_pc</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_all_display_pc" name="medialink_all_display_pc" value="<?php echo intval($medialink_all['display_pc']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_display_pc" name="medialink_album_display_pc" value="<?php echo intval($medialink_album['display_pc']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_display_pc" name="medialink_movie_display_pc" value="<?php echo intval($medialink_movie['display_pc']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_display_pc" name="medialink_music_display_pc" value="<?php echo intval($medialink_music['display_pc']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_display_pc" name="medialink_slideshow_display_pc" value="<?php echo intval($medialink_slideshow['display_pc']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_display_pc" name="medialink_document_display_pc" value="<?php echo intval($medialink_document['display_pc']) ?>" size="3" />
					</td>
					<td align="left" valign="middle">
						<?php _e('File Display per page(PC)', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">display_sp</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_all_display_sp" name="medialink_all_display_sp" value="<?php echo intval($medialink_all['display_sp']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_display_sp" name="medialink_album_display_sp" value="<?php echo intval($medialink_album['display_sp']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_display_sp" name="medialink_movie_display_sp" value="<?php echo intval($medialink_movie['display_sp']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_display_sp" name="medialink_music_display_sp" value="<?php echo intval($medialink_music['display_sp']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_display_sp" name="medialink_slideshow_display_sp" value="<?php echo intval($medialink_slideshow['display_sp']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_display_sp" name="medialink_document_display_sp" value="<?php echo intval($medialink_document['display_sp']) ?>" size="3" />
					</td>
					<td align="left" valign="middle">
						<?php _e('File Display per page(Smartphone)', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">image_show_size</td>
					<td align="center" valign="middle">
					<?php $target_all_image_show_size = $medialink_all['image_show_size']; ?>
					<select id="medialink_all_image_show_size" name="medialink_all_image_show_size">
						<option <?php if ('Full' == $target_all_image_show_size)echo 'selected="selected"'; ?>>Full</option>
						<option <?php if ('Medium' == $target_all_image_show_size)echo 'selected="selected"'; ?>>Medium</option>
						<option <?php if ('Large' == $target_all_image_show_size)echo 'selected="selected"'; ?>>Large</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_image_show_size = $medialink_album['image_show_size']; ?>
					<select id="medialink_album_image_show_size" name="medialink_album_image_show_size">
						<option <?php if ('Full' == $target_album_image_show_size)echo 'selected="selected"'; ?>>Full</option>
						<option <?php if ('Medium' == $target_album_image_show_size)echo 'selected="selected"'; ?>>Medium</option>
						<option <?php if ('Large' == $target_album_image_show_size)echo 'selected="selected"'; ?>>Large</option>
					</select>
					</td>
					<td colspan="2"></td>
					<td align="center" valign="middle">
					<?php $target_slideshow_image_show_size = $medialink_slideshow['image_show_size']; ?>
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
					<td align="center" valign="middle">thumbnail</td>
					<td align="center" valign="middle">
						-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?>
					</td>
					<td align="center" valign="middle">
						-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_thumbnail = $medialink_movie['thumbnail']; ?>
					<select id="medialink_movie_thumbnail" name="medialink_movie_thumbnail">
						<option <?php if ('' == $target_movie_thumbnail)echo 'selected="selected"'; ?>></option>
						<option <?php if ('icon' == $target_movie_thumbnail)echo 'selected="selected"'; ?>>icon</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_thumbnail = $medialink_music['thumbnail']; ?>
					<select id="medialink_music_thumbnail" name="medialink_music_thumbnail">
						<option <?php if ('' == $target_music_thumbnail)echo 'selected="selected"'; ?>></option>
						<option <?php if ('icon' == $target_music_thumbnail)echo 'selected="selected"'; ?>>icon</option>
					</select>
					</td>
					<td align="center" valign="middle">
						-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_thumbnail = $medialink_document['thumbnail']; ?>
					<select id="medialink_document_thumbnail" name="medialink_document_thumbnail">
						<option <?php if ('' == $target_document_thumbnail)echo 'selected="selected"'; ?>></option>
						<option <?php if ('icon' == $target_document_thumbnail)echo 'selected="selected"'; ?>>icon</option>
					</select>
					</td>
					<td align="left" valign="middle">
						<?php _e('(album, slideshow) thumbnail suffix name. (movie, music, document) The icon is displayed if you specify icon. The thumbnail no display if you do not specify anything.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">include_cat</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_all_include_cat" name="medialink_all_include_cat" value="<?php echo $medialink_all['include_cat'] ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_include_cat" name="medialink_album_include_cat" value="<?php echo $medialink_album['include_cat'] ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_include_cat" name="medialink_movie_include_cat" value="<?php echo $medialink_movie['include_cat'] ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_include_cat" name="medialink_music_include_cat" value="<?php echo $medialink_music['include_cat'] ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_include_cat" name="medialink_slideshow_include_cat" value="<?php echo $medialink_slideshow['include_cat'] ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_include_cat" name="medialink_document_include_cat" value="<?php echo $medialink_document['include_cat'] ?>" size="15" />
					</td>
					<td align="left" valign="middle">
						<?php _e('Category you want to include. Only one.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">exclude_cat</td>
					<td align="center" valign="middle" colspan="6">
						<input type="text" id="medialink_exclude_cat" name="medialink_exclude_cat" value="<?php echo $medialink_exclude['cat'] ?>" size="100" />
					</td>
					<td align="left" valign="middle">
						<?php _e('Category you want to exclude. More than one, specified separated by |.', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">generate_rssfeed</td>
					<td align="center" valign="middle">
					<?php $target_all_generate_rssfeed = $medialink_all['generate_rssfeed']; ?>
					<select id="medialink_all_generate_rssfeed" name="medialink_all_generate_rssfeed">
						<option <?php if ('on' == $target_all_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_all_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_generate_rssfeed = $medialink_album['generate_rssfeed']; ?>
					<select id="medialink_album_generate_rssfeed" name="medialink_album_generate_rssfeed">
						<option <?php if ('on' == $target_album_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_album_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_generate_rssfeed = $medialink_movie['generate_rssfeed']; ?>
					<select id="medialink_movie_generate_rssfeed" name="medialink_movie_generate_rssfeed">
						<option <?php if ('on' == $target_movie_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_movie_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_generate_rssfeed = $medialink_music['generate_rssfeed']; ?>
					<select id="medialink_music_generate_rssfeed" name="medialink_music_generate_rssfeed">
						<option <?php if ('on' == $target_music_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_music_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_generate_rssfeed = $medialink_slideshow['generate_rssfeed']; ?>
					<select id="medialink_slideshow_generate_rssfeed" name="medialink_slideshow_generate_rssfeed">
						<option <?php if ('on' == $target_slideshow_generate_rssfeed)echo 'selected="selected"'; ?>>on</option>
						<option <?php if ('off' == $target_slideshow_generate_rssfeed)echo 'selected="selected"'; ?>>off</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_generate_rssfeed = $medialink_document['generate_rssfeed']; ?>
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
					<td align="center" valign="middle">rssname</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_all_rssname" name="medialink_all_rssname" value="<?php echo $medialink_all['rssname'] ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_rssname" name="medialink_album_rssname" value="<?php echo $medialink_album['rssname'] ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_rssname" name="medialink_movie_rssname" value="<?php echo $medialink_movie['rssname'] ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_rssname" name="medialink_music_rssname" value="<?php echo $medialink_music['rssname'] ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_rssname" name="medialink_slideshow_rssname" value="<?php echo $medialink_slideshow['rssname'] ?>" size="15" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_rssname" name="medialink_document_rssname" value="<?php echo $medialink_document['rssname'] ?>" size="15" />
					</td>
					<td align="left" valign="middle">
						<?php _e('The name of the RSS feed file (Use to widget)', 'medialink'); ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">rssmax</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_all_rssmax" name="medialink_all_rssmax" value="<?php echo intval($medialink_all['rssmax']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_album_rssmax" name="medialink_album_rssmax" value="<?php echo intval($medialink_album['rssmax']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_movie_rssmax" name="medialink_movie_rssmax" value="<?php echo intval($medialink_movie['rssmax']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_music_rssmax" name="medialink_music_rssmax" value="<?php echo intval($medialink_music['rssmax']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_slideshow_rssmax" name="medialink_slideshow_rssmax" value="<?php echo intval($medialink_slideshow['rssmax']) ?>" size="3" />
					</td>
					<td align="center" valign="middle">
						<input type="text" id="medialink_document_rssmax" name="medialink_document_rssmax" value="<?php echo intval($medialink_document['rssmax']) ?>" size="3" />
					</td>
					<td align="left" valign="middle">
						<?php _e('Syndication feeds show the most recent (Use to widget)', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle">filesize_show</td>
					<td align="center" valign="middle">
					<?php $target_all_filesize_show = $medialink_all['filesize_show']; ?>
					<select id="medialink_all_filesize_show" name="medialink_all_filesize_show">
						<option <?php if ('Show' == $target_all_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_filesize_show = $medialink_album['filesize_show']; ?>
					<select id="medialink_album_filesize_show" name="medialink_album_filesize_show">
						<option <?php if ('Show' == $target_album_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_filesize_show = $medialink_movie['filesize_show']; ?>
					<select id="medialink_movie_filesize_show" name="medialink_movie_filesize_show">
						<option <?php if ('Show' == $target_movie_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_filesize_show = $medialink_music['filesize_show']; ?>
					<select id="medialink_music_filesize_show" name="medialink_music_filesize_show">
						<option <?php if ('Show' == $target_music_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_filesize_show = $medialink_slideshow['filesize_show']; ?>
					<select id="medialink_slideshow_filesize_show" name="medialink_slideshow_filesize_show">
						<option <?php if ('Show' == $target_slideshow_filesize_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_filesize_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_filesize_show = $medialink_document['filesize_show']; ?>
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
					<td align="center" valign="middle">stamptime_show</td>
					<td align="center" valign="middle">
					<?php $target_all_stamptime_show = $medialink_all['stamptime_show']; ?>
					<select id="medialink_all_stamptime_show" name="medialink_all_stamptime_show">
						<option <?php if ('Show' == $target_all_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_stamptime_show = $medialink_album['stamptime_show']; ?>
					<select id="medialink_album_stamptime_show" name="medialink_album_stamptime_show">
						<option <?php if ('Show' == $target_album_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_stamptime_show = $medialink_movie['stamptime_show']; ?>
					<select id="medialink_movie_stamptime_show" name="medialink_movie_stamptime_show">
						<option <?php if ('Show' == $target_movie_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_stamptime_show = $medialink_music['stamptime_show']; ?>
					<select id="medialink_music_stamptime_show" name="medialink_music_stamptime_show">
						<option <?php if ('Show' == $target_music_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_stamptime_show = $medialink_slideshow['stamptime_show']; ?>
					<select id="medialink_slideshow_stamptime_show" name="medialink_slideshow_stamptime_show">
						<option <?php if ('Show' == $target_slideshow_stamptime_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_stamptime_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_stamptime_show = $medialink_document['stamptime_show']; ?>
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
					<td align="center" valign="middle">categorylinks_show</td>
					<td align="center" valign="middle">
					<?php $target_all_categorylinks_show = $medialink_all['categorylinks_show']; ?>
					<select id="medialink_all_categorylinks_show" name="medialink_all_categorylinks_show">
						<option <?php if ('Show' == $target_all_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_categorylinks_show = $medialink_album['categorylinks_show']; ?>
					<select id="medialink_album_categorylinks_show" name="medialink_album_categorylinks_show">
						<option <?php if ('Show' == $target_album_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_categorylinks_show = $medialink_movie['categorylinks_show']; ?>
					<select id="medialink_movie_categorylinks_show" name="medialink_movie_categorylinks_show">
						<option <?php if ('Show' == $target_movie_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_categorylinks_show = $medialink_music['categorylinks_show']; ?>
					<select id="medialink_music_categorylinks_show" name="medialink_music_categorylinks_show">
						<option <?php if ('Show' == $target_music_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_categorylinks_show = $medialink_slideshow['categorylinks_show']; ?>
					<select id="medialink_slideshow_categorylinks_show" name="medialink_slideshow_categorylinks_show">
						<option <?php if ('Show' == $target_slideshow_categorylinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_categorylinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_categorylinks_show = $medialink_document['categorylinks_show']; ?>
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
					<td align="center" valign="middle">pagelinks_show</td>
					<td align="center" valign="middle">
					<?php $target_all_pagelinks_show = $medialink_all['pagelinks_show']; ?>
					<select id="medialink_all_pagelinks_show" name="medialink_all_pagelinks_show">
						<option <?php if ('Show' == $target_all_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_pagelinks_show = $medialink_album['pagelinks_show']; ?>
					<select id="medialink_album_pagelinks_show" name="medialink_album_pagelinks_show">
						<option <?php if ('Show' == $target_album_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_pagelinks_show = $medialink_movie['pagelinks_show']; ?>
					<select id="medialink_movie_pagelinks_show" name="medialink_movie_pagelinks_show">
						<option <?php if ('Show' == $target_movie_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_pagelinks_show = $medialink_music['pagelinks_show']; ?>
					<select id="medialink_music_pagelinks_show" name="medialink_music_pagelinks_show">
						<option <?php if ('Show' == $target_music_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_pagelinks_show = $medialink_slideshow['pagelinks_show']; ?>
					<select id="medialink_slideshow_pagelinks_show" name="medialink_slideshow_pagelinks_show">
						<option <?php if ('Show' == $target_slideshow_pagelinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_pagelinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_pagelinks_show = $medialink_document['pagelinks_show']; ?>
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
					<td align="center" valign="middle">sortlinks_show</td>
					<td align="center" valign="middle">
					<?php $target_all_sortlinks_show = $medialink_all['sortlinks_show']; ?>
					<select id="medialink_all_sortlinks_show" name="medialink_all_sortlinks_show">
						<option <?php if ('Show' == $target_all_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_sortlinks_show = $medialink_album['sortlinks_show']; ?>
					<select id="medialink_album_sortlinks_show" name="medialink_album_sortlinks_show">
						<option <?php if ('Show' == $target_album_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_sortlinks_show = $medialink_movie['sortlinks_show']; ?>
					<select id="medialink_movie_sortlinks_show" name="medialink_movie_sortlinks_show">
						<option <?php if ('Show' == $target_movie_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_sortlinks_show = $medialink_music['sortlinks_show']; ?>
					<select id="medialink_music_sortlinks_show" name="medialink_music_sortlinks_show">
						<option <?php if ('Show' == $target_music_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_sortlinks_show = $medialink_slideshow['sortlinks_show']; ?>
					<select id="medialink_slideshow_sortlinks_show" name="medialink_slideshow_sortlinks_show">
						<option <?php if ('Show' == $target_slideshow_sortlinks_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_sortlinks_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_sortlinks_show = $medialink_document['sortlinks_show']; ?>
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
					<td align="center" valign="middle">searchbox_show</td>
					<td align="center" valign="middle">
					<?php $target_all_searchbox_show = $medialink_all['searchbox_show']; ?>
					<select id="medialink_all_searchbox_show" name="medialink_all_searchbox_show">
						<option <?php if ('Show' == $target_all_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_searchbox_show = $medialink_album['searchbox_show']; ?>
					<select id="medialink_album_searchbox_show" name="medialink_album_searchbox_show">
						<option <?php if ('Show' == $target_album_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_searchbox_show = $medialink_movie['searchbox_show']; ?>
					<select id="medialink_movie_searchbox_show" name="medialink_movie_searchbox_show">
						<option <?php if ('Show' == $target_movie_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_searchbox_show = $medialink_music['searchbox_show']; ?>
					<select id="medialink_music_searchbox_show" name="medialink_music_searchbox_show">
						<option <?php if ('Show' == $target_music_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_searchbox_show = $medialink_slideshow['searchbox_show']; ?>
					<select id="medialink_slideshow_searchbox_show" name="medialink_slideshow_searchbox_show">
						<option <?php if ('Show' == $target_slideshow_searchbox_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_searchbox_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_searchbox_show = $medialink_document['searchbox_show']; ?>
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
					<td align="center" valign="middle">rssicon_show</td>
					<td align="center" valign="middle">
					<?php $target_all_rssicon_show = $medialink_all['rssicon_show']; ?>
					<select id="medialink_all_rssicon_show" name="medialink_all_rssicon_show">
						<option <?php if ('Show' == $target_all_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_rssicon_show = $medialink_album['rssicon_show']; ?>
					<select id="medialink_album_rssicon_show" name="medialink_album_rssicon_show">
						<option <?php if ('Show' == $target_album_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_rssicon_show = $medialink_movie['rssicon_show']; ?>
					<select id="medialink_movie_rssicon_show" name="medialink_movie_rssicon_show">
						<option <?php if ('Show' == $target_movie_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_rssicon_show = $medialink_music['rssicon_show']; ?>
					<select id="medialink_music_rssicon_show" name="medialink_music_rssicon_show">
						<option <?php if ('Show' == $target_music_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_rssicon_show = $medialink_slideshow['rssicon_show']; ?>
					<select id="medialink_slideshow_rssicon_show" name="medialink_slideshow_rssicon_show">
						<option <?php if ('Show' == $target_slideshow_rssicon_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_rssicon_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_rssicon_show = $medialink_document['rssicon_show']; ?>
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
					<td align="center" valign="middle">credit_show</td>
					<td align="center" valign="middle">
					<?php $target_all_credit_show = $medialink_all['credit_show']; ?>
					<select id="medialink_all_credit_show" name="medialink_all_credit_show">
						<option <?php if ('Show' == $target_all_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_all_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_album_credit_show = $medialink_album['credit_show']; ?>
					<select id="medialink_album_credit_show" name="medialink_album_credit_show">
						<option <?php if ('Show' == $target_album_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_album_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_movie_credit_show = $medialink_movie['credit_show']; ?>
					<select id="medialink_movie_credit_show" name="medialink_movie_credit_show">
						<option <?php if ('Show' == $target_movie_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_movie_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_music_credit_show = $medialink_music['credit_show']; ?>
					<select id="medialink_music_credit_show" name="medialink_music_credit_show">
						<option <?php if ('Show' == $target_music_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_music_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_slideshow_credit_show = $medialink_slideshow['credit_show']; ?>
					<select id="medialink_slideshow_credit_show" name="medialink_slideshow_credit_show">
						<option <?php if ('Show' == $target_slideshow_credit_show)echo 'selected="selected"'; ?>>Show</option>
						<option <?php if ('Hide' == $target_slideshow_credit_show)echo 'selected="selected"'; ?>>Hide</option>
					</select>
					</td>
					<td align="center" valign="middle">
					<?php $target_document_credit_show = $medialink_document['credit_show']; ?>
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
				<?php _e('Alias read extension : ', 'medialink'); ?>
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
			<table border="1" class="wp-list-table widefat fixed">
			<tbody>
				<tr>
					<td align="center" valign="middle" colspan="4">PC</td>
					<td align="center" valign="middle" colspan="4">Smartphone</td>
					<td></td>
				</tr>
				<tr>
					<td align="center" valign="middle">all</td>
					<td align="center" valign="middle">movie</td>
					<td align="center" valign="middle">music</td>
					<td align="center" valign="middle">document</td>
					<td align="center" valign="middle">all</td>
					<td align="center" valign="middle">movie</td>
					<td align="center" valign="middle">music</td>
					<td align="center" valign="middle">document</td>
					<td align="center" valign="middle"><?php _e('Description'); ?></td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="2">
					<?php $target_movie_container = $medialink_movie['container']; ?>
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
					<?php $target_css_pc_listthumbsize = $medialink_css['pc_listthumbsize']; ?>
					<select id="medialink_css_pc_listthumbsize" name="medialink_css_pc_listthumbsize">
						<option <?php if ('40x40' == $target_css_pc_listthumbsize)echo 'selected="selected"'; ?>>40x40</option>
						<option <?php if ('60x60' == $target_css_pc_listthumbsize)echo 'selected="selected"'; ?>>60x60</option>
						<option <?php if ('80x80' == $target_css_pc_listthumbsize)echo 'selected="selected"'; ?>>80x80</option>
					</select>
					</td>
					<td align="left" valign="middle">
					<?php _e('Size of the thumbnail size for Video and Music', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_pc_linkbackcolor" name="medialink_css_pc_linkbackcolor" value="<?php echo $medialink_css['pc_linkbackcolor'] ?>" size="10" />
					</td>
					<td colspan="4"></td>
					<td align="left" valign="middle">
					<?php _e('Background color', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_pc_linkstrcolor" name="medialink_css_pc_linkstrcolor" value="<?php echo $medialink_css['pc_linkstrcolor'] ?>" size="10" />
					</td>
					<td colspan="4"></td>
					<td align="left" valign="middle">
					<?php _e('Text color', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_listarrowcolor" name="medialink_css_sp_listarrowcolor" value="<?php echo $medialink_css['sp_listarrowcolor'] ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Color of the arrow', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_listbackcolor" name="medialink_css_sp_listbackcolor" value="<?php echo $medialink_css['sp_listbackcolor'] ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the list', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_listpartitionlinecolor" name="medialink_css_sp_listpartitionlinecolor" value="<?php echo $medialink_css['sp_listpartitionlinecolor'] ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the partition line in the list', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_navbackcolor" name="medialink_css_sp_navbackcolor" value="<?php echo $medialink_css['sp_navbackcolor'] ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the navigation', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_navpartitionlinecolor" name="medialink_css_sp_navpartitionlinecolor" value="<?php echo $medialink_css['sp_navpartitionlinecolor'] ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Background color of the partition line in the navigation', 'medialink') ?>
					</td>
				</tr>
				<tr>
					<td colspan="4"></td>
					<td align="center" valign="middle" colspan="4">
						<input type="text" id="medialink_css_sp_navstrcolor" name="medialink_css_sp_navstrcolor" value="<?php echo $medialink_css['sp_navstrcolor'] ?>" size="10" />
					</td>
					<td align="left" valign="middle">
					<?php _e('Text color navigation', 'medialink') ?>
					</td>
				</tr>
			</tbody>
			</table>

			<h2><?php _e('The default value for User Agent.', 'medialink') ?></h2>	
			<table border="1" class="wp-list-table widefat fixed">
			<tbody>
				<tr>
					<td align="center" valign="middle"><?php _e('Generate html', 'medialink'); ?></td>
					<td align="center" valign="middle"><?php _e('Default'); ?></td>
					<td align="center" valign="middle"><?php _e('Description'); ?></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><?php _e('for Pc or Tablet', 'medialink'); ?></td>
					<td align="center" valign="middle">
						<textarea id="medialink_useragent_tb" name="medialink_useragent_tb" rows="4" cols="120"><?php echo $medialink_useragent['tb'] ?></textarea>

					</td>
					<td align="left" valign="middle" rowspan="2"><?php _e('| Specify separated by. Regular expression is possible.', 'medialink'); ?></td>
				</tr>
				<tr>
					<td align="center" valign="middle"><?php _e('for Smartphone', 'medialink'); ?></td>
					<td align="center" valign="middle">
						<textarea id="medialink_useragent_sp" name="medialink_useragent_sp" rows="4" cols="120"><?php echo $medialink_useragent['sp'] ?></textarea>

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
		<h2><?php _e('Effect of Images', 'medialink'); ?></h2>
			<h3><?php _e('It is possible to work with the following plugins. Please install.', 'medialink'); ?></h3>
			<li><a href="<?php echo get_admin_url().'plugin-install.php?tab=search&s=Boxers+and+Swipers'; ?>">Boxers and Swipers</a></li>
			<li><a href="<?php echo get_admin_url().'plugin-install.php?tab=search&s=Simple+NivoSlider'; ?>">Simple NivoSlider</a></li>
			<h3><?php _e('In addition, offer the following filters. This filter passes the html that is generated.', 'medialink'); ?></h3>
			<li><code>post_medialink</code></li>
		</div>
	  </div>

	  <div id="tabs-5">
		<div class="wrap">
	<h3><?php _e('The to playback of video and music, that such as the next, .htaccess may be required to the directory containing the data file by the environment.', 'medialink') ?></h3>
	<textarea readonly rows="23" cols="100">
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

	/* ==================================================
	 * Update wp_options table.
	 * @since	4.4
	 */
	function options_updated(){

		$all_tbl = array(
						'sort' => $_POST['medialink_all_sort'],
						'display_pc' => $_POST['medialink_all_display_pc'],
						'display_sp' => $_POST['medialink_all_display_sp'],
						'image_show_size' => $_POST['medialink_all_image_show_size'],
						'include_cat' => $_POST['medialink_all_include_cat'],
						'generate_rssfeed' => $_POST['medialink_all_generate_rssfeed'],
						'rssname' => $_POST['medialink_all_rssname'],
						'rssmax' => $_POST['medialink_all_rssmax'],
						'filesize_show' => $_POST['medialink_all_filesize_show'],
						'stamptime_show' => $_POST['medialink_all_stamptime_show'],
						'categorylinks_show' => $_POST['medialink_all_categorylinks_show'],
						'pagelinks_show' => $_POST['medialink_all_pagelinks_show'],
						'sortlinks_show' => $_POST['medialink_all_sortlinks_show'],
						'searchbox_show' => $_POST['medialink_all_searchbox_show'],
						'rssicon_show' => $_POST['medialink_all_rssicon_show'],
						'credit_show' => $_POST['medialink_all_credit_show']
					);
		update_option( 'medialink_all', $all_tbl );

		$album_tbl = array(
						'sort' => $_POST['medialink_album_sort'],
						'suffix_pc' => $_POST['medialink_album_suffix_pc'],
						'suffix_sp' => $_POST['medialink_album_suffix_sp'],
						'display_pc' => $_POST['medialink_album_display_pc'],
						'display_sp' => $_POST['medialink_album_display_sp'],
						'image_show_size' => $_POST['medialink_album_image_show_size'],
						'include_cat' => $_POST['medialink_album_include_cat'],
						'generate_rssfeed' => $_POST['medialink_album_generate_rssfeed'],
						'rssname' => $_POST['medialink_album_rssname'],
						'rssmax' => $_POST['medialink_album_rssmax'],
						'filesize_show' => $_POST['medialink_album_filesize_show'],
						'stamptime_show' => $_POST['medialink_album_stamptime_show'],
						'categorylinks_show' => $_POST['medialink_album_categorylinks_show'],
						'pagelinks_show' => $_POST['medialink_album_pagelinks_show'],
						'sortlinks_show' => $_POST['medialink_album_sortlinks_show'],
						'searchbox_show' => $_POST['medialink_album_searchbox_show'],
						'rssicon_show' => $_POST['medialink_album_rssicon_show'],
						'credit_show' => $_POST['medialink_album_credit_show']
					);
		update_option( 'medialink_album', $album_tbl );

		$movie_tbl = array(
						'sort' => $_POST['medialink_movie_sort'],
						'suffix_pc' => $_POST['medialink_movie_suffix_pc'],
						'suffix_pc2' => $_POST['medialink_movie_suffix_pc2'],
						'suffix_flash' => $_POST['medialink_movie_suffix_flash'],
						'suffix_sp' => $_POST['medialink_movie_suffix_sp'],
						'display_pc' => $_POST['medialink_movie_display_pc'],
						'display_sp' => $_POST['medialink_movie_display_sp'],
						'thumbnail' => $_POST['medialink_movie_thumbnail'],
						'include_cat' => $_POST['medialink_movie_include_cat'],
						'generate_rssfeed' => $_POST['medialink_movie_generate_rssfeed'],
						'rssname' => $_POST['medialink_movie_rssname'],
						'rssmax' => $_POST['medialink_movie_rssmax'],
						'container' => $_POST['medialink_movie_container'],
						'filesize_show' => $_POST['medialink_movie_filesize_show'],
						'stamptime_show' => $_POST['medialink_movie_stamptime_show'],
						'categorylinks_show' => $_POST['medialink_movie_categorylinks_show'],
						'pagelinks_show' => $_POST['medialink_movie_pagelinks_show'],
						'sortlinks_show' => $_POST['medialink_movie_sortlinks_show'],
						'searchbox_show' => $_POST['medialink_movie_searchbox_show'],
						'rssicon_show' => $_POST['medialink_movie_rssicon_show'],
						'credit_show' => $_POST['medialink_movie_credit_show']
						);
		update_option( 'medialink_movie', $movie_tbl );

		$music_tbl = array(
						'sort' => $_POST['medialink_music_sort'],
						'suffix_pc' => $_POST['medialink_music_suffix_pc'],
						'suffix_pc2' => $_POST['medialink_music_suffix_pc2'],
						'suffix_flash' => $_POST['medialink_music_suffix_flash'],
						'suffix_sp' => $_POST['medialink_music_suffix_sp'],
						'display_pc' => $_POST['medialink_music_display_pc'],
						'display_sp' => $_POST['medialink_music_display_sp'],
						'thumbnail' => $_POST['medialink_music_thumbnail'],
						'include_cat' => $_POST['medialink_music_include_cat'],
						'generate_rssfeed' => $_POST['medialink_music_generate_rssfeed'],
						'rssname' => $_POST['medialink_music_rssname'],
						'rssmax' => $_POST['medialink_music_rssmax'],
						'filesize_show' => $_POST['medialink_music_filesize_show'],
						'stamptime_show' => $_POST['medialink_music_stamptime_show'],
						'categorylinks_show' => $_POST['medialink_music_categorylinks_show'],
						'pagelinks_show' => $_POST['medialink_music_pagelinks_show'],
						'sortlinks_show' => $_POST['medialink_music_sortlinks_show'],
						'searchbox_show' => $_POST['medialink_music_searchbox_show'],
						'rssicon_show' => $_POST['medialink_music_rssicon_show'],
						'credit_show' => $_POST['medialink_music_credit_show']
						);
		update_option( 'medialink_music', $music_tbl );

		$slideshow_tbl = array(
						'sort' => $_POST['medialink_slideshow_sort'],
						'suffix_pc' => $_POST['medialink_slideshow_suffix_pc'],
						'suffix_sp' => $_POST['medialink_slideshow_suffix_sp'],
						'display_pc' => $_POST['medialink_slideshow_display_pc'],
						'display_sp' => $_POST['medialink_slideshow_display_sp'],
						'image_show_size' => $_POST['medialink_slideshow_image_show_size'],
						'include_cat' => $_POST['medialink_slideshow_include_cat'],
						'generate_rssfeed' => $_POST['medialink_slideshow_generate_rssfeed'],
						'rssname' => $_POST['medialink_slideshow_rssname'],
						'rssmax' => $_POST['medialink_slideshow_rssmax'],
						'filesize_show' => $_POST['medialink_slideshow_filesize_show'],
						'stamptime_show' => $_POST['medialink_slideshow_stamptime_show'],
						'categorylinks_show' => $_POST['medialink_slideshow_categorylinks_show'],
						'pagelinks_show' => $_POST['medialink_slideshow_pagelinks_show'],
						'sortlinks_show' => $_POST['medialink_slideshow_sortlinks_show'],
						'searchbox_show' => $_POST['medialink_slideshow_searchbox_show'],
						'rssicon_show' => $_POST['medialink_slideshow_rssicon_show'],
						'credit_show' => $_POST['medialink_slideshow_credit_show']
						);
		update_option( 'medialink_slideshow', $slideshow_tbl );

		$document_tbl = array(
						'sort' => $_POST['medialink_document_sort'],
						'suffix_pc' => $_POST['medialink_document_suffix_pc'],
						'suffix_sp' => $_POST['medialink_document_suffix_sp'],
						'display_pc' => $_POST['medialink_document_display_pc'],
						'display_sp' => $_POST['medialink_document_display_sp'],
						'thumbnail' => $_POST['medialink_document_thumbnail'],
						'include_cat' => $_POST['medialink_document_include_cat'],
						'generate_rssfeed' => $_POST['medialink_document_generate_rssfeed'],
						'rssname' => $_POST['medialink_document_rssname'],
						'rssmax' => $_POST['medialink_document_rssmax'],
						'filesize_show' => $_POST['medialink_document_filesize_show'],
						'stamptime_show' => $_POST['medialink_document_stamptime_show'],
						'categorylinks_show' => $_POST['medialink_document_categorylinks_show'],
						'pagelinks_show' => $_POST['medialink_document_pagelinks_show'],
						'sortlinks_show' => $_POST['medialink_document_sortlinks_show'],
						'searchbox_show' => $_POST['medialink_document_searchbox_show'],
						'rssicon_show' => $_POST['medialink_document_rssicon_show'],
						'credit_show' => $_POST['medialink_document_credit_show']
						);
		update_option( 'medialink_document', $document_tbl );

		$exclude_tbl = array(
						'cat' => stripslashes($_POST['medialink_exclude_cat'])
						);
		update_option( 'medialink_exclude', $exclude_tbl );

		$css_tbl = array(
						'pc_listthumbsize' => $_POST['medialink_css_pc_listthumbsize'],
						'pc_linkstrcolor' => $_POST['medialink_css_pc_linkstrcolor'],
						'pc_linkbackcolor' => $_POST['medialink_css_pc_linkbackcolor'],
						'sp_navstrcolor' => $_POST['medialink_css_sp_navstrcolor'],
						'sp_navbackcolor' => $_POST['medialink_css_sp_navbackcolor'],
						'sp_navpartitionlinecolor' => $_POST['medialink_css_sp_navpartitionlinecolor'],
						'sp_listbackcolor' => $_POST['medialink_css_sp_listbackcolor'],
						'sp_listarrowcolor' => $_POST['medialink_css_sp_listarrowcolor'],
						'sp_listpartitionlinecolor' => $_POST['medialink_css_sp_listpartitionlinecolor']
						);
		update_option( 'medialink_css', $css_tbl );

		$useragent_tbl = array(
						'tb' => stripslashes($_POST['medialink_useragent_tb']),
						'sp' => stripslashes($_POST['medialink_useragent_sp'])
						);
		update_option( 'medialink_useragent', $useragent_tbl );

	}

}

?>