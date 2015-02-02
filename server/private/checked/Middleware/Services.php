<?php

namespace App\Middleware;

use \App\Controller\Authentication as Authentication;
use \App\Controller\Background as Background;
use \App\Controller\ClinicalImpression as ClinicalImpression;
use \App\Controller\Consultation as Consultation;
use \App\Controller\Diagnosis as Diagnosis;
use \App\Controller\Experiment as Experiment;
use \App\Controller\ImageTest as ImageTest;
use \App\Controller\LaboratoryTest as LaboratoryTest;
use \App\Controller\Medication as Medication;
use \App\Controller\NeurocognitiveTest as NeurocognitiveTest;
use \App\Controller\Patient as Patient;
use \App\Controller\Study as Study;
use \App\Controller\Treatment as Treatment;

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
		
		// URL:		/server/authentication/get-state
		// Method:	POST
		$app->services->define(
			'/authentication/get-state',
			'POST',
			new Authentication\GetState()
		);
		
		// URL:		/server/background/create
		// Method:	POST
		$app->services->define(
			'/background/create',
			'POST',
			new Background\Create()
		);
		
		// URL:		/server/background/delete
		// Method:	POST
		$app->services->define(
			'/background/delete',
			'POST',
			new Background\Delete()
		);
		
		// URL:		/server/background/edit
		// Method:	POST
		$app->services->define(
			'/background/edit',
			'POST',
			new Background\Edit()
		);
		
		// URL:		/server/background/get
		// Method:	POST
		$app->services->define(
			'/background/get',
			'POST',
			new Background\Get()
		);
		
		// URL:		/server/background/search
		// Method:	POST
		$app->services->define(
			'/background/search',
			'POST',
			new Background\search()
		);
		
		// URL:		/server/clinical-impression/create
		// Method:	POST
		$app->services->define(
			'/clinical-impression/create',
			'POST',
			new ClinicalImpression\Create()
		);
		
		// URL:		/server/clinical-impression/delete
		// Method:	POST
		$app->services->define(
			'/clinical-impression/delete',
			'POST',
			new ClinicalImpression\Delete()
		);
		
		// URL:		/server/clinical-impression/edit
		// Method:	POST
		$app->services->define(
			'/clinical-impression/edit',
			'POST',
			new ClinicalImpression\Edit()
		);
		
		// URL:		/server/clinical-impression/get
		// Method:	POST
		$app->services->define(
			'/clinical-impression/get',
			'POST',
			new ClinicalImpression\Get()
		);
		
		// URL:		/server/clinical-impression/search
		// Method:	POST
		$app->services->define(
			'/clinical-impression/search',
			'POST',
			new ClinicalImpression\search()
		);
		
		// URL:		/server/consultation/create
		// Method:	POST
		$app->services->define(
			'/consultation/create',
			'POST',
			new Consultation\Create()
		);
		
		// URL:		/server/consultation/delete
		// Method:	POST
		$app->services->define(
			'/consultation/delete',
			'POST',
			new Consultation\Delete()
		);
		
		// URL:		/server/consultation/edit
		// Method:	POST
		$app->services->define(
			'/consultation/edit',
			'POST',
			new Consultation\Edit()
		);
		
		// URL:		/server/consultation/get
		// Method:	POST
		$app->services->define(
			'/consultation/get',
			'POST',
			new Consultation\Get()
		);
		
		// URL:		/server/diagnosis/create
		// Method:	POST
		$app->services->define(
			'/diagnosis/create',
			'POST',
			new Diagnosis\Create()
		);
		
		// URL:		/server/diagnosis/delete
		// Method:	POST
		$app->services->define(
			'/diagnosis/delete',
			'POST',
			new Diagnosis\Delete()
		);
		
		// URL:		/server/diagnosis/edit
		// Method:	POST
		$app->services->define(
			'/diagnosis/edit',
			'POST',
			new Diagnosis\Edit()
		);
		
		// URL:		/server/diagnosis/get
		// Method:	POST
		$app->services->define(
			'/diagnosis/get',
			'POST',
			new Diagnosis\Get()
		);
		
		// URL:		/server/diagnosis/search
		// Method:	POST
		$app->services->define(
			'/diagnosis/search',
			'POST',
			new Diagnosis\search()
		);
		
		// URL:		/server/experiment/create
		// Method:	POST
		$app->services->define(
			'/experiment/create',
			'POST',
			new Experiment\Create()
		);
		
		// URL:		/server/experiment/delete
		// Method:	POST
		$app->services->define(
			'/experiment/delete',
			'POST',
			new Experiment\Delete()
		);
		
		// URL:		/server/experiment/edit
		// Method:	POST
		$app->services->define(
			'/experiment/edit',
			'POST',
			new Experiment\Edit()
		);
		
		// URL:		/server/experiment/get
		// Method:	POST
		$app->services->define(
			'/experiment/get',
			'POST',
			new Experiment\Get()
		);
		
		// URL:		/server/experiment/search
		// Method:	POST
		$app->services->define(
			'/experiment/search',
			'POST',
			new Experiment\search()
		);
		
		// URL:		/server/image-test/create
		// Method:	POST
		$app->services->define(
			'/image-test/create',
			'POST',
			new ImageTest\Create()
		);
		
		// URL:		/server/image-test/delete
		// Method:	POST
		$app->services->define(
			'/image-test/delete',
			'POST',
			new ImageTest\Delete()
		);
		
		// URL:		/server/image-test/edit
		// Method:	POST
		$app->services->define(
			'/image-test/edit',
			'POST',
			new ImageTest\Edit()
		);
		
		// URL:		/server/image-test/get
		// Method:	POST
		$app->services->define(
			'/image-test/get',
			'POST',
			new ImageTest\Get()
		);
		
		// URL:		/server/image-test/search
		// Method:	POST
		$app->services->define(
			'/image-test/search',
			'POST',
			new ImageTest\search()
		);
		
		// URL:		/server/laboratory-test/create
		// Method:	POST
		$app->services->define(
			'/laboratory-test/create',
			'POST',
			new LaboratoryTest\Create()
		);
		
		// URL:		/server/laboratory-test/delete
		// Method:	POST
		$app->services->define(
			'/laboratory-test/delete',
			'POST',
			new LaboratoryTest\Delete()
		);
		
		// URL:		/server/laboratory-test/edit
		// Method:	POST
		$app->services->define(
			'/laboratory-test/edit',
			'POST',
			new LaboratoryTest\Edit()
		);
		
		// URL:		/server/laboratory-test/get
		// Method:	POST
		$app->services->define(
			'/laboratory-test/get',
			'POST',
			new LaboratoryTest\Get()
		);
		
		// URL:		/server/laboratory-test/search
		// Method:	POST
		$app->services->define(
			'/laboratory-test/search',
			'POST',
			new LaboratoryTest\search()
		);
		
		// URL:		/server/medication/create
		// Method:	POST
		$app->services->define(
			'/medication/create',
			'POST',
			new Medication\Create()
		);
		
		// URL:		/server/medication/delete
		// Method:	POST
		$app->services->define(
			'/medication/delete',
			'POST',
			new Medication\Delete()
		);
		
		// URL:		/server/medication/edit
		// Method:	POST
		$app->services->define(
			'/medication/edit',
			'POST',
			new Medication\Edit()
		);
		
		// URL:		/server/medication/get
		// Method:	POST
		$app->services->define(
			'/medication/get',
			'POST',
			new Medication\Get()
		);
		
		// URL:		/server/medication/search
		// Method:	POST
		$app->services->define(
			'/medication/search',
			'POST',
			new Medication\search()
		);
		
		// URL:		/server/neurocognitive-test/create
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/create',
			'POST',
			new NeurocognitiveTest\Create()
		);
		
		// URL:		/server/neurocognitive-test/delete
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/delete',
			'POST',
			new NeurocognitiveTest\Delete()
		);
		
		// URL:		/server/neurocognitive-test/edit
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/edit',
			'POST',
			new NeurocognitiveTest\Edit()
		);
		
		// URL:		/server/neurocognitive-test/get
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/get',
			'POST',
			new NeurocognitiveTest\Get()
		);
		
		// URL:		/server/neurocognitive-test/search
		// Method:	POST
		$app->services->define(
			'/neurocognitive-test/search',
			'POST',
			new NeurocognitiveTest\search()
		);
		
		// URL:		/server/patient/create
		// Method:	POST
		$app->services->define(
			'/patient/create',
			'POST',
			new Patient\Create()
		);
		
		// URL:		/server/patient/delete
		// Method:	POST
		$app->services->define(
			'/patient/delete',
			'POST',
			new Patient\Delete()
		);
		
		// URL:		/server/patient/edit
		// Method:	POST
		$app->services->define(
			'/patient/edit',
			'POST',
			new Patient\Edit()
		);
		
		// URL:		/server/patient/get
		// Method:	POST
		$app->services->define(
			'/patient/get',
			'POST',
			new Patient\Get()
		);
		
		// URL:		/server/patient/search
		// Method:	POST
		$app->services->define(
			'/patient/search',
			'POST',
			new Patient\search()
		);
		
		// URL:		/server/study/create
		// Method:	POST
		$app->services->define(
			'/study/create',
			'POST',
			new Study\Create()
		);
		
		// URL:		/server/study/delete
		// Method:	POST
		$app->services->define(
			'/study/delete',
			'POST',
			new Study\Delete()
		);
		
		// URL:		/server/study/edit
		// Method:	POST
		$app->services->define(
			'/study/edit',
			'POST',
			new Study\Edit()
		);
		
		// URL:		/server/study/get
		// Method:	POST
		$app->services->define(
			'/study/get',
			'POST',
			new Study\Get()
		);
		
		// URL:		/server/treatment/create
		// Method:	POST
		$app->services->define(
			'/treatment/create',
			'POST',
			new Treatment\Create()
		);
		
		// URL:		/server/treatment/delete
		// Method:	POST
		$app->services->define(
			'/treatment/delete',
			'POST',
			new Treatment\Delete()
		);
		
		// URL:		/server/treatment/edit
		// Method:	POST
		$app->services->define(
			'/treatment/edit',
			'POST',
			new Treatment\Edit()
		);
		
		// URL:		/server/treatment/get
		// Method:	POST
		$app->services->define(
			'/treatment/get',
			'POST',
			new Treatment\Get()
		);
		
		// URL:		/server/treatment/search
		// Method:	POST
		$app->services->define(
			'/treatment/search',
			'POST',
			new Treatment\search()
		);
	}
	
}
