<?php

namespace App\Helpers;

/*
 * This helper allows to obtain parameters.
 */
class Parameters extends \App\Helpers\Helper {
	
	/*
	 * The paths of the parameter files.
	 */
	private $filePaths;
	
	/*
	 * The parameters.
	 */
	private $parameters;
	
	/*
	 * Returns a parameter.
	 * 
	 * It receives the parameter's ID.
	 */
	public function get($id) {
		if (! isset($this->parameters[$id])) {
			// The parameter has not been loaded yet
			$this->load($id);
		}
		
		return $this->parameters[$id];
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the file paths
		$this->filePaths = [
			'businessLogicDatabase' => 'private/parameters/business-logic-database.json',
			'webServerDatabase' => 'private/parameters/web-server-database.json',
			'email' => 'private/parameters/email.json'
		];
		
		// Initializes the parameters array
		$this->parameters = [];
	}
	
	/*
	 * Loads a parameter.
	 * 
	 * It receives the parameter's ID.
	 */
	private function load($id) {
		// Gets the path of the parameter's file
		$filePath = $this->filePaths[$id];
		
		// Reads the file's content and stores the result
		$this->parameters[$id] = readJsonFile($filePath);
	}
	
}
