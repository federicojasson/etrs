<?php

namespace App\Controller;

/*
 * This class encapsulates the logic of a service that performs security checks
 * and offers convenient methods.
 */
abstract class SpecializedSecureController extends SecureController {
	
	/*
	 * TODO: comments
	 */
	private $output;
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		// Invokes the parent's constructor
		parent::__construct();
		
		// Initializes the output
		$this->output = [];
	}
	
	/*
	 * Serves the request.
	 */
	public function serveRequest() {
		$app = $this->app;
		
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
	 * TODO: comments
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
			// No parsing is needed
			return $input;
		}
		
		// Invokes the parsing function and returns the result
		return call_user_func($parsingFunction, $input);
	}
	
	/*
	 * TODO: comments
	 */
	protected function setOutput($output) {
		$this->output = $output;
	}
	
	/*
	 * TODO: comments
	 */
	protected function setOutputEntry($key, $value) {
		$this->output[$key] = $value;
	}


	// TODO: implement methods here
	
}
