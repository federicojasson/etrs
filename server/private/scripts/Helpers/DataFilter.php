<?php

/*
 * This helper is used to filter data before send it to the client.
 */
class DataFilter extends Helper {
	
	/*
	 * TODO: comments
	 */
	public function filterBackground($background) {
		// TODO: filter fields
		
		// Converts the background's binary fields to hexadecimal
		$filteredBackground = $this->applyFunction('bin2hex', $background, [
			'id'
		]);
		
		return $filteredBackground;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterClinicalImpression($clinicalImpression) {
		// TODO: filter fields
		
		// Converts the clinical impression's binary fields to hexadecimal
		$filteredClinicalImpression = $this->applyFunction('bin2hex', $clinicalImpression, [
			'id'
		]);
		
		return $filteredClinicalImpression;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterConsultation($consultation) {
		// TODO: filter fields
		
		// Converts the consultation's binary fields to hexadecimal
		$filteredConsultation = $this->applyFunction('bin2hex', $consultation, [
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
		// TODO: filter fields
		
		// Converts the diagnosis's binary fields to hexadecimal
		$filteredDiagnosis = $this->applyFunction('bin2hex', $diagnosis, [
			'id'
		]);
		
		return $filteredDiagnosis;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterExperiment($experiment) {
		// TODO: filter fields
		
		// Converts the experiment's binary fields to hexadecimal
		$filteredExperiment = $this->applyFunction('bin2hex', $experiment, [
			'id'
		]);
		
		return $filteredExperiment;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterFile($file) {
		// TODO: filter fields
		
		// Converts the file's binary fields to hexadecimal
		$filteredFile = $this->applyFunction('bin2hex', $file, [
			'id',
			'hash'
		]);
		
		return $filteredFile;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterImageTest($imageTest) {
		// TODO: filter fields
		
		// Converts the image test's binary fields to hexadecimal
		$filteredImageTest = $this->applyFunction('bin2hex', $imageTest, [
			'id'
		]);
		
		return $filteredImageTest;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterLaboratoryTest($laboratoryTest) {
		// TODO: filter fields
		
		// Converts the laboratory test's binary fields to hexadecimal
		$filteredLaboratoryTest = $this->applyFunction('bin2hex', $laboratoryTest, [
			'id'
		]);
		
		return $filteredLaboratoryTest;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterMedication($medication) {
		// TODO: filter fields
		
		// Converts the medication's binary fields to hexadecimal
		$filteredMedication = $this->applyFunction('bin2hex', $medication, [
			'id'
		]);
		
		return $filteredMedication;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterNeurocognitiveEvaluation($neurocognitiveEvaluation) {
		// TODO: filter fields
		
		// Converts the neurocognitive evaluation's binary fields to hexadecimal
		$filteredNeurocognitiveEvaluation = $this->applyFunction('bin2hex', $neurocognitiveEvaluation, [
			'id'
		]);
		
		return $filteredNeurocognitiveEvaluation;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterPatient($patient) {
		// TODO: filter fields
		
		// Converts the patient's binary fields to hexadecimal
		$filteredPatient = $this->applyFunction('bin2hex', $patient, [
			'id'
		]);
		
		return $filteredPatient;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterStudy($study) {		
		// TODO: filter fields
		
		// Converts the study's binary fields to hexadecimal
		$filteredStudy = $this->applyFunction('bin2hex', $study, [
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
		// TODO: filter fields
		
		// Converts the treatment's binary fields to hexadecimal
		$filteredTreatment = $this->applyFunction('bin2hex', $treatment, [
			'id'
		]);
		
		return $filteredTreatment;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterUser($user) {
		// TODO: filter fields
		
		// Converts the user's binary fields to hexadecimal
		$filteredUser = $this->applyFunction('bin2hex', $user, [
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
	
}
