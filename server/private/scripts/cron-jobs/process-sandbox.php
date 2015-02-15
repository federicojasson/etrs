<?php

/*
 * This script processes the first sandbox it finds.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

// Includes the application
require ROOT_DIRECTORY . '/private/scripts/application.php';

// Serves the internal request
serveInternalRequest('/sandbox/process');
