<?php

/*
 * This script defines application-wide constants.
 */

// File paths
define('FILE_PATH_DATABASE_CONFIGURATIONS', 'private/configurations/databases.json');
define('FILE_PATH_LOG', 'private/logs/log.log');

// HTTP content types
define('HTTP_CONTENT_TYPE_JSON', 'application/json');

// HTTP headers
define('HTTP_HEADER_CONTENT_TYPE', 'Content-Type');

// HTTP methods
define('HTTP_METHOD_POST', 'POST');

// HTTP statuses
define('HTTP_STATUS_BAD_REQUEST', 400);
define('HTTP_STATUS_FORBIDDEN', 403);
define('HTTP_STATUS_INTERNAL_SERVER_ERROR', 500);
define('HTTP_STATUS_NOT_FOUND', 404);

// JSON structure keys
define('JSON_STRUCTURE_KEY_DEFINITION', '__');
define('JSON_STRUCTURE_KEY_TYPE', '_');

// JSON structure types
define('JSON_STRUCTURE_TYPE_ARRAY', 'array');
define('JSON_STRUCTURE_TYPE_OBJECT', 'object');
define('JSON_STRUCTURE_TYPE_VALUE', 'value');

// Operation modes
define('OPERATION_MODE_DEBUG', 'debug');
define('OPERATION_MODE_RELEASE', 'release');

// PHP directives
define('PHP_DIRECTIVE_SESSION_IDLE_LIFETIME', 'session.gc_maxlifetime');

// Session keys
define('SESSION_KEY_LOGGED_IN_USER_ID', 'logged-in-user-id');

// User roles
define('USER_ROLE_ADMINISTRATOR', 'ad');
define('USER_ROLE_ANONYMOUS', '__');
define('USER_ROLE_DOCTOR', 'dr');
define('USER_ROLE_OPERATOR', 'op');
define('USER_ROLE_RESEARCHER', 'rs');
