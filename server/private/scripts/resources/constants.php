<?php

/*
 * This script defines constants.
 */

define('ACCESS_PERMISSIONS_DIRECTORY', 0600); // -rw-------
define('ACCESS_PERMISSIONS_FILE', 0400); // -r--------

define('APACHE_ENVIRONMENT_VARIABLE_DOWNLOAD', 'etrs_download');

define('DATA_TYPE_BOOLEAN', 'boolean');
define('DATA_TYPE_INTEGER_FIX_VALUES', 'integer_fix_values');
define('DATA_TYPE_INTEGER_RANGE', 'integer_range');

define('ENTITY_MODEL_ACCOUNT', 'account');
define('ENTITY_MODEL_BACKGROUND', 'background');
define('ENTITY_MODEL_CLINICAL_IMPRESSION', 'clinicalImpression');
define('ENTITY_MODEL_CONSULTATION', 'consultation');
define('ENTITY_MODEL_DIAGNOSIS', 'diagnosis');
define('ENTITY_MODEL_EXPERIMENT', 'experiment');
define('ENTITY_MODEL_FILE', 'file');
define('ENTITY_MODEL_IMAGE_TEST', 'imageTest');
define('ENTITY_MODEL_LABORATORY_TEST', 'laboratoryTest');
define('ENTITY_MODEL_LOG', 'log');
define('ENTITY_MODEL_MEDICATION', 'medication');
define('ENTITY_MODEL_NEUROCOGNITIVE_TEST', 'neurocognitiveTest');
define('ENTITY_MODEL_PATIENT', 'patient');
define('ENTITY_MODEL_RECOVER_PASSWORD_PERMISSION', 'recoverPasswordPermission');
define('ENTITY_MODEL_SANDBOX', 'sandbox');
define('ENTITY_MODEL_SESSION', 'session');
define('ENTITY_MODEL_SIGN_UP_PERMISSION', 'signUpPermission');
define('ENTITY_MODEL_STUDY', 'study');
define('ENTITY_MODEL_TREATMENT', 'treatment');
define('ENTITY_MODEL_USER', 'user');

define('ERROR_ALREADY_EXISTING_FILE', 'ALREADY_EXISTING_FILE');
define('ERROR_ALREADY_EXISTING_USER', 'ALREADY_EXISTING_USER');
define('ERROR_CORRUPTED_FILE', 'CORRUPTED_FILE');
define('ERROR_FILE_SYSTEM_PROBLEM', 'FILE_SYSTEM_PROBLEM');
define('ERROR_INVALID_INPUT', 'INVALID_INPUT');
define('ERROR_NON_EXISTENT_BACKGROUND', 'NON_EXISTENT_BACKGROUND');
define('ERROR_NON_EXISTENT_CLINICAL_IMPRESSION', 'NON_EXISTENT_CLINICAL_IMPRESSION');
define('ERROR_NON_EXISTENT_CONSULTATION', 'NON_EXISTENT_CONSULTATION');
define('ERROR_NON_EXISTENT_DIAGNOSIS', 'NON_EXISTENT_DIAGNOSIS');
define('ERROR_NON_EXISTENT_EXPERIMENT', 'NON_EXISTENT_EXPERIMENT');
define('ERROR_NON_EXISTENT_FILE', 'NON_EXISTENT_FILE');
define('ERROR_NON_EXISTENT_IMAGE_TEST', 'NON_EXISTENT_IMAGE_TEST');
define('ERROR_NON_EXISTENT_LABORATORY_TEST', 'NON_EXISTENT_LABORATORY_TEST');
define('ERROR_NON_EXISTENT_LOG', 'NON_EXISTENT_LOG');
define('ERROR_NON_EXISTENT_MEDICATION', 'NON_EXISTENT_MEDICATION');
define('ERROR_NON_EXISTENT_NEUROCOGNITIVE_TEST', 'NON_EXISTENT_NEUROCOGNITIVE_TEST');
define('ERROR_NON_EXISTENT_PATIENT', 'NON_EXISTENT_PATIENT');
define('ERROR_NON_EXISTENT_STUDY', 'NON_EXISTENT_STUDY');
define('ERROR_NON_EXISTENT_TREATMENT', 'NON_EXISTENT_TREATMENT');
define('ERROR_NON_EXISTENT_USER', 'NON_EXISTENT_USER');
define('ERROR_UNAUTHORIZED_USER', 'UNAUTHORIZED_USER');
define('ERROR_UNDEFINED_SERVICE', 'UNDEFINED_SERVICE');
define('ERROR_UNDELIVERED_EMAIL', 'UNDELIVERED_EMAIL');
define('ERROR_UNEXPECTED_ERROR', 'UNEXPECTED_ERROR');

define('EXTENSION_TIME_EMAIL_DELIVERY', 30); // Seconds
define('EXTENSION_TIME_FILE_HASHING', 25); // Seconds
define('EXTENSION_TIME_PASSWORD_HASHING', 15); // Seconds

define('GENDER_FEMALE', 'f');
define('GENDER_MALE', 'm');

define('HTTP_STATUS_BAD_REQUEST', 400);
define('HTTP_STATUS_CONFLICT', 409);
define('HTTP_STATUS_FORBIDDEN', 403);
define('HTTP_STATUS_INTERNAL_SERVER_ERROR', 500);
define('HTTP_STATUS_NOT_FOUND', 404);

define('KEY_STRETCHING_ITERATIONS', 64000);

define('LENGTH_RANDOM_ID', 16); // Bytes
define('LENGTH_RANDOM_PASSWORD', 64); // Bytes
define('LENGTH_SALT', 64); // Bytes

define('LOG_LEVEL_1', 1);
define('LOG_LEVEL_2', 2);
define('LOG_LEVEL_3', 3);
define('LOG_LEVEL_4', 4);
define('LOG_LEVEL_5', 5);

define('MAXIMUM_AGE_LOG', 12); // Months
define('MAXIMUM_AGE_RECOVER_PASSWORD_PERMISSION', 4); // Hours
define('MAXIMUM_AGE_SIGN_UP_PERMISSION', 120); // Hours
define('MAXIMUM_INACTIVITY_TIME_SESSION', 2880); // Minutes

define('OPERATION_MODE_DEBUG', 'debug');
define('OPERATION_MODE_RELEASE', 'release');

define('SEARCH_RESULTS_PER_PAGE', 10);

define('SESSION_DATA_IP_ADDRESS', 'ip_address');
define('SESSION_DATA_USER', 'user');

define('SORTING_ORDER_ASCENDING', 'ascending');
define('SORTING_ORDER_DESCENDING', 'descending');

define('USER_ROLE_ADMINISTRATOR', 'ad');
define('USER_ROLE_ANONYMOUS', '__');
define('USER_ROLE_DOCTOR', 'dr');
define('USER_ROLE_OPERATOR', 'op');
