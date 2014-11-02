<?php

/*
 * This class extends the Slim's Response class, to allow an object or an array
 * to be set as the response's body, automatically encoding it in JSON format.
 */
class JsonResponse extends \Slim\Http\Response {
	
    /**
     * DEPRECATION WARNING! use `getBody` or `setBody` instead.
     *
     * Get and set body
     * @param  string|null $body Content of HTTP response body
     * @return string
     */
	
	/*
	 * Gets and sets the response's body.
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
	 * Sets the response's body.
	 * If an object or an array is received, it encodes it in JSON format.
	 */
    public function setBody($output) {
		if (is_string($output)) {
			// The content is a string
			parent::setBody($output);
			return;
		}
		
		// Encodes the output
		$encodedOutput = json_encode($output); // TODO: deberia hacerse algo en caso de error? (el servidor es responsable del error)
		
		// Sets the response's content type
		$this->headers->set(HTTP_HEADER_CONTENT_TYPE, HTTP_CONTENT_TYPE_JSON);
		
		// Sets the encoded version as the output
		parent::setBody($encodedOutput);
    }
	
}
