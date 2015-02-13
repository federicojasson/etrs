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
	 * Invoked when an inaccessible property is tried to be obtained.
	 * 
	 * It receives the property's name.
	 */
	public function __get($name) {
		if (! isset($this->parameters[$name])) {
			// The parameters have not been loaded yet
			
			// Gets the path of the parameters file
			$path = $this->paths[$name];

			// Reads the file and stores the result
			$this->parameters[$name] = readJsonFile($path);
		}
		
		// Returns the parameters
		return $this->parameters[$name];
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the parameters
		$this->parameters = [];
		
		// Initializes the paths
		$this->paths = [
			'databases' => ROOT_DIRECTORY . '/private/parameters/databases.json',
			'emails' => ROOT_DIRECTORY . '/private/parameters/emails.json',
			'webServer' => ROOT_DIRECTORY . '/private/parameters/web-server.json'
		];
	}
	
}
