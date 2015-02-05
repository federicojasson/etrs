<?php

namespace App\Helper;

/*
 * This helper offers an interface to access the entity models.
 */
class Data extends Helper {
	
	/*
	 * The entity models.
	 */
	private $entityModels;
	
	/*
	 * Invoked when an inaccessible property is obtained.
	 * 
	 * It receives the property's name.
	 */
	public function __get($name) {
		return $this->entityModels[$name];
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the entity models
		$this->entityModels = [
			'background' => new \App\Auxiliar\EntityModel\BackgroundModel(),
			'file' => new \App\Auxiliar\EntityModel\FileModel(),
			'log' => new \App\Auxiliar\EntityModel\LogModel(),
			'recoverPasswordPermission' => new \App\Auxiliar\EntityModel\RecoverPasswordPermissionModel(),
			'session' => new \App\Auxiliar\EntityModel\SessionModel(),
			'signUpPermission' => new \App\Auxiliar\EntityModel\SignUpPermissionModel(),
			'user' => new \App\Auxiliar\EntityModel\UserModel()
		];
	}
	
}
