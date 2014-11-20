<?php

/*
 * This manager handles the application configurations.
 */
class ConfigurationManager extends Manager {
	
	/*
	 * The database configurations.
	 */
	private $databaseConfigurations;
	
	/*
	 * Returns the database configurations.
	 */
	public function getDatabaseConfigurations() {
		if (is_null($this->databaseConfigurations)) {
			// The database configurations have to be initialized
			$jsonString = file_get_contents(FILE_PATH_DATABASE_CONFIGURATIONS);
			$this->databaseConfigurations = json_decode($jsonString, true);
		}
		
		return $this->databaseConfigurations;
	}
	
}
