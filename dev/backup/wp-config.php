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
define('DB_NAME', 'db630488467');

/** MySQL database username */
define('DB_USER', 'dbo630488467');

/** MySQL database password */
define('DB_PASSWORD', '8message');

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
define('AUTH_KEY',         'Pg*8#m)2]ouJ7Pq*:%leNKeH]MD}x5M@Dj+.$z]gg??x|yyx^fae~6+`au|j>==C');
define('SECURE_AUTH_KEY',  'cG$-tg)Q#TeC(6-a8qc9r2#+(uEBNa g8IR-C}PjbI.-e,yP}dGo?Fg-gD}u{`k|');
define('LOGGED_IN_KEY',    '<A++>L$d2;P(3,oXmPdM+wr|||7p`V{RheDh6?u93>?FlrP~PNCK+a]%mz{/:wM@');
define('NONCE_KEY',        'f %Iw+m^/1oRGpq!*G7{*tAx;+*wkshb^WZ`hCB2-vRuAA[>L5:2PS!Uz|rcJ[Z[');
define('AUTH_SALT',        '$]9u|y!+6-E5rmG{?2xVK ,RSYBW2DyqP*0nk[)chtr%(k}N/OoJTjepP275k9+u');
define('SECURE_AUTH_SALT', 'q;DBtr{&mA>|Nwk/< P3<Qv##kt=m(Qq[FK-.9X~+~`p[|SnX-_z/Z((F@L>l%L@');
define('LOGGED_IN_SALT',   'M O1H.5Q`x,kme{_Q8&zRs,Dw4Lht1|soNYN]9Fr*?YGLX4v7zMw<vq?H`qn.#|O');
define('NONCE_SALT',       '%VYvaV~8|0-qt,DEk*unN:[+)!:RS/fmV7wLFP)$GgSZ^~Dc58LYff?rd9&UXk+[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'rest_';

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
