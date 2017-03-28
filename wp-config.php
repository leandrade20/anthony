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
define( 'DB_NAME', 'juvoclie_anthony' );

/** MySQL database username */
define( 'DB_USER', 'juvoclie_anthony' );

/** MySQL database password */
define( 'DB_PASSWORD', '+)LQ.2dS#U0!' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         '}&V@K}6}gJc]GylN_$rA9.$dDZgA$WuVi(?hC9([Ws %QJ.l.FJ.xRj|!{@U4!kk');
define('SECURE_AUTH_KEY',  'u/):u?$kKZ[Kr_$q.QU=!qwNEX8k8AJ.2P+[r>,u1nt]N}Ru:cvkx% br #^+TvG');
define('LOGGED_IN_KEY',    'vi@vSydC`/Wu3Uf;29zu6SxBRd[u:m)P&QbbgvSej1`wwi#M3ZlZk!r4b [-l|El');
define('NONCE_KEY',        '45T()F&{>MB}]AL=@wORxj_C;jeeCoX:.!,6%?{~q[q[< 7QPSMPV <O3w`]roOx');
define('AUTH_SALT',        'E]4q(CK/0;34xy],z?_ud3Q#Tk[y/00:(Lyd)5sb%96wG4 n50|*DSzm&uuI!j~M');
define('SECURE_AUTH_SALT', '%LrU|[XoEu>FL$UFf:yp%AzI&]8.;GR3&y1F1AkM#Soh9y@%p|=EIg)3dS+*J>Eu');
define('LOGGED_IN_SALT',   '+~#O?kq.CZ!19x;gSn2TPpbhIeMHvruyL*CgS[OGa<WvxoM6_VpOK}>*%cz$$sRT');
define('NONCE_SALT',       ';O.VOu=x?((7!9Z,bWQb&[;vytrf?CUXS<XVr(IS~-2nzM1 1VNcNaQxQPqS<Qg%');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'bp_';

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
define('WPCF7_AUTOP', false);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
