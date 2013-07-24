<?php

	if( !defined('WP_UNINSTALL_PLUGIN') )
    	exit();

	delete_option('medialink_album_suffix_pc');
	delete_option('medialink_album_suffix_sp');
	delete_option('medialink_movie_suffix_pc');
	delete_option('medialink_movie_suffix_pc2');
	delete_option('medialink_movie_suffix_sp');
	delete_option('medialink_music_suffix_pc');
	delete_option('medialink_music_suffix_pc2');
	delete_option('medialink_music_suffix_sp');
	delete_option('medialink_album_display_pc');
	delete_option('medialink_album_display_sp');
	delete_option('medialink_movie_display_pc');
	delete_option('medialink_movie_display_sp');
	delete_option('medialink_music_display_pc');
	delete_option('medialink_music_display_sp');
	delete_option('medialink_movie_suffix_thumbnail');
	delete_option('medialink_music_suffix_thumbnail');
	delete_option('medialink_exclude_cat');
	delete_option('medialink_rssmax'); 
	delete_option('medialink_movie_container');
	delete_option('medialink_css_pc_listwidth');
	delete_option('medialink_css_pc_listthumbsize');
	delete_option('medialink_css_pc_linkstrcolor');
	delete_option('medialink_css_pc_linkbackcolor');
	delete_option('medialink_css_sp_navstrcolor');
	delete_option('medialink_css_sp_navbackcolor');
	delete_option('medialink_css_sp_navpartitionlinecolor');
	delete_option('medialink_css_sp_listbackcolor');
	delete_option('medialink_css_sp_listarrowcolor');
	delete_option('medialink_css_sp_listpartitionlinecolor');

?>
