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
require 'private/scripts/Controllers/CreateBackgroundController.php';
require 'private/scripts/Controllers/CreateClinicalImpressionController.php';
require 'private/scripts/Controllers/CreateDiagnosisController.php';
require 'private/scripts/Controllers/CreateExperimentController.php';
require 'private/scripts/Controllers/CreateImageTestController.php';
require 'private/scripts/Controllers/CreateLaboratoryTestController.php';
require 'private/scripts/Controllers/CreateMedicationController.php';
require 'private/scripts/Controllers/CreateNeurocognitiveEvaluationController.php';
require 'private/scripts/Controllers/CreatePatientController.php';
require 'private/scripts/Controllers/CreateTreatmentController.php';
require 'private/scripts/Controllers/GetAuthenticationStateController.php';
require 'private/scripts/Controllers/GetBackgroundController.php';
require 'private/scripts/Controllers/GetClinicalImpressionController.php';
require 'private/scripts/Controllers/GetConsultationController.php';
require 'private/scripts/Controllers/GetDiagnosisController.php';
require 'private/scripts/Controllers/GetExperimentController.php';
require 'private/scripts/Controllers/GetFileController.php';
require 'private/scripts/Controllers/GetImageTestController.php';
require 'private/scripts/Controllers/GetLaboratoryTestController.php';
require 'private/scripts/Controllers/GetMedicationController.php';
require 'private/scripts/Controllers/GetNeurocognitiveEvaluationController.php';
require 'private/scripts/Controllers/GetPatientController.php';
require 'private/scripts/Controllers/GetStudyController.php';
require 'private/scripts/Controllers/GetTreatmentController.php';
require 'private/scripts/Controllers/GetUserController.php';
require 'private/scripts/Controllers/LogInController.php';
require 'private/scripts/Controllers/LogOutController.php';
require 'private/scripts/Controllers/RequestPasswordRecoveryController.php';
require 'private/scripts/Controllers/SearchPatientsController.php';
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
