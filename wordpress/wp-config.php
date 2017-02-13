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
define('DB_NAME', 'dbnew');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '4zwR1~H=>CHp:Qc<}!7 oS}^@M_a:+m#Ww8 b<#yG=w{5#4JpFp,Ib^T<$x1YFBi');
define('SECURE_AUTH_KEY',  '(vV@;EfG7qzhZU@{1Oj^J1F+F1qs}Y83 ]Vw.YyluG74fV:]O9>2XS7h4}]@B2o6');
define('LOGGED_IN_KEY',    'G@L)^-!]F0eRHq*fw3z]_F,>B{xT)I`_F+Mk()&3/TW.D&h}yhq;O=4HxUa{I^~o');
define('NONCE_KEY',        '?C%~y?k|vI6Qy^>l4Ls*{S63s2J220e-q,#~^&gSDHURQ*QrFQ1kTm#}3|#LYEI,');
define('AUTH_SALT',        '&R@8g)Y8*#u%&h3]xNjp0i}Ec9^u2?%QW&lgZ(m1jDBafQ#Vq$&[N(C41Rj1);?4');
define('SECURE_AUTH_SALT', 'YR>$kI.78M__IJwY`Ulk`O_BxBr/2$Ows7Zr.3VG%CB~CQKH`?^5Sql{)@-Du xv');
define('LOGGED_IN_SALT',   'K<sYP8F`N%ot3d$;APWY^K7Gcr12GF(;90D>EhFeqlX>ml-B{uiU{w/<~J5P(FT$');
define('NONCE_SALT',       '{!0/jk!aaMnQAIp%TDv6DRvRnQKRkm}s#F.N$/COm+R9uaA_lE!Dgz,/h8;9;O ;');

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
