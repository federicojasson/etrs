<?php

namespace App\Extensions;

/*
 * This class extends the Slim's Response class.
 */
class Response extends \Slim\Http\Response {
	
	/*
	 * Returns, and optionally sets, the response's body.
	 * 
	 * It receives, optionally, the output to be set.
	 * 
	 * The method redefines a deprecated version, and calls getBody or setBody
	 * instead. This is necessary because the Slim framework still uses it.
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
	 * Sets the response's body.
	 * 
	 * It receives the output to be set. If it is not a string, it encodes it in
	 * JSON format.
	 */
	public function setBody($output) {
		if (is_string($output)) {
			// The content is a string
			parent::setBody($output);
			
			return;
		}
		
		// Encodes the output
		$encodedOutput = json_encode($output);
		
		// Sets the Content-Type header
		$this->headers->set(HTTP_HEADER_CONTENT_TYPE, HTTP_MEDIA_TYPE_JSON);
		
		// Sets the encoded version as the body
		parent::setBody($encodedOutput);
	}
	
}
