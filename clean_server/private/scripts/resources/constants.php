<?php

/*
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

/*
 * This script defines useful global constants.
 */

define('CODE_INVALID_INPUT', 'INVALID_INPUT');
define('CODE_SYSTEM_UNDER_MAINTENANCE', 'SYSTEM_UNDER_MAINTENANCE');
define('CODE_UNAUTHORIZED_USER', 'UNAUTHORIZED_USER');

define('HTTP_METHOD_MOCK', 'MOCK');
define('HTTP_METHOD_POST', 'POST');

define('HTTP_STATUS_BAD_REQUEST', 400);
define('HTTP_STATUS_FORBIDDEN', 403);
define('HTTP_STATUS_SERVICE_UNAVAILABLE', 503);

define('OPERATION_MODE_DEBUG', 'debug');
define('OPERATION_MODE_MAINTENANCE', 'maintenance');
define('OPERATION_MODE_RELEASE', 'release');