<?php

/*
 * This script defines the services of the server.
 */

$app = \Slim\Slim::getInstance();
$services = $app->services;

// URL:		/server/change-password
// Method:	POST
$services->define(
	'/change-password',
	HTTP_METHOD_POST,
	new ChangePasswordController()
);

// URL:		/server/create-experiment
// Method:	POST
$services->define(
	'/create-experiment',
	HTTP_METHOD_POST,
	new CreateExperimentController()
);

// URL:		/server/create-patient
// Method:	POST
$services->define(
	'/create-patient',
	HTTP_METHOD_POST,
	new CreatePatientController()
);

// URL:		/server/create-user
// Method:	POST
$services->define(
	'/create-user',
	HTTP_METHOD_POST,
	new CreateUserController()
);

// URL:		/server/get-authentication-state
// Method:	POST
$services->define(
	'/get-authentication-state',
	HTTP_METHOD_POST,
	new GetAuthenticationStateController()
);

// URL:		/server/get-consultation-image-analysis
// Method:	POST
$services->define(
	'/get-consultation-image-analysis',
	HTTP_METHOD_POST,
	new GetConsultationImageAnalysisController()
);

// URL:		/server/get-consultation-laboratory-results
// Method:	POST
$services->define(
	'/get-consultation-laboratory-results',
	HTTP_METHOD_POST,
	new GetConsultationLaboratoryResultsController()
);

// URL:		/server/get-consultation-main-data
// Method:	POST
$services->define(
	'/get-consultation-main-data',
	HTTP_METHOD_POST,
	new GetConsultationMainDataController()
);

// URL:		/server/get-consultation-metadata
// Method:	POST
$services->define(
	'/get-consultation-metadata',
	HTTP_METHOD_POST,
	new GetConsultationMetadataController()
);

// URL:		/server/get-consultation-neurocognitive-assessment
// Method:	POST
$services->define(
	'/get-consultation-neurocognitive-assessment',
	HTTP_METHOD_POST,
	new GetConsultationNeurocognitiveAssessmentController()
);

// URL:		/server/get-consultation-patient-background
// Method:	POST
$services->define(
	'/get-consultation-patient-background',
	HTTP_METHOD_POST,
	new GetConsultationPatientBackgroundController()
);

// URL:		/server/get-consultation-patient-medications
// Method:	POST
$services->define(
	'/get-consultation-patient-medications',
	HTTP_METHOD_POST,
	new GetConsultationPatientMedicationsController()
);

// URL:		/server/get-consultation-treatments
// Method:	POST
$services->define(
	'/get-consultation-treatments',
	HTTP_METHOD_POST,
	new GetConsultationTreatmentsController()
);

// URL:		/server/get-experiment-files
// Method:	POST
$services->define(
	'/get-experiment-files',
	HTTP_METHOD_POST,
	new GetExperimentFilesController()
);

// URL:		/server/get-experiment-main-data
// Method:	POST
$services->define(
	'/get-experiment-main-data',
	HTTP_METHOD_POST,
	new GetExperimentMainDataController()
);

// URL:		/server/get-experiment-metadata
// Method:	POST
$services->define(
	'/get-experiment-metadata',
	HTTP_METHOD_POST,
	new GetExperimentMetadataController()
);

// URL:		/server/get-file-main-data
// Method:	POST
$services->define(
	'/get-file-main-data',
	HTTP_METHOD_POST,
	new GetFileMainDataController()
);

// URL:		/server/get-file-metadata
// Method:	POST
$services->define(
	'/get-file-metadata',
	HTTP_METHOD_POST,
	new GetFileMetadataController()
);

// URL:		/server/get-patient-main-data
// Method:	POST
$services->define(
	'/get-patient-main-data',
	HTTP_METHOD_POST,
	new GetPatientMainDataController()
);

// URL:		/server/get-patient-metadata
// Method:	POST
$services->define(
	'/get-patient-metadata',
	HTTP_METHOD_POST,
	new GetPatientMetadataController()
);

// URL:		/server/get-study-files
// Method:	POST
$services->define(
	'/get-study-files',
	HTTP_METHOD_POST,
	new GetStudyFilesController()
);

// URL:		/server/get-study-main-data
// Method:	POST
$services->define(
	'/get-study-main-data',
	HTTP_METHOD_POST,
	new GetStudyMainDataController()
);

// URL:		/server/get-study-metadata
// Method:	POST
$services->define(
	'/get-study-metadata',
	HTTP_METHOD_POST,
	new GetStudyMetadataController()
);

// URL:		/server/get-user-main-data
// Method:	POST
$services->define(
	'/get-user-main-data',
	HTTP_METHOD_POST,
	new GetUserMainDataController()
);

// URL:		/server/get-user-metadata
// Method:	POST
$services->define(
	'/get-user-metadata',
	HTTP_METHOD_POST,
	new GetUserMetadataController()
);

// URL:		/server/log-in
// Method:	POST
$services->define(
	'/log-in',
	HTTP_METHOD_POST,
	new LogInController()
);

// URL:		/server/log-out
// Method:	POST
$services->define(
	'/log-out',
	HTTP_METHOD_POST,
	new LogOutController()
);

// URL:		/server/request-user-creation
// Method:	POST
$services->define(
	'/request-user-creation',
	HTTP_METHOD_POST,
	new RequestUserCreationController()
);
