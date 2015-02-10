<?php

namespace App\Helper;

/*
 * This helper offers access validation functions.
 */
class AccessValidator extends Helper {
	
	/*
	 * The accessible fields of each entity model.
	 */
	private $accessibleFields;
	
	/*
	 * Returns the accessible fields of an entity model.
	 * 
	 * It receives the entity model.
	 */
	public function getAccessibleFields($entityModel) {
		return $this->accessibleFields[$entityModel];
	}
	
	/*
	 * Checks whether the requesting user is authorized to access according to
	 * its privileges and returns the result.
	 * 
	 * It receives the user roles that are authorized to access.
	 */
	public function validateAccess($authorizedUserRoles) {
		$app = $this->app;
		
		if (! $app->authentication->isUserSignedIn()) {
			// The user is not signed in
			return isElementInArray(USER_ROLE_ANONYMOUS, $authorizedUserRoles);
		}
		
		// The user is signed in: the decision depends on its role
		$signedInUser = $app->authentication->getSignedInUser();
		return isElementInArray($signedInUser['role'], $authorizedUserRoles);
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the accessible fields
		$this->accessibleFields = $this->getRequestingUserAccessibleFields();
	}
	
	/*
	 * Returns the fields accessible by administrators.
	 */
	private function getAdministratorAccessibleFields() {
		// TODO: define fields
		// Defines and returns the accessible fields
		return [
			ENTITY_MODEL_ACCOUNT => [
				'id',
				'creator',
				'creationDatetime',
				'lastEditionDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role',
				'firstName',
				'lastName',
				'gender',
				'emailAddress'
			],
			ENTITY_MODEL_BACKGROUND => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_CLINICAL_IMPRESSION => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_CONSULTATION => [
				'id',
				'deleted',
				'clinicalImpression',
				'creator',
				'diagnosis',
				'lastEditor',
				'patient',
				'creationDatetime',
				'lastEditionDatetime',
				'date',
				'reasons',
				'indications',
				'observations'
			],
			ENTITY_MODEL_DIAGNOSIS => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_EXPERIMENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'commandLine'
			],
			ENTITY_MODEL_FILE => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'hash'
			],
			ENTITY_MODEL_IMAGE_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_LABORATORY_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_LOG => [
				'id',
				'creationDatetime',
				'level',
				'message'
			],
			ENTITY_MODEL_MEDICATION => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_NEUROCOGNITIVE_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_PATIENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'firstName',
				'lastName',
				'gender',
				'birthDate',
				'educationYears'
			],
			ENTITY_MODEL_RECOVER_PASSWORD_PERMISSION => [
				'id',
				'user',
				'creationDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations'
			],
			ENTITY_MODEL_SESSION => [
				'id',
				'creationDatetime',
				'lastEditionDatetime',
				'data'
			],
			ENTITY_MODEL_SIGN_UP_PERMISSION => [
				'id',
				'creator',
				'creationDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role'
			],
			ENTITY_MODEL_STUDY => [
				'id',
				'deleted',
				'consultation',
				'creator',
				'experiment',
				'input',
				'lastEditor',
				'output',
				'creationDatetime',
				'lastEditionDatetime',
				'observations'
			],
			ENTITY_MODEL_TREATMENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_USER => [
				'id',
				'creator',
				'creationDatetime',
				'lastEditionDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role',
				'firstName',
				'lastName',
				'gender',
				'emailAddress'
			]
		];
	}
	
	/*
	 * Returns the fields accessible by anonymous users.
	 */
	private function getAnonymousAccessibleFields() {
		// TODO: define fields
		// Defines and returns the accessible fields
		return [
			ENTITY_MODEL_ACCOUNT => [
				'id',
				'creator',
				'creationDatetime',
				'lastEditionDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role',
				'firstName',
				'lastName',
				'gender',
				'emailAddress'
			],
			ENTITY_MODEL_BACKGROUND => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_CLINICAL_IMPRESSION => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_CONSULTATION => [
				'id',
				'deleted',
				'clinicalImpression',
				'creator',
				'diagnosis',
				'lastEditor',
				'patient',
				'creationDatetime',
				'lastEditionDatetime',
				'date',
				'reasons',
				'indications',
				'observations'
			],
			ENTITY_MODEL_DIAGNOSIS => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_EXPERIMENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'commandLine'
			],
			ENTITY_MODEL_FILE => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'hash'
			],
			ENTITY_MODEL_IMAGE_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_LABORATORY_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_LOG => [
				'id',
				'creationDatetime',
				'level',
				'message'
			],
			ENTITY_MODEL_MEDICATION => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_NEUROCOGNITIVE_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_PATIENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'firstName',
				'lastName',
				'gender',
				'birthDate',
				'educationYears'
			],
			ENTITY_MODEL_RECOVER_PASSWORD_PERMISSION => [
				'id',
				'user',
				'creationDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations'
			],
			ENTITY_MODEL_SESSION => [
				'id',
				'creationDatetime',
				'lastEditionDatetime',
				'data'
			],
			ENTITY_MODEL_SIGN_UP_PERMISSION => [
				'id',
				'creator',
				'creationDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role'
			],
			ENTITY_MODEL_STUDY => [
				'id',
				'deleted',
				'consultation',
				'creator',
				'experiment',
				'input',
				'lastEditor',
				'output',
				'creationDatetime',
				'lastEditionDatetime',
				'observations'
			],
			ENTITY_MODEL_TREATMENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_USER => [
				'id',
				'creator',
				'creationDatetime',
				'lastEditionDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role',
				'firstName',
				'lastName',
				'gender',
				'emailAddress'
			]
		];
	}
	
	/*
	 * Returns the fields accessible by doctors.
	 */
	private function getDoctorAccessibleFields() {
		// TODO: define fields
		// Defines and returns the accessible fields
		return [
			ENTITY_MODEL_ACCOUNT => [
				'id',
				'creator',
				'creationDatetime',
				'lastEditionDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role',
				'firstName',
				'lastName',
				'gender',
				'emailAddress'
			],
			ENTITY_MODEL_BACKGROUND => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_CLINICAL_IMPRESSION => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_CONSULTATION => [
				'id',
				'deleted',
				'clinicalImpression',
				'creator',
				'diagnosis',
				'lastEditor',
				'patient',
				'creationDatetime',
				'lastEditionDatetime',
				'date',
				'reasons',
				'indications',
				'observations'
			],
			ENTITY_MODEL_DIAGNOSIS => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_EXPERIMENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'commandLine'
			],
			ENTITY_MODEL_FILE => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'hash'
			],
			ENTITY_MODEL_IMAGE_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_LABORATORY_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_LOG => [
				'id',
				'creationDatetime',
				'level',
				'message'
			],
			ENTITY_MODEL_MEDICATION => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_NEUROCOGNITIVE_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_PATIENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'firstName',
				'lastName',
				'gender',
				'birthDate',
				'educationYears'
			],
			ENTITY_MODEL_RECOVER_PASSWORD_PERMISSION => [
				'id',
				'user',
				'creationDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations'
			],
			ENTITY_MODEL_SESSION => [
				'id',
				'creationDatetime',
				'lastEditionDatetime',
				'data'
			],
			ENTITY_MODEL_SIGN_UP_PERMISSION => [
				'id',
				'creator',
				'creationDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role'
			],
			ENTITY_MODEL_STUDY => [
				'id',
				'deleted',
				'consultation',
				'creator',
				'experiment',
				'input',
				'lastEditor',
				'output',
				'creationDatetime',
				'lastEditionDatetime',
				'observations'
			],
			ENTITY_MODEL_TREATMENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_USER => [
				'id',
				'creator',
				'creationDatetime',
				'lastEditionDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role',
				'firstName',
				'lastName',
				'gender',
				'emailAddress'
			]
		];
	}
	
	/*
	 * Returns the fields accessible by operators.
	 */
	private function getOperatorAccessibleFields() {
		// TODO: define fields
		// Defines and returns the accessible fields
		return [
			ENTITY_MODEL_ACCOUNT => [
				'id',
				'creator',
				'creationDatetime',
				'lastEditionDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role',
				'firstName',
				'lastName',
				'gender',
				'emailAddress'
			],
			ENTITY_MODEL_BACKGROUND => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_CLINICAL_IMPRESSION => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_CONSULTATION => [
				'id',
				'deleted',
				'clinicalImpression',
				'creator',
				'diagnosis',
				'lastEditor',
				'patient',
				'creationDatetime',
				'lastEditionDatetime',
				'date',
				'reasons',
				'indications',
				'observations'
			],
			ENTITY_MODEL_DIAGNOSIS => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_EXPERIMENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'commandLine'
			],
			ENTITY_MODEL_FILE => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'hash'
			],
			ENTITY_MODEL_IMAGE_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_LABORATORY_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_LOG => [
				'id',
				'creationDatetime',
				'level',
				'message'
			],
			ENTITY_MODEL_MEDICATION => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_NEUROCOGNITIVE_TEST => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'dataTypeDescriptor'
			],
			ENTITY_MODEL_PATIENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'firstName',
				'lastName',
				'gender',
				'birthDate',
				'educationYears'
			],
			ENTITY_MODEL_RECOVER_PASSWORD_PERMISSION => [
				'id',
				'user',
				'creationDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations'
			],
			ENTITY_MODEL_SESSION => [
				'id',
				'creationDatetime',
				'lastEditionDatetime',
				'data'
			],
			ENTITY_MODEL_SIGN_UP_PERMISSION => [
				'id',
				'creator',
				'creationDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role'
			],
			ENTITY_MODEL_STUDY => [
				'id',
				'deleted',
				'consultation',
				'creator',
				'experiment',
				'input',
				'lastEditor',
				'output',
				'creationDatetime',
				'lastEditionDatetime',
				'observations'
			],
			ENTITY_MODEL_TREATMENT => [
				'id',
				'deleted',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name'
			],
			ENTITY_MODEL_USER => [
				'id',
				'creator',
				'creationDatetime',
				'lastEditionDatetime',
				'passwordHash',
				'salt',
				'keyStretchingIterations',
				'role',
				'firstName',
				'lastName',
				'gender',
				'emailAddress'
			]
		];
	}
	
	/*
	 * Returns the fields accessible by the requesting user.
	 */
	private function getRequestingUserAccessibleFields() {
		$app = $this->app;
		
		if (! $app->authentication->isUserSignedIn()) {
			// The user is not signed in
			return $this->getAnonymousAccessibleFields();
		}
		
		// The user is signed in: the accessible fields depend on its role
		$signedInUser = $app->authentication->getSignedInUser();
		switch ($signedInUser['role']) {
			case USER_ROLE_ADMINISTRATOR: {
				return $this->getAdministratorAccessibleFields();
			}

			case USER_ROLE_DOCTOR: {
				return $this->getDoctorAccessibleFields();
			}

			case USER_ROLE_OPERATOR: {
				return $this->getOperatorAccessibleFields();
			}
		}
	}
	
}
