<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_wordpress' );

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
define( 'AUTH_KEY',         'X~#]-/BMlSMKA[Xn$<&F/k_V)#8h}L$zqkk;mg`xPJS`,|=)CeZh8p<9;=3L9R{+' );
define( 'SECURE_AUTH_KEY',  'Aa`y|p_0.o{#(e&?VhE`l_nz:Stm%:<ffEx%zA(q;[m[Z:APg>n,B<xEGb@pgV3p' );
define( 'LOGGED_IN_KEY',    'B0%=vo[TU`ba5Z jXu):~uG_EFK4ALl:%>RgLwO8~Q$Fgd[qff2#J%#P35u ZF+S' );
define( 'NONCE_KEY',        'pr>|^E ?s~{Cv%-A:|NjvxUkPBu+~3ss|5ja?D5XC?wuA<*~=Q<kQ8#isrS0+z@^' );
define( 'AUTH_SALT',        'P9%Ac$UZs`02I{i0{4}0<s++x8LP@;g;|2@3^]2H~_b0oS^>qRq+Hp(4>}fl/tqQ' );
define( 'SECURE_AUTH_SALT', 'CXc`g8x6K(4EgudA50W80BA79pH&-fnq}{_H.WEA>=M cBEw&`$.A11B=b)9QH%F' );
define( 'LOGGED_IN_SALT',   '3Lp=7Jkwc#ah1Iew-SOJvJ PY+CU2l&|Vo^22A13Y;bAg};bk;;~zvp{mf!<$.7*' );
define( 'NONCE_SALT',       '-T!H>2oE*65o}i?[Ms#~m<1CZDRXcd5Km~+ndfNKI2S<N<nf9PGkYky%0)W0NU7.' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
