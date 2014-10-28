<?php

/*
 * This script includes the classes of the application.
 */

// Controllers
require 'controllers/Controller.php';
require 'controllers/user/UserGetAuthenticationStateController.php';
require 'controllers/user/UserGetUserController.php';
require 'controllers/user/UserLogInController.php';
require 'controllers/user/UserLogOutController.php';
// TODO: remove
require 'controllers/test/TestUserGetAuthenticationStateController.php';
require 'controllers/test/TestUserGetUserController.php';
require 'controllers/test/TestUserLogInController.php';
require 'controllers/test/TestUserLogOutController.php';

// Extensions
require 'extensions/JsonResponse.php';

// Managers
require 'managers/ControllerManager.php';

// Middlewares
require 'middlewares/JsonMiddleware.php';
