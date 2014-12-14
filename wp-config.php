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
define('DB_NAME', 'new-wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'a');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ')UKA*]0c-G+Tfop@VUy&Lp^R?/:Zv`,| [=W|%%%|2822cJ{O|Hn:v;W.rNuBZDq');
define('SECURE_AUTH_KEY',  'cK*rF@;d$sfBFD5Fh[+:4q-e]kKmGS]bUO+I-a)3(X:@fGg-2cMsz`{LKQ?Q$&WG');
define('LOGGED_IN_KEY',    'b;_d:i&uF%^P,G$%=|iWX7mIyAFGn4vmziL--T>zS-5~IyV#$@Ql{U?H(|nVN|GJ');
define('NONCE_KEY',        'kr|QLy$WxL=YmG{IJ=a[*>#b*cgsEF+TXKKYtuw=|_#Qy5[TH=SRWmzb?;M{G3J+');
define('AUTH_SALT',        'i:pM2G!m7?ylB>PI(5OEO&f621H;OAZ#NW]#.(^EhT45|~4PP[K|05&Y?vs6)&.&');
define('SECURE_AUTH_SALT', '+,s=$qFi<tPZW <5)?uaB/eV5,if$2:dK.|)/f.`U9ygGRl/hq<z3vnS!|$KAjvy');
define('LOGGED_IN_SALT',   '-p|HBqc^qf_Cnh`RCUv%o{CFBh6@+%ed3Ck}%f l}qO|}}vZufES-IGkMMR~-[Rq');
define('NONCE_SALT',       'w(N `j$d4W7Tgf<dZu$+Msz-+c=D_)Ns(0|Kw=m8byG39HJa{ K#em/E5lta8~)}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
