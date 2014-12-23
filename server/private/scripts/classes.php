<?php

/*
 * This script includes the classes of the application.
 */

require 'private/scripts/Auxiliars/SessionStorageHandler.php';
require 'private/scripts/Auxiliars/DatabaseLogWriter.php';
require 'private/scripts/Auxiliars/DatabaseSessionStorageHandler.php';
require 'private/scripts/Auxiliars/Email.php';
require 'private/scripts/Auxiliars/JsonStructureDescriptor.php';
require 'private/scripts/Controllers/Controller.php';
require 'private/scripts/Controllers/SecureController.php';
require 'private/scripts/Controllers/GetAuthenticationStateController.php';
require 'private/scripts/Controllers/LogInController.php';
require 'private/scripts/Controllers/LogOutController.php';
require 'private/scripts/Extensions/Request.php';
require 'private/scripts/Extensions/Response.php';
require 'private/scripts/Helpers/Helper.php';
require 'private/scripts/Helpers/Database.php';
require 'private/scripts/Helpers/Authentication.php';
require 'private/scripts/Helpers/Authenticator.php';
require 'private/scripts/Helpers/AuthorizationValidator.php';
require 'private/scripts/Helpers/BusinessLogicDatabase.php';
require 'private/scripts/Helpers/Configurations.php';
require 'private/scripts/Helpers/Cryptography.php';
require 'private/scripts/Helpers/Data.php';
require 'private/scripts/Helpers/DataFilter.php';
require 'private/scripts/Helpers/EmailBuilder.php';
require 'private/scripts/Helpers/InputValidator.php';
require 'private/scripts/Helpers/Services.php';
require 'private/scripts/Helpers/Session.php';
require 'private/scripts/Helpers/WebServerDatabase.php';
require 'private/scripts/Middlewares/ConfigurationsMiddleware.php';
require 'private/scripts/Middlewares/ErrorHandlersMiddleware.php';
require 'private/scripts/Middlewares/ExtensionsMiddleware.php';
require 'private/scripts/Middlewares/HelpersMiddleware.php';
require 'private/scripts/Middlewares/ServicesMiddleware.php';
require 'private/scripts/Middlewares/SessionMiddleware.php';
