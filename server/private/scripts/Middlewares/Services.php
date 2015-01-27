<?php

namespace App\Middlewares;

/*
 * This middleware defines the services.
 */
class Services extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
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
		$app = $this->app;
		
		// URL:		/server/authentication/get-state
		// Method:	POST
		$app->services->define(
			'/authentication/get-state',
			HTTP_METHOD_POST,
			new \App\Controllers\Authentication\GetState()
		);
		
		// URL:		/server/authentication/sign-in
		// Method:	POST
		$app->services->define(
			'/authentication/sign-in',
			HTTP_METHOD_POST,
			new \App\Controllers\Authentication\SignIn()
		);
		
		// URL:		/server/authentication/sign-out
		// Method:	POST
		$app->services->define(
			'/authentication/sign-out',
			HTTP_METHOD_POST,
			new \App\Controllers\Authentication\SignOut()
		);
		
		// URL:		/server/backgrounds/create
		// Method:	POST
		$app->services->define(
			'/backgrounds/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Backgrounds\Create()
		);
		
		// URL:		/server/backgrounds/edit
		// Method:	POST
		$app->services->define(
			'/backgrounds/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Backgrounds\Edit()
		);
		
		// URL:		/server/backgrounds/erase
		// Method:	POST
		$app->services->define(
			'/backgrounds/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\Backgrounds\Erase()
		);
		
		// URL:		/server/backgrounds/get
		// Method:	POST
		$app->services->define(
			'/backgrounds/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Backgrounds\Get()
		);
		
		// URL:		/server/backgrounds/search
		// Method:	POST
		$app->services->define(
			'/backgrounds/search',
			HTTP_METHOD_POST,
			new \App\Controllers\Backgrounds\Search()
		);
		
		// URL:		/server/clinical-impressions/create
		// Method:	POST
		$app->services->define(
			'/clinical-impressions/create',
			HTTP_METHOD_POST,
			new \App\Controllers\ClinicalImpressions\Create()
		);
		
		// URL:		/server/clinical-impressions/edit
		// Method:	POST
		$app->services->define(
			'/clinical-impressions/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\ClinicalImpressions\Edit()
		);
		
		// URL:		/server/clinical-impressions/erase
		// Method:	POST
		$app->services->define(
			'/clinical-impressions/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\ClinicalImpressions\Erase()
		);
		
		// URL:		/server/clinical-impressions/get
		// Method:	POST
		$app->services->define(
			'/clinical-impressions/get',
			HTTP_METHOD_POST,
			new \App\Controllers\ClinicalImpressions\Get()
		);
		
		// URL:		/server/clinical-impressions/search
		// Method:	POST
		$app->services->define(
			'/clinical-impressions/search',
			HTTP_METHOD_POST,
			new \App\Controllers\ClinicalImpressions\Search()
		);
		
		// URL:		/server/consultations/create
		// Method:	POST
		$app->services->define(
			'/consultations/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Consultations\Create()
		);
		
		// URL:		/server/consultations/edit
		// Method:	POST
		$app->services->define(
			'/consultations/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Consultations\Edit()
		);
		
		// URL:		/server/consultations/erase
		// Method:	POST
		$app->services->define(
			'/consultations/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\Consultations\Erase()
		);
		
		// URL:		/server/consultations/get
		// Method:	POST
		$app->services->define(
			'/consultations/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Consultations\Get()
		);
		
		// URL:		/server/diagnoses/create
		// Method:	POST
		$app->services->define(
			'/diagnoses/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Diagnoses\Create()
		);
		
		// URL:		/server/diagnoses/edit
		// Method:	POST
		$app->services->define(
			'/diagnoses/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Diagnoses\Edit()
		);
		
		// URL:		/server/diagnoses/erase
		// Method:	POST
		$app->services->define(
			'/diagnoses/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\Diagnoses\Erase()
		);
		
		// URL:		/server/diagnoses/get
		// Method:	POST
		$app->services->define(
			'/diagnoses/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Diagnoses\Get()
		);
		
		// URL:		/server/diagnoses/search
		// Method:	POST
		$app->services->define(
			'/diagnoses/search',
			HTTP_METHOD_POST,
			new \App\Controllers\Diagnoses\Search()
		);
		
		// URL:		/server/experiments/create
		// Method:	POST
		$app->services->define(
			'/experiments/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Experiments\Create()
		);
		
		// URL:		/server/experiments/edit
		// Method:	POST
		$app->services->define(
			'/experiments/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Experiments\Edit()
		);
		
		// URL:		/server/experiments/erase
		// Method:	POST
		$app->services->define(
			'/experiments/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\Experiments\Erase()
		);
		
		// URL:		/server/experiments/get
		// Method:	POST
		$app->services->define(
			'/experiments/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Experiments\Get()
		);
		
		// URL:		/server/experiments/search
		// Method:	POST
		$app->services->define(
			'/experiments/search',
			HTTP_METHOD_POST,
			new \App\Controllers\Experiments\Search()
		);
		
		// URL:		/server/image-tests/create
		// Method:	POST
		$app->services->define(
			'/image-tests/create',
			HTTP_METHOD_POST,
			new \App\Controllers\ImageTests\Create()
		);
		
		// URL:		/server/image-tests/edit
		// Method:	POST
		$app->services->define(
			'/image-tests/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\ImageTests\Edit()
		);
		
		// URL:		/server/image-tests/erase
		// Method:	POST
		$app->services->define(
			'/image-tests/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\ImageTests\Erase()
		);
		
		// URL:		/server/image-tests/get
		// Method:	POST
		$app->services->define(
			'/image-tests/get',
			HTTP_METHOD_POST,
			new \App\Controllers\ImageTests\Get()
		);
		
		// URL:		/server/image-tests/search
		// Method:	POST
		$app->services->define(
			'/image-tests/search',
			HTTP_METHOD_POST,
			new \App\Controllers\ImageTests\Search()
		);
		
		// URL:		/server/laboratory-tests/create
		// Method:	POST
		$app->services->define(
			'/laboratory-tests/create',
			HTTP_METHOD_POST,
			new \App\Controllers\LaboratoryTests\Create()
		);
		
		// URL:		/server/laboratory-tests/edit
		// Method:	POST
		$app->services->define(
			'/laboratory-tests/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\LaboratoryTests\Edit()
		);
		
		// URL:		/server/laboratory-tests/erase
		// Method:	POST
		$app->services->define(
			'/laboratory-tests/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\LaboratoryTests\Erase()
		);
		
		// URL:		/server/laboratory-tests/get
		// Method:	POST
		$app->services->define(
			'/laboratory-tests/get',
			HTTP_METHOD_POST,
			new \App\Controllers\LaboratoryTests\Get()
		);
		
		// URL:		/server/laboratory-tests/search
		// Method:	POST
		$app->services->define(
			'/laboratory-tests/search',
			HTTP_METHOD_POST,
			new \App\Controllers\LaboratoryTests\Search()
		);
		
		// URL:		/server/medications/create
		// Method:	POST
		$app->services->define(
			'/medications/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Medications\Create()
		);
		
		// URL:		/server/medications/edit
		// Method:	POST
		$app->services->define(
			'/medications/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Medications\Edit()
		);
		
		// URL:		/server/medications/erase
		// Method:	POST
		$app->services->define(
			'/medications/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\Medications\Erase()
		);
		
		// URL:		/server/medications/get
		// Method:	POST
		$app->services->define(
			'/medications/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Medications\Get()
		);
		
		// URL:		/server/medications/search
		// Method:	POST
		$app->services->define(
			'/medications/search',
			HTTP_METHOD_POST,
			new \App\Controllers\Medications\Search()
		);
		
		// URL:		/server/neurocognitive-tests/create
		// Method:	POST
		$app->services->define(
			'/neurocognitive-tests/create',
			HTTP_METHOD_POST,
			new \App\Controllers\NeurocognitiveTests\Create()
		);
		
		// URL:		/server/neurocognitive-tests/edit
		// Method:	POST
		$app->services->define(
			'/neurocognitive-tests/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\NeurocognitiveTests\Edit()
		);
		
		// URL:		/server/neurocognitive-tests/erase
		// Method:	POST
		$app->services->define(
			'/neurocognitive-tests/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\NeurocognitiveTests\Erase()
		);
		
		// URL:		/server/neurocognitive-tests/get
		// Method:	POST
		$app->services->define(
			'/neurocognitive-tests/get',
			HTTP_METHOD_POST,
			new \App\Controllers\NeurocognitiveTests\Get()
		);
		
		// URL:		/server/neurocognitive-tests/search
		// Method:	POST
		$app->services->define(
			'/neurocognitive-tests/search',
			HTTP_METHOD_POST,
			new \App\Controllers\NeurocognitiveTests\Search()
		);
		
		// URL:		/server/patients/create
		// Method:	POST
		$app->services->define(
			'/patients/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Patients\Create()
		);
		
		// URL:		/server/patients/edit
		// Method:	POST
		$app->services->define(
			'/patients/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Patients\Edit()
		);
		
		// URL:		/server/patients/erase
		// Method:	POST
		$app->services->define(
			'/patients/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\Patients\Erase()
		);
		
		// URL:		/server/patients/get
		// Method:	POST
		$app->services->define(
			'/patients/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Patients\Get()
		);
		
		// URL:		/server/patients/search
		// Method:	POST
		$app->services->define(
			'/patients/search',
			HTTP_METHOD_POST,
			new \App\Controllers\Patients\Search()
		);
		
		// URL:		/server/studies/create
		// Method:	POST
		$app->services->define(
			'/studies/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Studies\Create()
		);
		
		// URL:		/server/studies/edit
		// Method:	POST
		$app->services->define(
			'/studies/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Studies\Edit()
		);
		
		// URL:		/server/studies/erase
		// Method:	POST
		$app->services->define(
			'/studies/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\Studies\Erase()
		);
		
		// URL:		/server/studies/get
		// Method:	POST
		$app->services->define(
			'/studies/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Studies\Get()
		);
		
		// TODO: remove
		// URL:		/server/test/upload
		// Method:	POST
		$app->services->define(
			'/test/upload',
			HTTP_METHOD_POST,
			new \App\Controllers\Test\Upload()
		);
		
		// URL:		/server/treatments/create
		// Method:	POST
		$app->services->define(
			'/treatments/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Treatments\Create()
		);
		
		// URL:		/server/treatments/edit
		// Method:	POST
		$app->services->define(
			'/treatments/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Treatments\Edit()
		);
		
		// URL:		/server/treatments/erase
		// Method:	POST
		$app->services->define(
			'/treatments/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\Treatments\Erase()
		);
		
		// URL:		/server/treatments/get
		// Method:	POST
		$app->services->define(
			'/treatments/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Treatments\Get()
		);
		
		// URL:		/server/treatments/search
		// Method:	POST
		$app->services->define(
			'/treatments/search',
			HTTP_METHOD_POST,
			new \App\Controllers\Treatments\Search()
		);
	}
	
}
