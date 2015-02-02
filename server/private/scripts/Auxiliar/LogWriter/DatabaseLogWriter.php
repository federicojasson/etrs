<?php

namespace App\Auxiliar\LogWriter;

/*
 * This class is used to write logs in a database.
 */
class DatabaseLogWriter {
	
	/*
	 * The application.
	 */
	private $app;
	
	/*
	 * The level mapping.
	 * 
	 * Maps the log levels used in the application to those used in the
	 * database.
	 */
	private $levelMapping;
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
		
		// Initializes the level mapping
		$this->levelMapping = [
			Slim\Log::DEBUG => LOG_LEVEL_4,
			Slim\Log::INFO => LOG_LEVEL_3,
			Slim\Log::NOTICE => LOG_LEVEL_3,
			Slim\Log::WARN => LOG_LEVEL_2,
			Slim\Log::ERROR => LOG_LEVEL_2,
			Slim\Log::CRITICAL => LOG_LEVEL_1,
			Slim\Log::ALERT => LOG_LEVEL_1,
			Slim\Log::EMERGENCY => LOG_LEVEL_1
		];
	}
	
	/*
	 * Writes a log.
	 * 
	 * It receives the log's message and level.
	 */
	public function write($message, $level) {
		$app = $this->app;
		
		// Generates random IDs until it finds one that is not in use
		do {
			$id = $app->cryptography->generateRandomId();
		} while ($app->webServerDatabase->logExists($id));
		
		// Maps the log's level to the one used in the database
		$level = $this->levelMapping[$level];
		
		// Creates the log
		$app->webServerDatabase->createLog($id, $level, $message);
	}
	
}
