<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class represents an entity model. Entity models offer operations to
 * manage a specific type of entity.
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
	
}
