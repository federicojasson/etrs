<?php

/*
 * TODO
 */
class UserData {
	
	/*
	 * TODO
	 */
	private $id;
	private $passwordHash;
	private $role;
	private $salt;
	
	/*
	 * TODO
	 */
	public function __construct($row) {
		foreach ($row as $column => $value)
			switch ($column) {
				case 'id' : {
					$this->id = $value;
					break;
				}
				
				case 'password_hash' : {
					$this->passwordHash = $value;
					break;
				}
				
				case 'role' : {
					$this->role = $value;
					break;
				}
				
				case 'salt' : {
					$this->salt = $value;
					break;
				}
			}
	}
	
	/*
	 * TODO
	 */
	public function getId() {
		return $this->id;
	}
	
	/*
	 * TODO
	 */
	public function getPasswordHash() {
		return $this->passwordHash;
	}
	
	/*
	 * TODO
	 */
	public function getRole() {
		return $this->role;
	}
	
	/*
	 * TODO
	 */
	public function getSalt() {
		return $this->salt;
	}
	
}
