<?php

/*
 * This class extends the Slim's Response class, to allow an object or an array
 * to be set as the response body, automatically encoding it in JSON format.
 */
class JsonResponse extends \Slim\Http\Response {
	
	/*
	 * Gets and sets the response body.
	 * 
	 * The method redefines a deprecated version, and calls getBody or setBody
	 * instead. This is necessary because the Slim framework still uses it.
	 */
    public function body($output = null) {
        if (! is_null($output)) {
            $this->setBody($output);
        }
		
        return $this->getBody();
    }
	
	/*
	 * Sets the response body.
	 * 
	 * If an object or an array is received, it encodes it in JSON format.
	 */
    public function setBody($output) {
		if (is_string($output)) {
			// The content is a string
			parent::setBody($output);
			return;
		}
		
		// Encodes the output in JSON format
		$encodedOutput = json_encode($output);
		
		// Sets the response content type
		$this->headers->set(HTTP_HEADER_CONTENT_TYPE, HTTP_CONTENT_TYPE_JSON);
		
		// Sets the encoded version as the output
		parent::setBody($encodedOutput);
    }
	
}
