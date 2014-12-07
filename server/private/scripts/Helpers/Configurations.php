<?php

/*
 * This helper allows to obtain the application's configurations.
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
	 * Creates an instance of this class.
	 */
	public function __construct() {
		parent::__construct();
		
		// Initializes the configurations array
		$this->configurations = [];
		
		// Initializes the file paths array
		$this->filePaths = $this->readJsonFile(FILE_PATH_CONFIGURATIONS_FILE_PATHS);
	}
	
	/*
	 * Returns a certain configuration.
	 * 
	 * It receives the configuration's ID.
	 */
	public function get($configurationId) {
		if (! isset($this->configurations[$configurationId])) {
			// The configuration has not been loaded yet
			$this->load($configurationId);
		}
		
		return $this->configurations[$configurationId];
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
		$this->configurations[$configurationId] = $this->readJsonFile($filePath);
	}
	
	/*
	 * Reads the content of a JSON file, decodes it and returns the result.
	 * 
	 * It receives the file path.
	 */
	private function readJsonFile($filePath) {
		// Gets the file's content
		$fileContent = file_get_contents($filePath);
		
		// Decodes the file's content and returns the result
		return json_decode($fileContent, true);
	}
	
}
