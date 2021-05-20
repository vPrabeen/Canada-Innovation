<?php
/** Enable W3 Total Cache */
 //Added by WP-Cache Manager

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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
 //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/sparkl41/public_html/bc-mortgage-broker.ca/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'sparkl41_wp101');

/** MySQL database username */
define('DB_USER', 'sparkl41_wp101');

/** MySQL database password */
define('DB_PASSWORD', 'B8EP!37.0S');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'basltihu7ik842mzoewpsosknvoiferwcsvdk6rrcema8fbsb6vxflnarmjzlryi');
define('SECURE_AUTH_KEY',  'e9jpxnuel7d3gprojjdqic9tlctugjwzyjqgz3ejmt5unjbezfurygnk3o6wppoy');
define('LOGGED_IN_KEY',    'vxsvftnakjijtlt8crk4mmipnvb19oyofarifxauoygy5ljpelfikzydahafjljl');
define('NONCE_KEY',        'mllg9id4iouwiuydprduycmrtm2cdq2pito8b1blmr4ifqjskrpwt75xvux7mzxt');
define('AUTH_SALT',        'w9srabwgv32ksqs2ib3phgu1xfijihnptiewlwln6pgkvrvwqmq7anaio1ocwnpg');
define('SECURE_AUTH_SALT', 'ykfj32mqva42hkgqdwreqxoomcc5fyluuf0u5yypjd79wo1mo5zb4mjf81wjzpqc');
define('LOGGED_IN_SALT',   'bgbtc87muvwr2ppjwvmijescpsjpil9huqglj5p4r8s5uwlwblezzgiwyzidirpi');
define('NONCE_SALT',       'rfj37vvtyvfsa5oxt51supod7hntyiqg8p0vfhy9cabyamj0wsjxbuv4f2ethjf4');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
