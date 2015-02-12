<?php

namespace App\Extension;

/*
 * This class extends the Slim's Response class.
 */
class Response extends \Slim\Http\Response {
	
	/*
	 * Returns, and optionally sets, the body.
	 * 
	 * The method redefines a deprecated version, and uses getBody and setBody
	 * instead. This is necessary because the Slim framework still uses it.
	 * 
	 * It receives, optionally, the output to be set.
	 */
	public function body($output = null) {
		if (! is_null($output)) {
			// Sets the body
			$this->setBody($output);
		}
		
		// Returns the body
		return $this->getBody();
	}
	
	/*
	 * Sets the body.
	 * 
	 * It receives the output to be set. If it is not a string, it encodes it in
	 * JSON format.
	 */
	public function setBody($output) {
		if (! is_string($output)) {
			// The content is not a string
			
			// Encodes the output
			$output = json_encode($output);
			
			// Sets the proper header
			$this->headers->set('Content-Type', 'application/json');
		}
		
		// Invokes the parent's function
		parent::setBody($output);
	}
	
}
