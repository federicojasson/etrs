<?php

/*
 * TODO: comments
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
	 * TODO: comments
	 */
    public function write($message, $level) {
        // TODO: implement
    }
	
}
