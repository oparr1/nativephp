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
define('DB_NAME', 'dbname');

/** MySQL database username */
define('DB_USER', 'username');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', 'servername');

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
define('AUTH_KEY',         'pj:?5:LkUGfc`LQ%sc_*<`vFE+R%y9i/yys0`>E7 F30QO){qp$Zx,+`L dy6)c4');
define('SECURE_AUTH_KEY',  'b%f^1RC*d^Ims .p{8-zHH|+%+&H>`3RT3?{=FQ+ Ez#blC-R(s1~,yc)(/!KP~x');
define('LOGGED_IN_KEY',    '5/<q{nm{?[-&iTyW`*5*p`s^LQGIST:?:JV04P/+&%$k};&V8.iK|)=0?[4%~3|r');
define('NONCE_KEY',        'e~uUHC=9dIE@GxC8>4-gtk;]n_hjg&X,C:{s8$,IHjo>vvFfMV2{nMztZtI}79I;');
define('AUTH_SALT',        '.6J.AOX?g]?|/jMQaWRjc8z[}kGsEsf_5;j4~5015%Ub=wJ_@(PdMkcjI%*aT)+c');
define('SECURE_AUTH_SALT', 'Zf?PX!CO7CM{_Vke2|#~cx{u89H|ETQOp712Iy_g}U3>&ATT&@T(Hjp-SF[vYei*');
define('LOGGED_IN_SALT',   'oeq|MdioE0 gdPC.qm>ZQ||D*J^7;239/.NID:t~,v|-~!D#;DWl|>Ko,V;x2N|@');
define('NONCE_SALT',       '![lAu+(|>Y9@0w2~9b^%?9t<[p8nyjGT;d+6TQ$OSBk3S[QKW;5[qL:+GQC$qY^Q');

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
