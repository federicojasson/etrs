<?php

namespace App\Helper;

use App\Auxiliar\EntityModel\BackgroundModel;
use App\Auxiliar\EntityModel\ClinicalImpressionModel;
use App\Auxiliar\EntityModel\ConsultationModel;
use App\Auxiliar\EntityModel\DiagnosisModel;
use App\Auxiliar\EntityModel\ExperimentModel;
use App\Auxiliar\EntityModel\FileModel;
use App\Auxiliar\EntityModel\ImageTestModel;
use App\Auxiliar\EntityModel\LaboratoryTestModel;
use App\Auxiliar\EntityModel\LogModel;
use App\Auxiliar\EntityModel\MedicationModel;
use App\Auxiliar\EntityModel\NeurocognitiveTestModel;
use App\Auxiliar\EntityModel\PatientModel;
use App\Auxiliar\EntityModel\RecoverPasswordPermissionModel;
use App\Auxiliar\EntityModel\SessionModel;
use App\Auxiliar\EntityModel\SignUpPermissionModel;
use App\Auxiliar\EntityModel\StudyModel;
use App\Auxiliar\EntityModel\TreatmentModel;
use App\Auxiliar\EntityModel\UserModel;

/*
 * This helper offers an interface to access the entity models.
 */
class Data extends Helper {
	
	/*
	 * The entity models.
	 */
	private $entityModels;
	
	/*
	 * Invoked when an inaccessible property is tried to be obtained.
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
			ENTITY_MODEL_BACKGROUND => new BackgroundModel(),
			ENTITY_MODEL_CLINICAL_IMPRESSION => new ClinicalImpressionModel(),
			ENTITY_MODEL_CONSULTATION => new ConsultationModel(),
			ENTITY_MODEL_DIAGNOSIS => new DiagnosisModel(),
			ENTITY_MODEL_EXPERIMENT => new ExperimentModel(),
			ENTITY_MODEL_FILE => new FileModel(),
			ENTITY_MODEL_IMAGE_TEST => new ImageTestModel(),
			ENTITY_MODEL_LABORATORY_TEST => new LaboratoryTestModel(),
			ENTITY_MODEL_LOG => new LogModel(),
			ENTITY_MODEL_MEDICATION => new MedicationModel(),
			ENTITY_MODEL_NEUROCOGNITIVE_TEST => new NeurocognitiveTestModel(),
			ENTITY_MODEL_PATIENT => new PatientModel(),
			ENTITY_MODEL_RECOVER_PASSWORD_PERMISSION => new RecoverPasswordPermissionModel(),
			ENTITY_MODEL_SESSION => new SessionModel(),
			ENTITY_MODEL_SIGN_UP_PERMISSION => new SignUpPermissionModel(),
			ENTITY_MODEL_STUDY => new StudyModel(),
			ENTITY_MODEL_TREATMENT => new TreatmentModel(),
			ENTITY_MODEL_USER => new UserModel()
		];
	}
	
}
