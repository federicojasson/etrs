<?php

/*
 * This class represents a data object.
 */
abstract class DataObject {
	
	/*
	 * The key-value pairs that hold the data.
	 */
	private $entries;
	
	/*
	 * Creates an instance of this class.
	 */
	protected function __construct() {
		$this->entries = [];
	}
	
	/*
	 * Fills the object with data. Note that the method doesn't remove previous
	 * data entries.
	 * 
	 * It receives an associative array that contains key-value pairs.
	 */
	public function fill($data) {
		foreach ($data as $key => $value) {
			$instance->set($key, $value);
		}
	}
	
	/*
	 * Returns the value of an entry.
	 * 
	 * It receives the entry key.
	 */
	protected function get($key) {
		return $this->entries[$key];
	}
	
	/*
	 * Sets an entry.
	 * 
	 * It receives the key and value of the entry.
	 */
	protected function set($key, $value) {
		$this->entries[$key] = $value;
	}
	
}
