<?php

if ( php_sapi_name() !== 'cli' ) {
	die( "Meant to be run from command line" );
}

function find_wordpress_base_path() {
	$dir = dirname( __FILE__ );
	do {
		//it is possible to check for other files here
		if ( file_exists( $dir . "/wp-config.php" ) ) {
			return $dir;
		}
	} while ( $dir = realpath( "$dir/.." ) );
	return null;
}

define( 'BASE_PATH', find_wordpress_base_path() . "/" );
define( 'WP_USE_THEMES', false );
global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;
require(BASE_PATH . 'wp-load.php');

echo 'Begining Import Process';
echo PHP_EOL;


update_option( 'woocommerce_recommender_build_running', true );
update_option( 'woocommerce_recommender_cron_start', time() );
set_time_limit( 0 );

try {
	$builder = new WC_Recommender_Recorder();
	$builder->woocommerce_recommender_begin_build_simularity( false, 0 );
	update_option( 'woocommerce_recommender_cron_result', 'OK' );
} catch ( Exception $exc ) {
	update_option( 'woocommerce_recommender_cron_result', $exc->getTraceAsString() );
	echo $exc->getTraceAsString();
}

update_option( 'woocommerce_recommender_cron_end', time() );
update_option( 'woocommerce_recommender_build_running', false );

echo 'End Import Process';



