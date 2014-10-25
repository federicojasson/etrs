<?php

/*
 * This script defines application-wide constants.
 */

// HTTP content types
define('HTTP_CONTENT_TYPE_JSON', 'application/json');

// HTTP headers
define('HTTP_HEADER_CONTENT_TYPE', 'Content-Type');

// HTTP statuses
define('HTTP_STATUS_BAD_REQUEST', 400);
define('HTTP_STATUS_FORBIDDEN', 403);
define('HTTP_STATUS_UNAUTHORIZED', 401);
define('HTTP_STATUS_UNSUPPORTED_MEDIA_TYPE', 415);

// Operation modes
define('OPERATION_MODE_DEBUG', 'debug');
define('OPERATION_MODE_RELEASE', 'release');

// PHP directives
define('PHP_DIRECTIVE_SESSION_IDLE_LIFETIME', 'session.gc_maxlifetime');

// Route groups
define('ROUTE_GROUP_ANONYMOUS', '/anonymous');
define('ROUTE_GROUP_DOCTOR', '/doctor');
define('ROUTE_GROUP_OPERATOR', '/operator');
define('ROUTE_GROUP_RESEARCHER', '/researcher');
