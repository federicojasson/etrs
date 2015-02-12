<?php

/*
 * This script clears expired permissions.
 */

// Defines the root path
define('ROOT_PATH', __DIR__ . '/../../../');

// Includes resources
require ROOT_PATH . 'private/scripts/resources/cron-job-utilities.php';

// Executes the cron job
executeShortCronJob('execute');

/*
 * Executes the cron job.
 */
function execute() {
	// TODO: implement
}
