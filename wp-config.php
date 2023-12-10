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
define( 'DB_NAME', 'ecomerce' );

/** Database username */
define( 'DB_USER', 'Hennita Gultom' );

/** Database password */
define( 'DB_PASSWORD', 'HGH231ke.' );

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
define( 'AUTH_KEY',         ';-5DDpuY#(3Q;vv|e:;J8$n {Y*XE=f*rQB,dY#>9dEH)& }k1.DU:2yetz|`d_M' );
define( 'SECURE_AUTH_KEY',  '[`&==EwUP+ze_T:BZxGD8zjS+G Y$yexO4>pW.;>Jj5>tavV^D8VtB 2(m&6~hqo' );
define( 'LOGGED_IN_KEY',    'OqB>]~C7/g@j6-EJP!;(0w?M|P6^4)8d4MU9@VKUz/[Wmxe|B $8{0tR0MLB?3gE' );
define( 'NONCE_KEY',        'aX MOw9m @3l;gBBH@?@}|,I_hI[K>4@dbo8<rZBl=JS$r!p70xsp^GYO.}LV gI' );
define( 'AUTH_SALT',        'QC-D/w(v`7o-0Xe@Ws?x8N<3[Y4p@Jt]-`FL~NL#xR31!YR2!w|HK2v)aD#11s71' );
define( 'SECURE_AUTH_SALT', 'KkC4g?MV8O)Muv-dz8HLi4I@I.)^Pzq-KM@L=(??3T|Dzz46YUz<r}ri52wbC:ZG' );
define( 'LOGGED_IN_SALT',   'o};A<KOH}.:U0xg_f5fBwg`qZzS+x<CX-Pn+[!t&FGP$Dis5mAb-b{U$p4qTHZvH' );
define( 'NONCE_SALT',       'SiHwI&e*jqS}kC}qwC-<6UvF!?f#0$71?<q$!=64*h:mWqWB8fPgdEfk@<C+Zc?Z' );

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
