<?php

/*
 * This script deletes the old sign up permissions.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

// Includes the application
require ROOT_DIRECTORY . '/private/scripts/application.php';

// Serves the internal request
serveInternalRequest('/sign-up-permission/delete-old');
