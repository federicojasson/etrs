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
		
		// URL:		/server/create-neurocognitive-evaluation
		// Method:	POST
		$services->define(
			'/create-neurocognitive-evaluation',
			HTTP_METHOD_POST,
			new CreateNeurocognitiveEvaluationController()
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
		
		// URL:		/server/erase-neurocognitive-evaluation
		// Method:	POST
		$services->define(
			'/erase-neurocognitive-evaluation',
			HTTP_METHOD_POST,
			new EraseNeurocognitiveEvaluationController()
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
		
		// URL:		/server/get-backgrounds
		// Method:	POST
		$services->define(
			'/get-backgrounds',
			HTTP_METHOD_POST,
			new GetBackgroundsController()
		);
		
		// URL:		/server/get-clinical-impression
		// Method:	POST
		$services->define(
			'/get-clinical-impression',
			HTTP_METHOD_POST,
			new GetClinicalImpressionController()
		);
		
		// URL:		/server/get-clinical-impressions
		// Method:	POST
		$services->define(
			'/get-clinical-impressions',
			HTTP_METHOD_POST,
			new GetClinicalImpressionsController()
		);
		
		// URL:		/server/get-consultation
		// Method:	POST
		$services->define(
			'/get-consultation',
			HTTP_METHOD_POST,
			new GetConsultationController()
		);
		
		// URL:		/server/get-diagnoses
		// Method:	POST
		$services->define(
			'/get-diagnoses',
			HTTP_METHOD_POST,
			new GetDiagnosesController()
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
		
		// URL:		/server/get-experiments
		// Method:	POST
		$services->define(
			'/get-experiments',
			HTTP_METHOD_POST,
			new GetExperimentsController()
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
		
		// URL:		/server/get-image-tests
		// Method:	POST
		$services->define(
			'/get-image-tests',
			HTTP_METHOD_POST,
			new GetImageTestsController()
		);
		
		// URL:		/server/get-laboratory-test
		// Method:	POST
		$services->define(
			'/get-laboratory-test',
			HTTP_METHOD_POST,
			new GetLaboratoryTestController()
		);
		
		// URL:		/server/get-laboratory-tests
		// Method:	POST
		$services->define(
			'/get-laboratory-tests',
			HTTP_METHOD_POST,
			new GetLaboratoryTestsController()
		);
		
		// URL:		/server/get-medication
		// Method:	POST
		$services->define(
			'/get-medication',
			HTTP_METHOD_POST,
			new GetMedicationController()
		);
		
		// URL:		/server/get-medications
		// Method:	POST
		$services->define(
			'/get-medications',
			HTTP_METHOD_POST,
			new GetMedicationsController()
		);
		
		// URL:		/server/get-neurocognitive-evaluations
		// Method:	POST
		$services->define(
			'/get-neurocognitive-evaluations',
			HTTP_METHOD_POST,
			new GetNeurocognitiveEvaluationsController()
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
		
		// URL:		/server/get-treatments
		// Method:	POST
		$services->define(
			'/get-treatments',
			HTTP_METHOD_POST,
			new GetTreatmentsController()
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
		
		// URL:		/server/search-patients
		// Method:	POST
		$services->define(
			'/search-patients',
			HTTP_METHOD_POST,
			new SearchPatientsController()
		);
	}
	
}
