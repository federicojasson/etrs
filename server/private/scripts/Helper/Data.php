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
			ENTITY_MODEL_BACKGROUND => new \App\Auxiliar\EntityModel\BackgroundModel(),
			ENTITY_MODEL_CLINICAL_IMPRESSION => new \App\Auxiliar\EntityModel\ClinicalImpressionModel(),
			ENTITY_MODEL_CONSULTATION => new \App\Auxiliar\EntityModel\ConsultationModel(),
			ENTITY_MODEL_DIAGNOSIS => new \App\Auxiliar\EntityModel\DiagnosisModel(),
			ENTITY_MODEL_EXPERIMENT => new \App\Auxiliar\EntityModel\ExperimentModel(),
			ENTITY_MODEL_FILE => new \App\Auxiliar\EntityModel\FileModel(),
			ENTITY_MODEL_IMAGE_TEST => new \App\Auxiliar\EntityModel\ImageTestModel(),
			ENTITY_MODEL_LABORATORY_TEST => new \App\Auxiliar\EntityModel\LaboratoryTestModel(),
			ENTITY_MODEL_LOG => new \App\Auxiliar\EntityModel\LogModel(),
			ENTITY_MODEL_MEDICATION => new \App\Auxiliar\EntityModel\MedicationModel(),
			ENTITY_MODEL_NEUROCOGNITIVE_TEST => new \App\Auxiliar\EntityModel\NeurocognitiveTestModel(),
			ENTITY_MODEL_PATIENT => new \App\Auxiliar\EntityModel\PatientModel(),
			ENTITY_MODEL_RECOVER_PASSWORD_PERMISSION => new \App\Auxiliar\EntityModel\RecoverPasswordPermissionModel(),
			ENTITY_MODEL_SESSION => new \App\Auxiliar\EntityModel\SessionModel(),
			ENTITY_MODEL_SIGN_UP_PERMISSION => new \App\Auxiliar\EntityModel\SignUpPermissionModel(),
			ENTITY_MODEL_STUDY => new \App\Auxiliar\EntityModel\StudyModel(),
			ENTITY_MODEL_TREATMENT => new \App\Auxiliar\EntityModel\TreatmentModel(),
			ENTITY_MODEL_USER => new \App\Auxiliar\EntityModel\UserModel()
		];
	}
	
}
