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
require 'private/scripts/Controllers/Authentication/GetState.php';
require 'private/scripts/Controllers/Authentication/SignIn.php';
require 'private/scripts/Controllers/Authentication/SignOut.php';
require 'private/scripts/Controllers/Experiments/Create.php';
require 'private/scripts/Controllers/Experiments/Edit.php';
require 'private/scripts/Controllers/Experiments/Erase.php';
require 'private/scripts/Controllers/Experiments/Get.php';
require 'private/scripts/Controllers/Experiments/Search.php';
require 'private/scripts/Controllers/Medications/Create.php';
require 'private/scripts/Controllers/Medications/Edit.php';
require 'private/scripts/Controllers/Medications/Erase.php';
require 'private/scripts/Controllers/Medications/Get.php';
require 'private/scripts/Controllers/Medications/Search.php';
require 'private/scripts/Controllers/Patients/Get.php';
require 'private/scripts/Extensions/Request.php';
require 'private/scripts/Extensions/Response.php';
require 'private/scripts/Helpers/Helper.php';
require 'private/scripts/Helpers/Database.php';
require 'private/scripts/Helpers/Authentication.php';
require 'private/scripts/Helpers/Authenticator.php';
require 'private/scripts/Helpers/AuthorizationValidator.php';
require 'private/scripts/Helpers/BusinessLogicDatabase.php';
require 'private/scripts/Helpers/Cryptography.php';
require 'private/scripts/Helpers/EmailBuilder.php';
require 'private/scripts/Helpers/InputValidator.php';
require 'private/scripts/Helpers/Parameters.php';
require 'private/scripts/Helpers/Services.php';
require 'private/scripts/Helpers/Session.php';
require 'private/scripts/Helpers/WebServerDatabase.php';
require 'private/scripts/Middlewares/Configurations.php';
require 'private/scripts/Middlewares/ErrorHandlers.php';
require 'private/scripts/Middlewares/Extensions.php';
require 'private/scripts/Middlewares/Helpers.php';
require 'private/scripts/Middlewares/Services.php';
require 'private/scripts/Middlewares/Session.php';
