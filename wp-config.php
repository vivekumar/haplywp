<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

$servername = "localhost";
$username = "root";
$password = "Admin@123";
$dbname = "happly";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT * FROM haply_wp_multidomains_theme";
$result = $conn->query($sql);


$rows = [];
if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
} else {
	//echo "0 results";
}

$conn->close();
$searchDomain = $_SERVER['HTTP_HOST'];


$domainNames = array_column($rows, 'domain_name');

// Use array_search to find the index of the specified domain
$index = array_search($searchDomain, $domainNames);

if ($index !== false) {
	// Match found, return the data for the matching domain
	$BODY_CLASS = $rows[$index]['domain_name'] == 'happly.local' ? '' : 'body-black-theme';
	//print_r($rows[$index]);
	define('WP_HOME', 'http://' . $rows[$index]['domain_name']);
	define('WP_SITEURL', 'http://' . $rows[$index]['domain_name']);
	define('THEME_NAME', $rows[$index]['theme_name']);
	//define('THEME_COLOR', $rows[$index]['theme_color']);
	//define('THEME_BACKGROUND', $rows[$index]['theme_background']);
	if ($rows[$index]['theme_name'] == 'black') {
		define('THEME_COLOR', '#fff');
		define('THEME_BACKGROUND', '#222');
	} else {
		define('THEME_COLOR', '#fff');
		define('THEME_BACKGROUND', '#129E41');
	}
	define('THEME_LOGO', $rows[$index]['theme_logo']);
	define('FOOTER_LOGO', $rows[$index]['footer_logo']);
	define('THEME_FEBICON', $rows[$index]['febicon']);
	define('BODY_CLASS', $BODY_CLASS);
} else {
	define('WP_HOME', 'http://happly.local/');
	define('WP_SITEURL', 'http://happly.local/');
	define('THEME_COLOR', '');
	define('THEME_NAME', '');
	define('THEME_LOGO', '');
	define('THEME_FEBICON', '');
	define('THEME_BACKGROUND', '');
	define('BODY_CLASS', '');
}


// define('WP_HOME', 'http://happly.local/');
// define('WP_SITEURL', 'http://happly.local/');

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'happly');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', 'Admin@123');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'xS8a~MXhg5d~/-.64q}Ddm1t%9@$)M|,7+p(e>mDv<uK{w}:KG>,X,NQLbUv9U2x');
define('SECURE_AUTH_KEY',  'Xu={QlpqX44$4-KS{_sh#|Y#U2[B D-5!? S*>HbJ];JhFYy[>u*%.3R5l1zQ?nW');
define('LOGGED_IN_KEY',    'Ux*i%,qGeWg3h`XQMzea*&-eK-fv[:*p494Z>7e}lq?$+Kz ^F$ [=^tcI~pl7]]');
define('NONCE_KEY',        '>l^~|ebUm0k-|@x7FVP`39#f@SZBBaTnuFVWuo3uZ5:;b~!4=.AnQ9`d1CYRh7.q');
define('AUTH_SALT',        '^?C. poD%lpGoo dk9:pBj=FgXH{n_,7eK3:}_Bc@]&QURKN+[ne_DDI9m7bVJDQ');
define('SECURE_AUTH_SALT', 'mrH!)J*(*?hao*T&JdQ9<tM8/wlPRe:T#@(]?I?*&K$P+[jFZY,2L-7]#:xNTE%>');
define('LOGGED_IN_SALT',   'b*w!n*j)6DBnB*<o9{g~&ikegaajmn=ez+.^Kim*r<qf3ZmoW5Es(o?;>vEf3{2$');
define('NONCE_SALT',       'W#!0MWmc1:R}SGy=y~k,j[`h)xd{%@gaDb?NbCdjEOiiYynk`Mpiq7bu|AYO>`Sj');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'haply_wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);
define('FS_METHOD', 'direct');

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
