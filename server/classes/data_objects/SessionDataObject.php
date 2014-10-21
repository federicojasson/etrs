<?php

/*
 * TODO
 */
class SessionDataObject extends DataObject {
	
	/*
	 * TODO
	 */
	public function getCreationDatetime() {
		return $this->entries['creationDatetime'];
	}
	
	/*
	 * TODO
	 */
	public function getData() {
		return $this->entries['data'];
	}
	
	/*
	 * TODO
	 */
	public function getId() {
		return $this->entries['id'];
	}
	
	/*
	 * TODO
	 */
	public function getLastAccessDatetime() {
		return $this->entries['lastAccessDatetime'];
	}
	
	/*
	 * TODO
	 */
	protected function setEntry($key, $value) {
		switch ($key) {
			case 'creation_datetime' : {
				$this->entries['creationDatetime'] = $value;
				break;
			}

			case 'data' : {
				$this->entries['data'] = $value;
				break;
			}

			case 'id' : {
				$this->entries['id'] = $value;
				break;
			}

			case 'last_access_datetime' : {
				$this->entries['lastAccessDatetime'] = $value;
				break;
			}
		}
	}
	
}
