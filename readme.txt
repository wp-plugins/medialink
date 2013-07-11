=== Plugin Name ===
Contributors: Katsushi Kawamori
Donate link: http://gallerylink.nyanko.org/medialink/
Tags: audio,feed,feeds,flash,gallery,html5,image,images,list,music,photo,photos,picture,pictures,rss,shortcode,video,xml
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

MediaLink outputs as a gallery from the media library(image and music and video). Support the classification of the category.

== Description ==

Create a playlist (image, music, video) of data in the media library below the specified, MediaLink displays Pages by passing the data to various software.

You write and use short codes to page.

Support the classification of the category.
Use the caption of the media library, and are classified.

Bundled software and function

*   HTML5 player (video, music)
*   FlashPlugin: jQuery SWFObject
*   Flash player (video, music): Flowplayer Flash, MP3Player (for previous versions of IE8)
*   Image: Nivo Slider, ColorBox, PhotoSwipe
*   Create RSS feeds of data (XML). It support to the podcast.
*   Switching of smartphones or tablets: PHP Mobile Detect

    It support to the smartphone. WordPress3.4 or higher.

    [Demo1(Music)](http://gallerylink.nyanko.org/medialink/music/):::[Demo2(Album)](http://gallerylink.nyanko.org/medialink/album/):::[Demo3(Movie)](http://gallerylink.nyanko.org/medialink/movie/):::[Demo4(Slideshow)](http://gallerylink.nyanko.org/medialink/slideshow/)

== Installation ==

1. Upload `medialink` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add a new Page
4. Write a short code. The following text field. `[medialink]`
5. For pictures `[medialink]`. For video `[medialink set='movie']`. For music `[medialink set='music']`.
6. Please read. (Settings > MediaLink)

    [Settings](http://wordpress.org/plugins/medialink/other_notes/)

== Frequently Asked Questions ==

none

== Screenshots ==

1. screenshot-1.jpg

== Changelog ==

= 1.2 =
Add "Default settings"
Change /languages

= 1.1 =
Change readme.txt

= 1.0 =

== Upgrade Notice ==

= 1.2 =
= 1.1 =
= 1.0 =

== Settings ==

(In the case of image) Easy use

Please add new Page. Please write a short code in the text field of the Page. Please go in Text mode this task.

[medialink]

When you view this Page, it is displayed in album mode. It is the result of a search for Media Library. The Settings> Media, determine the size of the thumbnail. The default value of MediaLink, width 80, height 80. Please set its value. In the Media> Add New, please drag and drop the image. You view the Page again. Should see the image to the Page.

In addition, you want to place add an attribute like this in the short code.

[medialink effect='nivoslider']

When you view this Page, it is displayed in slideshow mode.

Customization 1

MediaLink is also handles video and music. If you are dealing with music and video, please add the following attributes to the short code.

Video set='movie'

Music set='music'

* (WordPress > Settings > General Timezone) Please specify your area other than UTC. For accurate time display of RSS feed.

[Customization 2](http://wordpress.org/plugins/medialink/screenshots/)
