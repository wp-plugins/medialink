<?php

class MediaLink {

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
	 * @param	string	$catparam
	 * @param	string	$file
	 * @param	string	$title
	 * @param	string	$topurl
	 * @param	string	$thumblink
	 * @param	string	$largemediumlink
	 * @param	string	$document_root
	 * @param	string	$mode
	 * @return	string	$effect
	 * @since	1.0
	 */
	function print_file($catparam,$file,$title,$topurl,$thumblink,$largemediumlink,$document_root,$mode,$effect) {

		$suffix = '.'.end(explode('.', $file));

		$catparam = mb_convert_encoding($catparam, "UTF-8", "auto");
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
			$imgshowlink = $topurl.$file;
		}

		$scriptname = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

		$mimetype = 'type="'.$this->mime_type($suffix).'"'; // MimeType

		$linkfile = NULL;
		if ( preg_match( "/jpg|jpeg|jpe|gif|png|bmp|tif|tiff|ico/i", $suffix) ) {
			if ($effect === 'nivoslider'){ // for nivoslider
				$linkfile = '<img src="'.$imgshowlink.'" alt="'.$titlename.'" title="'.$titlename.'">';
			} else if ($effect === 'colorbox' && $mode === 'pc'){ // for colorbox
				$linkfile = '<a class=medialink href="'.$imgshowlink.'" title="'.$titlename.'"><img src="'.$thumblink.'" alt="'.$titlename.'" title="'.$titlename.'"></a>';
			} else if ($effect === 'photoswipe' && $mode === 'sp'){ // for Photoswipe
				$linkfile = '<li><a rel="external" href="'.$imgshowlink.'" title="'.$titlename.'"><img src="'.$thumblink.'" alt="'.$titlename.'" title="'.$titlename.'"></a></li>';
			} else if ($effect === 'Lightbox' && $mode === 'pc'){ // for Lightbox
				$linkfile = '<a href="'.$imgshowlink.'" rel="lightbox[medialink]" title="'.$titlename.'"><img src="'.$thumblink.'" alt="'.$titlename.'" title="'.$titlename.'"></a>';
			} else {
				$linkfile = '<li><a href="'.$imgshowlink.'" title="'.$titlename.'"><img src="'.$topurl.$thumblink.'" alt="'.$titlename.'" title="'.$titlename.'"></a></li>';
			}
		}else{
			if ( $mode === 'sp' ) {
				$linkfile = '<li>'.$thumblink.'<a href="'.$topurl.$file.'" '.$mimetype.'>'.$titlename.'</a></li>';
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

				$linkfile = '<li>'.$thumblink.'<a href="'.$scriptname.$permlinkstr.$catparam.'&mlp='.$page.'&f='.$fileparam.'">'.$filetitle.'</a></li>';
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
	function print_pages($page,$maxpage,$mode) {

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
	 * @param	string	$largemediumlink
	 * @param	string	$document_root
	 * @param	string	$topurl
	 * @return	string	$xmlitem
	 * @since	1.0
	 */
	function xmlitem_read($file, $title, $thumblink, $largemediumlink, $document_root, $topurl) {

		$suffix = '.'.end(explode('.', $file));

		$filesize = filesize($document_root.$file);
		$filestat = stat($document_root.$file);
		date_default_timezone_set(timezone_name_from_abbr(get_the_date(T)));
		$stamptime = date(DATE_RSS,  $filestat['mtime']);

		$fparam = mb_convert_encoding(str_replace($document_root.'/', "", $file), "UTF8", "auto");
		$fparam = str_replace("%2F","/",urlencode($fparam));
		$fparam = substr($fparam,1);

		$file = str_replace($suffix, '', str_replace($document_root, '', $file));

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
				$link_url = 'http://'.$servername.$topurl.$file.$suffix;
			}
			$img_url = '<a href="'.$link_url.'"><img src = "'.$thumblink.'"></a>';
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
		if ( !preg_match( "/jpg|jpeg|jpe|gif|png|bmp|tif|tiff|ico/i", $suffix) ){
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
	 * @param	string	$topurl
	 * @return	none
	 * @since	1.33
	 */
	function rss_wirte($xml_title, $catparam, $mode, $rssname, $rssmax, $rssfiles, $rsstitles, $rssthumblinks, $rsslargemediumlinks, $document_root, $topurl) {

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
				if(preg_match("/\<pubDate\>(.+)\<\/pubDate\>/ms", $this->xmlitem_read($rssfiles[0], $rsstitles[0], $rssthumblinks[0], $rsslargemediumlinks[0], $document_root, $topurl), $reg)){
					$new_rss_pubdate = $reg[1];
				}
				if ($exist_rss_pubdate <> $new_rss_pubdate || $exist_rssfile_count != $rssmax){
					$xmlitem = NULL;
					for ( $i = 0; $i <= $rssmax-1; $i++ ) {
						$xmlitem .= $this->xmlitem_read($rssfiles[$i], $rsstitles[$i], $rssthumblinks[$i], $rsslargemediumlinks[$i], $document_root, $topurl);
					}
					$xmlitem = $xml_begin.$xmlitem.$xml_end;
					$fno = fopen($xmlfile, 'w');
						fwrite($fno, $xmlitem);
					fclose($fno);
				}
			}
		}else{
			for ( $i = 0; $i <= $rssmax-1; $i++ ) {
				$xmlitem .= $this->xmlitem_read($rssfiles[$i], $rsstitles[$i], $rssthumblinks[$i], $rsslargemediumlinks[$i], $document_root, $topurl);
			}
			$xmlitem = $xml_begin.$xmlitem.$xml_end;
			$fno = fopen($xmlfile, 'w');
				fwrite($fno, $xmlitem);
			fclose($fno);
			chmod($xmlfile, 0646);
		}

	}

}