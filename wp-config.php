<?php

// Configuration common to all environments
include_once __DIR__ . '/wp-config.common.php';

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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'admin_prop' );

/** MySQL database username */
define( 'DB_USER', 'admin_prop' );

/** MySQL database password */
define( 'DB_PASSWORD', 'pxw*951pxw' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'qd-U-D9Ix@a&R(o:T;^>+lnl@xV]?Ej!S}`#8~MiW<M3jGab#^4N}&_ql@j@[fQ.' );
define( 'SECURE_AUTH_KEY',  'XbsB.ILIqnU>-iDV]4FIBvAT>5Zj7Y7N5eRBgod;2RWZ-APORb11KAmH^[qSfD3o' );
define( 'LOGGED_IN_KEY',    '9j Oy?`g-X{g1GOU:>9:<g,!&B<0Vgu%Nr&P;`1Sku|/Ee`&};NOETIXgaf@.ou9' );
define( 'NONCE_KEY',        'QLs~|vD^?H}=u|v[:2Jau)fii$U!q1p!30~zF<X@?TxPHJ3?n0$9`n-)=@*y,6{a' );
define( 'AUTH_SALT',        'FhK#Is1;S9Pv5-=Ii:kRz H_(~L4-q:N~rAj]84-%413Ool79wHNaI09Qs^II*l}' );
define( 'SECURE_AUTH_SALT', '/n(S{0p:euP)$k E=HYfHiccIL,@`>EV5M*QUzp^89gwO:&0H*oB2Y]SJ~Ei8V5[' );
define( 'LOGGED_IN_SALT',   '5rM>p@QbCz-l5mD5bxS{3BlZ~vZun2T;*=&m_ehba1/}3!`KC#Er7wRcU5pGDoM$' );
define( 'NONCE_SALT',       '@yWdk;5GESE(iQGU}?R3tnn5wJXB4)SCP|V7:vr<,OHaa3O @K~ES]776HQ)<X#=' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'prop_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
