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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_MEMORY_LIMIT','64M');
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );
define( 'DISPLAY_ERRORS', 0 );
define( 'SCRIPT_DEBUG', true );


define( 'DB_NAME', 'unbox_local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '2mPrUAqiISzjvtpsKbHHEbyplPacoEJeSVhxejy4grUgFk7lYyn3yHu/EwpxkQqvXwHP9i1rEy7mCBxLBaAoXQ==');
define('SECURE_AUTH_KEY',  '53QBs7tV1v4xTyIS6CSUJrR9Ijrt/q/EmKpTif1Jx/j/KW2OWE9/aAh7QNUlPt6mDJKoxC1s7ZlqY8iy8SIskw==');
define('LOGGED_IN_KEY',    'miP6Ms3OqPNDKafv9bzyGjr52PffF4kKcJVnz/ImD52/CizCQsHNY/CgMoEANs9Dqr8W/0gjnxH85ogfezfivQ==');
define('NONCE_KEY',        'YtPgcZ5XufYNvt287SBA2KeQt17gpptxnO/FfOe4VSpel3gVUI4RyihBWG2u7GXhFqPqGcDxQMxqqIXm34Rikg==');
define('AUTH_SALT',        'PxjvHx5/YiuKlX9w4TACZDQgau+PT9pFENMlAXTd7oBBY2ZdzDmL4AVhpHkBMui1LecGrURqCIouYWZe5aQGlA==');
define('SECURE_AUTH_SALT', 'w+ZUfM0FXfhnCmj6pV9ZSDkVOJS8/meKFFOB4BOUzrpktSmW3HkexzpU232QmdteYMxk4UOjzHkt3hETSVInug==');
define('LOGGED_IN_SALT',   '+axaQZ5Q2R0DFc3lW4y45l9yfFh7Z58x9Kd9SeF4RBwQA284JsrsAZw270hFOR6O6Hh0PSeaLeJ8f/gzSHNXqA==');
define('NONCE_SALT',       'ELWbTR8iaz9DRMFZiX35zF2diI+B2fhIw9lPdd5V4rnhfFLf2mFHV7Btdm65iJg8MtCK6VpitZ18Ck588HvObw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

