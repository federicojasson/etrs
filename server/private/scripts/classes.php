<?php

/*
 * This script includes the classes of the application.
 */

// Controllers
require 'Controllers/Controller.php';
require 'Controllers/SecureController.php';
require 'Controllers/GetAuthenticationStateController.php';
require 'Controllers/GetUserController.php';
require 'Controllers/LogInController.php';
require 'Controllers/LogOutController.php';
// TODO: remove tests
require 'Controllers/TestGetAuthenticationStateController.php';
require 'Controllers/TestGetUserController.php';
require 'Controllers/TestLogInController.php';
require 'Controllers/TestLogOutController.php';

// Data objects
require 'DataObjects/DataObject.php';
require 'DataObjects/Name.php';
require 'DataObjects/User.php';

// Databases
require 'Databases/Database.php';
require 'Databases/BusinessLogicDatabase.php';
require 'Databases/WebServerDatabase.php';

// Extensions
require 'Extensions/JsonResponse.php';

// Managers
require 'Managers/Manager.php';
require 'Managers/AuthenticationManager.php';
require 'Managers/ServiceManager.php';
require 'Managers/SessionManager.php';

// Middlewares
require 'Middlewares/SessionMiddleware.php';

// Session storage handlers
require 'SessionStorageHandlers/SessionStorageHandler.php';
require 'SessionStorageHandlers/DatabaseSessionStorageHandler.php';
