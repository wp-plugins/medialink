<?php
/*
Plugin Name: MediaLink
Plugin URI: http://wordpress.org/plugins/medialink/
Version: 1.21
Description: MediaLink outputs as a gallery from the media library(image and music and video). Support the classification of the category.
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
	// Add action hooks
	add_action('admin_init', 'medialink_register_settings');
	add_filter( 'plugin_action_links', 'medialink_settings_link', 10, 2 );
	add_action('wp_head','medialink_add_feedlink');
	add_action('wp_head','medialink_add_css');
	add_action( 'wp_head', wp_enqueue_script('jquery') );
	add_action( 'admin_menu', 'medialink_plugin_menu' );
	add_shortcode( 'medialink', 'medialink_func' );
	add_action('widgets_init', create_function('', 'return register_widget("MediaLinkWidgetItem");'));

/* ==================================================
 * Widget
 * @since	1.12
 */
class MediaLinkWidgetItem extends WP_Widget {
	function MediaLinkWidgetItem() {
		parent::WP_Widget(false, $name = 'MediaLinkRssFeed');
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$checkbox1 = apply_filters('widget_checkbox', $instance['checkbox1']);
		$checkbox2 = apply_filters('widget_checkbox', $instance['checkbox2']);
		$checkbox3 = apply_filters('widget_checkbox', $instance['checkbox3']);
		$checkbox4 = apply_filters('widget_checkbox', $instance['checkbox4']);
		$checkbox5 = apply_filters('widget_checkbox', $instance['checkbox5']);
		$checkbox6 = apply_filters('widget_checkbox', $instance['checkbox6']);

		$wp_uploads = wp_upload_dir();
		$wp_uploads_path = str_replace('http://'.$_SERVER["SERVER_NAME"], '', $wp_uploads['baseurl']);
		$pluginurl = plugins_url($path='',$scheme=null);

		$documentrootname = $_SERVER['DOCUMENT_ROOT'];
		$servername = 'http://'.$_SERVER['HTTP_HOST'];
		$xmlurl2 = get_bloginfo('comments_rss2_url');
		$xml3 = $wp_uploads_path.'/'.get_option('medialink_album_rssname').'.xml';
		$xml4 = $wp_uploads_path.'/'.get_option('medialink_movie_rssname').'.xml';
		$xml5 = $wp_uploads_path.'/'.get_option('medialink_music_rssname').'.xml';
		$xml6 = $wp_uploads_path.'/'.get_option('medialink_slideshow_rssname').'.xml';
		if ($title) {
			echo $before_widget;
			echo $before_title . $title . $after_title;
			echo '<table>';
			if ($checkbox1) {
				?>
				<tr>
				<td align="center" valign="middle">
				<a href="<?php echo bloginfo('rss2_url'); ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/rssfeeds.png"></a>
				</td>
				<td align="left" valign="middle"><?php echo bloginfo('name'); ?></td>
				</tr>
				<?
			}
			if ($checkbox2) {
				$xmldata2 = simplexml_load_file($xmlurl2);
				?>
				<tr>
				<td align="center" valign="middle"><a href="<?php echo bloginfo('comments_rss2_url'); ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/rssfeeds.png"></a>
				</td>
				<td align="left" valign="middle"><?php echo $xmldata2->channel->title; ?></td>
				</tr>
				<?
			}	
			if ($checkbox3 && file_exists($documentrootname.$xml3)) {
				$xmldata3 = simplexml_load_file($servername.$xml3);
				?>
				<tr>
				<td align="center" valign="middle"><a href="<?php echo $servername.$xml3; ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/rssfeeds.png"></a></td>
				<td align="left" valign="middle"><?php echo $xmldata3->channel->title; ?></td>
				</tr>
				<?
			}
			if ($checkbox4 && file_exists($documentrootname.$xml4)) {
				$xmldata4 = simplexml_load_file($servername.$xml4);
				?>
				<tr>
				<td align="center" valign="middle"><a href="<?php echo $servername.$xml4; ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/podcast.png"></a></td>
				<td align="left" valign="middle"><?php echo $xmldata4->channel->title; ?></td>
				</tr>
				<?
			}
			if ($checkbox5 && file_exists($documentrootname.$xml5)) {
				$xmldata5 = simplexml_load_file($servername.$xml5);
				?>
				<tr>
				<td align="center" valign="middle"><a href="<?php echo $servername.$xml5; ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/podcast.png"></a></td>
				<td align="left" valign="middle"><?php echo $xmldata5->channel->title; ?></td>
				</tr>
				<?
			}
			if ($checkbox6 && file_exists($documentrootname.$xml6)) {
				$xmldata6 = simplexml_load_file($servername.$xml6);
				?>
				<tr>
				<td align="center" valign="middle"><a href="<?php echo $servername.$xml6; ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/rssfeeds.png"></a></td>
				<td align="left" valign="middle"><?php echo $xmldata6->channel->title; ?></td>
				</tr>
				<?
			}
			echo '</table>';
			echo $after_widget;
		}
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['checkbox1'] = strip_tags($new_instance['checkbox1']);
		$instance['checkbox2'] = strip_tags($new_instance['checkbox2']);
		$instance['checkbox3'] = strip_tags($new_instance['checkbox3']);
		$instance['checkbox4'] = strip_tags($new_instance['checkbox4']);
		$instance['checkbox5'] = strip_tags($new_instance['checkbox5']);
		$instance['checkbox6'] = strip_tags($new_instance['checkbox6']);
		return $instance;
	}
	
	function form($instance) {
		$title = esc_attr($instance['title']);
		$checkbox1 = esc_attr($instance['checkbox1']);
		$checkbox2 = esc_attr($instance['checkbox2']);
		$checkbox3 = esc_attr($instance['checkbox3']);
		$checkbox4 = esc_attr($instance['checkbox4']);
		$checkbox5 = esc_attr($instance['checkbox5']);
		$checkbox6 = esc_attr($instance['checkbox6']);

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<div><?php echo get_bloginfo('name'); ?>:</div>
		<table>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox1'); ?> ">
<input class="widefat" id="<?php echo $this->get_field_id('checkbox1'); ?>" name="<?php echo $this->get_field_name('checkbox1'); ?>" type="checkbox"<?php checked('Blog', $checkbox1); ?> value="Blog" />
			<?php _e('Entries (RSS)'); ?></label>
		</td>
		</tr>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox2'); ?> ">
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox2'); ?>" name="<?php echo $this->get_field_name('checkbox2'); ?>" type="checkbox"<?php checked('Blog Comments', $checkbox2); ?> value="Blog Comments" />
			<?php _e('Comments (RSS)'); ?></label>
		</td>
		</tr>
		</table>
		<div>MediaLink:</div>
		<table>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox3'); ?> ">
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox3'); ?>" name="<?php echo $this->get_field_name('checkbox3'); ?>" type="checkbox"<?php checked('Album', $checkbox3); ?> value="Album" />
			<?php _e('Album (RSS)', 'medialink'); ?></label>
		</td>
		</tr>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox4'); ?> ">
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox4'); ?>" name="<?php echo $this->get_field_name('checkbox4'); ?>" type="checkbox"<?php checked('Movie', $checkbox4); ?> value="Movie" />
			<?php _e('Video (Podcast)', 'medialink'); ?></label>
		</td>
		</tr>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox5'); ?> ">
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox5'); ?>" name="<?php echo $this->get_field_name('checkbox5'); ?>" type="checkbox"<?php checked('Music', $checkbox5); ?> value="Music" />
			<?php _e('Music (Podcast)', 'medialink'); ?></label>
		</td>
		</tr>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox6'); ?> ">
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox6'); ?>" name="<?php echo $this->get_field_name('checkbox6'); ?>" type="checkbox"<?php checked('Slideshow', $checkbox6); ?> value="Slideshow" />
			<?php _e('Slideshow (RSS)', 'medialink'); ?></label>
		</td>
		</tr>
		</table>
		<?php
	}
}

/* ==================================================
 * Settings register
 * @since	1.1
 */
function medialink_register_settings(){
	register_setting( 'medialink-settings-group', 'medialink_album_effect_pc');
	register_setting( 'medialink-settings-group', 'medialink_album_effect_sp');
	register_setting( 'medialink-settings-group', 'medialink_slideshow_effect_pc');
	register_setting( 'medialink-settings-group', 'medialink_slideshow_effect_sp');
	register_setting( 'medialink-settings-group', 'medialink_album_suffix_pc');
	register_setting( 'medialink-settings-group', 'medialink_album_suffix_sp');
	register_setting( 'medialink-settings-group', 'medialink_movie_suffix_pc');
	register_setting( 'medialink-settings-group', 'medialink_movie_suffix_pc2');
	register_setting( 'medialink-settings-group', 'medialink_movie_suffix_sp');
	register_setting( 'medialink-settings-group', 'medialink_music_suffix_pc');
	register_setting( 'medialink-settings-group', 'medialink_music_suffix_pc2');
	register_setting( 'medialink-settings-group', 'medialink_music_suffix_sp');
	register_setting( 'medialink-settings-group', 'medialink_slideshow_suffix_pc');
	register_setting( 'medialink-settings-group', 'medialink_slideshow_suffix_sp');
	register_setting( 'medialink-settings-group', 'medialink_album_display_pc', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_album_display_sp', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_movie_display_pc', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_movie_display_sp', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_music_display_pc', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_music_display_sp', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_slideshow_display_pc', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_slideshow_display_sp', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_movie_suffix_thumbnail');
	register_setting( 'medialink-settings-group', 'medialink_music_suffix_thumbnail');
	register_setting( 'medialink-settings-group', 'medialink_include_cat');
	register_setting( 'medialink-settings-group', 'medialink_exclude_cat');
	register_setting( 'medialink-settings-group', 'medialink_album_rssname');
	register_setting( 'medialink-settings-group', 'medialink_movie_rssname');
	register_setting( 'medialink-settings-group', 'medialink_music_rssname');
	register_setting( 'medialink-settings-group', 'medialink_slideshow_rssname');
	register_setting( 'medialink-settings-group', 'medialink_album_rssmax', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_movie_rssmax', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_music_rssmax', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_slideshow_rssmax', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_movie_container');
	register_setting( 'medialink-settings-group', 'medialink_css_listthumbsize');
	register_setting( 'medialink-settings-group', 'medialink_css_pc_listwidth', 'medialink_pos_intval');
	register_setting( 'medialink-settings-group', 'medialink_css_pc_linkstrcolor');
	register_setting( 'medialink-settings-group', 'medialink_css_pc_linkbackcolor');
	register_setting( 'medialink-settings-group', 'medialink_css_sp_navstrcolor');
	register_setting( 'medialink-settings-group', 'medialink_css_sp_navbackcolor');
	register_setting( 'medialink-settings-group', 'medialink_css_sp_navpartitionlinecolor');
	register_setting( 'medialink-settings-group', 'medialink_css_sp_listbackcolor');
	register_setting( 'medialink-settings-group', 'medialink_css_sp_listarrowcolor');
	register_setting( 'medialink-settings-group', 'medialink_css_sp_listpartitionlinecolor');
	add_option('medialink_album_effect_pc', 'colorbox');
	add_option('medialink_album_effect_sp', 'photoswipe');
	add_option('medialink_slideshow_effect_pc', 'nivoslider');
	add_option('medialink_slideshow_effect_sp', 'nivoslider');
	add_option('medialink_album_suffix_pc', '.jpg');
	add_option('medialink_album_suffix_sp', '.jpg');
	add_option('medialink_movie_suffix_pc', '.mp4');
	add_option('medialink_movie_suffix_pc2', '.ogv');
	add_option('medialink_movie_suffix_sp', '.mp4');
	add_option('medialink_music_suffix_pc', '.mp3');
	add_option('medialink_music_suffix_pc2', '.ogg');
	add_option('medialink_music_suffix_sp', '.mp3');
	add_option('medialink_slideshow_suffix_pc', '.jpg');
	add_option('medialink_slideshow_suffix_sp', '.jpg');
	add_option('medialink_album_display_pc', 20); 	
	add_option('medialink_album_display_sp', 9); 	
	add_option('medialink_movie_display_pc', 8); 	
	add_option('medialink_movie_display_sp', 6); 	
	add_option('medialink_music_display_pc', 8); 	
	add_option('medialink_music_display_sp', 6); 	
	add_option('medialink_slideshow_display_pc', 10); 	
	add_option('medialink_slideshow_display_sp', 10); 	
	add_option('medialink_movie_suffix_thumbnail', '.gif');
	add_option('medialink_music_suffix_thumbnail', '.gif');
	add_option('medialink_include_cat', '');
	add_option('medialink_exclude_cat', '');
	add_option('medialink_album_rssname', 'medialink_album_feed');
	add_option('medialink_movie_rssname', 'medialink_movie_feed');
	add_option('medialink_music_rssname', 'medialink_music_feed');
	add_option('medialink_slideshow_rssname', 'medialink_slideshow_feed');
	add_option('medialink_album_rssmax', 10);
	add_option('medialink_movie_rssmax', 10);
	add_option('medialink_music_rssmax', 10);
	add_option('medialink_slideshow_rssmax', 10);
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

}

/* ==================================================
 * @param	bool	$v
 * @return	bool	$v
 * @since	1.1
 */
function medialink_bool_intval($v){
	return $v == 1 ? '1' : '0';
}

/* ==================================================
 * @param	int		$v
 * @return	int		$v
 * @since	1.1
 */
function medialink_pos_intval($v){
	return abs(intval($v));
}

/* ==================================================
 * Add a "Settings" link to the plugins page
 * @since	1.0
 */
function medialink_settings_link( $links, $file ) {
	static $this_plugin;
	if ( empty($this_plugin) ) {
		$this_plugin = plugin_basename(__FILE__);
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
function medialink_plugin_menu() {
	add_options_page( 'MediaLink Options', 'MediaLink', 'manage_options', 'MediaLink', 'medialink_plugin_options' );
}

/* ==================================================
 * Add FeedLink
 * @since	1.16
 */
function medialink_add_feedlink(){

	$wp_uploads = wp_upload_dir();
	$wp_uploads_path = str_replace('http://'.$_SERVER["SERVER_NAME"], '', $wp_uploads['baseurl']);
	$documentrootname = $_SERVER['DOCUMENT_ROOT'];
	$servername = 'http://'.$_SERVER['HTTP_HOST'];
	$xml_album = $wp_uploads_path.'/'.get_option('medialink_album_rssname').'.xml';
	$xml_movie = $wp_uploads_path.'/'.get_option('medialink_movie_rssname').'.xml';
	$xml_music = $wp_uploads_path.'/'.get_option('medialink_music_rssname').'.xml';
	$xml_slideshow = $wp_uploads_path.'/'.get_option('medialink_slideshow_rssname').'.xml';

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
	echo '<!-- End Medialink feed -->'."\n";

}

/* ==================================================
 * Settings CSS
 * @since	1.9
 */
function medialink_add_css(){

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

	$mode = medialink_agent_check();
	if ( $mode === 'pc' ) {
		echo $medialink_add_css_pc;
	} else if ( $mode === 'sp') {
		echo $medialink_add_css_sp;
	}

}

/* ==================================================
 * Settings page
 * @since	1.0
 */
function medialink_plugin_options() {

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
	<p>&#91;medialink&#93;</p>
	<p><?php _e('When you view this Page, it is displayed in album mode. This is the result of the search of the media library. The Settings> Media, determine the size of the thumbnail. The default value of MediaLink, width 80, height 80. Please set its value. In the Media> Add New, please drag and drop the image. You view the Page again. Should see the image to the Page.', 'medialink'); ?></p>
	<p><?php _e('In addition, you want to place add an attribute like this in the short code.', 'medialink'); ?></p>
	<p>&#91;medialink set='slideshow'&#93</p>
	<?php _e('When you view this Page, it is displayed in slideshow mode.', 'medialink'); ?></p>
	
	<p><div><strong><?php _e('Customization 1', 'medialink'); ?></strong></div>
	<?php _e('MediaLink is also handles video and music. If you are dealing with music and video, please add the following attributes to the short code.', 'medialink'); ?>
	<p><div><?php _e("Video set = 'movie'", 'medialink'); ?></div>
	<div><?php _e("Music set = 'music'", 'medialink'); ?></div>
	<p><div><?php _e('* (WordPress > Settings > General Timezone) Please specify your area other than UTC. For accurate time display of RSS feed.', 'medialink'); ?></div>
	<p><div><?php _e('* When you move to (WordPress > Appearance > Widgets), there is a widget MediaLinkRssFeed. If you place you can set this to display the sidebar link the RSS feed.', 'medialink'); ?></div></p>

	<table border="1"><div><strong><?php _e('Customization 2', 'medialink'); ?></strong></div>
	<div><strong><?php _e('Below, I shows the default values and various attributes of the short code.', 'medialink'); ?></strong></div>
	<tbody>
	<tr>
	<td align="center" valign="middle">
	<?php _e('Attribute', 'medialink'); ?>
	</td>
	<td colspan="4" align="center" valign="middle">
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
	<td align="left" valign="middle">
	<?php _e('Next only four. album(image), movie(video), music(music), slideshow(image)', 'medialink'); ?>
	</td>
	</tr>

	<tr>
	<td align="center" valign="middle"><b>effect_pc</b></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_album_effect_pc') ?></td>
	<td colspan="2" align="center" valign="middle" bgcolor="#dddddd"></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_effect_pc') ?></td>
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
	<td colspan="2" align="center" valign="middle" bgcolor="#dddddd"></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_effect_sp') ?></td>
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
	<td align="left" valign="middle">
	<?php _e('extension of PC', 'medialink'); ?>
	</td>
	</tr>

	<tr>
	<td align="center" valign="middle"><b>suffix_pc2</b></td>
	<td align="center" valign="middle" bgcolor="#dddddd"></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_pc2') ?></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_music_suffix_pc2') ?></td>
	<td align="center" valign="middle" bgcolor="#dddddd"></td>
	<td align="left" valign="middle">
	<?php _e('second extension on the PC. Second candidate when working with html5', 'medialink'); ?>
	</td>
	</tr>

	<tr>
	<td align="center" valign="middle"><b>suffix_sp</b></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_album_suffix_sp') ?></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_sp') ?></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_music_suffix_sp') ?></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_suffix_sp') ?></td>
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
	<td align="left" valign="middle">
	<?php _e('File Display per page(Smartphone)', 'medialink'); ?>
	</td>
	</tr>

	<tr>
	<td align="center" valign="middle"><b>thumbnail</b></td>
	<td align="center" valign="middle">-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_movie_suffix_thumbnail') ?></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_music_suffix_thumbnail') ?></td>
	<td align="center" valign="middle">-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?></td>
	<td align="left" valign="middle">
	<?php _e('(album) default thumbnail suffix name of WordPress. (movie, music) specify an extension for the thumbnail of the title the same name as the file you want to view, but if the thumbnail is not found, display the icon of WordPress standard, the thumbnail display if you do not specify anything.', 'medialink'); ?>
	</td>
	</tr>

	<tr>
	<td align="center" valign="middle"><b>include_cat</b></td>
	<td colspan="3" align="center" valign="middle" bgcolor="#dddddd"></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_include_cat') ?></td>
	<td align="left" valign="middle">
	<?php _e('Category you want to include. Only one.', 'medialink'); ?>
	</td>
	</tr>

	<tr>
	<td align="center" valign="middle"><b>exclude_cat</b></td>
	<td colspan="3" align="center" valign="middle"><?php echo get_option('medialink_exclude_cat') ?></td>
	<td align="center" valign="middle" bgcolor="#dddddd"></td>
	<td align="left" valign="middle">
	<?php _e('Category you want to exclude. More than one, specified separated by |.', 'medialink'); ?>
	</td>
	</tr>

	<tr>
	<td align="center" valign="middle"><b>rssname</b></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_album_rssname') ?></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_movie_rssname') ?></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_music_rssname') ?></td>
	<td align="center" valign="middle"><?php echo get_option('medialink_slideshow_rssname') ?></td>
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
	<td align="left" valign="middle">
	<?php _e('Syndication feeds show the most recent (Use to widget)', 'medialink'); ?>
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
				<td align="center" valign="middle" colspan=4><?php _e('Default'); ?></td>
				<td align="center" valign="middle"><?php _e('Description'); ?></td>
			</tr>
			<tr>
				<td align="center" valign="middle"><b>set</b></td>
				<td align="center" valign="middle">album</td>
				<td align="center" valign="middle">movie</td>
				<td align="center" valign="middle">music</td>
				<td align="center" valign="middle">slideshow</td>
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
				<td colspan="2">
				</td>
				<td align="center" valign="middle">
				<?php $target_slideshow_effect_pc = get_option('medialink_slideshow_effect_pc'); ?>
				<select id="medialink_slideshow_effect_pc" name="medialink_slideshow_effect_pc">
					<option <?php if ('nivoslider' == $target_slideshow_effect_pc)echo 'selected="selected"'; ?>>nivoslider</option>
				</select>
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
				</select>
				</td>
				<td colspan="2">
				</td>
				<td align="center" valign="middle">
				<?php $target_slideshow_effect_sp = get_option('medialink_slideshow_effect_sp'); ?>
				<select id="medialink_slideshow_effect_sp" name="medialink_slideshow_effect_sp">
					<option <?php if ('nivoslider' == $target_slideshow_effect_sp)echo 'selected="selected"'; ?>>nivoslider</option>
				</select>
				</td>
				<td align="left" valign="middle">
					<?php _e('Effects of Smartphone', 'medialink'); ?>
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle"><b>suffix_pc</b></td>
				<td align="center" valign="middle">
				<?php $target_album_suffix_pc = get_option('medialink_album_suffix_pc'); ?>
				<select id="medialink_album_suffix_pc" name="medialink_album_suffix_pc">
					<option <?php if ('.jpg' == $target_album_suffix_pc)echo 'selected="selected"'; ?>>.jpg</option>
					<option <?php if ('.png' == $target_album_suffix_pc)echo 'selected="selected"'; ?>>.png</option>
					<option <?php if ('.gif' == $target_album_suffix_pc)echo 'selected="selected"'; ?>>.gif</option>
					<option <?php if ('.bmp' == $target_album_suffix_pc)echo 'selected="selected"'; ?>>.bmp</option>
				</select>
				</td>
				<td align="center" valign="middle">
				<?php $target_movie_suffix_pc = get_option('medialink_movie_suffix_pc'); ?>
				<select id="medialink_movie_suffix_pc" name="medialink_movie_suffix_pc">
					<option <?php if ('.mp4' == $target_movie_suffix_pc)echo 'selected="selected"'; ?>>.mp4</option>
					<option <?php if ('.ogv' == $target_movie_suffix_pc)echo 'selected="selected"'; ?>>.ogv</option>
				</select>
				</td>
				<td align="center" valign="middle">
				<?php $target_music_suffix_pc = get_option('medialink_music_suffix_pc'); ?>
				<select id="medialink_music_suffix_pc" name="medialink_music_suffix_pc">
					<option <?php if ('.mp3' == $target_movie_suffix_pc)echo 'selected="selected"'; ?>>.mp3</option>
					<option <?php if ('.ogg' == $target_movie_suffix_pc)echo 'selected="selected"'; ?>>.ogg</option>
				</select>
				</td>
				<td align="center" valign="middle">
				<?php $target_slideshow_suffix_pc = get_option('medialink_slideshow_suffix_pc'); ?>
				<select id="medialink_slideshow_suffix_pc" name="medialink_slideshow_suffix_pc">
					<option <?php if ('.jpg' == $target_slideshow_suffix_pc)echo 'selected="selected"'; ?>>.jpg</option>
					<option <?php if ('.png' == $target_slideshow_suffix_pc)echo 'selected="selected"'; ?>>.png</option>
					<option <?php if ('.gif' == $target_slideshow_suffix_pc)echo 'selected="selected"'; ?>>.gif</option>
					<option <?php if ('.bmp' == $target_slideshow_suffix_pc)echo 'selected="selected"'; ?>>.bmp</option>
				</select>
				</td>
				<td align="left" valign="middle">
					<?php _e('extension of PC', 'medialink'); ?>
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle"><b>suffix_pc2</b></td>
				<td>
				</td>
				<td align="center" valign="middle">
				<?php $target_movie_suffix_pc2 = get_option('medialink_movie_suffix_pc2'); ?>
				<select id="medialink_movie_suffix_pc2" name="medialink_movie_suffix_pc2">
					<option <?php if ('.ogv' == $target_movie_suffix_pc2)echo 'selected="selected"'; ?>>.ogv</option>
					<option <?php if ('.mp4' == $target_movie_suffix_pc2)echo 'selected="selected"'; ?>>.mp4</option>
				</select>
				</td>
				<td align="center" valign="middle">
				<?php $target_music_suffix_pc2 = get_option('medialink_music_suffix_pc2'); ?>
				<select id="medialink_music_suffix_pc2" name="medialink_music_suffix_pc2">
					<option <?php if ('.ogg' == $target_movie_suffix_pc2)echo 'selected="selected"'; ?>>.ogg</option>
					<option <?php if ('.mp3' == $target_movie_suffix_pc2)echo 'selected="selected"'; ?>>.mp3</option>
				</select>
				</td>
				<td>
				</td>
				<td align="left" valign="middle">
					<?php _e('second extension on the PC. Second candidate when working with html5', 'medialink'); ?>
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle"><b>suffix_sp</b></td>
				<td align="center" valign="middle">
				<?php $target_album_suffix_sp = get_option('medialink_album_suffix_sp'); ?>
				<select id="medialink_album_suffix_sp" name="medialink_album_suffix_sp">
					<option <?php if ('.jpg' == $target_album_suffix_sp)echo 'selected="selected"'; ?>>.jpg</option>
					<option <?php if ('.png' == $target_album_suffix_sp)echo 'selected="selected"'; ?>>.png</option>
					<option <?php if ('.gif' == $target_album_suffix_sp)echo 'selected="selected"'; ?>>.gif</option>
					<option <?php if ('.bmp' == $target_album_suffix_sp)echo 'selected="selected"'; ?>>.bmp</option>
				</select>
				</td>
				<td align="center" valign="middle">
				<?php $target_movie_suffix_sp = get_option('medialink_movie_suffix_sp'); ?>
				<select id="medialink_movie_suffix_sp" name="medialink_movie_suffix_sp">
					<option <?php if ('.mp4' == $target_movie_suffix_sp)echo 'selected="selected"'; ?>>.mp4</option>
					<option <?php if ('.ogv' == $target_movie_suffix_sp)echo 'selected="selected"'; ?>>.ogv</option>
				</select>
				</td>
				<td align="center" valign="middle">
				<?php $target_music_suffix_sp = get_option('medialink_music_suffix_sp'); ?>
				<select id="medialink_music_suffix_sp" name="medialink_music_suffix_sp">
					<option <?php if ('.mp3' == $target_movie_suffix_sp)echo 'selected="selected"'; ?>>.mp3</option>
					<option <?php if ('.ogg' == $target_movie_suffix_sp)echo 'selected="selected"'; ?>>.ogg</option>
				</select>
				</td>
				<td align="center" valign="middle">
				<?php $target_slideshow_suffix_sp = get_option('medialink_slideshow_suffix_sp'); ?>
				<select id="medialink_slideshow_suffix_sp" name="medialink_slideshow_suffix_sp">
					<option <?php if ('.jpg' == $target_slideshow_suffix_sp)echo 'selected="selected"'; ?>>.jpg</option>
					<option <?php if ('.png' == $target_slideshow_suffix_sp)echo 'selected="selected"'; ?>>.png</option>
					<option <?php if ('.gif' == $target_slideshow_suffix_sp)echo 'selected="selected"'; ?>>.gif</option>
					<option <?php if ('.bmp' == $target_slideshow_suffix_sp)echo 'selected="selected"'; ?>>.bmp</option>
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
				<td align="left" valign="middle">
					<?php _e('File Display per page(Smartphone)', 'medialink') ?>
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
					<option <?php if ('.gif' == $target_movie_suffix_thumbnail)echo 'selected="selected"'; ?>>.gif</option>
					<option <?php if ('.jpg' == $target_movie_suffix_thumbnail)echo 'selected="selected"'; ?>>.jpg</option>
					<option <?php if ('.png' == $target_movie_suffix_thumbnail)echo 'selected="selected"'; ?>>.png</option>
					<option <?php if ('.bmp' == $target_movie_suffix_thumbnail)echo 'selected="selected"'; ?>>.bmp</option>
				</select>
				</td>
				<td align="center" valign="middle">
				<?php $target_music_suffix_thumbnail = get_option('medialink_music_suffix_thumbnail'); ?>
				<select id="medialink_music_suffix_thumbnail" name="medialink_music_suffix_thumbnail">
					<option <?php if ('' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>></option>
					<option <?php if ('.gif' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>>.gif</option>
					<option <?php if ('.jpg' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>>.jpg</option>
					<option <?php if ('.png' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>>.png</option>
					<option <?php if ('.bmp' == $target_music_suffix_thumbnail)echo 'selected="selected"'; ?>>.bmp</option>
				</select>
				</td>
				<td align="center" valign="middle">
					-<?php echo get_option('thumbnail_size_w') ?>x<?php echo get_option('thumbnail_size_h') ?>
				</td>
				<td align="left" valign="middle">
					<?php _e('(album) default thumbnail suffix name of WordPress. (movie, music) specify an extension for the thumbnail of the title the same name as the file you want to view, but if the thumbnail is not found, display the icon of WordPress standard, the thumbnail display if you do not specify anything.', 'medialink'); ?>
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle"><b>include_cat</b></td>
				<td align="center" valign="middle" colspan="3"></td>
				<td align="center" valign="middle">
					<input type="text" id="medialink_include_cat" name="medialink_include_cat" value="<?php echo get_option('medialink_include_cat') ?>" size="20" />
				</td>
				<td align="left" valign="middle">
					<?php _e('Category you want to include. Only one.', 'medialink'); ?>
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle"><b>exclude_cat</b></td>
				<td align="center" valign="middle" colspan="3">
					<input type="text" id="medialink_exclude_cat" name="medialink_exclude_cat" value="<?php echo get_option('medialink_exclude_cat') ?>" size="40" />
				</td>
				<td>
				</td>
				<td align="left" valign="middle">
					<?php _e('Category you want to exclude. More than one, specified separated by |.', 'medialink'); ?>
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
				<td align="left" valign="middle">
					<?php _e('Syndication feeds show the most recent (Use to widget)', 'medialink') ?>
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
<textarea rows="5" cols="30">AddType video/mp4 .mp4
AddType video/ogg .ogv
AddType audio/mpeg .mp3
AddType audio/ogg .ogg
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
	<?
}


/* ==================================================
 * @param	string	$catparam
 * @param	string	$file
 * @param	string	$title
 * @param	string	$topurl
 * @param	string	$suffix
 * @param	string	$thumblink
 * @param	string	$document_root
 * @param	string	$mode
 * @return	string	$effect
 * @since	1.0
 */
function medialink_print_file($catparam,$file,$title,$topurl,$suffix,$thumblink,$document_root,$mode,$effect) {

	$catparam = mb_convert_encoding($catparam, "UTF-8", "auto");
	$filename = mb_convert_encoding($file, "UTF-8", "auto");
	$filename = str_replace($suffix, "", $filename);
	$titlename = $title;

	$fileparam = substr($file,1);
	$filetitle = $titlename;
	$fileparam = str_replace("%2F","/",urlencode($fileparam));
	$file = str_replace("%2F","/",urlencode($file));

	$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	if ( preg_match( "/jpg|png|gif|bmp/i", $suffix) ){
		$thumbfile = str_replace("%2F","/",urlencode($filename)).$thumblink.$suffix;
	}else{
		$thumbfile = $thumblink;
	}

	$mimetype = 'type="'.medialink_mime_type($suffix).'"'; // MimeType

	$linkfile = NULL;
	if ( preg_match( "/jpg|png|gif|bmp/i", $suffix) ) {
		if ($effect === 'nivoslider'){ // for nivoslider
			$linkfile = '<img src="'.$topurl.$file.'" alt="'.$titlename.'" title="'.$titlename.'">';
		} else if ($effect === 'colorbox' && $mode === 'pc'){ // for colorbox
			$linkfile = '<a class=medialink href="'.$topurl.$file.'" title="'.$titlename.'"><img src="'.$topurl.$thumbfile.'" alt="'.$titlename.'" title="'.$titlename.'"></a>';
		} else if ($effect === 'photoswipe' && $mode === 'sp'){ // for Photoswipe
			$linkfile = '<li><a rel="external" href="'.$topurl.$file.'" title="'.$titlename.'"><img src="'.$topurl.$thumbfile.'" alt="'.$titlename.'" title="'.$titlename.'"></a></li>';
		} else if ($effect === 'Lightbox' && $mode === 'pc'){ // for Lightbox
			$linkfile = '<a href="'.$topurl.$file.'" rel="lightbox[medialink]" title="'.$titlename.'"><img src="'.$topurl.$thumbfile.'" alt="'.$titlename.'" title="'.$titlename.'"></a>';
		} else {
			$linkfile = '<li><a href="'.$topurl.$file.'" title="'.$titlename.'"><img src="'.$topurl.$thumbfile.'" alt="'.$titlename.'" title="'.$titlename.'"></a></li>';
		}
	}else{
		if ( $mode === 'sp' ) {
			$linkfile = '<li>'.$thumbfile.'<a href="'.$topurl.$file.'" '.$mimetype.'>'.$titlename.'</a></li>';
		}else{ //PC
			$page =NULL;
			if (!empty($_GET['mlp'])){
				$page = $_GET['mlp'];				//pages
			}

			$permlinkstr = NULL;
			$permalinkstruct = NULL;
			$permalinkstruct = get_option('permalink_structure');
			if( empty($permalinkstruct) ){
				$perm_id = get_the_ID();
				$permlinkstr = '?page_id='.$perm_id.'&mlcat=';
			} else {
				$permlinkstr = '?mlcat=';
			}

			$linkfile = '<li>'.$thumbfile.'<a href="'.$scriptname.$permlinkstr.$catparam.'&mlp='.$page.'&f='.$fileparam.'">'.$filetitle.'</a></li>';
		}
	}

	return $linkfile;

}

/* ==================================================
 * @param	int		$page
 * @param	int		$maxpage
 * @param	string	$mode
 * @return	string	$linkpages
 * @since	1.0
 */
function medialink_print_pages($page,$maxpage,$mode) {

	$pagetagleft = NULL;
	$pagetagright = NULL;
	$pageleftalow = NULL;
	$pagerightalow = NULL;
	$pagetag_a_leftalow = NULL;
	$pagetag_a_rightalow = NULL;
	$page_no_tag_left = NULL;
	$page_no_tag_right = NULL;

	$displayprev = __('prev', 'medialink');
	$displaynext = __('next', 'medialink');

	$displayprev = mb_convert_encoding($displayprev, "UTF-8", "auto");
	$displaynext = mb_convert_encoding($displaynext, "UTF-8", "auto");

	$linkpages = "";

	$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

	$query = $_SERVER['QUERY_STRING'];
	$query = str_replace('&mlp='.$page, '', $query);
	$query = str_replace('mlp='.$page, '', $query);
	$query = preg_replace('/&f=.*/', '', $query);

	if ( $mode === 'pc' ) { //PC
		$pageleftalow = '&lt;&lt;';
		$pagerightalow = '&gt;&gt;';
	} else if ( $mode === 'sp' ) { //SP
		$pagetagleft = '<li>';
		$pagetagright = '</li>';
		$page_no_tag_left = '<a>';
		$page_no_tag_right = '</a>';
	}

	if( $maxpage > 1 ){
		if( $page == 1 ){
			$linkpages = $pagetagleft.$pagetagright.$pagetagleft.$page_no_tag_left.$page.'/'.$maxpage.$page_no_tag_right.$pagetagright.$pagetagleft.'<a href="'.$scriptname.'?'.$query.'&mlp='.($page+1).'">'.$displaynext.$pagerightalow.'</a>'.$pagetagright;
		}else if( $page == $maxpage ){
			$linkpages = $pagetagleft.'<a href="'.$scriptname.'?'.$query.'&mlp='.($page-1).'">'.$pageleftalow.$displayprev.'</a>'.$pagetagright.$pagetagleft.$page_no_tag_left.$page.'/'.$maxpage.$page_no_tag_right.$pagetagright.$pagetagleft.$pagetagright;
		}else{
			$linkpages = $pagetagleft.'<a href="'.$scriptname.'?'.$query.'&mlp='.($page-1).'">'.$pageleftalow.$displayprev.'</a>'.$pagetagright.$pagetagleft.$page_no_tag_left.$page.'/'.$maxpage.$page_no_tag_right.$pagetagright.$pagetagleft.'<a href="'.$scriptname.'?'.$query.'&mlp='.($page+1).'">'.$displaynext.$pagerightalow.'</a>'.$pagetagright;
		}
	}

	return $linkpages;

}

/* ==================================================
 * @param	string	$file
 * @param	string	$title
 * @param	string	$thumblink
 * @param	string	$suffix
 * @param	string	$document_root
 * @param	string	$topurl
 * @return	string	$xmlitem
 * @since	1.0
 */
function medialink_xmlitem_read($file, $title, $thumblink, $suffix, $document_root, $topurl) {

	$filesize = filesize($document_root.$file);
	$filestat = stat($document_root.$file);
	date_default_timezone_set(timezone_name_from_abbr(get_the_date(T)));
	$stamptime = date(DATE_RSS,  $filestat['mtime']);

	$fparam = mb_convert_encoding(str_replace($document_root.'/', "", $file), "UTF8", "auto");
	$fparam = str_replace("%2F","/",urlencode($fparam));
	$fparam = substr($fparam,1);

	$file = str_replace($suffix, "", str_replace($document_root, "", $file));
	$titlename = $title;
	$file = str_replace("%2F","/",urlencode(mb_convert_encoding($file, "UTF8", "auto")));

	$servername = $_SERVER['HTTP_HOST'];
	$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

	$permalinkstruct = NULL;
	$permalinkstruct = get_option('permalink_structure');
	if( empty($permalinkstruct) ){
		$perm_id = get_the_ID();
		$scriptname .= '?page_id='.$perm_id.'&#38;f=';
	} else {
		$scriptname .= '?f=';
	}

	if ( preg_match( "/jpg|png|gif|bmp/i", $suffix) ){
		$link_url = 'http://'.$servername.$topurl.$file.$suffix;
		$img_url = '<a href="'.$link_url.'"><img src = "http://'.$servername.$topurl.$file.$thumblink.$suffix.'"></a>';
	}else{
		$link_url = 'http://'.$servername.$scriptname.$fparam;
		$enc_url = 'http://'.$servername.$topurl.$file.$suffix;
		if( !empty($thumblink) ) {
			$img_url = '<a href="'.$link_url.'">'.$thumblink.'</a>';
		}
	}

	$xmlitem = NULL;
	$xmlitem .= "<item>\n";
	$xmlitem .= "<title>".$titlename."</title>\n";
	$xmlitem .= "<link>".$link_url."</link>\n";
	if ( !preg_match( "/jpg|png|gif|bmp/i", $suffix) ){
		$xmlitem .= '<enclosure url="'.$enc_url.'" length="'.$filesize.'" type="'.medialink_mime_type($suffix).'" />'."\n";
	}
	if( !empty($thumblink) ) {
		$xmlitem .= "<description><![CDATA[".$img_url."]]></description>\n";
	}
	$xmlitem .= "<pubDate>".$stamptime."</pubDate>\n";
	$xmlitem .= "</item>\n";
	return $xmlitem;

}

/* ==================================================
 * @param	string	$suffix
 * @return	string	$mimetype
 * @since	1.0
 */
function medialink_mime_type($suffix){

	switch ($suffix){
		case '.jpg':
			$mimetype = 'image/jpeg';
			break;
		case '.png':
			$mimetype = 'image/png';
			break;
		case '.gif':
			$mimetype = 'image/gif';
			break;
		case '.bmp':
			$mimetype = 'image/bmp';
			break;
		case '.flv':
			$mimetype = 'video/x-flv';
			break;
		case '.mp4':
			$mimetype = 'video/mp4';
			break;
		case '.ogv':
			$mimetype = 'video/ogg';
			break;
		case '.ogg':
			$mimetype = 'audio/ogg';
			break;
		case '.mp3':
			$mimetype = 'audio/mpeg';
			break;
	}

	return $mimetype;

}

/* ==================================================
 * @param	none
 * @return	string	$mode
 * @since	1.0
 */
function medialink_agent_check(){

	include_once dirname(__FILE__).'/Mobile-Detect-2.6.2/Mobile_Detect.php';
	$detect = new MediaLink_Mobile_Detect();

	if ( function_exists('wp_is_mobile') && wp_is_mobile() ) { //smartphone or tablet
		// Check for any mobile device, excluding tablets.
		if ($detect->isMobile() && !$detect->isTablet()){
			$mode = 'sp';
		} else {
			$mode = 'pc';
		}
	} else {
		$mode = 'pc';
	}

	return $mode;

}

/* ==================================================
 * Main
 */
function medialink_func( $atts ) {

	extract(shortcode_atts(array(
        'set' => 'album',
        'effect_pc' => '',
        'effect_sp' => '',
        'include_cat' => '',
        'suffix_pc' => '',
        'suffix_pc2' => '',
        'suffix_sp' => '',
        'display_pc' => '',
        'display_sp' => '',
        'thumbnail'  => '',
        'exclude_cat' => '',
        'rssname' => '',
        'rssmax'  => ''
	), $atts));

	$wp_uploads = wp_upload_dir();
	$wp_uploads_path = str_replace('http://'.$_SERVER["SERVER_NAME"], '', $wp_uploads['baseurl']);
	$topurl = $wp_uploads_path;

	$wp_path = str_replace('http://'.$_SERVER["SERVER_NAME"], '', get_bloginfo('wpurl')).'/';
	$document_root = str_replace($wp_path, '', ABSPATH).$topurl;

	if ( empty($include_cat) && ($set === 'slideshow') ) {
		$include_cat = get_option('medialink_include_cat');
	}
	if ( empty($exclude_cat) && ($set === 'album' || $set === 'movie' || $set === 'music') ) {
		$exclude_cat = get_option('medialink_exclude_cat');
	}

	$rssdef = false;
	if ( $set === 'album' ){
		if( empty($effect_pc) ) { $effect_pc = get_option('medialink_album_effect_pc'); }
		if( empty($effect_sp) ) { $effect_sp = get_option('medialink_album_effect_sp'); }
		if( empty($suffix_pc) ) { $suffix_pc = get_option('medialink_album_suffix_pc'); }
		if( empty($suffix_sp) ) { $suffix_sp = get_option('medialink_album_suffix_sp'); }
		if( empty($display_pc) ) { $display_pc = intval(get_option('medialink_album_display_pc')); }
		if( empty($display_sp) ) { $display_sp = intval(get_option('medialink_album_display_sp')); }
		if( empty($rssname) ) {
			$rssname = get_option('medialink_album_rssname');
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval(get_option('medialink_album_rssmax')); }
	} else if ( $set === 'movie' ){
		if( empty($suffix_pc) ) { $suffix_pc = get_option('medialink_movie_suffix_pc'); }
		if( empty($suffix_pc2) ) { $suffix_pc2 = get_option('medialink_movie_suffix_pc2'); }
		if( empty($suffix_sp) ) { $suffix_sp = get_option('medialink_movie_suffix_sp'); }
		if( empty($display_pc) ) { $display_pc = intval(get_option('medialink_movie_display_pc')); }
		if( empty($display_sp) ) { $display_sp = intval(get_option('medialink_movie_display_sp')); }
		if( empty($thumbnail) ) { $thumbnail = get_option('medialink_movie_suffix_thumbnail'); }
		if( empty($rssname) ) {
			$rssname = get_option('medialink_movie_rssname');
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval(get_option('medialink_movie_rssmax')); }
	} else if ( $set === 'music' ){
		if( empty($suffix_pc) ) { $suffix_pc = get_option('medialink_music_suffix_pc'); }
		if( empty($suffix_pc2) ) { $suffix_pc2 = get_option('medialink_music_suffix_pc2'); }
		if( empty($suffix_sp) ) { $suffix_sp = get_option('medialink_music_suffix_sp'); }
		if( empty($display_pc) ) { $display_pc = intval(get_option('medialink_music_display_pc')); }
		if( empty($display_sp) ) { $display_sp = intval(get_option('medialink_music_display_sp')); }
		if( empty($thumbnail) ) { $thumbnail = get_option('medialink_music_suffix_thumbnail'); }
		if( empty($rssname) ) {
			$rssname = get_option('medialink_music_rssname');
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval(get_option('medialink_music_rssmax')); }
	} else if ( $set === 'slideshow' ){
		if( empty($effect_pc) ) { $effect_pc = get_option('medialink_slideshow_effect_pc'); }
		if( empty($effect_sp) ) { $effect_sp = get_option('medialink_slideshow_effect_sp'); }
		if( empty($suffix_pc) ) { $suffix_pc = get_option('medialink_slideshow_suffix_pc'); }
		if( empty($suffix_sp) ) { $suffix_sp = get_option('medialink_slideshow_suffix_sp'); }
		if( empty($display_pc) ) { $display_pc = intval(get_option('medialink_slideshow_display_pc')); }
		if( empty($display_sp) ) { $display_sp = intval(get_option('medialink_slideshow_display_sp')); }
		if( empty($rssname) ) {
			$rssname = get_option('medialink_slideshow_rssname');
			$rssdef = true;
		}
		if( empty($rssmax) ) { $rssmax = intval(get_option('medialink_slideshow_rssmax')); }
	}

	$mode = NULL;
	$suffix = NULL;
	$display = NULL;

	$mode = medialink_agent_check();
	if ( $mode === 'pc' ) {
		$effect = $effect_pc;
		$suffix = $suffix_pc;
		$display = $display_pc;
	} else {
		$effect = $effect_sp;
		$suffix = $suffix_sp;
		$display = $display_sp;
	}

	$catparam = NULL;
	$fparam = NULL;
	$page = NULL;
	$search = NULL;
	$sort =  NULL;

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

	$file = NULL;
	$attachment = NULL;
	$title = NULL;
	$caption = NULL;
	$linkfiles = NULL;
	$sort_key = NULL;
	$sort_order = NULL;
	if ( $sort === "n" || empty($sort) ) {
		// new
		$sort_key = 'date';
		$sort_order = 'DESC';
	} else if ($sort === 'o') {
		// old
		$sort_key = 'date';
		$sort_order = 'ASC';
	} else if ($sort === 'd') {
		// des
		$sort_key = 'title';
		$sort_order = 'DESC';
	} else if ($sort === 'a') {
		// asc
		$sort_key = 'title';
		$sort_order = 'ASC';
	}

	$args = array(
		'post_type' => 'attachment',
		'post_mime_type' => medialink_mime_type($suffix),
		'numberposts' => -1,
		'orderby' => $sort_key,
		'order' => $sort_order,
		's' => $search,
		'post_status' => null,
		'post_parent' => $post->ID
		); 

	$attachments = get_posts($args);

	$rsscount = 0;
	$filecount = 0;
	$categorycount = 0;
	$files = array();
	$categories = array();
	$thumblinks = array();
	$titles = array();
	$rssfiles = array();
	$rsstitles = array();
	$rssthumblinks = array();
	$titlename = NULL;
	if ($attachments) {
		foreach ( $attachments as $attachment ) {
			$title = $attachment->post_title;
			$caption = $attachment->post_excerpt;
			if( empty($exclude_cat) ) { 
				$loops = TRUE;
			} else {
				if ( preg_match("/".$exclude_cat."/", $caption) ) {
					$loops = FALSE;
				} else {
					$loops = TRUE;
				}
			}
			if( $loops === TRUE ) {
				if ( !empty($caption) ) {
					$categories[$categorycount] = $caption;
					++$categorycount;
				}
				$thumblink = NULL;
				if ( preg_match( "/jpg|png|gif|bmp/i", $suffix) ){
					$thumb_src = wp_get_attachment_image_src($attachment->ID);
					$thumblink = '-'.$thumb_src[1].'x'.$thumb_src[2];
				} else {
					if( !empty($thumbnail) ) {
						if ( preg_match( "/jpg|png|gif|bmp/i", $thumbnail) ) {
							if( file_exists(str_replace($suffix, "", str_replace($wp_path, '', ABSPATH).$wp_uploads_path.str_replace($wp_uploads['baseurl'], '', $attachment->guid) ).$thumbnail) ){
								$thumblink = '<img src = "'.str_replace($suffix, "", $attachment->guid).'.gif'.'">';
							} else {
								$thumblink = wp_get_attachment_image( $attachment->ID, 'thumbnail', TRUE );
							}
						}
					}
				}
				$attachment = str_replace($wp_path, '', ABSPATH).$wp_uploads_path.str_replace($wp_uploads['baseurl'], '', $attachment->guid);
				$attachment = str_replace($document_root, "", $attachment);
				if ( $sort_order === 'DESC' && empty($search) ) {
					if ( $set <> 'slideshow' ) {
						$rssfiles[$rsscount] = $attachment;
						$rsstitles[$rsscount] = $title;
						$rssthumblinks [$rsscount] = $thumblink;
						++$rsscount;
					} else if ( ($set === 'slideshow') && (($caption === $include_cat) || empty($include_cat)) ) {
						$rssfiles[$rsscount] = $attachment;
						$rsstitles[$rsscount] = $title;
						$rssthumblinks [$rsscount] = $thumblink;
						++$rsscount;
					}
				}
				if ( ($caption === $catparam || empty($catparam)) ) {
					if ($set <> 'slideshow') {
						$files[$filecount] = $attachment;
						$titles[$filecount] = $title;
						$thumblinks [$filecount] = $thumblink;
						++$filecount;
					} else if ( ($set === 'slideshow') && (($caption === $include_cat) || empty($include_cat)) ) {
						$files[$filecount] = $attachment;
						$titles[$filecount] = $title;
						$thumblinks [$filecount] = $thumblink;
						++$filecount;
					}
				}
			}
		}
	}

	$maxpage = ceil(count($files) / $display);
	$beginfiles = 0;
	$endfiles = 0;
	if(empty($page)){
		$page = 1;
	}
	if( $page == $maxpage){
		$beginfiles = $display * ( $page - 1 );
		$endfiles = count($files) - 1;
	}else{
		$beginfiles = $display * ( $page - 1 );
		$endfiles = ( $display * $page ) - 1;
	}

	if ($files) {
		for ( $i = $beginfiles; $i <= $endfiles; $i++ ) {
			$linkfile = medialink_print_file($catparam,$files[$i],$titles[$i],$topurl,$suffix,$thumblinks[$i],$document_root,$mode,$effect);
			$linkfiles = $linkfiles.$linkfile;
			if ( $files[$i] === '/'.$fparam ) {
				$titlename = $titles[$i];
			}
		}
	}

	if ( $set <> 'slideshow' ) {
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

		$linkpages = medialink_print_pages($page,$maxpage,$mode);
	}

	$servername = $_SERVER['HTTP_HOST'];
	$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	$query = $_SERVER['QUERY_STRING'];

	$currentcategory = mb_convert_encoding($catparam, "UTF-8", "auto");
	$selectedfilename = $titlename;

	if(empty($page)){
		$page = 1;
	}
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

	$catparam = mb_convert_encoding($catparam, "UTF-8", "auto");
	$currentcategory_encode = urlencode($catparam);
	if ( empty($currentcategory) ){
		$scripturl .= $pagestr;
	}else{
		$scripturl .= "&mlcat=".$currentcategory_encode.$pagestr;
	}

	// MimeType
	$mimetype = 'type="'.medialink_mime_type($suffix).'"';

	$fparam = mb_convert_encoding($fparam, "UTF-8", "auto");

	$prevfile = "";
	if (!empty($fparam)) {
		if (empty($catparam)) {
			$prevfile = $topurl.'/'.str_replace("%2F","/",urlencode($fparam));
		}else{
			$prevfile = $topurl.'/'.str_replace("%2F","/",$currentfolder_encode).'/'.str_replace("%2F","/",urlencode($fparam));
		}
	}
	$prevfile_nosuffix = str_replace($suffix, "", $prevfile);

	if ( $set <> 'slideshow' ) {
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
		if ( $sort === "n" || empty($sort) ) {
			// new
			$sortlink_n = $page_no_tag_left.$sortnamenew.$page_no_tag_right;
			$sortlink_o = '<a href="'.$scripturl.'&sort=o">'.$sortnameold.'</a>';
			$sortlink_d = '<a href="'.$scripturl.'&sort=d">'.$sortnamedes.'</a>';
			$sortlink_a = '<a href="'.$scripturl.'&sort=a">'.$sortnameasc.'</a>';
		} else if ($sort === 'o') {
			// old
			$sortlink_n = '<a href="'.$scripturl.'&sort=n">'.$sortnamenew.'</a>';
			$sortlink_o = $page_no_tag_left.$sortnameold.$page_no_tag_right;
			$sortlink_d = '<a href="'.$scripturl.'&sort=d">'.$sortnamedes.'</a>';
			$sortlink_a = '<a href="'.$scripturl.'&sort=a">'.$sortnameasc.'</a>';
		} else if ($sort === 'd') {
			// des
			$sortlink_n = '<a href="'.$scripturl.'&sort=n">'.$sortnamenew.'</a>';
			$sortlink_o = '<a href="'.$scripturl.'&sort=o">'.$sortnameold.'</a>';
			$sortlink_d = $page_no_tag_left.$sortnamedes.$page_no_tag_right;
			$sortlink_a = '<a href="'.$scripturl.'&sort=a">'.$sortnameasc.'</a>';
		} else if ($sort === 'a') {
			// asc
			$sortlink_n = '<a href="'.$scripturl.'&sort=n">'.$sortnamenew.'</a>';
			$sortlink_o = '<a href="'.$scripturl.'&sort=o">'.$sortnameold.'</a>';
			$sortlink_d = '<a href="'.$scripturl.'&sort=d">'.$sortnamedes.'</a>';
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

	}

$pluginurl = plugins_url($path='',$scheme=null);

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
      "url":"{$prevfile}",
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
      "url":"{$prevfile}",
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
mp3: '{$prevfile}',
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
			echo '<h2>'.$selectedfilename.'</h2>';
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
			echo $movieplayercontainerIE9;
		} else {
			echo $movieplayercontainer;
		}
	} else if ( $mode === 'pc' && $set === 'music' ) {
		echo $flashmusicplayer;
		echo $musicplayercontainer;
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
	if ( preg_match( "/jpg|png|gif|bmp/i", $suffix) ){
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
		if ( $mode === 'pc' && $set <> 'slideshow') {
			$categoryselectbox_begin = '<div align="right">';
			$categoryselectbox_end = '</div>';
			$linkpages_begin = '<div align="center">';
			$linkpages_end = '</div>';
			$sortlink_begin = '<div align="right">';
			$sortlink_end = '</div>';
			$searchform_begin = '<div align="center">';
			$searchform_end = '</div>';
		} else if ( $mode === 'sp' && $set <> 'slideshow') {
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

	echo $linkfiles_begin;
	echo $linkfiles;
	echo $linkfiles_end;

	echo $categoryselectbox_begin;
	echo $categoryselectbox;
	echo $categoryselectbox_end;

	echo $linkpages_begin;
	echo $linkpages;
	echo $linkpages_end;

	echo $sortlink_begin;
	echo $sortlinks;
	echo $sortlink_end;

	echo $searchform_begin;
	echo $searchform;
	echo $searchform_end;

	// RSS Feeds
	$xml_title =  get_bloginfo('name').' | '.get_the_title();
	if ( $set <> 'slideshow' ) {

		$rssfeed_url = $topurl.'/'.$rssname.'.xml';
		if ( $set === "album" ) {
			$rssfeeds_icon = '<div align="right"><a href="'.$rssfeed_url.'"><img src="'.$pluginurl.'/medialink/icon/rssfeeds.png"></a></div>';
		} else {
			$rssfeeds_icon = '<div align="right"><a href="'.$rssfeed_url.'"><img src="'.$pluginurl.'/medialink/icon/podcast.png"></a></div>';
		}
		if ( $mode === "pc" || $mode === "sp" ) {
			echo $rssfeeds_icon;
			if ( $rssdef === false ) {
				echo '<link rel="alternate" type="application/rss+xml" href="'.$rssfeed_url.'" title="'.$xml_title.'" />';
			}
		}
	}

	echo '<div align = "right"><a href="http://wordpress.org/plugins/medialink/"><span style="font-size : xx-small">by MediaLink</span></a></div>';

	$xml_begin = NULL;
	$xml_end = NULL;
//RSS Feed
$xml_begin = <<<XMLBEGIN
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
<channel>
<title>{$xml_title}</title>

XMLBEGIN;

$xml_end = <<<XMLEND
</channel>
</rss>
XMLEND;

	$xmlfile = $document_root.'/'.$rssname.'.xml';
	if(!empty($rssfiles)){
		if(count($rssfiles) < $rssmax){$rssmax = count($rssfiles);}
		if ( file_exists($xmlfile)){
			if ( empty($catparam) && ($mode === "pc" || $mode === "sp") ) {
				$pubdate = NULL;
				$xml = simplexml_load_file($xmlfile);
				$exist_rssfile_count = 0;
				foreach($xml->channel->item as $entry){
					$pubdate[] = $entry->pubDate;
					++$exist_rssfile_count;
 				}
 				$exist_rss_pubdate = $pubdate[0];
				if(preg_match("/\<pubDate\>(.+)\<\/pubDate\>/ms", medialink_xmlitem_read($rssfiles[0], $rsstitles[0], $rssthumblinks[0], $suffix, $document_root, $topurl), $reg)){
					$new_rss_pubdate = $reg[1];
				}
				if ($exist_rss_pubdate <> $new_rss_pubdate || $exist_rssfile_count != $rssmax){
					$xmlitem = NULL;
					for ( $i = 0; $i <= $rssmax-1; $i++ ) {
						$xmlitem .= medialink_xmlitem_read($rssfiles[$i], $rsstitles[$i], $rssthumblinks[$i], $suffix, $document_root, $topurl);
					}
					$xmlitem = $xml_begin.$xmlitem.$xml_end;
					$fno = fopen($xmlfile, 'w');
						fwrite($fno, $xmlitem);
					fclose($fno);
				}
			}
		}else{
			for ( $i = 0; $i <= $rssmax-1; $i++ ) {
				$xmlitem .= medialink_xmlitem_read($rssfiles[$i], $rsstitles[$i], $rssthumblinks[$i], $suffix, $document_root, $topurl);
			}
			$xmlitem = $xml_begin.$xmlitem.$xml_end;
			$fno = fopen($xmlfile, 'w');
				fwrite($fno, $xmlitem);
			fclose($fno);
			chmod($xmlfile, 0646);
		}
	}


}

?>