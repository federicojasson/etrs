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

define('APACHE_ENVIRONMENT_VARIABLE_ETRS_SUBREQUEST', 'etrs_subrequest');

define('DATA_TYPE_BOOLEAN', 'boolean');
define('DATA_TYPE_INTEGER_FIX_VALUES', 'integer_fix_values');
define('DATA_TYPE_INTEGER_RANGE', 'integer_range');

define('ERROR_CODE_FILE_SYSTEM_ERROR', 'FILE_SYSTEM_ERROR');
define('ERROR_CODE_INVALID_REQUEST', 'INVALID_REQUEST');
define('ERROR_CODE_NON_EXISTENT_ENTITY', 'NON_EXISTENT_ENTITY');
define('ERROR_CODE_OUTDATED_ENTITY', 'OUTDATED_ENTITY');
define('ERROR_CODE_SYSTEM_UNDER_MAINTENANCE', 'SYSTEM_UNDER_MAINTENANCE');
define('ERROR_CODE_UNAUTHORIZED_USER', 'UNAUTHORIZED_USER');
define('ERROR_CODE_UNDEFINED_SERVICE', 'UNDEFINED_SERVICE');
define('ERROR_CODE_UNDELIVERED_EMAIL', 'UNDELIVERED_EMAIL');
define('ERROR_CODE_UNEXPECTED_ERROR', 'UNEXPECTED_ERROR');

define('FILE_MAXIMUM_AGE', 24); // Hours
define('FILE_OUTPUT_NAME', 'Reporte.pdf');
define('FILE_UNNAMED_NAME', 'Archivo sin nombre');
define('FILE_UPLOADED_INPUT_NAME', 'file');

define('GENDER_FEMALE', 'f');
define('GENDER_MALE', 'm');

define('HOOK_PRIORITY_DATA', 2);
define('HOOK_PRIORITY_SESSION', 1);

define('HTTP_STATUS_BAD_REQUEST', 400);
define('HTTP_STATUS_CONFLICT', 409);
define('HTTP_STATUS_FORBIDDEN', 403);
define('HTTP_STATUS_INTERNAL_SERVER_ERROR', 500);
define('HTTP_STATUS_NOT_FOUND', 404);
define('HTTP_STATUS_SERVICE_UNAVAILABLE', 503);

define('KEY_STRETCHING_ITERATIONS', 64000);

define('LOG_MAXIMUM_AGE', 12); // Months

define('OPERATION_MODE_DEVELOPMENT', 'development');
define('OPERATION_MODE_MAINTENANCE', 'maintenance');
define('OPERATION_MODE_PRODUCTION', 'production');

define('PASSWORD_RESET_PERMISSION_MAXIMUM_AGE', 120); // Minutes

define('RANDOM_ID_LENGTH', 16); // Bytes

define('RANDOM_PASSWORD_LENGTH', 128); // Bytes

define('SALT_LENGTH', 64); // Bytes

define('SESSION_DATA_USER', 'user');
define('SESSION_MAXIMUM_AGE', 15); // Days
define('SESSION_MAXIMUM_INACTIVITY_TIME', 48); // Hours
define('SESSION_NAME', 'session');

define('SIGN_UP_PERMISSION_MAXIMUM_AGE', 48); // Hours

define('SORTING_DIRECTION_ASCENDING', 'asc');
define('SORTING_DIRECTION_DESCENDING', 'desc');

define('STUDY_STATE_CONDUCTING', 1);
define('STUDY_STATE_FAILURE', 3);
define('STUDY_STATE_PENDING', 0);
define('STUDY_STATE_SUCCESS', 2);

define('USER_ROLE_ADMINISTRATOR', 'ad');
define('USER_ROLE_DOCTOR', 'dr');
define('USER_ROLE_OPERATOR', 'op');
