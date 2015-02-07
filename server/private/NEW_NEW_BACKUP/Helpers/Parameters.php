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
	 * Returns a set of parameters.
	 * 
	 * It receives the set's ID.
	 */
	public function get($id) {
		if (! array_key_exists($id, $this->parameters)) {
			// The parameters have not been loaded yet
			$this->load($id);
		}
		
		// Returns the parameters
		return $this->parameters[$id];
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the file paths
		$this->filePaths = [
			PARAMETERS_DATABASES => 'private/parameters/databases.json',
			PARAMETERS_EMAILS => 'private/parameters/emails.json',
			PARAMETERS_SERVER => 'private/parameters/server.json'
		];
		
		// Initializes the parameters
		$this->parameters = [];
	}
	
	/*
	 * Loads a set of parameters.
	 * 
	 * It receives the set's ID.
	 */
	private function load($id) {
		// Gets the path of the parameters' file
		$path = $this->filePaths[$id];
		
		// Reads the file and stores the result
		$this->parameters[$id] = readJsonFile($path);
	}
	
}