<?php

/*
 * TODO
 */
class UserDataObject extends DataObject {
	
	/*
	 * TODO
	 */
	public function getId() {
		return $this->entries['id'];
	}
	
	/*
	 * TODO
	 */
	public function getPasswordHash() {
		return $this->entries['passwordHash'];
	}
	
	/*
	 * TODO
	 */
	public function getRole() {
		return $this->entries['role'];
	}
	
	/*
	 * TODO
	 */
	public function getSalt() {
		return $this->entries['salt'];
	}
	
	/*
	 * TODO
	 */
	protected function setEntry($key, $value) {
		switch ($key) {
			case 'id' : {
				$this->entries['id'] = $value;
				break;
			}

			case 'password_hash' : {
				$this->entries['passwordHash'] = $value;
				break;
			}

			case 'role' : {
				$this->entries['role'] = $value;
				break;
			}

			case 'salt' : {
				$this->entries['salt'] = $value;
				break;
			}
		}
	}
	
}
