<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * This script defines global constants.
 */

define('CODE_INVALID_INPUT', 'INVALID_INPUT');
define('CODE_NON_EXISTENT_MEDICATION', 'NON_EXISTENT_MEDICATION');
define('CODE_SYSTEM_UNDER_MAINTENANCE', 'SYSTEM_UNDER_MAINTENANCE');
define('CODE_UNAUTHORIZED_USER', 'UNAUTHORIZED_USER');
define('CODE_UNDEFINED_SERVICE', 'UNDEFINED_SERVICE');
define('CODE_UNEXPECTED_ERROR', 'UNEXPECTED_ERROR');

define('HTTP_STATUS_BAD_REQUEST', 400);
define('HTTP_STATUS_FORBIDDEN', 403);
define('HTTP_STATUS_INTERNAL_SERVER_ERROR', 500);
define('HTTP_STATUS_NOT_FOUND', 404);
define('HTTP_STATUS_SERVICE_UNAVAILABLE', 503);

define('KEY_STRETCHING_ITERATIONS', 64000);

define('LENGTH_RANDOM_ID', 16); // Bytes
define('LENGTH_SALT', 64); // Bytes

define('LOG_LEVEL_1', 1);
define('LOG_LEVEL_2', 2);
define('LOG_LEVEL_3', 3);
define('LOG_LEVEL_4', 4);
define('LOG_LEVEL_5', 5);

define('OPERATION_MODE_DEVELOPMENT', 'development');
define('OPERATION_MODE_MAINTENANCE', 'maintenance');
define('OPERATION_MODE_PRODUCTION', 'production');

define('SESSION_DATA_IP_ADDRESS', 'ip_address');
define('SESSION_DATA_USER', 'user');
