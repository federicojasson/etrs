<?php

namespace App\Extension;

/*
 * This class extends the Slim's Request class.
 */
class Request extends \Slim\Http\Request {
	
	/*
	 * Sets the body.
	 * 
	 * It receives the input to be set.
	 */
	public function setBody($input) {
		$this->env['slim.input'] = $input;
	}
	
}
