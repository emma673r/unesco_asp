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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'emsportfolio_dk' );

/** Database username */
define( 'DB_USER', 'emsportfolio_dk' );

/** Database password */
define( 'DB_PASSWORD', 'commedabitude!' );

/** Database hostname */
define( 'DB_HOST', 'emsportfolio.dk.mysql' );

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
define( 'AUTH_KEY',         'h{:+Tt[b ]R,S?`Acju!!SGI+~Lz5?wnP_39_8,?[,5>v/sxZ2UKx*4lAnO)[xWC' );
define( 'SECURE_AUTH_KEY',  'VOj:&s1It+&17:fh7#^:3{&-P^52P^}RhN.<D>#G4;ewf_T)Vkktw38P 6q>8YhU' );
define( 'LOGGED_IN_KEY',    '`Pn])fVBcghG%Z/Fh-bqCZI9pkxQqrDJ5ZE~U]J;kcQ^=hAGB-HI~!6Fu49}Tn~}' );
define( 'NONCE_KEY',        'E=qV+0B7zR[/0NFp@K[gSm/07X=?&oNYtdy!Wv=&on1E-! Om#D<(w#F$Fo$RK8e' );
define( 'AUTH_SALT',        'unrga.W7bO3jR}b16x#32=MCGv!;{|E1Vh%SY7_KsS0;lPFxup]nBh>lAXiLmx9)' );
define( 'SECURE_AUTH_SALT', ')ti-aiH]^pk9$uzuB*6Q85l_e@qdlRkMk4zyP?XuN}NVFf5YDBpYM2[Pq(N3<sxx' );
define( 'LOGGED_IN_SALT',   '+GK#P@I$x@ W{tA-/b uS+4TwMu4SXd%RJbFNGjj<SY5>}x[=O& L2QQP{*x*`oM' );
define( 'NONCE_SALT',       '!!+g-PI&3n+4Rd~{hm/1lq0JD4m=NByFql?@pk9Y6N8fj$v%0M(M13}f!,3^eu%{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'unesco_asp_wp_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
