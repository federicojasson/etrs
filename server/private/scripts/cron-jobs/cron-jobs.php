<?php

/*
 * This script offers utilities for the cron jobs.
 */

namespace CronJobs;

/*
 * TODO: comments
 */
class Database {
	
	/*
	 * TODO: comments
	 */
	private static $pdo;

	/*
	 * TODO: comments
	 */
	public static function connect($dsn, $username, $password) {
		static::$pdo = new \PDO($dsn, $username, $password);
	}
	
	/*
	 * TODO: comments
	 */
	public static function executePreparedStatement($statement, $parameters = null) {
		try {
			// Prepares and executes the statement
			$preparedStatement = static::$pdo->prepare($statement);
			$preparedStatement->execute($parameters);
			
			if ($preparedStatement->columnCount() === 0) {
				// The statement is not a query
				return null;
			}
			
			// Fetches and returns the results
			return $preparedStatement->fetchAll();
		} catch (\PDOException $exception) {
			// An operation failed
			// TODO
		}
	}
	
}

/*
 * TODO: comments
 */
class Lock {
	
	/*
	 * TODO: comments
	 */
	private static $locks = [];
	
	/*
	 * TODO: comments
	 */
	public static function acquire($id) {
		$file = static::$locks[$id];
		flock($file, LOCK_EX);
	}
	
	/*
	 * TODO: comments
	 */
	public static function create($id, $path) {
		$file = fopen($path, 'c');
		static::$locks[$id] = $file;
	}
	
	/*
	 * TODO: comments
	 */
	public static function release($id) {
		$file = static::$locks[$id];
		flock($file, LOCK_UN);
	}
	
}

/*
 * TODO: commnets
 */
class Parameters {
	
	/*
	 * The parameters.
	 */
	private $parameters;
	
	/*
	 * The paths of the parameters files.
	 */
	private $paths;
	
	/*
	 * Invoked when an inaccessible property is obtained.
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
		$this->paths = readJsonFile('private/parameters/parameters.json');
	}
	
}
