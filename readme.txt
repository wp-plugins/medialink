=== MediaLink ===
Contributors: Katsushi Kawamori
Donate link: http://gallerylink.nyanko.org/medialink/
Tags: audio,feed,feeds,gallery,html5,image,images,list,music,photo,photos,picture,pictures,rss,shortcode,video,xml
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 6.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

MediaLink outputs as a gallery from the media library(image and music and video and document).

== Description ==

Create a playlist (image, music, video, document) of data in the media library below the specified, MediaLink displays Pages by passing the data to various software.

If you want to output the gallery by specifying the directory, please use the [GalleryLink](http://wordpress.org/plugins/gallerylink/).

In the media uploader, you may not be able to upload by the environment of server. That's when the files are large. If you want to upload to the media library without having to worry about the file size, please use the [Media from FTP](http://wordpress.org/plugins/media-from-ftp/).

You write and use short codes to page.

Bundled software and function

*   HTML5 player (video, music)
*   Create RSS feeds of data (XML). It support to the podcast.
*   Works with [Boxers and Swipers](http://wordpress.org/plugins/boxers-and-swipers/).
*   Works with [Simple NivoSlider](http://wordpress.org/plugins/simple-nivoslider/).
*   Works with [Simple Masonry Gallery](http://wordpress.org/plugins/simple-masonry-gallery/).

    [Demo1(All Data)](http://gallerylink.nyanko.org/medialink/all-data/):::[Demo2(Images)](http://gallerylink.nyanko.org/medialink/album/):::[Demo3(Images with Simple Masonry Gallery)](http://gallerylink.nyanko.org/medialink/masonry/):::[Demo4(Video)](http://gallerylink.nyanko.org/medialink/movie/):::[Demo5(Music)](http://gallerylink.nyanko.org/medialink/music/):::[Demo6(Slideshow with Simple NivoSlider)](http://gallerylink.nyanko.org/medialink/slideshow/):::[Demo7(Documents)](http://gallerylink.nyanko.org/medialink/documents/)

Translators

*   Serbo-Croatian (sr_RS) - Borisa Djuraskovic. I want to thank Borisa Djuraskovic and his [company](http://www.webhostinghub.com).
*   Japanese (ja) - [Katsushi Kawamori](http://gallerylink.nyanko.org/medialink/)

== Installation ==

1. Upload `medialink` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add a new Page
4. Write a short code. The following text field. `[medialink]`
5. For pictures `[medialink]`. For video `[medialink set='movie']`. For music `[medialink set='music']`. For document `[medialink set='document']`.
6. Please read. (Settings > MediaLink)

    [Settings](http://wordpress.org/plugins/medialink/other_notes/)

7. Navigate to the appearance section and select widgets, select wordpress MediaLinkRssFeed and configure from here.

== Frequently Asked Questions ==

none

== Screenshots ==

1. Settings 1
2. Settings 2

== Changelog ==

= 6.4 =
Fixed the problem of the management screen.

= 6.3 =
Fixed the problem of with Simple NivoSlider.
Works with Simple Masonry Gallery.

= 6.2 =
Removed unnecessary code.

= 6.1 =
Stopped the support of Flash.
Fixed the problem of size of video container.
Fixed the problem of playing video.
Fixed the problem of playing music.
Change /languages.

= 6.0 =
Adopt Responsive design. 
Stop using category, adopting the archive.

= 5.3 =
Fixed of problem of display for rss feed icon.

= 5.2 =
Fixed of problem of filesize & datetime.

= 5.1 =
Fixed of problem of error in debug mode.

= 5.0 =
Can be cooperation with Boxers and Swipers.
Can be cooperation with Simple NivoSlider.

= 4.9 =
Fixed css.

= 4.8 =
Fixed css.

= 4.7 =
Change quicktag.

= 4.6 =
Easy to see the management screen.

= 4.5 =
Re-organized the data that is stored in the wp_options.
Fixed the problem of the display for images.

= 4.3 =
Fixed the problem of the display.
Change /languages.

= 4.2 =
Add search mode of all files.
Fixed the problem of permalinks.
Fixed the problem of RSS feed.

= 4.1 =
Add quicktag.
Fixed the problem of permalinks.

= 4.0 =
Be able to settings to effects.
Easy to see the management screen.
Change /languages.

= 3.5 =
Update PhotoSwipe.
Fixed the problem of RSS feed to the header.
Javascript placement in the footer.

= 3.4 =
Fixed the problem of the display of filesize & datetime.

= 3.3 =
Fixed the problem of widgets.
Add filesize & datetime.

= 3.2 =
Add extension type.

= 3.1 =
Fixed a display of management screen.
Fixed css for smartphone.

= 3.0 =
Add mode for output of all data.
Fixed the problem of permalinks.
Fixed the problem of podcast.
Change /languages.
Change readme.txt.

= 2.11 =
Removed unnecessary code.

= 2.10 =
Was added the ability to allocate to each terminal by the user agent that you specify.
Version up of colorbox.
Removed of PHP Mobile Detect.

= 2.9 =
Removed unnecessary code.

= 2.8 =
Supported Swipebox
Change /icon.

= 2.7 =
Change /languages.
Supported language Serbo-Croatian.

= 2.6 =
Fixed the problem of InternetExplorer11.

= 2.5 =
Supported Xampp(Microsoft Windows).

= 2.4 =
Fixed the problem of RSS Feed creation.

= 2.3 =
Added shortcode attribute is the type of sort.

= 2.2 =
Optimization

= 2.1 =
Optimization

= 2.0 =
Add document mode.
Change /languages
Change readme.txt

= 1.38 =
Add the short code attribute called generate_rssfeed .
Add error handling of RSS feed generation.

= 1.37 =
Fixed the problem of short code.
Extension of exclude_cat and include_cat.

= 1.36 =
Optimization

= 1.35 =
Optimization

= 1.34 =
Optimization

= 1.33 =
To avoid duplication of the function name, it was summarized in class.

= 1.32 =
Fixed a display of management screen.

= 1.31 =
Fixed problem that can not get the image of the Large size.

= 1.30 =
In the slideshow and album, you can change the size of the image to be displayed.

= 1.29 =
Added shortcode attribute is the credit display and the various navigation display.

= 1.28 =
Can be changed, the credit display and the various navigation display.
Change /languages

= 1.27 =
Fixed problem of playlist of music and video.

= 1.26 =
Excluded period  from extension of the management screen and short codes.
Have increased the file types that can be set in the administration screen.
Fixed an issue with the selection of extension of music management screen.
Change /languages

= 1.25 =
In the case of jpg can reads jpe and jpeg.
Change /languages

= 1.24 =
Fixed problem of thumbnail (Video or Music),  In the case of multi-byte characters.

= 1.23 =
Change /languages

= 1.22 =
Update colorbox
Change /languages

= 1.21 =
Change Settings Page

= 1.20 =
Fixed problem of slideshow mode.

= 1.19 =
Add slideshow mode.
Change Settings Page
Change readme.txt
Change /languages

= 1.18 =
Change Settings Page
Change /languages

= 1.17 =
Add (effect_pc, effect_sp) of short code attribute value.
Support for Lightbox.
Change /languages

= 1.16 =
Add RSS feed to the header.

= 1.15 =
Show the title of the feed to widget.

= 1.14 =
Change Settings Page
Change /languages

= 1.13 =
Change readme.txt

= 1.12 =
Add widget for RSS feed.

= 1.11 =
When uninstalling the plug-in, remove the table that it created.

= 1.10 =
Fixed problem in the case of a "Permalink Settings > Default".

= 1.9 =
Add "Settings" for CSS.
Fixed conflict of class.

= 1.8 =
Fixed problem of CSS.

= 1.7 =
Change readme.txt

= 1.6 =
Fixed problem of thumbnail.

= 1.5 =
Fixed problem of thumbnail size.

= 1.4 =
Add Default settings for size of movie container.
Change /languages

= 1.3 =
Subdivision of the "Default settings".
Change readme.txt

= 1.2 =
Add "Default settings"
Change /languages

= 1.1 =
Change readme.txt

= 1.0 =

== Upgrade Notice ==

= 6.4 =
= 6.3 =
= 6.2 =
= 6.1 =
= 6.0 =
= 5.3 =
= 5.2 =
= 5.1 =
= 5.0 =
= 4.9 =
= 4.8 =
= 4.7 =
= 4.6 =
= 4.5 =
= 4.3 =
= 4.2 =
= 4.1 =
= 4.0 =
= 3.5 =
= 3.4 =
= 3.3 =
= 3.2 =
= 3.1 =
= 3.0 =
= 2.11 =
= 2.10 =
= 2.9 =
= 2.8 =
= 2.7 =
= 2.6 =
= 2.5 =
= 2.4 =
= 2.3 =
= 2.2 =
= 2.1 =
= 2.0 =
= 1.38 =
= 1.37 =
= 1.36 =
= 1.35 =
= 1.34 =
= 1.33 =
= 1.32 =
= 1.31 =
= 1.30 =
= 1.29 =
= 1.28 =
= 1.27 =
= 1.26 =
= 1.25 =
= 1.24 =
= 1.23 =
= 1.22 =
= 1.21 =
= 1.20 =
= 1.19 =
= 1.18 =
= 1.17 =
= 1.16 =
= 1.15 =
= 1.14 =
= 1.13 =
= 1.12 =
= 1.11 =
= 1.10 =
= 1.9 =
= 1.8 =
= 1.7 =
= 1.6 =
= 1.5 =
= 1.4 =
= 1.3 =
= 1.2 =
= 1.1 =
= 1.0 =

== Settings ==

(In the case of image) Easy use

Please add new Page. Please write a short code in the text field of the Page. Please go in Text mode this task.

[medialink set='album']

When you view this Page, it is displayed in album mode. It is the result of a search for Media Library. The Settings> Media, determine the size of the thumbnail. Please set its value. In the Media> Add New, please drag and drop the image. You view the Page again. Should see the image to the Page.

MediaLink is also handles video and music and document. If you are dealing with music and video and document, please add the following attributes to the short code.

Video set='movie'

Music set='music'

Document set='document'

If you want to display in a mix of data, please specify the following attributes to the short code.

Mix of data set = 'all'

* (WordPress > Settings > General Timezone) Please specify your area other than UTC. For accurate time display of RSS feed.

* When you move to (WordPress > Appearance> Widgets), there is a widget MediaLinkRssFeed. If you place you can set this to display the sidebar link the RSS feed.

