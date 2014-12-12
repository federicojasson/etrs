<?php

/*
 * This script defines the constants of the application.
 */

define('ALGORITHM_HASH_SHA512', 'sha512');
define('CRLF', "\r\n");
define('EMAIL_BUILDER_FROM', 'from');
define('EMAIL_BUILDER_MESSAGE', 'message');
define('EMAIL_BUILDER_SUBJECT', 'subject');
define('EMAIL_BUILDER_TO', 'to');
define('ERROR_ID_INVALID_INPUT', 'INVALID_INPUT');
define('ERROR_ID_UNAUTHORIZED_USER', 'UNAUTHORIZED_USER');
define('ERROR_ID_UNDEFINED_SERVICE', 'UNDEFINED_SERVICE');
define('ERROR_ID_UNEXPECTED_ERROR', 'UNEXPECTED_ERROR');
define('FILE_PATH_CONFIGURATIONS_FILE_PATHS', 'private/configurations/file-paths.json');
define('FILE_PATH_LOGS_DEBUG', 'private/logs/debug.log');
define('HTTP_CONTENT_TYPE_JSON', 'application/json');
define('HTTP_HEADER_CONTENT_TYPE', 'Content-Type');
define('HTTP_METHOD_POST', 'POST');
define('HTTP_STATUS_BAD_REQUEST', 400);
define('HTTP_STATUS_FORBIDDEN', 403);
define('HTTP_STATUS_INTERNAL_SERVER_ERROR', 500);
define('HTTP_STATUS_NOT_FOUND', 404);
define('JSON_STRUCTURE_TYPE_ARRAY', 'array');
define('JSON_STRUCTURE_TYPE_OBJECT', 'object');
define('JSON_STRUCTURE_TYPE_VALUE', 'value');
define('OPERATION_MODE_DEBUG', 'debug');
define('OPERATION_MODE_RELEASE', 'release');
define('PASSWORD_HASH_ITERATIONS', 20000); // TODO: test strength
define('PASSWORD_SALT_LENGTH', 64);
define('SESSION_DATA_LOGGED_IN_USER_ID', 'loggedInUserId');
define('SESSION_IDLE_LIFETIME', 512); // TODO: define lifetime
define('SLIM_ENVIRONMENT_INPUT', 'slim.input');
define('USER_ROLE_ADMINISTRATOR', 'ad');
define('USER_ROLE_ANONYMOUS', '__');
define('USER_ROLE_DOCTOR', 'dr');
define('USER_ROLE_OPERATOR', 'op');
