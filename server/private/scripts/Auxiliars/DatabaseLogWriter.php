<?php

namespace App\Auxiliars;

/*
 * This class is used to write logs in a database.
 */
class DatabaseLogWriter {
	
	/*
	 * The application.
	 */
	private $app;
	
	/*
	 * The log levels used in the database.
	 */
	private $databaseLevels;
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
		
		// Initializes the log levels used in the database
		$this->databaseLevels = [
			\Slim\Log::EMERGENCY => LOG_LEVEL_1,
			\Slim\Log::ALERT => LOG_LEVEL_1,
			\Slim\Log::CRITICAL => LOG_LEVEL_1,
			\Slim\Log::ERROR => LOG_LEVEL_1,
			\Slim\Log::WARN => LOG_LEVEL_2,
			\Slim\Log::NOTICE => LOG_LEVEL_3,
			\Slim\Log::INFO => LOG_LEVEL_3,
			\Slim\Log::DEBUG => LOG_LEVEL_4
		];
	}
	
	/*
	 * Writes a log.
	 * 
	 * It receives the log's message and its level.
	 */
	public function write($message, $level) {
		$app = $this->app;
		
		do {
			// Generates a random ID
			$id = $app->cryptography->generateRandomId();
		} while ($app->webServerDatabase->logExists($id));
		
		// Gets the log's level used in the database
		$databaseLevel = $this->databaseLevels[$level];
		
		// Creates the log
		$app->webServerDatabase->createLog($id, $databaseLevel, $message);
	}
	
}
