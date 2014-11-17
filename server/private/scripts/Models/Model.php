<?php

/*
 * This class represents a data model.
 */
abstract class Model {
	
	/*
	 * TODO
	 */
	private $entries;
	
	/*
	 * TODO
	 */
	public static function createFromData($data) {
		// Instantiates the model
		$class = get_called_class();
		$instance = new $class();
		
		// Sets the entries
		foreach ($data as $key => $value) {
			$instance->set($key, $value);
		}
	}
	
	/*
	 * TODO
	 */
	protected function __construct() {
		$this->entries = [];
	}
	
	/*
	 * TODO
	 */
	protected function get($key) {
		return $this->entries[$key];
	}
	
	/*
	 * TODO
	 */
	protected function set($key, $value) {
		$this->entries[$key] = $value;
	}
	
}
