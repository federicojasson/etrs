<?php

namespace App\Controller;

/*
 * This class encapsulates the logic of a secure service and offers specialized
 * methods.
 */
abstract class SpecializedSecureController extends SecureController {
	
	/*
	 * The output.
	 */
	private $output;
	
	/*
	 * Serves the request.
	 */
	public function serveRequest() {
		$app = $this->app;
		
		// Initializes the output
		$this->output = [];
		
		// Invokes the parent's function
		parent::serveRequest();
		
		if (isArrayEmpty($this->output)) {
			// There is no output
			return;
		}
		
		// Sets the output
		$app->response->setBody($this->output);
	}
	
	/*
	 * Returns an input.
	 * 
	 * It receives the input's key and, optionally, a parsing function to be
	 * invoked on the input before it is returned.
	 */
	protected function getInput($key, $parsingFunction = null) {
		$app = $this->app;
		
		// Gets the input
		$inputs = $app->request->getBody();
		$input = $inputs[$key];
		
		if (is_null($input)) {
			// The input is null
			return null;
		}
		
		if (is_null($parsingFunction)) {
			// No parsing function needs to be invoked on the input
			return $input;
		}
		
		// Invokes the parsing function and returns the result
		return call_user_func($parsingFunction, $input);
	}
	
	/*
	 * Sets the output completely.
	 * 
	 * It receives the output.
	 */
	protected function setOutputCompletely($output) {
		$this->output = $output;
	}
	
	/*
	 * Sets the value of an output entry.
	 * 
	 * It receives the entry's key and the value to be set.
	 */
	protected function setOutput($key, $value) {
		$this->output[$key] = $value;
	}
	
	/*
	 * Validates a JSON request and returns the result.
	 * 
	 * If the request is valid, the input is replaced by a decoded version.
	 * 
	 * It receives the descriptor of the expected JSON structure.
	 */
	protected function validateJsonRequest($jsonStructureDescriptor) {
		$app = $this->app;
		
		// Gets the media type
		$mediaType = $app->request->getMediaType();
		
		if ($mediaType !== 'application/json') {
			// The media type is not JSON
			return false;
		}
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Decodes the input
		$input = json_decode($input, true);
		
		if (is_null($input)) {
			// The input could not be decoded
			return false;
		}
		
		if (! $jsonStructureDescriptor->isValidInput($input)) {
			// The input is invalid
			return false;
		}
		
		// Replaces the request's body with the decoded input
		$app->request->setBody($input);
		
		return true;
	}
	
	// TODO: implement methods here
	
}
