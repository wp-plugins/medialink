<?php

	//if uninstall not called from WordPress exit
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
	    exit();

	$option_names = array(
						'medialink_album',
						'medialink_all',
						'medialink_colorbox',
						'medialink_css',
						'medialink_document',
						'medialink_exclude',
						'medialink_movie',
						'medialink_music',
						'medialink_nivoslider',
						'medialink_photoswipe',
						'medialink_slideshow',
						'medialink_swipebox',
						'medialink_useragent'
					);

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

?>
