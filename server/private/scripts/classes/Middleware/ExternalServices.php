<?php

namespace App\Middleware;

/*
 * This middleware defines the external services.
 */
class ExternalServices extends \Slim\Middleware {

	/*
	 * Calls the middleware.
	 */
	public function call() {
		// Defines the external services
		$this->defineExternalServices();

		// Calls the next middleware
		$this->next->call();
	}

	/*
	 * Defines the external services.
	 */
	private function defineExternalServices() {
		$app = $this->app;

		// Defines the external services

		// URI:		/server/account/edit
		// Method:	POST
		$app->services->define(
			'/account/edit',
			'POST',
			new \App\Controller\Account\Edit()
		);

		// URI:		/server/account/get
		// Method:	POST
		$app->services->define(
			'/account/get',
			'POST',
			new \App\Controller\Account\Get()
		);

		// URI:		/server/account/recover-password
		// Method:	POST
		$app->services->define(
			'/account/recover-password',
			'POST',
			new \App\Controller\Account\RecoverPassword()
		);

		// URI:		/server/account/sign-in
		// Method:	POST
		$app->services->define(
			'/account/sign-in',
			'POST',
			new \App\Controller\Account\SignIn()
		);

		// URI:		/server/account/sign-out
		// Method:	POST
		$app->services->define(
			'/account/sign-out',
			'POST',
			new \App\Controller\Account\SignOut()
		);

		// URI:		/server/account/sign-up
		// Method:	POST
		$app->services->define(
			'/account/sign-up',
			'POST',
			new \App\Controller\Account\SignUp()
		);

		// URI:		/server/authentication/get-state
		// Method:	POST
		$app->services->define(
			'/authentication/get-state',
			'POST',
			new \App\Controller\Authentication\GetState()
		);

		// URI:		/server/background/create
		// Method:	POST
		$app->services->define(
			'/background/create',
			'POST',
			new \App\Controller\Background\Create()
		);

		// URI:		/server/background/delete
		// Method:	POST
		$app->services->define(
			'/background/delete',
			'POST',
			new \App\Controller\Background\Delete()
		);

		// URI:		/server/background/edit
		// Method:	POST
		$app->services->define(
			'/background/edit',
			'POST',
			new \App\Controller\Background\Edit()
		);

		// URI:		/server/background/get
		// Method:	POST
		$app->services->define(
			'/background/get',
			'POST',
			new \App\Controller\Background\Get()
		);

		// URI:		/server/background/search
		// Method:	POST
		$app->services->define(
			'/background/search',
			'POST',
			new \App\Controller\Background\Search()
		);

		// URI:		/server/clinical-impression/create
		// Method:	POST
		$app->services->define(
			'/clinical-impression/create',
			'POST',
			new \App\Controller\ClinicalImpression\Create()
		);

		// URI:		/server/clinical-impression/delete
		// Method:	POST
		$app->services->define(
			'/clinical-impression/delete',
			'POST',
			new \App\Controller\ClinicalImpression\Delete()
		);

		// URI:		/server/clinical-impression/edit
		// Method:	POST
		$app->services->define(
			'/clinical-impression/edit',
			'POST',
			new \App\Controller\ClinicalImpression\Edit()
		);

		// URI:		/server/clinical-impression/get
		// Method:	POST
		$app->services->define(
			'/clinical-impression/get',
			'POST',
			new \App\Controller\ClinicalImpression\Get()
		);

		// URI:		/server/clinical-impression/search
		// Method:	POST
		$app->services->define(
			'/clinical-impression/search',
			'POST',
			new \App\Controller\ClinicalImpression\Search()
		);

		// URI:		/server/consultation/create
		// Method:	POST
		$app->services->define(
			'/consultation/create',
			'POST',
			new \App\Controller\Consultation\Create()
		);

		// URI:		/server/consultation/delete
		// Method:	POST
		$app->services->define(
			'/consultation/delete',
			'POST',
			new \App\Controller\Consultation\Delete()
		);

		// URI:		/server/consultation/edit
		// Method:	POST
		$app->services->define(
			'/consultation/edit',
			'POST',
			new \App\Controller\Consultation\Edit()
		);

		// URI:		/server/consultation/get
		// Method:	POST
		$app->services->define(
			'/consultation/get',
			'POST',
			new \App\Controller\Consultation\Get()
		);

		// URI:		/server/diagnosis/create
		// Method:	POST
		$app->services->define(
			'/diagnosis/create',
			'POST',
			new \App\Controller\Diagnosis\Create()
		);

		// URI:		/server/diagnosis/delete
		// Method:	POST
		$app->services->define(
			'/diagnosis/delete',
			'POST',
			new \App\Controller\Diagnosis\Delete()
		);

		// URI:		/server/diagnosis/edit
		// Method:	POST
		$app->services->define(
			'/diagnosis/edit',
			'POST',
			new \App\Controller\Diagnosis\Edit()
		);

		// URI:		/server/diagnosis/get
		// Method:	POST
		$app->services->define(
			'/diagnosis/get',
			'POST',
			new \App\Controller\Diagnosis\Get()
		);

		// URI:		/server/diagnosis/search
		// Method:	POST
		$app->services->define(
			'/diagnosis/search',
			'POST',
			new \App\Controller\Diagnosis\Search()
		);

		// URI:		/server/experiment/create
		// Method:	POST
		$app->services->define(
			'/experiment/create',
			'POST',
			new \App\Controller\Experiment\Create()
		);

		// URI:		/server/experiment/delete
		// Method:	POST
		$app->services->define(
			'/experiment/delete',
			'POST',
			new \App\Controller\Experiment\Delete()
		);

		// URI:		/server/experiment/edit
		// Method:	POST
		$app->services->define(
			'/experiment/edit',
			'POST',
			new \App\Controller\Experiment\Edit()
		);

		// URI:		/server/experiment/get
		// Method:	POST
		$app->services->define(
			'/experiment/get',
			'POST',
			new \App\Controller\Experiment\Get()
		);

		// URI:		/server/experiment/search
		// Method:	POST
		$app->services->define(
			'/experiment/search',
			'POST',
			new \App\Controller\Experiment\Search()
		);

		// URI:		/server/file/download
		// Method:	POST
		$app->services->define(
			'/file/download',
			'POST',
			new \App\Controller\File\Download()
		);

		// URI:		/server/file/get
		// Method:	POST
		$app->services->define(
			'/file/get',
			'POST',
			new \App\Controller\File\Get()
		);

		// URI:		/server/file/upload
		// Method:	POST
		$app->services->define(
			'/file/upload',
			'POST',
			new \App\Controller\File\Upload()
		);

		// URI:		/server/image-test/create
		// Method:	POST
		$app->services->define(
			'/image-test/create',
			'POST',
			new \App\Controller\ImageTest\Create()
		);

		// URI:		/server/image-test/delete
		// Method:	POST
		$app->services->define(
			'/image-test/delete',
			'POST',
			new \App\Controller\ImageTest\Delete()
		);

		// URI:		/server/image-test/edit
		// Method:	POST
		$app->services->define(
			'/image-test/edit',
			'POST',
			new \App\Controller\ImageTest\Edit()
		);

		// URI:		/server/image-test/get
		// Method:	POST
		$app->services->define(
			'/image-test/get',
			'POST',
			new \App\Controller\ImageTest\Get()
		);

		// URI:		/server/image-test/search
		// Method:	POST
		$app->services->define(
			'/image-test/search',
			'POST',
			new \App\Controller\ImageTest\Search()
		);

		// URI:		/server/laboratory-test/create
		// Method:	POST
		$app->services->define(
			'/laboratory-test/create',
			'POST',
			new \App\Controller\LaboratoryTest\Create()
		);

		// URI:		/server/laboratory-test/delete
		// Method:	POST
		$app->services->define(
			'/laboratory-test/delete',
			'POST',
			new \App\Controller\LaboratoryTest\Delete()
		);

		// URI:		/server/laboratory-test/edit
		// Method:	POST
		$app->services->define(
			'/laboratory-test/edit',
			'POST',
			new \App\Controller\LaboratoryTest\Edit()
		);

		// URI:		/server/laboratory-test/get
		// Method:	POST
		$app->services->define(
			'/laboratory-test/get',
			'POST',
			new \App\Controller\LaboratoryTest\Get()
		);

		// URI:		/server/laboratory-test/search
		// Method:	POST
		$app->services->define(
			'/laboratory-test/search',
			'POST',
			new \App\Controller\LaboratoryTest\Search()
		);

		// URI:		/server/log/get
		// Method:	POST
		$app->services->define(
			'/log/get',
			'POST',
			new \App\Controller\Log\Get()
		);

		// URI:		/server/log/search
		// Method:	POST
		$app->services->define(
			'/log/search',
			'POST',
			new \App\Controller\Log\Search()
		);

		// URI:		/server/medication/create
		// Method:	POST
		$app->services->define(
			'/medication/create',
			'POST',
			new \App\Controller\Medication\Create()
		);

		// URI:		/server/medication/delete
		// Method:	POST
		$app->services->define(
			'/medication/delete',
			'POST',
			new \App\Controller\Medication\Delete()
		);

		// URI:		/server/medication/edit
		// Method:	POST
		$app->services->define(
			'/medication/edit',
			'POST',
			new \App\Controller\Medication\Edit()
		);

		// URI:		/server/medication/get
		// Method:	POST
		$app->services->define(
			'/medication/get',
			'POST',
			new \App\Controller\Medication\Get()
		);

		// URI:		/server/medication/search
		// Method:	POST
		$app->services->define(
			'/medication/search',
			'POST',
			new \App\Controller\Medication\Search()
		);

		// URI:		/server/neurocognitive-test/create
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/create',
			'POST',
			new \App\Controller\NeurocognitiveTest\Create()
		);

		// URI:		/server/neurocognitive-test/delete
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/delete',
			'POST',
			new \App\Controller\NeurocognitiveTest\Delete()
		);

		// URI:		/server/neurocognitive-test/edit
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/edit',
			'POST',
			new \App\Controller\NeurocognitiveTest\Edit()
		);

		// URI:		/server/neurocognitive-test/get
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/get',
			'POST',
			new \App\Controller\NeurocognitiveTest\Get()
		);

		// URI:		/server/neurocognitive-test/search
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/search',
			'POST',
			new \App\Controller\NeurocognitiveTest\Search()
		);

		// URI:		/server/patient/create
		// Method:	POST
		$app->services->define(
			'/patient/create',
			'POST',
			new \App\Controller\Patient\Create()
		);

		// URI:		/server/patient/delete
		// Method:	POST
		$app->services->define(
			'/patient/delete',
			'POST',
			new \App\Controller\Patient\Delete()
		);

		// URI:		/server/patient/edit
		// Method:	POST
		$app->services->define(
			'/patient/edit',
			'POST',
			new \App\Controller\Patient\Edit()
		);

		// URI:		/server/patient/get
		// Method:	POST
		$app->services->define(
			'/patient/get',
			'POST',
			new \App\Controller\Patient\Get()
		);

		// URI:		/server/patient/search
		// Method:	POST
		$app->services->define(
			'/patient/search',
			'POST',
			new \App\Controller\Patient\Search()
		);

		// URI:		/server/recover-password-permission/authenticate
		// Method:	POST
		$app->services->define(
			'/recover-password-permission/authenticate',
			'POST',
			new \App\Controller\RecoverPasswordPermission\Authenticate()
		);

		// URI:		/server/recover-password-permission/request
		// Method:	POST
		$app->services->define(
			'/recover-password-permission/request',
			'POST',
			new \App\Controller\RecoverPasswordPermission\Request()
		);

		// URI:		/server/sign-up-permission/authenticate
		// Method:	POST
		$app->services->define(
			'/sign-up-permission/authenticate',
			'POST',
			new \App\Controller\SignUpPermission\Authenticate()
		);

		// URI:		/server/sign-up-permission/request
		// Method:	POST
		$app->services->define(
			'/sign-up-permission/request',
			'POST',
			new \App\Controller\SignUpPermission\Request()
		);

		// URI:		/server/study/conduct
		// Method:	POST
		$app->services->define(
			'/study/conduct',
			'POST',
			new \App\Controller\Study\Conduct()
		);

		// URI:		/server/study/create
		// Method:	POST
		$app->services->define(
			'/study/create',
			'POST',
			new \App\Controller\Study\Create()
		);

		// URI:		/server/study/delete
		// Method:	POST
		$app->services->define(
			'/study/delete',
			'POST',
			new \App\Controller\Study\Delete()
		);

		// URI:		/server/study/edit
		// Method:	POST
		$app->services->define(
			'/study/edit',
			'POST',
			new \App\Controller\Study\Edit()
		);

		// URI:		/server/study/get
		// Method:	POST
		$app->services->define(
			'/study/get',
			'POST',
			new \App\Controller\Study\Get()
		);

		// URI:		/server/treatment/create
		// Method:	POST
		$app->services->define(
			'/treatment/create',
			'POST',
			new \App\Controller\Treatment\Create()
		);

		// URI:		/server/treatment/delete
		// Method:	POST
		$app->services->define(
			'/treatment/delete',
			'POST',
			new \App\Controller\Treatment\Delete()
		);

		// URI:		/server/treatment/edit
		// Method:	POST
		$app->services->define(
			'/treatment/edit',
			'POST',
			new \App\Controller\Treatment\Edit()
		);

		// URI:		/server/treatment/get
		// Method:	POST
		$app->services->define(
			'/treatment/get',
			'POST',
			new \App\Controller\Treatment\Get()
		);

		// URI:		/server/treatment/search
		// Method:	POST
		$app->services->define(
			'/treatment/search',
			'POST',
			new \App\Controller\Treatment\Search()
		);

		// URI:		/server/user/delete
		// Method:	POST
		$app->services->define(
			'/user/delete',
			'POST',
			new \App\Controller\User\Delete()
		);

		// URI:		/server/user/exists
		// Method:	POST
		$app->services->define(
			'/user/exists',
			'POST',
			new \App\Controller\User\Exists()
		);

		// URI:		/server/user/get
		// Method:	POST
		$app->services->define(
			'/user/get',
			'POST',
			new \App\Controller\User\Get()
		);
	}

}
