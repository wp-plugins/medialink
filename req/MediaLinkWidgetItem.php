<?php
/**
 * MediaLink
 * 
 * @package    MediaLink
 * @subpackage MediaLink Widget
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
		$checkbox7 = apply_filters('widget_checkbox', $instance['checkbox7']);
		$checkbox8 = apply_filters('widget_checkbox', $instance['checkbox8']);

		$wp_uploads = wp_upload_dir();
		$wp_uploads_path = str_replace('http://'.$_SERVER["SERVER_NAME"], '', $wp_uploads['baseurl']);
		$pluginurl = plugins_url($path='',$scheme=null);

		$medialink_album = get_option('medialink_album');
		$medialink_all = get_option('medialink_all');
		$medialink_document = get_option('medialink_document');
		$medialink_movie = get_option('medialink_movie');
		$medialink_music = get_option('medialink_music');
		$medialink_slideshow = get_option('medialink_slideshow');

		$documentrootname = $_SERVER['DOCUMENT_ROOT'];
		$servername = 'http://'.$_SERVER['HTTP_HOST'];
		$xmlurl2 = get_bloginfo('comments_rss2_url');
		$xml3 = $wp_uploads_path.'/'.$medialink_all['rssname'].'.xml';
		$xml4 = $wp_uploads_path.'/'.$medialink_album['rssname'].'.xml';
		$xml5 = $wp_uploads_path.'/'.$medialink_movie['rssname'].'.xml';
		$xml6 = $wp_uploads_path.'/'.$medialink_music['rssname'].'.xml';
		$xml7 = $wp_uploads_path.'/'.$medialink_slideshow['rssname'].'.xml';
		$xml8 = $wp_uploads_path.'/'.$medialink_document['rssname'].'.xml';
		if ($title) {
			echo $before_widget;
			echo $before_title . $title . $after_title;
			if ($checkbox1) {
				?>
				<div>
				<a href="<?php echo bloginfo('rss2_url'); ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/rssfeeds.png">
				<?php echo bloginfo('name'); ?></a>
				</div>
				<?php
			}
			if ($checkbox2) {
				$xmldata2 = @simplexml_load_file($xmlurl2);
				if ( !empty($xmldata2) ) {
					?>
					<div>
					<a href="<?php echo bloginfo('comments_rss2_url'); ?>">
					<img src="<?php echo $pluginurl ?>/medialink/icon/rssfeeds.png">
					<?php echo $xmldata2->channel->title; ?></a>
					</div>
					<?php
				}
			}	
			if ($checkbox3 && file_exists($documentrootname.$xml3)) {
				$xmldata3 = simplexml_load_file($servername.$xml3);
				?>
				<div>
				<a href="<?php echo $servername.$xml3; ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/podcast.png">
				<?php echo $xmldata3->channel->title; ?></a>
				</div>
				<?php
			}
			if ($checkbox4 && file_exists($documentrootname.$xml4)) {
				$xmldata4 = simplexml_load_file($servername.$xml4);
				?>
				<div>
				<a href="<?php echo $servername.$xml4; ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/rssfeeds.png">
				<?php echo $xmldata4->channel->title; ?></a>
				</div>
				<?php
			}
			if ($checkbox5 && file_exists($documentrootname.$xml5)) {
				$xmldata5 = simplexml_load_file($servername.$xml5);
				?>
				<div>
				<a href="<?php echo $servername.$xml5; ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/podcast.png">
				<?php echo $xmldata5->channel->title; ?></a>
				</div>
				<?php
			}
			if ($checkbox6 && file_exists($documentrootname.$xml6)) {
				$xmldata6 = simplexml_load_file($servername.$xml6);
				?>
				<div>
				<a href="<?php echo $servername.$xml6; ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/podcast.png">
				<?php echo $xmldata6->channel->title; ?></a>
				</div>
				<?php
			}
			if ($checkbox7 && file_exists($documentrootname.$xml7)) {
				$xmldata7 = simplexml_load_file($servername.$xml7);
				?>
				<div>
				<a href="<?php echo $servername.$xml7; ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/rssfeeds.png">
				<?php echo $xmldata7->channel->title; ?></a>
				</div>
				<?php
			}
			if ($checkbox8 && file_exists($documentrootname.$xml8)) {
				$xmldata8 = simplexml_load_file($servername.$xml8);
				?>
				<div>
				<a href="<?php echo $servername.$xml8; ?>">
				<img src="<?php echo $pluginurl ?>/medialink/icon/rssfeeds.png">
				<?php echo $xmldata8->channel->title; ?></a>
				</div>
				<?php
			}
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
		$instance['checkbox7'] = strip_tags($new_instance['checkbox7']);
		$instance['checkbox8'] = strip_tags($new_instance['checkbox8']);
		return $instance;
	}
	
	function form($instance) {

		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		} else {
			$title = NULL;
		}
		if (isset($instance['checkbox1'])) {
			$checkbox1 = esc_attr($instance['checkbox1']);
		} else {
			$checkbox1 = NULL;
		}
		if (isset($instance['checkbox2'])) {
			$checkbox2 = esc_attr($instance['checkbox2']);
		} else {
			$checkbox2 = NULL;
		}
		if (isset($instance['checkbox3'])) {
			$checkbox3 = esc_attr($instance['checkbox3']);
		} else {
			$checkbox3 = NULL;
		}
		if (isset($instance['checkbox4'])) {
			$checkbox4 = esc_attr($instance['checkbox4']);
		} else {
			$checkbox4 = NULL;
		}
		if (isset($instance['checkbox5'])) {
			$checkbox5 = esc_attr($instance['checkbox5']);
		} else {
			$checkbox5 = NULL;
		}
		if (isset($instance['checkbox6'])) {
			$checkbox6 = esc_attr($instance['checkbox6']);
		} else {
			$checkbox6 = NULL;
		}
		if (isset($instance['checkbox7'])) {
			$checkbox7 = esc_attr($instance['checkbox7']);
		} else {
			$checkbox7 = NULL;
		}
		if (isset($instance['checkbox8'])) {
			$checkbox8 = esc_attr($instance['checkbox8']);
		} else {
			$checkbox8 = NULL;
		}

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
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox3'); ?>" name="<?php echo $this->get_field_name('checkbox3'); ?>" type="checkbox"<?php checked('All data', $checkbox3); ?> value="All data" />
			<?php _e('All data (Podcast)', 'medialink'); ?></label>
		</td>
		</tr>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox4'); ?> ">
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox4'); ?>" name="<?php echo $this->get_field_name('checkbox4'); ?>" type="checkbox"<?php checked('Album', $checkbox4); ?> value="Album" />
			<?php _e('Album (RSS)', 'medialink'); ?></label>
		</td>
		</tr>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox5'); ?> ">
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox5'); ?>" name="<?php echo $this->get_field_name('checkbox5'); ?>" type="checkbox"<?php checked('Movie', $checkbox5); ?> value="Movie" />
			<?php _e('Video (Podcast)', 'medialink'); ?></label>
		</td>
		</tr>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox6'); ?> ">
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox6'); ?>" name="<?php echo $this->get_field_name('checkbox6'); ?>" type="checkbox"<?php checked('Music', $checkbox6); ?> value="Music" />
			<?php _e('Music (Podcast)', 'medialink'); ?></label>
		</td>
		</tr>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox7'); ?> ">
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox7'); ?>" name="<?php echo $this->get_field_name('checkbox7'); ?>" type="checkbox"<?php checked('Slideshow', $checkbox7); ?> value="Slideshow" />
			<?php _e('Slideshow (RSS)', 'medialink'); ?></label>
		</td>
		</tr>
		<tr>
		<td align="left" valign="middle" nowrap>
			<label for="<?php echo $this->get_field_id('checkbox8'); ?> ">
			<input class="widefat" id="<?php echo $this->get_field_id('checkbox8'); ?>" name="<?php echo $this->get_field_name('checkbox8'); ?>" type="checkbox"<?php checked('Document', $checkbox8); ?> value="Document" />
			<?php _e('Document (RSS)', 'medialink'); ?></label>
		</td>
		</tr>
		</table>
		<?php
	}
}

?>