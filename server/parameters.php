<?php

define('DSN_BUSINESS_DATABASE', 'mysql:host=localhost;dbname=etrs_business_database;charset=utf8');
define('DSN_SERVER_DATABASE', 'mysql:host=localhost;dbname=etrs_server_database;charset=utf8');

define('OPERATION_MODE_DEBUG', 'debug');
define('OPERATION_MODE_RELEASE', 'release');

define('PHP_DIRECTIVE_GC_PROBABILITY', 'session.gc_probability');
define('PHP_DIRECTIVE_SESSION_LIFETIME', 'session.gc_maxlifetime');

define('ROUTE_GROUP_ANONYMOUS', '/anonymous');
define('ROUTE_GROUP_DOCTOR', '/doctor');
define('ROUTE_GROUP_OPERATOR', '/operator');
define('ROUTE_GROUP_RESEARCHER', '/researcher');

/*define('BUSINESS_DATABASE_DSN', 'mysql:host=localhost;dbname=etrs_business_database;charset=utf8');

define('HTTP_STATUS_FORBIDDEN', 403);
define('HTTP_STATUS_UNAUTHORIZED', 401);

define('PASSWORD_HASH_ALGORITHM', 'sha512');
define('PASSWORD_KEY_STRETCHING_ITERATIONS', 100000);

define('SERVER_DATABASE_DSN', 'mysql:host=localhost;dbname=etrs_server_database;charset=utf8');

define('SESSION_KEY_LOGGED_IN_USER', 'logged-in-user');

define('USER_ROLE_DOCTOR', 'DR');
define('USER_ROLE_OPERATOR', 'OP');
define('USER_ROLE_RESEARCHER', 'RS');*/
