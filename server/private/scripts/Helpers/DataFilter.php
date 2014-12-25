<?php

/*
 * This helper is used to filter data before send it to the client.
 */
class DataFilter extends Helper {
	
	/*
	 * TODO: comments
	 */
	public function filterBackground($background) {
		// Converts the background's binary fields to hexadecimal
		$filteredBackground = $this->binaryToHexadecimalEntityFields($background, [
			'id'
		]);
		
		// TODO: filter fields
		
		return $filteredBackground;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterClinicalImpression($clinicalImpression) {
		// Converts the clinical impression's binary fields to hexadecimal
		$filteredClinicalImpression = $this->binaryToHexadecimalEntityFields($clinicalImpression, [
			'id'
		]);
		
		// TODO: filter fields
		
		return $filteredClinicalImpression;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterConsultation($consultation) {
		// Converts the consultation's binary fields to hexadecimal
		$filteredConsultation = $this->binaryToHexadecimalEntityFields($consultation, [
			'id',
			'clinicalImpression',
			'diagnosis',
			'patient'
		]);
		
		// TODO: filter fields
		
		return $filteredConsultation;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterDiagnosis($diagnosis) {
		// Converts the diagnosis's binary fields to hexadecimal
		$filteredDiagnosis = $this->binaryToHexadecimalEntityFields($diagnosis, [
			'id'
		]);
		
		// TODO: filter fields
		
		return $filteredDiagnosis;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterExperiment($experiment) {
		// Converts the experiment's binary fields to hexadecimal
		$filteredExperiment = $this->binaryToHexadecimalEntityFields($experiment, [
			'id'
		]);
		
		// TODO: filter fields
		
		return $filteredExperiment;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterFile($file) {
		// Converts the file's binary fields to hexadecimal
		$filteredFile = $this->binaryToHexadecimalEntityFields($file, [
			'id',
			'hash'
		]);
		
		// TODO: filter fields
		
		return $filteredFile;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterImageTest($imageTest) {
		// Converts the image test's binary fields to hexadecimal
		$filteredImageTest = $this->binaryToHexadecimalEntityFields($imageTest, [
			'id'
		]);
		
		// TODO: filter fields
		
		return $filteredImageTest;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterLaboratoryTest($laboratoryTest) {
		// Converts the laboratory test's binary fields to hexadecimal
		$filteredLaboratoryTest = $this->binaryToHexadecimalEntityFields($laboratoryTest, [
			'id'
		]);
		
		// TODO: filter fields
		
		return $filteredLaboratoryTest;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterMedication($medication) {
		// Converts the medication's binary fields to hexadecimal
		$filteredMedication = $this->binaryToHexadecimalEntityFields($medication, [
			'id'
		]);
		
		// TODO: filter fields
		
		return $filteredMedication;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterNeurocognitiveEvaluation($neurocognitiveEvaluation) {
		// Converts the neurocognitive evaluation's binary fields to hexadecimal
		$filteredNeurocognitiveEvaluation = $this->binaryToHexadecimalEntityFields($neurocognitiveEvaluation, [
			'id'
		]);
		
		// TODO: filter fields
		
		return $filteredNeurocognitiveEvaluation;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterPatient($patient) {
		// Converts the patient's binary fields to hexadecimal
		$filteredPatient = $this->binaryToHexadecimalEntityFields($patient, [
			'id'
		]);
		
		// TODO: filter fields
		
		return $filteredPatient;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterStudy($study) {
		// Converts the study's binary fields to hexadecimal
		$filteredStudy = $this->binaryToHexadecimalEntityFields($study, [
			'id',
			'consultation',
			'experiment',
			'report'
		]);
		
		// TODO: filter fields
		
		return $filteredStudy;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterTreatment($treatment) {
		// Converts the treatment's binary fields to hexadecimal
		$filteredTreatment = $this->binaryToHexadecimalEntityFields($treatment, [
			'id'
		]);
		
		// TODO: filter fields
		
		return $filteredTreatment;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterUser($user) {
		// Converts the user's binary fields to hexadecimal
		$filteredUser = $this->binaryToHexadecimalEntityFields($user, [
			'passwordHash',
			'passwordSalt'
		]);
		
		// TODO: filter fields
		
		return $filteredUser;
	}
	
	/*
	 * Converts the binary fields of an entity to hexadecimal and returns the
	 * result.
	 * 
	 * It receives the entity and an array containing the binary fields.
	 * 
	 * TODO: name
	 */
	private function binaryToHexadecimalEntityFields($entity, $fields) {
		// Converts the binary fields to hexadecimal
		$count = count($fields);
		for ($i = 0; $i < $count; $i++) {
			$field = $fields[$i];
			
			// Converts the binary field to hexadecimal
			$entity[$field] = binaryToHexadecimal($entity[$field]);
		}
		
		return $entity;
	}
	
}
