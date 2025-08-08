<?php
/** 
 * The base configurations of the WordPress.
 *
 **************************************************************************
 * Do not try to create this file manually. Read the README.txt and run the 
 * web installer.
 **************************************************************************
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'web_tokyotown_vn');

/** MySQL database username */
define('DB_USER', 'demo');

/** MySQL database password */
define('DB_PASSWORD', 'demosofv.2');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('VHOST', 'no'); 
$base = '/';
define('DOMAIN_CURRENT_SITE', 'tokyotown.vn' );
define('PATH_CURRENT_SITE', '/' );
define('SITE_ID_CURRENT_SITE', 1);
define('BLOGID_CURRENT_SITE', '1' );

/* Uncomment to allow blog admins to edit their users. See http://trac.mu.wordpress.org/ticket/1169 */
//define( "EDIT_ANY_USER", true );
/* Uncomment to enable post by email options. See http://trac.mu.wordpress.org/ticket/1084 */
//define( "POST_BY_EMAIL", true );

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link http://api.wordpress.org/secret-key/1.1/wpmu/salt WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '2fe36652ba50f1d0eb8b10d14619ab9a5a8eb19713fca334ec66b58b8a3fbf9f');
define('SECURE_AUTH_KEY', 'fc086fb230da0fe532d68131071a75b6662abc79f140826b1530f190099c6aa8');
define('LOGGED_IN_KEY', '435ebfd457575042230d70ffad7a97797ad1a37a7de47e81927fd5e405b5994d');
define('NONCE_KEY', 'fd1f4ac381d65f413f23c6b8086af625a1e22baa3403ff4e5c7fed2a1d786c14');
define('AUTH_SALT', 'fece8c7990235b166f7960187fd249a5137201ec917ac9cbb1ce209acf8941b3');
define('LOGGED_IN_SALT', 'd67c0ea58f4963fb5cc21f6ae54c0a0fed3cb84fbc17d792de4c11b96b439e78');
define('SECURE_AUTH_SALT', '8d28b7d87680e943f5403b43e846f9c0787f4082f0749052e67326b1f3e22ae4');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sof_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

// double check $base
if( $base == 'BASE' )
	die( 'Problem in wp-config.php - $base is set to BASE when it should be the path like "/" or "/blogs/"! Please fix it!' );

// uncomment this to enable WP_CONTENT_DIR/sunrise.php support
//define( 'SUNRISE', 'on' );

// uncomment to move wp-content/blogs.dir to another relative path
// remember to change WP_CONTENT too.
// define( "UPLOADBLOGSDIR", "fileserver" );

// If VHOST is 'yes' uncomment and set this to a URL to redirect if a blog does not exist or is a 404 on the main blog. (Useful if signup is disabled)
// For example, the browser will redirect to http://examples.com/ for the following: define( 'NOBLOGREDIRECT', 'http://example.com/' );
// Set this value to %siteurl% to redirect to the root of the site
// define( 'NOBLOGREDIRECT', '' );
// On a directory based install you must use the theme 404 handler.

// Location of mu-plugins
// define( 'WPMU_PLUGIN_DIR', '' );
// define( 'WPMU_PLUGIN_URL', '' );
// define( 'MUPLUGINDIR', 'wp-content/mu-plugins' );

define( "WP_USE_MULTIPLE_DB", false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
