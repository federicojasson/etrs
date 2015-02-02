<?php

/*
 * This script includes the classes of the application.
 */

// App\Auxiliar\DataTypeDescriptor
require 'private/scripts/Auxiliar/DataTypeDescriptor/DataTypeDescriptor.php';
require 'private/scripts/Auxiliar/DataTypeDescriptor/BooleanDescriptor.php';
require 'private/scripts/Auxiliar/DataTypeDescriptor/IntegerFixValuesDescriptor.php';
require 'private/scripts/Auxiliar/DataTypeDescriptor/IntegerRangeDescriptor.php';

// App\Auxiliar\JsonStructureDescriptor
require 'private/scripts/Auxiliar/JsonStructureDescriptor/JsonStructureDescriptor.php';
require 'private/scripts/Auxiliar/JsonStructureDescriptor/JsonArrayDescriptor.php';
require 'private/scripts/Auxiliar/JsonStructureDescriptor/JsonObjectDescriptor.php';
require 'private/scripts/Auxiliar/JsonStructureDescriptor/JsonValueDescriptor.php';

// App\Auxiliar\LogWriter
require 'private/scripts/Auxiliar/LogWriter/DatabaseLogWriter.php';

// App\Auxiliar\SessionStorageHandler
require 'private/scripts/Auxiliar/SessionStorageHandler/SessionStorageHandler.php';
require 'private/scripts/Auxiliar/SessionStorageHandler/DatabaseSessionStorageHandler.php';

// App\Controller
require 'private/scripts/Controller/Controller.php';
require 'private/scripts/Controller/SecureController.php';

// App\Controller\Authentication
require 'private/scripts/Controller/Authentication/GetState.php';

// App\Controller\Background
require 'private/scripts/Controller/Background/Create.php';
require 'private/scripts/Controller/Background/Delete.php';
require 'private/scripts/Controller/Background/Edit.php';
require 'private/scripts/Controller/Background/Get.php';
require 'private/scripts/Controller/Background/Search.php';

// App\Controller\ClinicalImpression
require 'private/scripts/Controller/ClinicalImpression/Create.php';
require 'private/scripts/Controller/ClinicalImpression/Delete.php';
require 'private/scripts/Controller/ClinicalImpression/Edit.php';
require 'private/scripts/Controller/ClinicalImpression/Get.php';
require 'private/scripts/Controller/ClinicalImpression/Search.php';

// App\Controller\Consultation
require 'private/scripts/Controller/Consultation/Create.php';
require 'private/scripts/Controller/Consultation/Delete.php';
require 'private/scripts/Controller/Consultation/Edit.php';
require 'private/scripts/Controller/Consultation/Get.php';

// App\Controller\Diagnosis
require 'private/scripts/Controller/Diagnosis/Create.php';
require 'private/scripts/Controller/Diagnosis/Delete.php';
require 'private/scripts/Controller/Diagnosis/Edit.php';
require 'private/scripts/Controller/Diagnosis/Get.php';
require 'private/scripts/Controller/Diagnosis/Search.php';

// App\Controller\Experiment
require 'private/scripts/Controller/Experiment/Create.php';
require 'private/scripts/Controller/Experiment/Delete.php';
require 'private/scripts/Controller/Experiment/Edit.php';
require 'private/scripts/Controller/Experiment/Get.php';
require 'private/scripts/Controller/Experiment/Search.php';

// App\Controller\ImageTest
require 'private/scripts/Controller/ImageTest/Create.php';
require 'private/scripts/Controller/ImageTest/Delete.php';
require 'private/scripts/Controller/ImageTest/Edit.php';
require 'private/scripts/Controller/ImageTest/Get.php';
require 'private/scripts/Controller/ImageTest/Search.php';

// App\Controller\LaboratoryTest
require 'private/scripts/Controller/LaboratoryTest/Create.php';
require 'private/scripts/Controller/LaboratoryTest/Delete.php';
require 'private/scripts/Controller/LaboratoryTest/Edit.php';
require 'private/scripts/Controller/LaboratoryTest/Get.php';
require 'private/scripts/Controller/LaboratoryTest/Search.php';

// App\Controller\Medication
require 'private/scripts/Controller/Medication/Create.php';
require 'private/scripts/Controller/Medication/Delete.php';
require 'private/scripts/Controller/Medication/Edit.php';
require 'private/scripts/Controller/Medication/Get.php';
require 'private/scripts/Controller/Medication/Search.php';

// App\Controller\NeurocognitiveTest
require 'private/scripts/Controller/NeurocognitiveTest/Create.php';
require 'private/scripts/Controller/NeurocognitiveTest/Delete.php';
require 'private/scripts/Controller/NeurocognitiveTest/Edit.php';
require 'private/scripts/Controller/NeurocognitiveTest/Get.php';
require 'private/scripts/Controller/NeurocognitiveTest/Search.php';

// App\Controller\Patient
require 'private/scripts/Controller/Patient/Create.php';
require 'private/scripts/Controller/Patient/Delete.php';
require 'private/scripts/Controller/Patient/Edit.php';
require 'private/scripts/Controller/Patient/Get.php';
require 'private/scripts/Controller/Patient/Search.php';

// App\Controller\Study
require 'private/scripts/Controller/Study/Create.php';
require 'private/scripts/Controller/Study/Delete.php';
require 'private/scripts/Controller/Study/Edit.php';
require 'private/scripts/Controller/Study/Get.php';

// App\Controller\Treatment
require 'private/scripts/Controller/Treatment/Create.php';
require 'private/scripts/Controller/Treatment/Delete.php';
require 'private/scripts/Controller/Treatment/Edit.php';
require 'private/scripts/Controller/Treatment/Get.php';
require 'private/scripts/Controller/Treatment/Search.php';

// App\Extension
require 'private/scripts/Extension/Request.php';
require 'private/scripts/Extension/Response.php';

// App\Helper
require 'private/scripts/Helper/Helper.php';
require 'private/scripts/Helper/Authentication.php';
require 'private/scripts/Helper/Cryptography.php';
require 'private/scripts/Helper/Data.php';
require 'private/scripts/Helper/InputValidator.php';
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
