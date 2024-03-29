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
define('DB_NAME', 'pgalvao');

/** MySQL database username */
define('DB_USER', 'pgalvao');

/** MySQL database password */
define('DB_PASSWORD', 'h2d7Hsg6f');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'R^cEEBd;L5966_@%s8Oh@;s2D]Uoan76O#A;|$@5R(5`Rnw:91^]0]!j%`|Lgx6j');
define('SECURE_AUTH_KEY',  'f*A|cd4)L~awndq1h@^lm |))W|-u),0D14B4JnKZIF^79o!o(u@xogM*-=z:F2/');
define('LOGGED_IN_KEY',    '3aLkN0]YYaHj-qpNc%:6:_%*B6c^oSsjqxux>H^mc~)VM(QSy1v?k~U`qj~wdb-z');
define('NONCE_KEY',        'P0+ecZ>pn4/gcO2Y2qbD]%gBY!<E}Gl|L`e#9f+?pQP|&HJi={M6(*-4SzK6i],%');
define('AUTH_SALT',        '9/~uQR^~{tN)xZf:E4^|Ho3UK=cFYNB|iP5;>|Oy<.~LJxN.c!+Omi.aG{PI.,u*');
define('SECURE_AUTH_SALT', 'VEkL;2OY8p]c{P,aXbuLtUVX.T~stmDi7dH&+}cl *{Xd4[?764/9~K|64+&mh+@');
define('LOGGED_IN_SALT',   'j8}Zh,+{:|d%b/1s4@pWKnUU6E$Ny=g;u9j.hl+^T!.QW2Y9w2l[zK7?4IZ B.Zp');
define('NONCE_SALT',       '7k-NM,n7D..r,|IBDxjkwIhHSQm }yxYp|BO6-gq+a<]%>=B-iMS_>|<tiYJ.|mO');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'pt_BR');

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

//Para desabilitar o cache
define('WP_CACHE', false);
define('DISABLE_CACHE', true);
