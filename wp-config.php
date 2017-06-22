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

 $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


//IF HOST IS PROD

if (strpos($url,'.com') !== false) {

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tenant_essentials_prod');

/** MySQL database username */
define('DB_USER', 'mvalen1221');

/** MySQL database password */
define('DB_PASSWORD', 'Ma301934485');

/** MySQL hostname */
define('DB_HOST', 'localhost');
 
} //END IF HOST PROD

//IF HOST IS LOCAL

if (strpos($url,'local') !== false) {

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tenant_essentials_dev');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

} //END IF HOST LOCAL



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '7Fo+#bxC}=~IG}FC>D,?K<H57v=R;Ii9IiJ>$%^RJO@+tP<$manA6K(#GGbC^^jE');
define('SECURE_AUTH_KEY',  'PofHHi6=51F 60+,5C<>YcV%C}.;A?uiyYl:3Jf3Li|qLK*TT3EVx$3i=CDK5]~[');
define('LOGGED_IN_KEY',    '{H0:?+9(*ZPz=hBUO,(QEemyQ5Q-MBVP3eyS+F~)O{b5Qph0>thX *AX,Pei-E$~');
define('NONCE_KEY',        'u2%pj(w_Rf=0Dbs`4w11n;p;TX_Y9+BwAKQ|3^x`I=>Q+%.eB%rkzx}[v/;|PQ[&');
define('AUTH_SALT',        '?(uEYTTI@r`-&hCye5cR@0V=^b5kPI97L/sVp;|wk1doGFC5xK2<~L||fZJC77%P');
define('SECURE_AUTH_SALT', '<qIeb01[[dE_3zSqH-f{uPBm3IN~zO&W8|& -kS-|cexb]c*r~wy={?<s@HT|bda');
define('LOGGED_IN_SALT',   '5v&#y_QjjA@AhXv!Z#n[1VEfp6J4I,]uqj-508GV`pV}x+RX1-Nk7wppjIB)#-3a');
define('NONCE_SALT',       'Eyvcxq]<d(c Eq|BtmS5=R7Wd6KN:JmpT uKa|, |RnV9,]y16qL^Z[(9$9)(sn0');

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

define ('WP_MEMORY_LIMIT', '256M');

define( 'WP_MAX_MEMORY_LIMIT', '256M' );

define( 'WP_ALLOW_MULTISITE', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

