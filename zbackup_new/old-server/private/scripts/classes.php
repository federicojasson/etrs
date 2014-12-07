<?php

/*
 * This script includes the classes of the application.
 */

// Controllers
require 'private/scripts/Controllers/Controller.php';
require 'private/scripts/Controllers/SecureController.php';
require 'private/scripts/Controllers/GetAuthenticationStateController.php';
require 'private/scripts/Controllers/LogInController.php';
require 'private/scripts/Controllers/LogOutController.php';

// Databases
require 'private/scripts/Databases/Database.php';
require 'private/scripts/Databases/BusinessLogicDatabase.php';
require 'private/scripts/Databases/WebServerDatabase.php';

// Extensions
require 'private/scripts/Extensions/JsonResponse.php';

// Managers
require 'private/scripts/Managers/Manager.php';
require 'private/scripts/Managers/AuthenticationManager.php';
require 'private/scripts/Managers/ConfigurationManager.php';
require 'private/scripts/Managers/ServiceManager.php';
require 'private/scripts/Managers/SessionManager.php';
require 'private/scripts/Managers/ValidationManager.php';

// Middlewares
require 'private/scripts/Middlewares/SessionMiddleware.php';

// Session storage handlers
require 'private/scripts/SessionStorageHandlers/SessionStorageHandler.php';
require 'private/scripts/SessionStorageHandlers/DatabaseSessionStorageHandler.php';
