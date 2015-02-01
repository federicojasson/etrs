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
		
		// URL:		/server/account/edit
		// Method:	POST
		$app->services->define(
			'/account/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Account\Edit()
		);
		
		// URL:		/server/account/edit-password
		// Method:	POST
		$app->services->define(
			'/account/edit-password',
			HTTP_METHOD_POST,
			new \App\Controllers\Account\EditPassword()
		);
		
		// URL:		/server/account/get
		// Method:	POST
		$app->services->define(
			'/account/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Account\Get()
		);
		
		// URL:		/server/account/get-state
		// Method:	POST
		$app->services->define(
			'/account/get-state',
			HTTP_METHOD_POST,
			new \App\Controllers\Account\GetState()
		);
		
		// URL:		/server/account/recover-password
		// Method:	POST
		$app->services->define(
			'/account/recover-password',
			HTTP_METHOD_POST,
			new \App\Controllers\Account\RecoverPassword()
		);
		
		// URL:		/server/account/sign-in
		// Method:	POST
		$app->services->define(
			'/account/sign-in',
			HTTP_METHOD_POST,
			new \App\Controllers\Account\SignIn()
		);
		
		// URL:		/server/account/sign-out
		// Method:	POST
		$app->services->define(
			'/account/sign-out',
			HTTP_METHOD_POST,
			new \App\Controllers\Account\SignOut()
		);
		
		// URL:		/server/account/sign-up
		// Method:	POST
		$app->services->define(
			'/account/sign-up',
			HTTP_METHOD_POST,
			new \App\Controllers\Account\SignUp()
		);
		
		// URL:		/server/backgrounds/create
		// Method:	POST
		$app->services->define(
			'/backgrounds/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Backgrounds\Create()
		);
		
		// URL:		/server/backgrounds/delete
		// Method:	POST
		$app->services->define(
			'/backgrounds/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\Backgrounds\Delete()
		);
		
		// URL:		/server/backgrounds/edit
		// Method:	POST
		$app->services->define(
			'/backgrounds/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Backgrounds\Edit()
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
		
		// URL:		/server/clinical-impressions/delete
		// Method:	POST
		$app->services->define(
			'/clinical-impressions/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\ClinicalImpressions\Delete()
		);
		
		// URL:		/server/clinical-impressions/edit
		// Method:	POST
		$app->services->define(
			'/clinical-impressions/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\ClinicalImpressions\Edit()
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
		
		// URL:		/server/consultations/delete
		// Method:	POST
		$app->services->define(
			'/consultations/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\Consultations\Delete()
		);
		
		// URL:		/server/consultations/edit
		// Method:	POST
		$app->services->define(
			'/consultations/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Consultations\Edit()
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
		
		// URL:		/server/diagnoses/delete
		// Method:	POST
		$app->services->define(
			'/diagnoses/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\Diagnoses\Delete()
		);
		
		// URL:		/server/diagnoses/edit
		// Method:	POST
		$app->services->define(
			'/diagnoses/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Diagnoses\Edit()
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
		
		// URL:		/server/image-tests/create
		// Method:	POST
		$app->services->define(
			'/image-tests/create',
			HTTP_METHOD_POST,
			new \App\Controllers\ImageTests\Create()
		);
		
		// URL:		/server/image-tests/delete
		// Method:	POST
		$app->services->define(
			'/image-tests/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\ImageTests\Delete()
		);
		
		// URL:		/server/image-tests/edit
		// Method:	POST
		$app->services->define(
			'/image-tests/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\ImageTests\Edit()
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
		
		// URL:		/server/laboratory-tests/delete
		// Method:	POST
		$app->services->define(
			'/laboratory-tests/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\LaboratoryTests\Delete()
		);
		
		// URL:		/server/laboratory-tests/edit
		// Method:	POST
		$app->services->define(
			'/laboratory-tests/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\LaboratoryTests\Edit()
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
		
		// URL:		/server/medications/delete
		// Method:	POST
		$app->services->define(
			'/medications/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\Medications\Delete()
		);
		
		// URL:		/server/medications/edit
		// Method:	POST
		$app->services->define(
			'/medications/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Medications\Edit()
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
		
		// URL:		/server/neurocognitive-tests/delete
		// Method:	POST
		$app->services->define(
			'/neurocognitive-tests/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\NeurocognitiveTests\Delete()
		);
		
		// URL:		/server/neurocognitive-tests/edit
		// Method:	POST
		$app->services->define(
			'/neurocognitive-tests/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\NeurocognitiveTests\Edit()
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
		
		// URL:		/server/patients/delete
		// Method:	POST
		$app->services->define(
			'/patients/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\Patients\Delete()
		);
		
		// URL:		/server/patients/edit
		// Method:	POST
		$app->services->define(
			'/patients/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Patients\Edit()
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
		
		// URL:		/server/permissions/recover-password/create
		// Method:	POST
		$app->services->define(
			'/permissions/recover-password/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Permissions\RecoverPassword\Create()
		);
		
		// URL:		/server/permissions/recover-password/exists
		// Method:	POST
		$app->services->define(
			'/permissions/recover-password/exists',
			HTTP_METHOD_POST,
			new \App\Controllers\Permissions\RecoverPassword\Exists()
		);
		
		// URL:		/server/permissions/sign-up/create
		// Method:	POST
		$app->services->define(
			'/permissions/sign-up/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Permissions\SignUp\Create()
		);
		
		// URL:		/server/permissions/sign-up/exists
		// Method:	POST
		$app->services->define(
			'/permissions/sign-up/exists',
			HTTP_METHOD_POST,
			new \App\Controllers\Permissions\SignUp\Exists()
		);
		
		// URL:		/server/treatments/create
		// Method:	POST
		$app->services->define(
			'/treatments/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Treatments\Create()
		);
		
		// URL:		/server/treatments/delete
		// Method:	POST
		$app->services->define(
			'/treatments/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\Treatments\Delete()
		);
		
		// URL:		/server/treatments/edit
		// Method:	POST
		$app->services->define(
			'/treatments/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Treatments\Edit()
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
		
		// URL:		/server/users/delete
		// Method:	POST
		$app->services->define(
			'/users/delete',
			HTTP_METHOD_POST,
			new \App\Controllers\Users\Delete()
		);
		
		// URL:		/server/users/exists
		// Method:	POST
		$app->services->define(
			'/users/exists',
			HTTP_METHOD_POST,
			new \App\Controllers\Users\Exists()
		);
		
		// URL:		/server/users/get
		// Method:	POST
		$app->services->define(
			'/users/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Users\Get()
		);
	}
	
}
