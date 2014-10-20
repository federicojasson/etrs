<?php

/*
 * TODO
 */
abstract class Database {
	
	/*
	 * TODO
	 */
	protected $connection;
	
	/*
	 * TODO
	 */
	public function connect($dsn, $user, $password) {
		// Creates a database connection
		$this->connection = new DatabaseConnection($dsn, $user, $password);
	}
	
}
