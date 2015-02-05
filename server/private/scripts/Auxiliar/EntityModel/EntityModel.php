<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on entities of a certain
 * type.
 * 
 * Subclasses must implement the different operations.
 */
abstract class EntityModel {
	
	/*
	 * The application.
	 */
	protected $app;
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
	}
	
	/*
	 * Creates an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public abstract function create();
	
	/*
	 * Deletes an entity of the type of this model.
	 * 
	 * It receives the entity's ID.
	 */
	public abstract function delete($id);
	
	/*
	 * Edits an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public abstract function edit();
	
	/*
	 * Determines whether an entity exists.
	 * 
	 * It receives the entity's ID.
	 */
	public abstract function exists($id);
	
	/*
	 * Filters an entity for presentation and returns the result.
	 * 
	 * It receives the entity.
	 */
	public abstract function filter($entity);
	
	/*
	 * Returns an entity of the type of this model. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the entity's ID.
	 */
	public abstract function get($id);
	
	/*
	 * Searches entities of the type of this model and returns the results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public abstract function search($expression, $page, $sorting);
	
}
