<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on logs.
 */
class LogModel extends EntityModel {
	
	/*
	 * Creates an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function create() {
		$app = $this->app;
		
		// Creates the log
		$function = [ $app->webServerDatabase, 'createLog' ];
		call_user_func_array($function, func_get_args());
	}
	
}
