<?php

/*
 * This class represents a name.
 */
class Name extends DataObject {
	
	/*
	 * Returns the first name.
	 */
	public function getFirstName() {
		return $this->get('firstName');
	}
	
	/*
	 * Returns the last name.
	 */
	public function getLastName() {
		return $this->get('lastName');
	}
	
	/*
	 * Sets the first name.
	 */
	public function setFirstName($firstName) {
		$this->set('firstName', $firstName);
	}
	
	/*
	 * Sets the last name.
	 */
	public function setLastName($lastName) {
		$this->set('lastName', $lastName);
	}
	
}
