<?php

/*
 * TODO
 */
class User extends Model {
	
	/*
	 * TODO
	 */
	public function __construct() {
		parent::__construct();
		$this->set('name', new Name());
	}
	
	/*
	 * TODO
	 */
	public function getGender() {
		return $this->get('gender');
	}
	
	/*
	 * TODO
	 */
	public function getId() {
		return $this->get('id');
	}
	
	/*
	 * TODO
	 */
	public function getName() {
		return $this->get('name');
	}
	
	// TODO: getters
	
	/*
	 * TODO
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
