<?php

abstract class DataObject {
	
	/*
	 * TODO
	 */
	protected $entries;
	
	/*
	 * TODO
	 */
	public function __construct($entries) {
		// Initializes the entries
		$this->entries = [];
		
		// Sets the received entries
		foreach ($entries as $key => $value) {
			$this->setEntry($key, $value);
		}
	}
	
	/*
	 * TODO
	 */
	protected abstract function setEntry($key, $value);
	
}
