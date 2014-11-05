<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

delete_option( 'wle_plugin_options' );
delete_option( 'wle_options' );
delete_option( 'widget_wle' );
delete_option( 'wle_first_sidebar_id' );
