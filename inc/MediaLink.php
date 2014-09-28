<?php
/**
 * MediaLink
 * 
 * @package    MediaLink
 * @subpackage MediaLink Main Functions
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

class MediaLink {

	public $thumbnail;
	public $image_show_size;
	public $generate_rssfeed;
	public $sort_order;
	public $search;
	public $archiveparam;
	public $topurl;
	public $wp_uploads_baseurl;
	public $document_root;
	public $set;
	public $page;
	public $maxpage;
	public $rssname;
	public $rssmax;
	public $sort;
	public $filesize_show;
	public $stamptime_show;

	/* ==================================================
	 * @param	array	$attachments
	 * @param	string	$thumbnail
	 * @param	string	$image_show_size
	 * @param	string	$generate_rssfeed
	 * @param	string	$sort_order
	 * @param	string	$search
	 * @param	string	$topurl
	 * @return	array	$files
	 * @return	array	$archives
	 * @return	array	$rssfiles
	 * @since	2.1
	 */
	function scan_media($attachments){

		$attachment = NULL;
		$title = NULL;
		$rsscount = 0;
		$filecount = 0;
		$archivecount = 0;
		$files = array();
		$archives = array();
		$rssfiles = array();
		if ($attachments) {
			foreach ( $attachments as $attachment ) {
				$title = $attachment->post_title;

				$exts = explode('.', $attachment->guid);
				$ext = end($exts);
				$ext2type = wp_ext2type($ext);

				$attachment_metadata = get_post_meta($attachment->ID, '_wp_attachment_metadata', true);
				if ( isset( $attachment_metadata['filesize'] ) ) {
					$file_size = $attachment_metadata['filesize'];
				} else {
					$file_size = filesize(get_attached_file($attachment->ID));
				}
				$datetime = $attachment->post_date;

				$y = substr( $datetime, 0, 4 );
				$m = substr( $datetime, 5, 2 );
				$archive_year_month = "$y/$m";

				$archives[$archivecount] = $archive_year_month;
				++$archivecount;

				$view_datetime = NULL;
				$view_file_size = NULL;
				$length = NULL;
				$metadata = NULL;
				if ( $this->filesize_show === 'Show' || $this->stamptime_show === 'Show' ) {
					if ( $this->filesize_show === 'Show' ) {
						$view_file_size = '&nbsp;&nbsp;'.size_format($file_size);
						if ( $ext2type === 'audio' || $ext2type === 'video' && isset( $attachment_metadata['length_formatted']) ) {
							$length = '&nbsp;&nbsp;'.$attachment_metadata['length_formatted'];
						}
					}
					if ( $this->stamptime_show === 'Show' ) {
						$view_datetime = $datetime;
					}
					$metadata = $view_datetime.$view_file_size.$length;
				}

				$thumblink = NULL;
				$mediumlink = NULL;
				$largelink = NULL;
				$largemediumlink = NULL;
				$medium_src = wp_get_attachment_image_src($attachment->ID, 'medium');
				$large_src = wp_get_attachment_image_src($attachment->ID, 'large');
				$mediumlink = $medium_src[0];
				$largelink = $large_src[0];
				if ( $this->set === 'album' || $this->set === 'slideshow' ){
					$thumb_src = wp_get_attachment_image_src($attachment->ID);
					$thumblink = $thumb_src[0];
				} else {
					$thumblink = wp_get_attachment_image( $attachment->ID, 'thumbnail', TRUE );
				}
				$attachment_file = get_attached_file($attachment->ID);
				$attachment_file = str_replace($this->document_root, "", $attachment_file);
				if ( $ext2type === 'image' ) {
					if ( $this->image_show_size === 'Medium' ) {
						$largemediumlink = $mediumlink;
					} else if ( $this->image_show_size === 'Large' ) {
						$largemediumlink = $largelink;
					} else {
						$largemediumlink = NULL;
					}
				}
				if ( $this->generate_rssfeed === 'on' ) {
					if ( ($this->sort === "new" || empty($this->sort)) && empty($this->archiveparam) && empty($this->search) ) {
						$rssfiles[$rsscount]['file'] = $attachment_file;
						$rssfiles[$rsscount]['title'] = $title;
						$rssfiles[$rsscount]['thumblink'] = $thumblink;
						$rssfiles[$rsscount]['largemediumlink'] = $largemediumlink;
						$rssfiles[$rsscount]['filesize'] = $file_size;
						$rssfiles[$rsscount]['datetime'] = mysql2date( DATE_RSS, $datetime );
						++$rsscount;
					}
				}
				if ( empty($this->archiveparam) || $this->archiveparam === $archive_year_month ) {
					$files[$filecount]['file'] = $attachment_file;
					$files[$filecount]['title'] = $title;
					$files[$filecount]['thumblink'] = $thumblink;
					$files[$filecount]['largemediumlink'] = $largemediumlink;
					$files[$filecount]['metadata'] = $metadata;
					++$filecount;
				}
			}
		}

		return array($files, $archives, $rssfiles, $rsscount);

	}

	/* ==================================================
	 * @param	string	$file
	 * @param	string	$title
	 * @param	string	$topurl
	 * @param	string	$thumblink
	 * @param	string	$largemediumlink
	 * @param	string	$metadata
	 * @return	string	$linkfile
	 * @since	1.0
	 */
	function print_file($file,$title,$thumblink,$largemediumlink,$metadata) {

		$exts = explode('.', $file);
		$ext = end($exts);
		$ext2type = wp_ext2type($ext);

		$fileparam = substr($file,1);
		$fileparam = mb_convert_encoding($fileparam, "UTF-8", "auto");
		$fileparam = str_replace("%2F","/",urlencode($fileparam));

		$file = str_replace("%2F","/",urlencode($file));

		if ( !empty($largemediumlink) ) {
			$imgshowlink = $largemediumlink;
		} else {
			$imgshowlink = $this->topurl.$file;
		}

		$mimetype = 'type="'.$this->mime_type('.'.$ext).'"'; // MimeType

		$linkfile = NULL;
		if ( $ext2type === 'image' ) {
			if ( $this->set === 'all' ) {
				$linkfile = '<li><a href="'.$imgshowlink.'" title="'.$title.$metadata.'">'.$thumblink.$title.'<div style="font-size: small;">'.$metadata.'</div></a></li>';
			} else {
				$thumblink = '<img src="'.$thumblink.'" alt="'.$title.$metadata.'" title="'.$title.$metadata.'">';
				$simplenivoslider_apply = get_post_meta( get_the_ID(), 'simplenivoslider_apply' );
				$simplemasonry_apply = get_post_meta( get_the_ID(), 'simplemasonry_apply' );
				if ($this->set === 'slideshow' && class_exists('SimpleNivoSlider') && !empty($simplenivoslider_apply) && $simplenivoslider_apply[0] === 'true'){
					// for Simple Nivo Slider http://wordpress.org/plugins/simple-nivoslider/
					$linkfile = '<img src="'.$imgshowlink.'" alt="'.$title.'" title="'.$title.$metadata.'">';
				} else if ($this->set === 'album' && class_exists('SimpleMasonry') && !empty($simplemasonry_apply) && $simplemasonry_apply[0] === 'true'){
					// for Simple Masonry Gallery http://wordpress.org/plugins/simple-masonry-gallery/
					$linkfile = '<a href="'.$imgshowlink.'" title="'.$title.$metadata.'"><img src="'.$imgshowlink.'" alt="'.$title.'" title="'.$title.$metadata.'"></a>';
				} else {
					$linkfile = '<a href="'.$imgshowlink.'" title="'.$title.$metadata.'">'.$thumblink.'</a>';
				}
			}
		}else{
			if( $this->set <> 'all' && $this->thumbnail <> 'icon' ) {
				$thumblink = '';
			}
			if ( $ext2type === 'document' || $ext2type === 'spreadsheet' || $ext2type === 'interactive' || $ext2type === 'text' || $ext2type === 'archive' || $ext2type === 'code' ) {
				$linkfile = '<li>'.$thumblink.'<a href="'.$imgshowlink.'" '.$mimetype.'>'.$title.'<div style="font-size: small;">'.$metadata.'</div></a></li>';
			}else{
				if (isset($_GET['mlp'])) {
					$page = $_GET['mlp'];
				} else {
					$page =NULL;
				}
				if (isset($_GET['sort'])) {
					$sortparam = $_GET['sort'];
				} else {
					$sortparam = NULL;
				}
				if (isset($_GET['mlacv'])){
					$archives = $_GET['mlacv'];
				} else {
					$archives = NULL;
				}
				$query = get_permalink();
				$new_query = add_query_arg( array('mlp' => $page, 'f' => $fileparam, 'sort' => $sortparam, 'mlacv' => $archives), $query );
				$linkfile = '<li>'.$thumblink.'<a href="'.$new_query.'">'.$title.'<div style="font-size: small;">'.$metadata.'</div></a></li>';
			}
		}

		return $linkfile;

	}

	/* ==================================================
	 * @param	int		$page
	 * @param	int		$maxpage
	 * @return	string	$linkpages
	 * @since	1.0
	 */
	function print_pages() {

		if (isset($_GET['sort'])) {
			$sortparam = $_GET['sort'];
		} else {
			$sortparam = NULL;
		}
		if (isset($_GET['mlacv'])){
			$archives = $_GET['mlacv'];
		} else {
			$archives = NULL;
		}

		$query = get_permalink();
		$new_query1 = add_query_arg( array('mlp' => 1, 'sort' => $sortparam, 'mlacv' => $archives), $query );
		$new_query2 = add_query_arg( array('mlp' => $this->page-1, 'sort' => $sortparam, 'mlacv' => $archives), $query );
		$new_query3 = add_query_arg( array('mlp' => $this->page+1, 'sort' => $sortparam, 'mlacv' => $archives), $query );
		$new_query4 = add_query_arg( array('mlp' => $this->maxpage, 'sort' => $sortparam, 'mlacv' => $archives), $query );

		$linkpages = NULL;
		$displayfirst = __('first page', 'medialink');
		$displayprev = __('previous page', 'medialink');
		$displaynext = __('next page', 'medialink');
		$displaylast = __('last page', 'medialink');
		if( $this->maxpage > 1 ){
			if( $this->page == 1 ){
				$linkpages = $this->page.'/'.$this->maxpage.'<a title="'.$displaynext.'" href="'.$new_query3.'">&rsaquo;</a> <a title="'.$displaylast.'" href="'.$new_query4.'">&raquo;</a>';
			}else if( $this->page == $this->maxpage ){
				$linkpages = '<a title="'.$displayfirst.'" href="'.$new_query1.'">&laquo;</a> <a title="'.$displayprev.'" href="'.$new_query2.'">&lsaquo;</a>'.$this->page.'/'.$this->maxpage;
			}else{
				$linkpages = '<a title="'.$displayfirst.'" href="'.$new_query1.'">&laquo;</a> <a title="'.$displayprev.'" href="'.$new_query2.'">&lsaquo;</a>'.$this->page.'/'.$this->maxpage.'<a title="'.$displaynext.'" href="'.$new_query3.'">&rsaquo;</a> <a title="'.$displaylast.'" href="'.$new_query4.'">&raquo;</a>';
			}
		}

		return $linkpages;

	}

	/* ==================================================
	 * @return	string	$sortlinks
	 * @since	1.0
	 */
	function sort_pages() {

		if (isset($_GET['mlp'])) {
			$page = $_GET['mlp'];
		} else {
			$page = NULL;
		}
		if (isset($_GET['mlacv'])){
			$archives = $_GET['mlacv'];
		} else {
			$archives = NULL;
		}

		$query = get_permalink();
		$new_query1 = add_query_arg( array('mlp' => $page, 'mlacv' => $archives, 'sort' => 'new'), $query );
		$new_query2 = add_query_arg( array('mlp' => $page, 'mlacv' => $archives, 'sort' => 'old'), $query );
		$new_query3 = add_query_arg( array('mlp' => $page, 'mlacv' => $archives, 'sort' => 'des'), $query );
		$new_query4 = add_query_arg( array('mlp' => $page, 'mlacv' => $archives, 'sort' => 'asc'), $query );

		$sortnamenew = __('New', 'medialink');
		$sortnameold = __('Old', 'medialink');
		$sortnamedes = __('Des', 'medialink');
		$sortnameasc = __('Asc', 'medialink');
		if ( $this->sort === 'new' || empty($this->sort) ) {
			$sortlink_n = $sortnamenew;
			$sortlink_o = '<a href="'.$new_query2.'">'.$sortnameold.'</a>';
			$sortlink_d = '<a href="'.$new_query3.'">'.$sortnamedes.'</a>';
			$sortlink_a = '<a href="'.$new_query4.'">'.$sortnameasc.'</a>';
		} else if ($this->sort === 'old') {
			// old
			$sortlink_n = '<a href="'.$new_query1.'">'.$sortnamenew.'</a>';
			$sortlink_o = $sortnameold;
			$sortlink_d = '<a href="'.$new_query3.'">'.$sortnamedes.'</a>';
			$sortlink_a = '<a href="'.$new_query4.'">'.$sortnameasc.'</a>';
		} else if ($this->sort === 'des') {
			// des
			$sortlink_n = '<a href="'.$new_query1.'">'.$sortnamenew.'</a>';
			$sortlink_o = '<a href="'.$new_query2.'">'.$sortnameold.'</a>';
			$sortlink_d = $sortnamedes;
			$sortlink_a = '<a href="'.$new_query4.'">'.$sortnameasc.'</a>';
		} else if ($this->sort === 'asc') {
			// asc
			$sortlink_n = '<a href="'.$new_query1.'">'.$sortnamenew.'</a>';
			$sortlink_o = '<a href="'.$new_query2.'">'.$sortnameold.'</a>';
			$sortlink_d = '<a href="'.$new_query3.'">'.$sortnamedes.'</a>';
			$sortlink_a = $sortnameasc;
		}
		$sortlinks = $sortlink_n.' '.$sortlink_o.' '.$sortlink_d.' '.$sortlink_a;

		return $sortlinks;

	}

	/* ==================================================
	 * @param	string	$file
	 * @param	string	$title
	 * @param	string	$thumblink
	 * @param	string	$largemediumlink
	 * @param	string	$filesize
	 * @param	string	$stamptime
	 * @param	string	$document_root
	 * @param	string	$topurl
	 * @return	string	$xmlitem
	 * @since	1.0
	 */
	function xmlitem_read($file, $titlename, $thumblink, $largemediumlink, $filesize, $stamptime) {

		$exts = explode('.', $file);
		$ext = end($exts);
		$ext2type = wp_ext2type($ext);
		$suffix = '.'.$ext;

		$file = $this->document_root.$file;

		$fparam = mb_convert_encoding(str_replace($this->document_root.'/', "", $file), "UTF8", "auto");
		$fparam = str_replace("%2F","/",urlencode($fparam));

		$file = str_replace($suffix, '', str_replace($this->document_root, '', $file));
		$file = str_replace("%2F","/",urlencode(mb_convert_encoding($file, "UTF8", "auto")));

		if ( $ext2type === 'image' ) {
			if ( !empty($largemediumlink) ) {
				$link_url = $largemediumlink;
			} else {
				$link_url = $this->topurl.$file.$suffix;
			}
			if ( $this->set === 'all' ) {
				$img_url = '<a href="'.$link_url.'">'.$thumblink.'"</a>';
			} else {
				$img_url = '<a href="'.$link_url.'"><img src = "'.$thumblink.'"></a>';
			}
		}else{
			if ( $ext2type === 'document' || $ext2type === 'spreadsheet' || $ext2type === 'interactive' || $ext2type === 'text' || $ext2type === 'archive' || $ext2type === 'code' ){
				$link_url = $this->topurl.$file.$suffix;
			} else {
				$query = get_permalink();
				$link_url = add_query_arg( 'f', $fparam, $query );
				$link_url = str_replace( '&', '&#38;', $link_url);
				$enc_url = $this->topurl.$file.$suffix;
			}
			if( !empty($thumblink) ) {
				$img_url = '<a href="'.$link_url.'">'.$thumblink.'</a>';
			}
		}

		$xmlitem = NULL;
		$xmlitem .= "<item>\n";
		$xmlitem .= "<title>".$titlename."</title>\n";
		$xmlitem .= "<link>".$link_url."</link>\n";
		if ( $ext2type === 'audio' || $ext2type === 'video' ){
			$xmlitem .= '<enclosure url="'.$enc_url.'" length="'.$filesize.'" type="'.$this->mime_type($suffix).'" />'."\n";
		}
		if( !empty($thumblink) ) {
			$xmlitem .= "<description><![CDATA[".$img_url."]]></description>\n";
		}
		$xmlitem .= "<pubDate>".$stamptime."</pubDate>\n";
		$xmlitem .= "</item>\n";
		return $xmlitem;

	}

	/* ==================================================
	 * @param	string	$xml_title
	 * @param	string	$rssname
	 * @param	string	$rssmax
	 * @param	string	$rsscount
	 * @param	array	$rssfiles
	 * @param	string	$document_root
	 * @return	none
	 * @since	1.33
	 */
	function rss_wirte($xml_title, $rssfiles, $rsscount) {

		$xml_begin = NULL;
		$xml_end = NULL;
//RSS Feed
$xml_begin = <<<XMLBEGIN
<?xml version="1.0" encoding="UTF-8"?>
<rss
 xmlns:dc="http://purl.org/dc/elements/1.1/"
 xmlns:content="http://purl.org/rss/1.0/modules/content/"
 version="2.0">
<channel>
<title>{$xml_title}</title>

XMLBEGIN;

$xml_end = <<<XMLEND
</channel>
</rss>
XMLEND;

		$xmlfile = $this->document_root.'/'.$this->rssname.'.xml';
		if($rsscount < $this->rssmax){$this->rssmax = $rsscount;}
		$xmlitem = NULL;
		if ( file_exists($xmlfile)){
			if ( empty($this->page) && empty($this->sort) && empty($this->archiveparam) ) {
				$pubdate = NULL;
				$xml = simplexml_load_file($xmlfile);
				$exist_rssfile_count = 0;
				foreach($xml->channel->item as $entry){
					$pubdate[] = $entry->pubDate;
					++$exist_rssfile_count;
 				}
 				$exist_rss_pubdate = $pubdate[0];
				if(preg_match("/\<pubDate\>(.+)\<\/pubDate\>/ms", $this->xmlitem_read($rssfiles[0]['file'], $rssfiles[0]['title'], $rssfiles[0]['thumblink'], $rssfiles[0]['largemediumlink'], $rssfiles[0]['filesize'], $rssfiles[0]['datetime']), $reg)){
					$new_rss_pubdate = $reg[1];
				}
				if ($exist_rss_pubdate <> $new_rss_pubdate || $exist_rssfile_count != $this->rssmax){
					for ( $i = 0; $i <= $this->rssmax-1; $i++ ) {
						$xmlitem .= $this->xmlitem_read($rssfiles[$i]['file'], $rssfiles[$i]['title'], $rssfiles[$i]['thumblink'], $rssfiles[$i]['largemediumlink'], $rssfiles[$i]['filesize'], $rssfiles[$i]['datetime']);
					}
					$xmlitem = $xml_begin.$xmlitem.$xml_end;
					$fno = fopen($xmlfile, 'w');
						fwrite($fno, $xmlitem);
					fclose($fno);
				}
			}
		}else{
			for ( $i = 0; $i <= $this->rssmax-1; $i++ ) {
				$xmlitem .= $this->xmlitem_read($rssfiles[$i]['file'], $rssfiles[$i]['title'], $rssfiles[$i]['thumblink'], $rssfiles[$i]['largemediumlink'], $rssfiles[$i]['filesize'], $rssfiles[$i]['datetime']);
			}
			$xmlitem = $xml_begin.$xmlitem.$xml_end;
			if (is_writable($this->document_root)) {
				$fno = fopen($xmlfile, 'w');
					fwrite($fno, $xmlitem);
				fclose($fno);
				chmod($xmlfile, 0646);
			} else {
				_e('Could not create an RSS Feed. Please change to 777 or 757 to permissions of following directory.', 'medialink');
				echo '<div>'.$this->topurl.'</div>';
			}
		}

	}

	/* ==================================================
	 * @param	string	$suffix
	 * @return	string	$mimetype
	 * @since	1.0
	 */
	function mime_type($suffix){

		$suffix = str_replace('.', '', $suffix);

		$mimes = wp_get_mime_types();

		foreach ($mimes as $ext => $mime) {
    		if ( preg_match("/".$ext."/i", $suffix) ) {
				$mimetype = $mime;
			}
		}

		return $mimetype;

	}

	/* ==================================================
	 * @return	string	$queryhead
	 * @since	3.0
	 */
	function permlink_form() {

		$permalinkstruct = NULL;
		$permalinkstruct = get_option('permalink_structure');

		$permlinkstrform = NULL;
		if( empty($permalinkstruct) ){
			$perm_id = get_the_ID();
			if( is_page($perm_id) ) {
				$permlinkstrform = '<input type="hidden" name="page_id" value="'.$perm_id.'">';
			} else {
				$permlinkstrform = '<input type="hidden" name="p" value="'.$perm_id.'">';
			}
		}

		return $permlinkstrform;

	}

	/* ==================================================
	 * @param	none
	 * @return	string	$extpattern
	 * @since	4.2
	 */
	function extpattern(){

		if ( $this->set === 'all' ) {
			$searchtype = 'image|document|spreadsheet|interactive|text|archive|code';
		} else if( $this->set === 'album' || $this->set === 'slideshow') {
			$searchtype = 'image';
		} else if ( $this->set === 'document' ) {
			$searchtype = 'document|spreadsheet|interactive|text|archive|code';
		}

		$mimes = wp_get_mime_types();
		$extpattern = NULL;
		foreach ($mimes as $ext => $mime) {
			if( strpos( $ext, '|' ) ){
				$exts = explode('|',$ext);
				foreach ( $exts as $ext2 ) {
					if( preg_match( "/".$searchtype."/", wp_ext2type($ext2) ) ) {
						$extpattern .= $ext2.','.strtoupper($ext2).',';
					}
				}
			} else {
				if( preg_match("/".$searchtype."/", wp_ext2type($ext) ) ) {
					$extpattern .= $ext.','.strtoupper($ext).',';
				}
			}
		}
		$extpattern = substr($extpattern, 0, -1);

		return $extpattern;

	}

}

?>