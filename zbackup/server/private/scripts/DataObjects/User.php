<?php

/*
 * This class represents a user.
 */
class User extends DataObject {
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		parent::__construct();
		
		// Sets an special entry for the user's name
		$this->set('name', new Name());
	}
	
	/*
	 * Returns the user's gender.
	 */
	public function getGender() {
		return $this->get('gender');
	}
	
	/*
	 * Returns the user's ID.
	 */
	public function getId() {
		return $this->get('id');
	}
	
	/*
	 * Returns the user's name.
	 */
	public function getName() {
		return $this->get('name');
	}
	
	/*
	 * Returns the user's role.
	 */
	public function getRole() {
		return $this->get('role');
	}
	
	/*
	 * Sets an entry.
	 * 
	 * It takes special measures for some keys.
	 * 
	 * It receives the key and value of the entry.
	 */
	protected function set($key, $value) {
		switch ($key) {
			case 'firstName' : {
				$this->get('name')->setFirstName($value);
				return;
			}
			
			case 'lastName' : {
				$this->get('name')->setLastName($value);
				return;
			}
			
			default : {
				parent::set($key, $value);
			}
		}
	}
	
}
