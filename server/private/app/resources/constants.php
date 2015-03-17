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

define('ERROR_CODE_INVALID_INPUT', 'INVALID_INPUT');
define('ERROR_CODE_SYSTEM_UNDER_MAINTENANCE', 'SYSTEM_UNDER_MAINTENANCE');
define('ERROR_CODE_UNAUTHORIZED_USER', 'UNAUTHORIZED_USER');
define('ERROR_CODE_UNDEFINED_SERVICE', 'UNDEFINED_SERVICE');
define('ERROR_CODE_UNEXPECTED_ERROR', 'UNEXPECTED_ERROR');

define('HTTP_STATUS_BAD_REQUEST', 400);
define('HTTP_STATUS_FORBIDDEN', 403);
define('HTTP_STATUS_INTERNAL_SERVER_ERROR', 500);
define('HTTP_STATUS_NOT_FOUND', 404);
define('HTTP_STATUS_SERVICE_UNAVAILABLE', 503);

define('OPERATION_MODE_DEVELOPMENT', 'development');
define('OPERATION_MODE_MAINTENANCE', 'maintenance');
define('OPERATION_MODE_PRODUCTION', 'production');

define('RANDOM_ID_LENGTH', 16); // Bytes

define('SESSION_DATA_USER', 'user');
define('SESSION_MAXIMUM_AGE', 30); // Days
define('SESSION_MAXIMUM_INACTIVITY_TIME', 48); // Hours
define('SESSION_NAME', 'id');
