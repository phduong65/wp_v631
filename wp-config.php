<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_v631' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.-9@0UUO^ge+{QQoy95yM,28w*FLQ,p_oJRB w3i(sq;ZKj3r*f~eGY<g)^FiWZ3' );
define( 'SECURE_AUTH_KEY',  'B9Tel| XP* rj&$0k$>bx>B:oH Ok*F@)@ZUolpwNR5LQ+j{w&%Lp7pBvt&N86lw' );
define( 'LOGGED_IN_KEY',    '~sQA.cGKX#;kgm:uU9cJ@sLBL&}?qVYUrknU.1#BIYDFrAnrVA8=47_k>V,BpG=B' );
define( 'NONCE_KEY',        '{jIT$U*`n*_L2V,T{n~&}($E#|@vx6%!bq>59G<x]/-)%wep5H)C)!,z*N?!.8W<' );
define( 'AUTH_SALT',        'IqVT#4,/<fe8x8}G:Nw9,*040[?p Y~/Y%_#-^BJbv?JxPe7$xZ,Kk:fV^4pq/mo' );
define( 'SECURE_AUTH_SALT', '/I)yxkbNZ.HnVoDwSP<%yIbIIt4eSv%OMu-9]!NrY>d ?Ijg/nk}|&>/Wf8XR*_T' );
define( 'LOGGED_IN_SALT',   'Ho7Hh&/h4-^MiRVp`9cp{OIaU-<Tf-ZV+]FX3zj&`<;l{jV;GmzmkBai[|eKKa% ' );
define( 'NONCE_SALT',       'yIYt!a*Mz#l+Sv[CDIGU1+F:gsDenWew7b@:iHSI<AHHcjRLK;N/z@j=$o~r]22N' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
