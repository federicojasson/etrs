<?php

/*
 * This script clears orphan files. Orphan files are those that are not
 * associated with any entity of the system.
 */

// Defines the root path
define('ROOT_PATH', __DIR__ . '/../../../');

// Includes resources
require ROOT_PATH . 'private/scripts/resources/cron-job-utilities.php';

// Executes the cron job
executeLongCronJob('execute');

/*
 * Executes the cron job.
 */
function execute() {
	// TODO: implement
}
