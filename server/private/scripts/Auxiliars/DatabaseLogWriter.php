<?php

/*
 * This class is used to write logs in a database.
 */
class DatabaseLogWriter {
	
	/*
	 * The cryptography helper.
	 */
	private $cryptography;
	
	/*
	 * The database helper through which the logs are written.
	 */
	private $database;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the cryptography and database helpers.
	 */
	public function __construct($cryptography, $database) {
		$this->cryptography = $cryptography;
		$this->database = $database;
	}
	
    /*
	 * Writes a log in the database.
	 * 
	 * It receives the message and the level.
	 */
    public function write($message, $level) {
		$database = $this->database;
		
		// Generate a random ID for the log
		do {
			$logId = $this->cryptography->generateRandomId();
		} while ($database->logExists($logId));
		
		// Gets the type of the log
		$logType = getLogType($level);
		
		// Inserts a log in the database
		$database->insertLog($logId, $logType, $message);
    }
	
	/*
	 * Returns the type of a log, according to its level.
	 * 
	 * It receives the level.
	 */
	private function getLogType($level) {
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
