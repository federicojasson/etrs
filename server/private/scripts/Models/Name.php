<?php

/*
 * TODO
 */
class Name extends Model {
	
	/*
	 * TODO
	 */
	public function getFirstName() {
		return $this->get('firstName');
	}
	
	/*
	 * TODO
	 */
	public function getLastName() {
		return $this->get('lastName');
	}
	
	/*
	 * TODO
	 */
	public function setFirstName($firstName) {
		$this->set('firstName', $firstName);
	}
	
	/*
	 * TODO
	 */
	public function setLastName($lastName) {
		$this->set('lastName', $lastName);
	}
	
}
