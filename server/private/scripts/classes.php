<?php

/*
 * This script includes the classes of the application.
 */

// Auxiliars
require 'private/scripts/Auxiliars/ColumnSet.php';
require 'private/scripts/Auxiliars/JsonStructureDescription.php';

// Controllers
require 'private/scripts/Controllers/Controller.php';
require 'private/scripts/Controllers/SecureController.php';
require 'private/scripts/Controllers/ChangePasswordController.php';
require 'private/scripts/Controllers/CreateExperimentController.php';
require 'private/scripts/Controllers/CreatePatientController.php';
require 'private/scripts/Controllers/CreateUserController.php';
require 'private/scripts/Controllers/GetAuthenticationState.php';
require 'private/scripts/Controllers/GetConsultationImageAnalysisController.php';
require 'private/scripts/Controllers/GetConsultationLaboratoryResultsController.php';
require 'private/scripts/Controllers/GetConsultationMainDataController.php';
require 'private/scripts/Controllers/GetConsultationMetadataController.php';
require 'private/scripts/Controllers/GetConsultationNeurocognitiveAssessmentController.php';
require 'private/scripts/Controllers/GetConsultationPatientBackgroundController.php';
require 'private/scripts/Controllers/GetConsultationPatientMedicationsController.php';
require 'private/scripts/Controllers/GetConsultationTreatmentsController.php';
require 'private/scripts/Controllers/GetExperimentFilesController.php';
require 'private/scripts/Controllers/GetExperimentMainDataController.php';
require 'private/scripts/Controllers/GetExperimentMetadataController.php';
require 'private/scripts/Controllers/GetFileMainDataController.php';
require 'private/scripts/Controllers/GetFileMetadataController.php';
require 'private/scripts/Controllers/GetPatientMainDataController.php';
require 'private/scripts/Controllers/GetPatientMetadataController.php';
require 'private/scripts/Controllers/GetStudyFilesController.php';
require 'private/scripts/Controllers/GetStudyMainDataController.php';
require 'private/scripts/Controllers/GetStudyMetadataController.php';
require 'private/scripts/Controllers/GetUserMainDataController.php';
require 'private/scripts/Controllers/GetUserMetadataController.php';
require 'private/scripts/Controllers/LogInController.php';
require 'private/scripts/Controllers/LogOutController.php';
require 'private/scripts/Controllers/RequestUserCreationController.php';

// Extensions
require 'private/scripts/Extensions/JsonResponse.php';

// Helpers
require 'private/scripts/Helpers/Helper.php';
require 'private/scripts/Helpers/Authentication.php';
require 'private/scripts/Helpers/Configurations.php';
require 'private/scripts/Helpers/Cryptography.php';
require 'private/scripts/Helpers/Database.php';
require 'private/scripts/Helpers/BusinessLogicDatabase.php';
require 'private/scripts/Helpers/WebServerDatabase.php';
require 'private/scripts/Helpers/InputValidator.php';
require 'private/scripts/Helpers/Services.php';
require 'private/scripts/Helpers/Session.php';
