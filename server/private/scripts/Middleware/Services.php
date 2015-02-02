<?php

namespace App\Middleware;

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
		
		// Defines the services
		
		// URL:		/server/authentication/get
		// Method:	POST
		$app->services->define(
			'/authentication/get',
			'POST',
			new \App\Controller\Authentication\Get()
		);
		
		// URL:		/server/background/create
		// Method:	POST
		$app->services->define(
			'/background/create',
			'POST',
			new \App\Controller\Background\Create()
		);
		
		// URL:		/server/background/delete
		// Method:	POST
		$app->services->define(
			'/background/delete',
			'POST',
			new \App\Controller\Background\Delete()
		);
		
		// URL:		/server/background/edit
		// Method:	POST
		$app->services->define(
			'/background/edit',
			'POST',
			new \App\Controller\Background\Edit()
		);
		
		// URL:		/server/background/get
		// Method:	POST
		$app->services->define(
			'/background/get',
			'POST',
			new \App\Controller\Background\Get()
		);
		
		// URL:		/server/background/search
		// Method:	POST
		$app->services->define(
			'/background/search',
			'POST',
			new \App\Controller\Background\search()
		);
		
		// URL:		/server/clinical-impression/create
		// Method:	POST
		$app->services->define(
			'/clinical-impression/create',
			'POST',
			new \App\Controller\ClinicalImpression\Create()
		);
		
		// URL:		/server/clinical-impression/delete
		// Method:	POST
		$app->services->define(
			'/clinical-impression/delete',
			'POST',
			new \App\Controller\ClinicalImpression\Delete()
		);
		
		// URL:		/server/clinical-impression/edit
		// Method:	POST
		$app->services->define(
			'/clinical-impression/edit',
			'POST',
			new \App\Controller\ClinicalImpression\Edit()
		);
		
		// URL:		/server/clinical-impression/get
		// Method:	POST
		$app->services->define(
			'/clinical-impression/get',
			'POST',
			new \App\Controller\ClinicalImpression\Get()
		);
		
		// URL:		/server/clinical-impression/search
		// Method:	POST
		$app->services->define(
			'/clinical-impression/search',
			'POST',
			new \App\Controller\ClinicalImpression\search()
		);
		
		// URL:		/server/consultation/create
		// Method:	POST
		$app->services->define(
			'/consultation/create',
			'POST',
			new \App\Controller\Consultation\Create()
		);
		
		// URL:		/server/consultation/delete
		// Method:	POST
		$app->services->define(
			'/consultation/delete',
			'POST',
			new \App\Controller\Consultation\Delete()
		);
		
		// URL:		/server/consultation/edit
		// Method:	POST
		$app->services->define(
			'/consultation/edit',
			'POST',
			new \App\Controller\Consultation\Edit()
		);
		
		// URL:		/server/consultation/get
		// Method:	POST
		$app->services->define(
			'/consultation/get',
			'POST',
			new \App\Controller\Consultation\Get()
		);
		
		// URL:		/server/diagnosis/create
		// Method:	POST
		$app->services->define(
			'/diagnosis/create',
			'POST',
			new \App\Controller\Diagnosis\Create()
		);
		
		// URL:		/server/diagnosis/delete
		// Method:	POST
		$app->services->define(
			'/diagnosis/delete',
			'POST',
			new \App\Controller\Diagnosis\Delete()
		);
		
		// URL:		/server/diagnosis/edit
		// Method:	POST
		$app->services->define(
			'/diagnosis/edit',
			'POST',
			new \App\Controller\Diagnosis\Edit()
		);
		
		// URL:		/server/diagnosis/get
		// Method:	POST
		$app->services->define(
			'/diagnosis/get',
			'POST',
			new \App\Controller\Diagnosis\Get()
		);
		
		// URL:		/server/diagnosis/search
		// Method:	POST
		$app->services->define(
			'/diagnosis/search',
			'POST',
			new \App\Controller\Diagnosis\search()
		);
		
		// URL:		/server/experiment/create
		// Method:	POST
		$app->services->define(
			'/experiment/create',
			'POST',
			new \App\Controller\Experiment\Create()
		);
		
		// URL:		/server/experiment/delete
		// Method:	POST
		$app->services->define(
			'/experiment/delete',
			'POST',
			new \App\Controller\Experiment\Delete()
		);
		
		// URL:		/server/experiment/edit
		// Method:	POST
		$app->services->define(
			'/experiment/edit',
			'POST',
			new \App\Controller\Experiment\Edit()
		);
		
		// URL:		/server/experiment/get
		// Method:	POST
		$app->services->define(
			'/experiment/get',
			'POST',
			new \App\Controller\Experiment\Get()
		);
		
		// URL:		/server/experiment/search
		// Method:	POST
		$app->services->define(
			'/experiment/search',
			'POST',
			new \App\Controller\Experiment\search()
		);
		
		// URL:		/server/image-test/create
		// Method:	POST
		$app->services->define(
			'/image-test/create',
			'POST',
			new \App\Controller\ImageTest\Create()
		);
		
		// URL:		/server/image-test/delete
		// Method:	POST
		$app->services->define(
			'/image-test/delete',
			'POST',
			new \App\Controller\ImageTest\Delete()
		);
		
		// URL:		/server/image-test/edit
		// Method:	POST
		$app->services->define(
			'/image-test/edit',
			'POST',
			new \App\Controller\ImageTest\Edit()
		);
		
		// URL:		/server/image-test/get
		// Method:	POST
		$app->services->define(
			'/image-test/get',
			'POST',
			new \App\Controller\ImageTest\Get()
		);
		
		// URL:		/server/image-test/search
		// Method:	POST
		$app->services->define(
			'/image-test/search',
			'POST',
			new \App\Controller\ImageTest\search()
		);
		
		// URL:		/server/laboratory-test/create
		// Method:	POST
		$app->services->define(
			'/laboratory-test/create',
			'POST',
			new \App\Controller\LaboratoryTest\Create()
		);
		
		// URL:		/server/laboratory-test/delete
		// Method:	POST
		$app->services->define(
			'/laboratory-test/delete',
			'POST',
			new \App\Controller\LaboratoryTest\Delete()
		);
		
		// URL:		/server/laboratory-test/edit
		// Method:	POST
		$app->services->define(
			'/laboratory-test/edit',
			'POST',
			new \App\Controller\LaboratoryTest\Edit()
		);
		
		// URL:		/server/laboratory-test/get
		// Method:	POST
		$app->services->define(
			'/laboratory-test/get',
			'POST',
			new \App\Controller\LaboratoryTest\Get()
		);
		
		// URL:		/server/laboratory-test/search
		// Method:	POST
		$app->services->define(
			'/laboratory-test/search',
			'POST',
			new \App\Controller\LaboratoryTest\search()
		);
		
		// URL:		/server/medication/create
		// Method:	POST
		$app->services->define(
			'/medication/create',
			'POST',
			new \App\Controller\Medication\Create()
		);
		
		// URL:		/server/medication/delete
		// Method:	POST
		$app->services->define(
			'/medication/delete',
			'POST',
			new \App\Controller\Medication\Delete()
		);
		
		// URL:		/server/medication/edit
		// Method:	POST
		$app->services->define(
			'/medication/edit',
			'POST',
			new \App\Controller\Medication\Edit()
		);
		
		// URL:		/server/medication/get
		// Method:	POST
		$app->services->define(
			'/medication/get',
			'POST',
			new \App\Controller\Medication\Get()
		);
		
		// URL:		/server/medication/search
		// Method:	POST
		$app->services->define(
			'/medication/search',
			'POST',
			new \App\Controller\Medication\search()
		);
		
		// URL:		/server/neurocognitive-test/create
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/create',
			'POST',
			new \App\Controller\NeurocognitiveTest\Create()
		);
		
		// URL:		/server/neurocognitive-test/delete
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/delete',
			'POST',
			new \App\Controller\NeurocognitiveTest\Delete()
		);
		
		// URL:		/server/neurocognitive-test/edit
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/edit',
			'POST',
			new \App\Controller\NeurocognitiveTest\Edit()
		);
		
		// URL:		/server/neurocognitive-test/get
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/get',
			'POST',
			new \App\Controller\NeurocognitiveTest\Get()
		);
		
		// URL:		/server/neurocognitive-test/search
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/search',
			'POST',
			new \App\Controller\NeurocognitiveTest\search()
		);
		
		// URL:		/server/patient/create
		// Method:	POST
		$app->services->define(
			'/patient/create',
			'POST',
			new \App\Controller\Patient\Create()
		);
		
		// URL:		/server/patient/delete
		// Method:	POST
		$app->services->define(
			'/patient/delete',
			'POST',
			new \App\Controller\Patient\Delete()
		);
		
		// URL:		/server/patient/edit
		// Method:	POST
		$app->services->define(
			'/patient/edit',
			'POST',
			new \App\Controller\Patient\Edit()
		);
		
		// URL:		/server/patient/get
		// Method:	POST
		$app->services->define(
			'/patient/get',
			'POST',
			new \App\Controller\Patient\Get()
		);
		
		// URL:		/server/patient/search
		// Method:	POST
		$app->services->define(
			'/patient/search',
			'POST',
			new \App\Controller\Patient\search()
		);
		
		// URL:		/server/study/create
		// Method:	POST
		$app->services->define(
			'/study/create',
			'POST',
			new \App\Controller\Study\Create()
		);
		
		// URL:		/server/study/delete
		// Method:	POST
		$app->services->define(
			'/study/delete',
			'POST',
			new \App\Controller\Study\Delete()
		);
		
		// URL:		/server/study/edit
		// Method:	POST
		$app->services->define(
			'/study/edit',
			'POST',
			new \App\Controller\Study\Edit()
		);
		
		// URL:		/server/study/get
		// Method:	POST
		$app->services->define(
			'/study/get',
			'POST',
			new \App\Controller\Study\Get()
		);
		
		// URL:		/server/treatment/create
		// Method:	POST
		$app->services->define(
			'/treatment/create',
			'POST',
			new \App\Controller\Treatment\Create()
		);
		
		// URL:		/server/treatment/delete
		// Method:	POST
		$app->services->define(
			'/treatment/delete',
			'POST',
			new \App\Controller\Treatment\Delete()
		);
		
		// URL:		/server/treatment/edit
		// Method:	POST
		$app->services->define(
			'/treatment/edit',
			'POST',
			new \App\Controller\Treatment\Edit()
		);
		
		// URL:		/server/treatment/get
		// Method:	POST
		$app->services->define(
			'/treatment/get',
			'POST',
			new \App\Controller\Treatment\Get()
		);
		
		// URL:		/server/treatment/search
		// Method:	POST
		$app->services->define(
			'/treatment/search',
			'POST',
			new \App\Controller\Treatment\search()
		);
	}
	
}
