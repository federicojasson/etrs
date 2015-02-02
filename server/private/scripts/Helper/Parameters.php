<?php

namespace App\Helper;

/*
 * This helper allows to obtain parameters.
 */
class Parameters extends Helper {
	
	/*
	 * The parameters.
	 */
	private $parameters;
	
	/*
	 * The paths of the parameters files.
	 */
	private $paths;
	
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
		// Initializes the parameters
		$this->parameters = [];
		
		// Initializes the paths
		$this->paths = [
			PARAMETERS_DATABASES => 'private/parameters/databases.json',
			PARAMETERS_EMAILS => 'private/parameters/emails.json',
			PARAMETERS_SERVER => 'private/parameters/server.json'
		];
	}
	
	/*
	 * Loads a set of parameters.
	 * 
	 * It receives the set's ID.
	 */
	private function load($id) {
		// Gets the path of the parameters file
		$path = $this->paths[$id];
		
		// Reads the file and stores the result
		$this->parameters[$id] = readJsonFile($path);
	}
	
}
