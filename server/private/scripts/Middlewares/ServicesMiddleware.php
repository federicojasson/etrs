<?php

/*
 * This middleware defines the services of the application.
 */
class ServicesMiddleware extends \Slim\Middleware {
	
	/*
	 * Executes the middleware.
	 */
	public function call() {
		// Defines the services
		$this->defineServices();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Defines the services.
	 */
	private function defineServices() {
		$services = $this->app->services;
		
		// URL:		/server/create-background
		// Method:	POST
		$services->define(
			'/create-background',
			HTTP_METHOD_POST,
			new CreateBackgroundController()
		);
		
		// URL:		/server/create-clinical-impression
		// Method:	POST
		$services->define(
			'/create-clinical-impression',
			HTTP_METHOD_POST,
			new CreateClinicalImpressionController()
		);
		
		// URL:		/server/create-diagnosis
		// Method:	POST
		$services->define(
			'/create-diagnosis',
			HTTP_METHOD_POST,
			new CreateDiagnosisController()
		);
		
		// URL:		/server/create-experiment
		// Method:	POST
		$services->define(
			'/create-experiment',
			HTTP_METHOD_POST,
			new CreateExperimentController()
		);
		
		// URL:		/server/create-image-test
		// Method:	POST
		$services->define(
			'/create-image-test',
			HTTP_METHOD_POST,
			new CreateImageTestController()
		);
		
		// URL:		/server/create-laboratory-test
		// Method:	POST
		$services->define(
			'/create-laboratory-test',
			HTTP_METHOD_POST,
			new CreateLaboratoryTestController()
		);
		
		// URL:		/server/create-medication
		// Method:	POST
		$services->define(
			'/create-medication',
			HTTP_METHOD_POST,
			new CreateMedicationController()
		);
		
		// URL:		/server/create-neurocognitive-test
		// Method:	POST
		$services->define(
			'/create-neurocognitive-test',
			HTTP_METHOD_POST,
			new CreateNeurocognitiveTestController()
		);
		
		// URL:		/server/create-patient
		// Method:	POST
		$services->define(
			'/create-patient',
			HTTP_METHOD_POST,
			new CreatePatientController()
		);
		
		// URL:		/server/create-treatment
		// Method:	POST
		$services->define(
			'/create-treatment',
			HTTP_METHOD_POST,
			new CreateTreatmentController()
		);
		
		// URL:		/server/erase-background
		// Method:	POST
		$services->define(
			'/erase-background',
			HTTP_METHOD_POST,
			new EraseBackgroundController()
		);
		
		// URL:		/server/erase-clinical-impression
		// Method:	POST
		$services->define(
			'/erase-clinical-impression',
			HTTP_METHOD_POST,
			new EraseClinicalImpressionController()
		);
		
		// URL:		/server/erase-diagnosis
		// Method:	POST
		$services->define(
			'/erase-diagnosis',
			HTTP_METHOD_POST,
			new EraseDiagnosisController()
		);
		
		// URL:		/server/erase-experiment
		// Method:	POST
		$services->define(
			'/erase-experiment',
			HTTP_METHOD_POST,
			new EraseExperimentController()
		);
		
		// URL:		/server/erase-image-test
		// Method:	POST
		$services->define(
			'/erase-image-test',
			HTTP_METHOD_POST,
			new EraseImageTestController()
		);
		
		// URL:		/server/erase-laboratory-test
		// Method:	POST
		$services->define(
			'/erase-laboratory-test',
			HTTP_METHOD_POST,
			new EraseLaboratoryTestController()
		);
		
		// URL:		/server/erase-medication
		// Method:	POST
		$services->define(
			'/erase-medication',
			HTTP_METHOD_POST,
			new EraseMedicationController()
		);
		
		// URL:		/server/erase-neurocognitive-test
		// Method:	POST
		$services->define(
			'/erase-neurocognitive-test',
			HTTP_METHOD_POST,
			new EraseNeurocognitiveTestController()
		);
		
		// URL:		/server/erase-treatment
		// Method:	POST
		$services->define(
			'/erase-treatment',
			HTTP_METHOD_POST,
			new EraseTreatmentController()
		);
		
		// URL:		/server/get-authentication-state
		// Method:	POST
		$services->define(
			'/get-authentication-state',
			HTTP_METHOD_POST,
			new GetAuthenticationStateController()
		);
		
		// URL:		/server/get-background
		// Method:	POST
		$services->define(
			'/get-background',
			HTTP_METHOD_POST,
			new GetBackgroundController()
		);
		
		// URL:		/server/get-clinical-impression
		// Method:	POST
		$services->define(
			'/get-clinical-impression',
			HTTP_METHOD_POST,
			new GetClinicalImpressionController()
		);
		
		// URL:		/server/get-consultation
		// Method:	POST
		$services->define(
			'/get-consultation',
			HTTP_METHOD_POST,
			new GetConsultationController()
		);
		
		// URL:		/server/get-diagnosis
		// Method:	POST
		$services->define(
			'/get-diagnosis',
			HTTP_METHOD_POST,
			new GetDiagnosisController()
		);
		
		// URL:		/server/get-experiment
		// Method:	POST
		$services->define(
			'/get-experiment',
			HTTP_METHOD_POST,
			new GetExperimentController()
		);
		
		// URL:		/server/get-file
		// Method:	POST
		$services->define(
			'/get-file',
			HTTP_METHOD_POST,
			new GetFileController()
		);
		
		// URL:		/server/get-image-test
		// Method:	POST
		$services->define(
			'/get-image-test',
			HTTP_METHOD_POST,
			new GetImageTestController()
		);
		
		// URL:		/server/get-laboratory-test
		// Method:	POST
		$services->define(
			'/get-laboratory-test',
			HTTP_METHOD_POST,
			new GetLaboratoryTestController()
		);
		
		// URL:		/server/get-medication
		// Method:	POST
		$services->define(
			'/get-medication',
			HTTP_METHOD_POST,
			new GetMedicationController()
		);
		
		// URL:		/server/get-patient
		// Method:	POST
		$services->define(
			'/get-patient',
			HTTP_METHOD_POST,
			new GetPatientController()
		);
		
		// URL:		/server/get-study
		// Method:	POST
		$services->define(
			'/get-study',
			HTTP_METHOD_POST,
			new GetStudyController()
		);
		
		// URL:		/server/get-treatment
		// Method:	POST
		$services->define(
			'/get-treatment',
			HTTP_METHOD_POST,
			new GetTreatmentController()
		);
		
		// URL:		/server/get-user
		// Method:	POST
		$services->define(
			'/get-user',
			HTTP_METHOD_POST,
			new GetUserController()
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

		// URL:		/server/request-password-recovery
		// Method:	POST
		$services->define(
			'/request-password-recovery',
			HTTP_METHOD_POST,
			new RequestPasswordRecoveryController()
		);

		// URL:		/server/request-user-creation
		// Method:	POST
		$services->define(
			'/request-user-creation',
			HTTP_METHOD_POST,
			new RequestUserCreationController()
		);
		
		// URL:		/server/search-backgrounds
		// Method:	POST
		$services->define(
			'/search-backgrounds',
			HTTP_METHOD_POST,
			new SearchBackgroundsController()
		);
		
		// URL:		/server/search-clinical-impressions
		// Method:	POST
		$services->define(
			'/search-clinical-impressions',
			HTTP_METHOD_POST,
			new SearchClinicalImpressionsController()
		);
		
		// URL:		/server/search-diagnoses
		// Method:	POST
		$services->define(
			'/search-diagnoses',
			HTTP_METHOD_POST,
			new SearchDiagnosesController()
		);
		
		// URL:		/server/search-experiments
		// Method:	POST
		$services->define(
			'/search-experiments',
			HTTP_METHOD_POST,
			new SearchExperimentsController()
		);
		
		// URL:		/server/search-image-tests
		// Method:	POST
		$services->define(
			'/search-image-tests',
			HTTP_METHOD_POST,
			new SearchImageTestsController()
		);
		
		// URL:		/server/search-laboratory-tests
		// Method:	POST
		$services->define(
			'/search-laboratory-tests',
			HTTP_METHOD_POST,
			new SearchLaboratoryTestsController()
		);
		
		// URL:		/server/search-medications
		// Method:	POST
		$services->define(
			'/search-medications',
			HTTP_METHOD_POST,
			new SearchMedicationsController()
		);
		
		// URL:		/server/search-neurocognitive-tests
		// Method:	POST
		$services->define(
			'/search-neurocognitive-tests',
			HTTP_METHOD_POST,
			new SearchNeurocognitiveTestsController()
		);
		
		// URL:		/server/search-patients
		// Method:	POST
		$services->define(
			'/search-patients',
			HTTP_METHOD_POST,
			new SearchPatientsController()
		);
		
		// URL:		/server/search-treatments
		// Method:	POST
		$services->define(
			'/search-treatments',
			HTTP_METHOD_POST,
			new SearchTreatmentsController()
		);
	}
	
}
