<?php

/*
 * This class extends the Slim's Response class, to allow an object or an array
 * to be set as the response's body, automatically encoding it in JSON format.
 */
class JsonResponse extends \Slim\Http\Response {
	
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
