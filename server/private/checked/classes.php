<?php

/*
 * This script includes the classes of the application.
 */

// App\Auxiliar\LogWriter
require 'private/scripts/Auxiliar/LogWriter/DatabaseLogWriter.php';

// App\Auxiliar\SessionStorageHandler
require 'private/scripts/Auxiliar/SessionStorageHandler/SessionStorageHandler.php';
require 'private/scripts/Auxiliar/SessionStorageHandler/DatabaseSessionStorageHandler.php';

// App\Controller
require 'private/scripts/Controller/Controller.php';
require 'private/scripts/Controller/SecureController.php';

// App\Extension
require 'private/scripts/Extension/Request.php';
require 'private/scripts/Extension/Response.php';

// App\Helper
require 'private/scripts/Helper/Helper.php';
require 'private/scripts/Helper/Cryptography.php';
require 'private/scripts/Helper/Data.php';
require 'private/scripts/Helper/Services.php';
require 'private/scripts/Helper/Session.php';

// App\Helper\Database
require 'private/scripts/Helper/Database/Database.php';
require 'private/scripts/Helper/Database/SpecializedDatabase.php';
require 'private/scripts/Helper/Database/WebServerDatabase.php';

// App\Middleware
require 'private/scripts/Middleware/Configurations.php';
require 'private/scripts/Middleware/ErrorHandlers.php';
require 'private/scripts/Middleware/Extensions.php';
require 'private/scripts/Middleware/Helpers.php';
require 'private/scripts/Middleware/Services.php';
require 'private/scripts/Middleware/Session.php';
