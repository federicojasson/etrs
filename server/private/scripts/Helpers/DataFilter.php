<?php

/*
 * This helper is used to filter data before send it to the client.
 */
class DataFilter extends Helper {
	
	/*
	 * TODO: comments
	 * TODO: initialize
	 */
	private $authorizedFields;
	
	/*
	 * TODO: comments
	 */
	public function filterBackground($background) {
		$filteredBackground = $background;
		
		// Filters the fields
		$filteredBackground = $this->filterFields($filteredBackground, $this->authorizedFields['backgrounds']);
		
		// Converts the binary fields to hexadecimal
		$filteredBackground = $this->applyFunction('bin2hex', $filteredBackground, [
			'id'
		]);
		
		return $filteredBackground;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterClinicalImpression($clinicalImpression) {
		$filteredClinicalImpression = $clinicalImpression;
		
		// Filters the fields
		$filteredClinicalImpression = $this->filterFields($filteredClinicalImpression, $this->authorizedFields['clinicalImpressions']);
		
		// Converts the binary fields to hexadecimal
		$filteredClinicalImpression = $this->applyFunction('bin2hex', $filteredClinicalImpression, [
			'id'
		]);
		
		return $filteredClinicalImpression;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterConsultation($consultation) {
		$filteredConsultation = $consultation;
		
		// Filters the fields
		$filteredConsultation = $this->filterFields($filteredConsultation, $this->authorizedFields['consultations']);
		
		// Converts the binary fields to hexadecimal
		$filteredConsultation = $this->applyFunction('bin2hex', $filteredConsultation, [
			'id',
			'clinicalImpression',
			'diagnosis',
			'patient'
		]);
		
		return $filteredConsultation;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterDiagnosis($diagnosis) {
		$filteredDiagnosis = $diagnosis;
		
		// Filters the fields
		$filteredDiagnosis = $this->filterFields($filteredDiagnosis, $this->authorizedFields['diagnoses']);
		
		// Converts the binary fields to hexadecimal
		$filteredDiagnosis = $this->applyFunction('bin2hex', $filteredDiagnosis, [
			'id'
		]);
		
		return $filteredDiagnosis;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterExperiment($experiment) {
		$filteredExperiment = $experiment;
		
		// Filters the fields
		$filteredExperiment = $this->filterFields($filteredExperiment, $this->authorizedFields['experiments']);
		
		// Converts the binary fields to hexadecimal
		$filteredExperiment = $this->applyFunction('bin2hex', $filteredExperiment, [
			'id'
		]);
		
		return $filteredExperiment;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterFile($file) {
		$filteredFile = $file;
		
		// Filters the fields
		$filteredFile = $this->filterFields($filteredFile, $this->authorizedFields['files']);
		
		// Converts the binary fields to hexadecimal
		$filteredFile = $this->applyFunction('bin2hex', $filteredFile, [
			'id',
			'hash'
		]);
		
		return $filteredFile;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterImageTest($imageTest) {
		$filteredImageTest = $imageTest;
		
		// Filters the fields
		$filteredImageTest = $this->filterFields($filteredImageTest, $this->authorizedFields['imageTests']);
		
		// Converts the binary fields to hexadecimal
		$filteredImageTest = $this->applyFunction('bin2hex', $filteredImageTest, [
			'id'
		]);
		
		return $filteredImageTest;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterLaboratoryTest($laboratoryTest) {
		$filteredLaboratoryTest = $laboratoryTest;
		
		// Filters the fields
		$filteredLaboratoryTest = $this->filterFields($filteredLaboratoryTest, $this->authorizedFields['laboratoryTests']);
		
		// Converts the binary fields to hexadecimal
		$filteredLaboratoryTest = $this->applyFunction('bin2hex', $filteredLaboratoryTest, [
			'id'
		]);
		
		return $filteredLaboratoryTest;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterMedication($medication) {
		$filteredMedication = $medication;
		
		// Filters the fields
		$filteredMedication = $this->filterFields($filteredMedication, $this->authorizedFields['medications']);
		
		// Converts the binary fields to hexadecimal
		$filteredMedication = $this->applyFunction('bin2hex', $filteredMedication, [
			'id'
		]);
		
		return $filteredMedication;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterNeurocognitiveEvaluation($neurocognitiveEvaluation) {
		$filteredNeurocognitiveEvaluation = $neurocognitiveEvaluation;
		
		// Filters the fields
		$filteredNeurocognitiveEvaluation = $this->filterFields($filteredNeurocognitiveEvaluation, $this->authorizedFields['neurocognitiveEvaluations']);
		
		// Converts the binary fields to hexadecimal
		$filteredNeurocognitiveEvaluation = $this->applyFunction('bin2hex', $filteredNeurocognitiveEvaluation, [
			'id'
		]);
		
		return $filteredNeurocognitiveEvaluation;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterPatient($patient) {
		$filteredPatient = $patient;
		
		// Filters the fields
		$filteredPatient = $this->filterFields($filteredPatient, $this->authorizedFields['patients']);
		
		// Converts the binary fields to hexadecimal
		$filteredPatient = $this->applyFunction('bin2hex', $filteredPatient, [
			'id'
		]);
		
		return $filteredPatient;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterStudy($study) {
		$filteredStudy = $study;
		
		// Filters the fields
		$filteredStudy = $this->filterFields($filteredStudy, $this->authorizedFields['studies']);
		
		// Converts the binary fields to hexadecimal
		$filteredStudy = $this->applyFunction('bin2hex', $filteredStudy, [
			'id',
			'consultation',
			'experiment',
			'report'
		]);
		
		return $filteredStudy;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterTreatment($treatment) {
		$filteredTreatment = $treatment;
		
		// Filters the fields
		$filteredTreatment = $this->filterFields($filteredTreatment, $this->authorizedFields['treatments']);
		
		// Converts the binary fields to hexadecimal
		$filteredTreatment = $this->applyFunction('bin2hex', $filteredTreatment, [
			'id'
		]);
		
		return $filteredTreatment;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterUser($user) {
		$filteredUser = $user;
		
		// Filters the fields
		$filteredUser = $this->filterFields($filteredUser, $this->authorizedFields['users']);
		
		// Converts the binary fields to hexadecimal
		$filteredUser = $this->applyFunction('bin2hex', $filteredUser, [
			'passwordHash',
			'passwordSalt'
		]);
		
		return $filteredUser;
	}
	
	/*
	 * TODO: comments
	 * 
	 * TODO: name
	 */
	private function applyFunction($function, $entity, $fields) {
		$count = count($fields);
		for ($i = 0; $i < $count; $i++) {
			$field = $fields[$i];
			
			if (isset($entity[$field])) {
				// The entity contains the field
				
				// Applies the function
				$entity[$field] = call_user_func($function, $entity[$field]);
			}
		}
		
		return $entity;
	}
	
	/*
	 * TODO: comments
	 */
	private function filterFields($entity, $authorizedFields) {
		// TODO: implement
	}
	
}
