<?php

/*
 * This script includes the classes of the application.
 */

// Controllers
require 'Controllers/Controller.php';
require 'Controllers/GetAuthenticationStateController.php';
require 'Controllers/GetUserController.php';
require 'Controllers/LogInController.php';
require 'Controllers/LogOutController.php';
// TODO: remove
require 'Controllers/TestGetAuthenticationStateController.php';
require 'Controllers/TestGetUserController.php';
require 'Controllers/TestLogInController.php';
require 'Controllers/TestLogOutController.php';

// Extensions
require 'Extensions/JsonResponse.php';

// Managers
require 'Managers/Manager.php';
require 'Managers/ServiceManager.php';
require 'Managers/SessionManager.php';

// Middlewares
require 'Middlewares/JsonMiddleware.php';
require 'Middlewares/SessionMiddleware.php';

// Session storage handlers
require 'SessionStorageHandlers/SessionStorageHandler.php';
require 'SessionStorageHandlers/DatabaseSessionStorageHandler.php';
