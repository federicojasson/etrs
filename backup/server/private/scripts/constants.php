<?php

/*
 * This script defines application-wide constants.
 */

// HTTP content types
define('HTTP_CONTENT_TYPE_JSON', 'application/json');

// HTTP headers
define('HTTP_HEADER_CONTENT_TYPE', 'Content-Type');

// HTTP methods
define('HTTP_METHOD_POST', 'POST');

// HTTP statuses
define('HTTP_STATUS_BAD_REQUEST', 400);
define('HTTP_STATUS_FORBIDDEN', 403);

// Operation modes
define('OPERATION_MODE_DEBUG', 'debug');
define('OPERATION_MODE_RELEASE', 'release');

// Session keys
define('SESSION_KEY_LOGGED_IN_USER_ID', 'logged-in-user-id');

// User roles
// TODO: long string or DR, OP, RS?
define('USER_ROLE_ADMINISTRATOR', 'administrator');
define('USER_ROLE_ANONYMOUS', 'anonymous');
define('USER_ROLE_DOCTOR', 'doctor');
define('USER_ROLE_OPERATOR', 'operator');
define('USER_ROLE_RESEARCHER', 'researcher');
