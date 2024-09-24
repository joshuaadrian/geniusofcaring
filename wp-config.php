<?php

define('DB_NAME', 'geniusofcaring_dev');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY',         'nMp[7n:,M+Zv7IW_zw{Y_|hHSZ-|^9j,y;FnaU8<!~XlkshfL`$c-Z93A`kVeXvc');
define('SECURE_AUTH_KEY',  '<=U{Khn`WlX+Z$Wb9p[8YR#^j+?+niiK|76WL[s.{?-8Y~B*1UmxA<sS+.b#;)HG');
define('LOGGED_IN_KEY',    '-^Kgg&?fKg^QF>6P8yeJ,|@-6d$Ib H89.i*$o$])x.~R2AGHI0,z h=>m~(DQ1{');
define('NONCE_KEY',        'EZYcsb*2{`++eLc1:X,?QO+gRYs6-Z<FrlNmCsWtwc-+[18L}$$oga8FrAbwL JD');
define('AUTH_SALT',        ']+i4tD-}|Q+}%9<R~um$-uf-t+}1qb1Ik58kpX+BT&_)4EC2(+:1tg~FZkP*OiZ7');
define('SECURE_AUTH_SALT', '#6!OE`B:-I%MTajsKh`bS</_5N(aXz=P@=tF-EkcqFrGvt?NxtACPvEq%KXo. |7');
define('LOGGED_IN_SALT',   'S=!wK4,SmAd;mFi9ZR(Dg(RJb&ei+1v4eAHC-` ,s1`%C?UuI?9!3QC#R_nzn/%&');
define('NONCE_SALT',       '1_G3{V{[|*e_v<y|27#${L2>vxUh5^gA:YWBH>Ce@{$giG/v6ADfW0]@4,mddp$}');

/* That's all, stop editing! Happy blogging. */

define('WP_HOME','https://geniusofcaring.test');
define('WP_SITEURL','https://geniusofcaring.test');

@ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG', true );
define('WP_ENV', 'development');
define('WP_CACHE', false);
define('SCRIPT_DEBUG', true);
define('CONCATENATE_SCRIPTS', false);
define('SAVEQUERIES', true);
define('WP_DEBUG_LOG', true);

$table_prefix = 'wp_';

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
