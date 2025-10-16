<?php
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wpuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'strongpassword' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 * You can generate these from: https://api.wordpress.org/secret-key/1.1/salt/
 */
define('AUTH_KEY',         '5k|8FU~(VX=P-`.`OvFhI:L`M`<;,%4L+G0K$}C*65GvR ?OXsA6a)Pq;RRg}UkI');
define('SECURE_AUTH_KEY',  'v+F&|hTsd2P8XAtA[HCI6h-Qfpx=G+X|lfSa&p?FS<kw%Q-Yp;0{-qI-VvaiPtA{');
define('LOGGED_IN_KEY',    '6GLMh4N./`*F/6/-C8O^gcxab9gc=Z6U:~@aJtvn|=b8F,<^@gRtEZ@>RRb|0#|V');
define('NONCE_KEY',        'D`EPEx^!{q/:xw(}<;^a.r  /Ey4~yHGrz<^whN_M$fG-n&Sj;d!bZc;/tr%*pDc');
define('AUTH_SALT',        'Ot7MNuBZ:Dw7[DMe5${b;8HUyfyTiYtB0g+:{S)DD&Vor<5+49GBFzNZ5%Q4;t 4');
define('SECURE_AUTH_SALT', 'Q%o3%]0d/mfRI7PKOWwOtrbz((u_DqZm=H5S)*KMS!9B~_-lkv&*ifrP:MYV:6>n');
define('LOGGED_IN_SALT',   '!oB?L@B@}hNPe2O=]8TRno@:KWqMh_}Y#dWj>:oe Lj:.s<[sE:QzLe&++=K>)*=');
define('NONCE_SALT',       ';CbT`Rsq6EaF2i:cm,m1E-uZ=|=B6-X67{4#os(_e%)2(X#R{>Kp$2V-bZVT/fC4');

/** WordPress Database Table prefix. */
$table_prefix = 'wp_';

/** For developers: WordPress debugging mode. */
define( 'WP_DEBUG', true );
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy publishing. */
if ( !defined('ABSPATH') )
    define('ABSPATH', __DIR__ . '/');
require_once ABSPATH . 'wp-settings.php';
