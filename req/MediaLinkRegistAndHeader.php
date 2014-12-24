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
							'display' => 8, 	
							'image_show_size' => 'Full',
							'generate_rssfeed' => 'on',
							'rssname' => 'medialink_all_feed',
							'rssmax' => 10,
							'filesize_show' => 'Show',
							'stamptime_show' => 'Show',
							'exif_show' => 'Show',
							'archiveslinks_show' => 'Show',
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
							'suffix' => 'all',
							'display' => 20, 	
							'image_show_size' => 'Full',
							'generate_rssfeed' => 'on',
							'rssname' => 'medialink_album_feed',
							'rssmax' => 10,
							'filesize_show' => 'Show',
							'stamptime_show' => 'Show',
							'exif_show' => 'Show',
							'archiveslinks_show' => 'Show',
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
							'suffix' => 'mp4',
							'suffix_2' => 'ogv',
							'display' => 8,
							'thumbnail' => '',
							'generate_rssfeed' => 'on',
							'rssname' => 'medialink_movie_feed',
							'rssmax' => 10,
							'filesize_show' => 'Show',
							'stamptime_show' => 'Show',
							'archiveslinks_show' => 'Show',
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
							'suffix' => 'mp3',
							'suffix_2' => 'ogg',
							'display' => 8,
							'thumbnail' => '',
							'generate_rssfeed' => 'on',
							'rssname' => 'medialink_music_feed',
							'rssmax' => 10,
							'filesize_show' => 'Show',
							'stamptime_show' => 'Show',
							'archiveslinks_show' => 'Show',
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
								'suffix' => 'all',
								'display' => 10,
								'image_show_size' => 'Full',
								'generate_rssfeed' => 'on',
								'rssname' => 'medialink_slideshow_feed',
								'rssmax' => 10,
								'filesize_show' => 'Show',
								'stamptime_show' => 'Show',
								'exif_show' => 'Show',
								'archiveslinks_show' => 'Hide',
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
								'suffix' => 'all',
								'display' => 20,
								'thumbnail' => 'icon',
								'generate_rssfeed' => 'on',
								'rssname' => 'medialink_document_feed',
								'rssmax' => 10,
								'filesize_show' => 'Show',
								'stamptime_show' => 'Show',
								'archiveslinks_show' => 'Show',
								'pagelinks_show' => 'Show',
								'sortlinks_show' => 'Show',
								'searchbox_show' => 'Show',
								'rssicon_show' => 'Show',
								'credit_show' => 'Show'
							);
			update_option( 'medialink_document', $document_tbl );
		}

		if ( !get_option('medialink_css') ) {
			$css_tbl = array(
							'listthumbsize' => '40x40',
							'linkstrcolor' => '#000000',
							'linkbackcolor' => '#f6efe2'
							);
			update_option( 'medialink_css', $css_tbl );
		}

	}

	/* ==================================================
	 * Add FeedLink
	 * @since	1.16
	 */
	function add_feedlink(){

		$medialink_all = get_option('medialink_all');
		$medialink_album = get_option('medialink_album');
		$medialink_movie = get_option('medialink_movie');
		$medialink_music = get_option('medialink_music');
		$medialink_slideshow = get_option('medialink_slideshow');
		$medialink_document = get_option('medialink_document');

		$wp_uploads = wp_upload_dir();

		$xml_all = '/'.$medialink_all['rssname'].'.xml';
		$xml_album = '/'.$medialink_album['rssname'].'.xml';
		$xml_movie = '/'.$medialink_movie['rssname'].'.xml';
		$xml_music = '/'.$medialink_music['rssname'].'.xml';
		$xml_slideshow = '/'.$medialink_slideshow['rssname'].'.xml';
		$xml_document = '/'.$medialink_document['rssname'].'.xml';

		echo '<!-- Start Medialink feed -->'."\n";
		if (file_exists($wp_uploads['basedir'].$xml_all)) {
			$xml_all_data = simplexml_load_file($wp_uploads['baseurl'].$xml_all);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$wp_uploads['baseurl'].$xml_all.'" title="'.$xml_all_data->channel->title.'" />'."\n";
		}
		if (file_exists($wp_uploads['basedir'].$xml_album)) {
			$xml_album_data = simplexml_load_file($wp_uploads['baseurl'].$xml_album);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$wp_uploads['baseurl'].$xml_album.'" title="'.$xml_album_data->channel->title.'" />'."\n";
		}
		if (file_exists($wp_uploads['basedir'].$xml_movie)) {
			$xml_movie_data = simplexml_load_file($wp_uploads['baseurl'].$xml_movie);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$wp_uploads['baseurl'].$xml_movie.'" title="'.$xml_movie_data->channel->title.'" />'."\n";
		}
		if (file_exists($wp_uploads['basedir'].$xml_music)) {
			$xml_music_data = simplexml_load_file($wp_uploads['baseurl'].$xml_music);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$wp_uploads['baseurl'].$xml_music.'" title="'.$xml_music_data->channel->title.'" />'."\n";
		}
		if (file_exists($wp_uploads['basedir'].$xml_slideshow)) {
			$xml_slideshow_data = simplexml_load_file($wp_uploads['baseurl'].$xml_slideshow);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$wp_uploads['baseurl'].$xml_slideshow.'" title="'.$xml_slideshow_data->channel->title.'" />'."\n";
		}
		if (file_exists($wp_uploads['basedir'].$xml_document)) {
			$xml_document_data = simplexml_load_file($wp_uploads['baseurl'].$xml_document);
			echo '<link rel="alternate" type="application/rss+xml" href="'.$wp_uploads['baseurl'].$xml_document.'" title="'.$xml_document_data->channel->title.'" />'."\n";
		}
		echo '<!-- End Medialink feed -->'."\n";

	}

	/* ==================================================
	 * Settings CSS
	 * @since	1.9
	 */
	function add_css(){

		$medialink_css = get_option('medialink_css');

		list($listthumbsize_w, $listthumbsize_h) = explode('x', $medialink_css['listthumbsize']);
		$linkstrcolor = $medialink_css['linkstrcolor'];
		$linkbackcolor = $medialink_css['linkbackcolor'];

	// CSS
$medialink_add_css = <<<MEDIALINKADDCSS
<!-- Start Medialink CSS -->
<style type="text/css">
.medialink-pages .medialink-links a { background: {$linkbackcolor}; }
.medialink-pages .medialink-links a:hover {color: {$linkstrcolor}; background: {$linkbackcolor};}
.medialink-list a:hover {color: {$linkstrcolor}; background: {$linkbackcolor};}
.medialink-list ul li a:after{ border: 4px solid transparent; border-left-color: {$linkbackcolor}; }
.medialink-list ul li img{ width: {$listthumbsize_w}px; height: {$listthumbsize_h}px; }
</style>
<!-- End Medialink CSS -->
MEDIALINKADDCSS;

		echo $medialink_add_css;

	}

	/* ==================================================
	 * Delete wp_options table of old version.
	 * @since	4.4
	 */
	function delete_old_versions_wp_options(){

		$delete_old_options = FALSE;

		if ( get_option('medialink_exclude') || get_option('medialink_useragent') ) {
			$delete_old_options = TRUE;
			$option_names = array(
								'medialink_exclude',
								'medialink_useragent'
						);
		}

		if ( $delete_old_options ) {
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