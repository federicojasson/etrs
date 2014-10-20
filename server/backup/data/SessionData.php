<?php

/*
 * TODO
 */
class SessionData {
	
	/*
	 * TODO
	 */
	private $creationDatetime;
	private $data;
	private $id;
	private $lastAccessDatetime;
	
	/*
	 * TODO
	 */
	public function __construct($row) {
		foreach ($row as $column => $value)
			switch ($column) {
				case 'creation_datetime' : {
					$this->creationDatetime = $value;
					break;
				}
				
				case 'data' : {
					$this->data = $value;
					break;
				}
				
				case 'id' : {
					$this->id = $value;
					break;
				}
				
				case 'last_access_datetime' : {
					$this->lastAccessDatetime = $value;
					break;
				}
			}
	}
	
	/*
	 * TODO
	 */
	public function getCreationDatetime() {
		return $creationDatetime;
	}
	
	/*
	 * TODO
	 */
	public function getData() {
		return $data;
	}
	
	/*
	 * TODO
	 */
	public function getId() {
		return $id;
	}
	
	/*
	 * TODO
	 */
	public function getLastAccessDatetime() {
		return $lastAccessDatetime;
	}
	
}
