<?php

/*
 * This script clears old logs.
 */

// Includes the cron jobs' utilities
require __DIR__ . '/cron-jobs.php';

\CronJobs\Lock::create('lock', __DIR__ . '/lock');
\CronJobs\Lock::acquire('lock');

\CronJobs\Database::connect(); // TODO: parameters

// Defines the statement
$statement = '
	DELETE
	FROM logs
	WHERE creation_datetime < DATE_SUB(UTC_TIMESTAMP(), INTERVAL :maximumInactiveTime SECOND)
';

// Sets the parameters
$parameters = [
	':maximumInactiveTime' => $maximumInactiveTime
];

\CronJobs\Database::executePreparedStatement($statement, $parameters);

\CronJobs\Lock::release('lock');
