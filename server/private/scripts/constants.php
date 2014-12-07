<?php

/*
 * This script defines the constants of the application.
 */

// Configuration IDs
define('CONFIGURATION_ID_BUSINESS_LOGIC_DATABASE', 'businessLogicDatabase');
define('CONFIGURATION_ID_WEB_SERVER_DATABASE', 'webServerDatabase');

// Error IDs
define('ERROR_ID_INVALID_INPUT', 'INVALID_INPUT');
define('ERROR_ID_UNAUTHORIZED_USER', 'UNAUTHORIZED_USER');

// File paths
define('FILE_PATH_CONFIGURATIONS_FILE_PATHS', 'private/configurations/file-paths.json');
define('FILE_PATH_LOGS_DEBUG', 'private/logs/debug.log');

// Hashing algorithms
define('HASHING_ALGORITHM_SHA512', 'sha512');

// HTTP content types
define('HTTP_CONTENT_TYPE_JSON', 'application/json');

// HTTP headers
define('HTTP_HEADER_CONTENT_TYPE', 'Content-Type');

// HTTP methods
define('HTTP_METHOD_POST', 'POST');

// HTTP statuses
define('HTTP_STATUS_BAD_REQUEST', 400);
define('HTTP_STATUS_FORBIDDEN', 403);

// JSON structure types
define('JSON_STRUCTURE_TYPE_ARRAY', 'array');
define('JSON_STRUCTURE_TYPE_OBJECT', 'object');
define('JSON_STRUCTURE_TYPE_VALUE', 'value');

// Operation modes
define('OPERATION_MODE_DEBUG', 'debug');
define('OPERATION_MODE_RELEASE', 'release');
