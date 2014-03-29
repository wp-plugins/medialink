<?php
/**
 * MediaLink
 * 
 * @package    MediaLink
 * @subpackage MediaLink Add quicktag
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
 * 
 * @since	4.1
 */
class MediaLinkQuickTag {

	function add_quicktag() {

		$all = 'MediaLink'.__('AllData', 'medialink');
		$image = 'MediaLink'.__('Image');
		$slideshow = 'MediaLink'.__('Slideshow', 'medialink');
		$video = 'MediaLink'.__('Video');
		$music = 'MediaLink'.__('Music', 'medialink');
		$documents = 'MediaLink'.__('Document', 'medialink');

$quicktag_add_js = <<<QUICKTAGADDJS
<script type="text/javascript">
	QTags.addButton("medialink_all", "{$all}", "[medialink set='all']");
	QTags.addButton("medialink_album", "{$image}", "[medialink set='album']");
	QTags.addButton("medialink_slideshow", "{$slideshow}", "[medialink set='slideshow']");
	QTags.addButton("medialink_movie", "{$video}", "[medialink set='movie']");
	QTags.addButton("medialink_music", "{$music}", "[medialink set='music']");
	QTags.addButton("medialink_document", "{$documents}", "[medialink set='document']");
</script>
QUICKTAGADDJS;
	echo $quicktag_add_js;

	}

}

?>