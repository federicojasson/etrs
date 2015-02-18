<?php

/*
 * This script deletes the inactive sessions.
 * 
 * It should be executed periodically. Recommendation: once an hour.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

// Includes the application
require ROOT_DIRECTORY . '/private/scripts/application.php';

// Serves the internal request
serveInternalRequest('/session/delete-inactive');
