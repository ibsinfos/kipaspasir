<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'alladein');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '#c[;&+Z5ok!!bKj/]YUZ4at+AUWN^9kdX<},kdOY,$]c8$.?z-O+GEvyHj&:/LLi');
define('SECURE_AUTH_KEY',  '>$tPki5Xv+=I _C_fwP-wI1} J-2pd,M((TL*l ?^?Nz2[^I~I5e822dPOw$X4}P');
define('LOGGED_IN_KEY',    '+!,B%Po+)$JZ%FG8uY]</ZWTNA97*yep sqf2#PxJBzbVUj`VGp%Tb;-b<Dn>uTj');
define('NONCE_KEY',        '`V)QlTCZ^z]NP:8br3-n*5#n*Lwc<JR}FZn*?XS(rY3L$r~3~[9T2`y(+hti4sul');
define('AUTH_SALT',        'A-z.Lp,&+ g--M00C9q3rnF0Zq!+BQ4hV|b~{m7;d8!U13b&aug>D|f]<soZ>BKW');
define('SECURE_AUTH_SALT', 'M(u?8}(_*F,urSH|45=}]r$vgn:>KT.q2Z5*Y]:-<=)B65zzh*}Z[WG4ZFv!AjI<');
define('LOGGED_IN_SALT',   '=}Fv5P6Q0o9.|$I+/_,xXZ3Mz@8)x]+y43#+QJ-:AVcn|NY  ,Kp~W$lRVbjTm+2');
define('NONCE_SALT',       '%Vr:WW/QxJb+,h`oky}auB9E8$9E8p+/JT|UW:K0ZX@N$gWPRIn:Vg|@!<vGjq@O');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ace_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
