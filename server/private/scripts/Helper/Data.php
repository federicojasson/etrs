<?php

namespace App\Helper;

/*
 * This helper offers data-related functionalities.
 */
class Data extends Helper {
	
	/*
	 * The data models.
	 */
	private $dataModels;
	
	/*
	 * Creates a background.
	 * 
	 * It receives the background's data.
	 */
	public function createBackground($id, $creator, $name) {
		$this->dataModels['background']->create($id, $creator, $name); // TODO: implement
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the data models
		$this->dataModels = [
			// TODO: initialize data models
		];
	}
	
}
