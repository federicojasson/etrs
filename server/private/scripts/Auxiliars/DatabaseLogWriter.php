<?php

/*
 * This class is used to write logs in a database.
 */
class DatabaseLogWriter {
	
	/*
	 * The database where the logs are written.
	 */
	private $database;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the database in which the logs should be written.
	 */
	public function __construct($database) {
		$this->database = $database;
	}
	
    /*
	 * Writes a log in the database.
	 * 
	 * It receives the message and the level.
	 */
    public function write($message, $level) {
		$database = $this->database;
		
		// Generates an ID for the log
		do {
			$logId = ''; // TODO: compute id
		} while ($database->logExists($logId));
		
		// Gets the value of the level
		$logLevel = getLevelValue($level);
		
		// Inserts a log in the database
		$database->insertLog($logId, $logLevel, $message);
    }
	
	/*
	 * Returns the value of a level.
	 * 
	 * It receives the level.
	 */
	private function getLevelValue($level) {
		switch ($level) {
			case Log::EMERGENCY: {
				return 'EM';
			}
			
			case Log::ALERT: {
				return 'AL';
			}
			
			case Log::CRITICAL: {
				return 'CR';
			}
			
			case Log::ERROR: {
				return 'ER';
			}
			
			case Log::WARN: {
				return 'WA';
			}
			
			case Log::NOTICE: {
				return 'NO';
			}
			
			case Log::INFO: {
				return 'IN';
			}
			
			case Log::DEBUG: {
				return 'DE';
			}
		}
	}
	
}
