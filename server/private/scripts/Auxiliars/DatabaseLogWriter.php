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
	 * The level mapping.
	 */
	private $levelMapping;
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
		
		// Initializes the level mapping
		$this->levelMapping = [
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
		
		// Gets the level-equivalent used in the database
		$level = $this->levelMapping[$level];
		
		// Creates the log
		$app->webServerDatabase->createLog($id, $level, $message);
	}
	
}
