<?php

/*
 * This helper allows to obtain configurations.
 */
class Configurations extends Helper {
	
	/*
	 * The configurations.
	 */
	private $configurations;
	
	/*
	 * The file paths of the configuration files.
	 */
	private $filePaths;
	
	/*
	 * Returns a certain configuration.
	 * 
	 * It receives the configuration's ID.
	 */
	public function get($configurationId) {
		$configurations = &$this->configurations;
		
		if (! isset($configurations[$configurationId])) {
			// The configuration has not been loaded yet
			$this->load($configurationId);
		}
		
		return $configurations[$configurationId];
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the configurations array
		$this->configurations = [];
		
		// Initializes the file paths
		$this->filePaths = [
			'businessLogicDatabase' => 'private/configurations/business-logic-database.json',
			'webServerDatabase' => 'private/configurations/web-server-database.json',
			'email' => 'private/configurations/email.json'
		];
	}
	
	/*
	 * Loads a certain configuration.
	 * 
	 * It receives the configuration's ID.
	 */
	private function load($configurationId) {
		// Gets the file path of the configuration file
		$filePath = $this->filePaths[$configurationId];
		
		// Reads the file and stores the result
		$this->configurations[$configurationId] = readJsonFile($filePath);
	}
	
}
