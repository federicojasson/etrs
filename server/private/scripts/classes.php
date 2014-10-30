<?php

/*
 * This script includes the classes of the application.
 */

// Controllers
require 'Controllers/Controller.php';
require 'Controllers/User/UserGetAuthenticationStateController.php';
require 'Controllers/User/UserGetUserController.php';
require 'Controllers/User/UserLogInController.php';
require 'Controllers/User/UserLogOutController.php';
// TODO: remove
require 'Controllers/Test/TestUserGetAuthenticationStateController.php';
require 'Controllers/Test/TestUserGetUserController.php';
require 'Controllers/Test/TestUserLogInController.php';
require 'Controllers/Test/TestUserLogOutController.php';

// Extensions
require 'Extensions/JsonResponse.php';

// Managers
require 'Managers/Manager.php';
require 'Managers/ControllerManager.php';
require 'Managers/SessionManager.php';

// Middlewares
require 'Middlewares/JsonMiddleware.php';
require 'Middlewares/SessionMiddleware.php';

// Session storage handlers
require 'SessionStorageHandlers/SessionStorageHandler.php';
require 'SessionStorageHandlers/DatabaseSessionStorageHandler.php';
