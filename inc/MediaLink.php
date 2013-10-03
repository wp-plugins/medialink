<?php

class MediaLink {

	public $thumbnail;
	public $include_cat;
	public $exclude_cat;
	public $image_show_size;
	public $generate_rssfeed;
	public $sort_order;
	public $search;
	public $catparam;
	public $topurl;
	public $document_root;
	public $wp_uploads_baseurl;
	public $wp_path;
	public $pluginurl;
	public $set;
	public $mode;
	public $effect;
	public $page;
	public $maxpage;
	public $rssname;
	public $rssmax;

	/* ==================================================
	 * @param	none
	 * @return	string	$mode
	 * @since	1.0
	 */
	function agent_check(){

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
	 * @param	array	$attachments
	 * @param	string	$include_cat
	 * @param	string	$exclude_cat
	 * @param	string	$thumbnail
	 * @param	string	$image_show_size
	 * @param	string	$generate_rssfeed
	 * @param	string	$sort_order
	 * @param	string	$search
	 * @param	string	$topurl
	 * @param	string	$wp_path
	 * @param	string	$pluginurl
	 * @return	array	$files
	 * @return	array	$titles
	 * @return	array	$thumblinks
	 * @return	array	$largemediumlinks
	 * @return	array	$categories
	 * @return	array	$rssfiles
	 * @return	array	$rsstitles
	 * @return	array	$rssthumblinks
	 * @return	array	$rsslargemediumlinks
	 * @since	2.1
	 */
	function scan_media($attachments){

		$attachment = NULL;
		$title = NULL;
		$caption = NULL;
		$rsscount = 0;
		$filecount = 0;
		$categorycount = 0;
		$files = array();
		$categories = array();
		$thumblinks = array();
		$largemediumlinks = array();
		$titles = array();
		$rssfiles = array();
		$rsstitles = array();
		$rssthumblinks = array();
		$rsslargemediumlinks = array();
		if ($attachments) {
			foreach ( $attachments as $attachment ) {
				$title = $attachment->post_title;
				$caption = $attachment->post_excerpt;
				$suffix = '.'.end(explode('.', $attachment->guid));
				if( empty($this->exclude_cat) ) { 
					$loops = TRUE;
				} else {
					if ( preg_match("/".$this->exclude_cat."/", $caption) ) {
						$loops = FALSE;
					} else {
						$loops = TRUE;
					}
				}
				if( $loops === TRUE ) {
					if ( !empty($caption) && (($caption === $this->include_cat) || empty($this->include_cat)) ) {
						$categories[$categorycount] = $caption;
						++$categorycount;
					}
					$thumblink = NULL;
					$mediumlink = NULL;
					$largelink = NULL;
					$largemediumlink = NULL;
					if ( $this->set === 'album' ){
						$thumb_src = wp_get_attachment_image_src($attachment->ID);
						$medium_src = wp_get_attachment_image_src($attachment->ID, 'medium');
						$large_src = wp_get_attachment_image_src($attachment->ID, 'large');
						$thumblink = $thumb_src[0];
						$mediumlink = $medium_src[0];
						$largelink = $large_src[0];
					} else {
						if( !empty($this->thumbnail) ) {
							if ( preg_match( "/jpg|jpeg|jpe|gif|png|bmp|tif|tiff|ico/i", $this->thumbnail) || $this->set === 'document') {
								$thumbname = NULL;
								$thumbname_md5 = NULL;
								$thumbpath = NULL;
								$thumbname = str_replace($suffix, '', end(explode('/', $attachment->guid)));
								$thumbname_md5 = md5($thumbname);
								$thumbpath = str_replace($thumbname.$suffix, '', $attachment->guid);
								$thumbcheck = str_replace($this->wp_path, '', ABSPATH).$this->topurl.str_replace($this->wp_uploads_baseurl, '', $thumbpath.$thumbname.$this->thumbnail);
								$thumbcheck_md5 = str_replace($this->wp_path, '', ABSPATH).$this->topurl.str_replace($this->wp_uploads_baseurl, '', $thumbpath.$thumbname_md5.$this->thumbnail);
								if( file_exists( $thumbcheck ) ){
									$thumblink = '<img src = "'.$thumbpath.$thumbname.$this->thumbnail.'">';
								} else if( file_exists( $thumbcheck_md5 ) ){
									$thumblink = '<img src = "'.$thumbpath.$thumbname_md5.$this->thumbnail.'">';
								} else {
									if ( $this->set === 'document' && $this->thumbnail === 'icon' ) {
										if ( $suffix === '.pdf' ) {
											$thumblink = '<img src = "'.$this->pluginurl.'/medialink/icon/pdf.png">';
										} else if ( $suffix === '.doc' || $suffix === '.docx' ) {
											$thumblink = '<img src = "'.$this->pluginurl.'/medialink/icon/word.png">';
										} else if ( $suffix === '.xls' || $suffix === '.xlsx' || $suffix === '.xla' || $suffix === '.xlt' || $suffix === '.xlw' ) {
											$thumblink = '<img src = "'.$this->pluginurl.'/medialink/icon/excel.png">';
										} else if ( $suffix === '.pot' || $suffix === '.pps' || $suffix === '.ppt' || $suffix === '.pptx' || $suffix === '.pptm' || $suffix === '.ppsx' || $suffix === '.ppsm' || $suffix === '.potx' || $suffix === '.potm' || $suffix === '.ppam' || $suffix === '.sldx' || $suffix === '.sldm' ) {
											$thumblink = '<img src = "'.$this->pluginurl.'/medialink/icon/powerpoint.png">';
										} else {
											$thumblink = wp_get_attachment_image( $attachment->ID, 'thumbnail', TRUE );
										}
									} else {
										$thumblink = wp_get_attachment_image( $attachment->ID, 'thumbnail', TRUE );
									}
								}
							}
						}
					}
					$attachment = str_replace($this->wp_path, '', ABSPATH).$this->topurl.str_replace($this->wp_uploads_baseurl, '', $attachment->guid);
					$attachment = str_replace($this->document_root, "", $attachment);
					if ( $this->set === 'album' || $this->set === 'slideshow' ) {
						if ( $this->image_show_size === 'Medium' ) {
							$largemediumlink = $mediumlink;
						} else if ( $this->image_show_size === 'Large' ) {
							$largemediumlink = $largelink;
						} else {
							$largemediumlink = NULL;
						}
					}
					if ( $this->generate_rssfeed === 'on' ) {
						if ( $this->sort_order === 'DESC' && empty($this->search) ) {
							if ( ($caption === $this->include_cat) || empty($this->include_cat) ) {
								$rssfiles[$rsscount] = $attachment;
								$rsstitles[$rsscount] = $title;
								$rssthumblinks [$rsscount] = $thumblink;
								$rsslargemediumlinks [$rsscount] = $largemediumlink;
								++$rsscount;
							}
						}
					}
					if ( ($caption === $this->catparam || empty($this->catparam)) ) {
						if ( ($caption === $this->include_cat) || empty($this->include_cat) ) {
							$files[$filecount] = $attachment;
							$titles[$filecount] = $title;
							$thumblinks [$filecount] = $thumblink;
							$largemediumlinks [$filecount] = $largemediumlink;
							++$filecount;
						}
					}
				}
			}
		}

		return array($files, $titles, $thumblinks, $largemediumlinks, $categories, $rssfiles, $rsstitles, $rssthumblinks, $rsslargemediumlinks);

	}

	/* ==================================================
	 * @param	string	$catparam
	 * @param	string	$file
	 * @param	string	$title
	 * @param	string	$topurl
	 * @param	string	$thumblink
	 * @param	string	$largemediumlink
	 * @param	string	$mode
	 * @param	string	$effect
	 * @return	string	$linkfile
	 * @since	1.0
	 */
	function print_file($file,$title,$thumblink,$largemediumlink) {

		$suffix = '.'.end(explode('.', $file));

		$this->catparam = mb_convert_encoding($this->catparam, "UTF-8", "auto");
		$filename = mb_convert_encoding($file, "UTF-8", "auto");
		$filename = str_replace($suffix, "", $filename);
		$titlename = $title;

		$fileparam = substr($file,1);
		$filetitle = $titlename;
		$fileparam = str_replace("%2F","/",urlencode($fileparam));

		$file = str_replace("%2F","/",urlencode($file));

		if ( !empty($largemediumlink) ) {
			$imgshowlink = $largemediumlink;
		} else {
			$imgshowlink = $this->topurl.$file;
		}

		$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

		$mimetype = 'type="'.$this->mime_type($suffix).'"'; // MimeType

		$linkfile = NULL;
		if ( preg_match( "/jpg|jpeg|jpe|gif|png|bmp|tif|tiff|ico/i", $suffix) ) {
			if ($this->effect === 'nivoslider'){ // for nivoslider
				$linkfile = '<img src="'.$imgshowlink.'" alt="'.$titlename.'" title="'.$titlename.'">';
			} else if ($this->effect === 'colorbox' && $this->mode === 'pc'){ // for colorbox
				$linkfile = '<a class=medialink href="'.$imgshowlink.'" title="'.$titlename.'"><img src="'.$thumblink.'" alt="'.$titlename.'" title="'.$titlename.'"></a>';
			} else if ($this->effect === 'photoswipe' && $this->mode === 'sp'){ // for Photoswipe
				$linkfile = '<li><a rel="external" href="'.$imgshowlink.'" title="'.$titlename.'"><img src="'.$thumblink.'" alt="'.$titlename.'" title="'.$titlename.'"></a></li>';
			} else if ($this->effect === 'Lightbox' && $this->mode === 'pc'){ // for Lightbox
				$linkfile = '<a href="'.$imgshowlink.'" rel="lightbox[medialink]" title="'.$titlename.'"><img src="'.$thumblink.'" alt="'.$titlename.'" title="'.$titlename.'"></a>';
			} else {
				$linkfile = '<li><a href="'.$imgshowlink.'" title="'.$titlename.'"><img src="'.$this->topurl.$thumblink.'" alt="'.$titlename.'" title="'.$titlename.'"></a></li>';
			}
		}else{
			if ( $this->mode === 'sp' || $this->set === 'document' ) {
				$linkfile = '<li>'.$thumblink.'<a href="'.$this->topurl.$file.'" '.$mimetype.'>'.$titlename.'</a></li>';
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

				$linkfile = '<li>'.$thumblink.'<a href="'.$scriptname.$permlinkstr.$this->catparam.'&mlp='.$page.'&f='.$fileparam.'&sort='.$_GET['sort'].'">'.$filetitle.'</a></li>';
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
	function print_pages() {

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
		$query = str_replace('&mlp='.$this->page, '', $query);
		$query = str_replace('mlp='.$this->page, '', $query);
		$query = preg_replace('/&f=.*/', '', $query);

		if ( $this->mode === 'pc' ) { //PC
			$pageleftalow = '&lt;&lt;';
			$pagerightalow = '&gt;&gt;';
		} else if ( $this->mode === 'sp' ) { //SP
			$pagetagleft = '<li>';
			$pagetagright = '</li>';
			$page_no_tag_left = '<a>';
			$page_no_tag_right = '</a>';
		}

		if( $this->maxpage > 1 ){
			if( $this->page == 1 ){
				$linkpages = $pagetagleft.$pagetagright.$pagetagleft.$page_no_tag_left.$this->page.'/'.$this->maxpage.$page_no_tag_right.$pagetagright.$pagetagleft.'<a href="'.$scriptname.'?'.$query.'&mlp='.($this->page+1).'">'.$displaynext.$pagerightalow.'</a>'.$pagetagright;
			}else if( $this->page == $this->maxpage ){
				$linkpages = $pagetagleft.'<a href="'.$scriptname.'?'.$query.'&mlp='.($this->page-1).'">'.$pageleftalow.$displayprev.'</a>'.$pagetagright.$pagetagleft.$page_no_tag_left.$this->page.'/'.$this->maxpage.$page_no_tag_right.$pagetagright.$pagetagleft.$pagetagright;
			}else{
				$linkpages = $pagetagleft.'<a href="'.$scriptname.'?'.$query.'&mlp='.($this->page-1).'">'.$pageleftalow.$displayprev.'</a>'.$pagetagright.$pagetagleft.$page_no_tag_left.$this->page.'/'.$this->maxpage.$page_no_tag_right.$pagetagright.$pagetagleft.'<a href="'.$scriptname.'?'.$query.'&mlp='.($this->page+1).'">'.$displaynext.$pagerightalow.'</a>'.$pagetagright;
			}
		}

		return $linkpages;

	}

	/* ==================================================
	 * @param	string	$file
	 * @param	string	$title
	 * @param	string	$thumblink
	 * @param	string	$largemediumlink
	 * @param	string	$document_root
	 * @param	string	$topurl
	 * @return	string	$xmlitem
	 * @since	1.0
	 */
	function xmlitem_read($file, $title, $thumblink, $largemediumlink) {

		$suffix = '.'.end(explode('.', $file));

		$filesize = filesize($this->document_root.$file);
		$filestat = stat($this->document_root.$file);

		date_default_timezone_set(timezone_name_from_abbr(get_the_date(T)));
		$stamptime = date(DATE_RSS,  $filestat['mtime']);

		$fparam = mb_convert_encoding(str_replace($this->document_root.'/', "", $file), "UTF8", "auto");
		$fparam = str_replace("%2F","/",urlencode($fparam));
		$fparam = substr($fparam,1);

		$file = str_replace($suffix, '', str_replace($this->document_root, '', $file));

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

		if ( preg_match( "/jpg|jpeg|jpe|gif|png|bmp|tif|tiff|ico/i", $suffix) ){
			if ( !empty($largemediumlink) ) {
				$link_url = $largemediumlink;
			} else {
				$link_url = 'http://'.$servername.$this->topurl.$file.$suffix;
			}
			$img_url = '<a href="'.$link_url.'"><img src = "'.$thumblink.'"></a>';
		}else{
			if ( $this->set === 'document' ){
				$link_url = 'http://'.$servername.$this->topurl.$file.$suffix;
			} else {
				$link_url = 'http://'.$servername.$scriptname.$fparam;
				$enc_url = 'http://'.$servername.$this->topurl.$file.$suffix;
			}
			if( !empty($thumblink) ) {
				$img_url = '<a href="'.$link_url.'">'.$thumblink.'</a>';
			}
		}

		$xmlitem = NULL;
		$xmlitem .= "<item>\n";
		$xmlitem .= "<title>".$titlename."</title>\n";
		$xmlitem .= "<link>".$link_url."</link>\n";
		if ( $this->set === 'movie' || $this->set === 'music' ){
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
	 * @param	string	$xml_title
	 * @param	string	$catparam
	 * @param	string	$mode
	 * @param	string	$rssname
	 * @param	string	$rssmax
	 * @param	array	$rssfiles
	 * @param	array	$rsstitles
	 * @param	array	$rssthumblinks
	 * @param	array	$rsslargemediumlinks
	 * @param	string	$document_root
	 * @return	none
	 * @since	1.33
	 */
	function rss_wirte($xml_title, $rssfiles, $rsstitles, $rssthumblinks, $rsslargemediumlinks) {

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

		$xmlfile = $this->document_root.'/'.$this->rssname.'.xml';
		if(count($rssfiles) < $this->rssmax){$this->rssmax = count($rssfiles);}
		if ( file_exists($xmlfile)){
			if ( empty($this->catparam) && ($this->mode === "pc" || $this->mode === "sp") ) {
				$pubdate = NULL;
				$xml = simplexml_load_file($xmlfile);
				$exist_rssfile_count = 0;
				foreach($xml->channel->item as $entry){
					$pubdate[] = $entry->pubDate;
					++$exist_rssfile_count;
 				}
 				$exist_rss_pubdate = $pubdate[0];
				if(preg_match("/\<pubDate\>(.+)\<\/pubDate\>/ms", $this->xmlitem_read($rssfiles[0], $rsstitles[0], $rssthumblinks[0], $rsslargemediumlinks[0]), $reg)){
					$new_rss_pubdate = $reg[1];
				}
				if ($exist_rss_pubdate <> $new_rss_pubdate || $exist_rssfile_count != $this->rssmax){
					$xmlitem = NULL;
					for ( $i = 0; $i <= $this->rssmax-1; $i++ ) {
						$xmlitem .= $this->xmlitem_read($rssfiles[$i], $rsstitles[$i], $rssthumblinks[$i], $rsslargemediumlinks[$i]);
					}
					$xmlitem = $xml_begin.$xmlitem.$xml_end;
					$fno = fopen($xmlfile, 'w');
						fwrite($fno, $xmlitem);
					fclose($fno);
				}
			}
		}else{
			for ( $i = 0; $i <= $this->rssmax-1; $i++ ) {
				$xmlitem .= $this->xmlitem_read($rssfiles[$i], $rsstitles[$i], $rssthumblinks[$i], $rsslargemediumlinks[$i]);
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

}

?>