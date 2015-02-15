<?php

/*
 * This script conducts the first pending study it finds.
 * 
 * It should be executed periodically. Recommendation: once every 5 minutes.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

// Includes the application
require ROOT_DIRECTORY . '/private/scripts/application.php';

// Serves the internal request
serveInternalRequest('/pending-study/conduct');
