<?php

namespace App\Helper;

/*
 * This helper offers an interface to access the entity models.
 */
class Data extends Helper {
	
	/*
	 * The entity models.
	 */
	private $entityModels;
	
	/*
	 * Invoked when an inaccessible property is obtained.
	 * 
	 * It receives the property's name.
	 */
	public function __get($name) {
		return $this->entityModels[$name];
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the entity models
		$this->entityModels = [
			'background' => new \App\Auxiliar\EntityModel\BackgroundModel(),
			'clinicalImpression' => new \App\Auxiliar\EntityModel\ClinicalImpressionModel(),
			'consultation' => new \App\Auxiliar\EntityModel\ConsultationModel(),
			'diagnosis' => new \App\Auxiliar\EntityModel\DiagnosisModel(),
			'experiment' => new \App\Auxiliar\EntityModel\ExperimentModel(),
			'file' => new \App\Auxiliar\EntityModel\FileModel(),
			'imageTest' => new \App\Auxiliar\EntityModel\ImageTestModel(),
			'laboratoryTest' => new \App\Auxiliar\EntityModel\LaboratoryTestModel(),
			'log' => new \App\Auxiliar\EntityModel\LogModel(),
			'medication' => new \App\Auxiliar\EntityModel\MedicationModel(),
			'neurocognitiveTest' => new \App\Auxiliar\EntityModel\NeurocognitiveTestModel(),
			'patient' => new \App\Auxiliar\EntityModel\PatientModel(),
			'recoverPasswordPermission' => new \App\Auxiliar\EntityModel\RecoverPasswordPermissionModel(),
			'session' => new \App\Auxiliar\EntityModel\SessionModel(),
			'signUpPermission' => new \App\Auxiliar\EntityModel\SignUpPermissionModel(),
			'study' => new \App\Auxiliar\EntityModel\StudyModel(),
			'treatment' => new \App\Auxiliar\EntityModel\TreatmentModel(),
			'user' => new \App\Auxiliar\EntityModel\UserModel()
		];
	}
	
}
