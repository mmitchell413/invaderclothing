<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// Environment URL parameters
$environments = array(
    'localhost'     => 'localhost/invader',
    'dev' => 'dev.invaderclothing.co',
    'stage'     => 'stage.invaderclothing.co',
    'production'  => 'invaderclothing.co'
);

// Get hostname
$http_host = $_SERVER['HTTP_HOST'];
echo $http_host . '<br>';


// Loop through $environments for match
foreach($environments as $environment => $hostname){
    if(stripos($hostname, $http_host) !== FALSE){
        define('ENVIRONMENT', $environment);
        break;
    }
}

echo ENVIRONMENT;

// Exit if ENVIRONMENT is undefined
if (!defined('ENVIRONMENT')) exit('No database configured for this host // Environment undefined');

// Location of environment-specific configuration
$wp_db_config = 'wp-config/wp-db-' . ENVIRONMENT . '.php'; 


// Check to see if the configuration file for the environment exists
if (file_exists(__DIR__ . '/' . $wp_db_config)) {
  require_once($wp_db_config);
} else {
  // Exit if configuration file does not exist
  exit('No database configuration found for this host');
}

/* That’s all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
