<?php

namespace App\Auxiliars;

/*
 * This class is used to write logs in a database.
 */
class DatabaseLogWriter {
	
	/*
	 * The Cryptography helper.
	 */
	private $cryptography;
	
	/*
	 * The log levels used in the database.
	 */
	private $databaseLevels = [
		Log::DEBUG => 'DE',
		Log::INFO => 'IN',
		Log::NOTICE => 'NO',
		Log::WARN => 'WA',
		Log::ERROR => 'ER',
		Log::CRITICAL => 'CR',
		Log::ALERT => 'AL',
		Log::EMERGENCY => 'EM'
	];
	
	/*
	 * The WebServerDatabase helper.
	 */
	private $webServerDatabase;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the Cryptography and WebServerDatabase helpers.
	 */
	public function __construct($cryptography, $webServerDatabase) {
		$this->cryptography = $cryptography;
		$this->webServerDatabase = $webServerDatabase;
	}
	
	/*
	 * Writes a log.
	 * 
	 * It receives the log's message and its level.
	 */
	public function write($message, $level) {
		do {
			// Generates a random ID
			$id = $this->cryptography->generateRandomId();
		} while ($this->webServerDatabase->logExists($id)); // TODO: implement
		
		// Gets the log's level used in the database
		$databaseLevel = $this->databaseLevels[$level];
		
		// Inserts the log
		$this->webServerDatabase->insertLog($id, $databaseLevel, $message); // TODO: implement
	}
	
}
