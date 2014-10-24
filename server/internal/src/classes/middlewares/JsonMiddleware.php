<?php

/*
 * This object automatically decodes and encodes the application input and
 * output respectively, assuming that JSON format is used. It should be used
 * only if all data exchange is expected to be done through JSON.
 * Be aware that if the input data is not a valid JSON string, the middleware
 * will halt the execution and respond with an HTTP error.
 */
class JsonMiddleware extends \Slim\Middleware {
	
	/*
	 * Implements the middleware's logic.
	 */
	public function call() {
		// Gets the app
		$app = $this->app;
		
		// Hooks some functionality before the dispatch
		$app->hook('slim.before.dispatch', [ $this, 'decodeInput' ]);
		
		// Hooks some functionality after the dispatch
		$app->hook('slim.after.dispatch', [ $this, 'encodeOutput' ]);
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Attempts to decode the input, assuming it is a JSON string.
	 * If the request's content type is not JSON or if it is, but the input
	 * can't be decoded, it halts the execution and responds with an HTTP error.
	 */
	public function decodeInput() {
		// Gets the app
		$app = $this->app;
		
		// Gets the environment
		$environment = $app->environment();
		
		if ($app->request()->getMediaType() !== HTTP_CONTENT_TYPE_JSON) {
			// The request's content type is not JSON
			$app->halt(HTTP_STATUS_UNSUPPORTED_MEDIA_TYPE);
		}
		
		// Attempts to decode the input
		$input = json_decode($environment['slim.input'], true);
		
		if ($input === null) {
			// The input could not be decoded
			$app->halt(HTTP_STATUS_BAD_REQUEST);
		}
		
		// Updates the input with the decoded version
		$environment['slim.input'] = $input;
	}
	
	/*
	 * Encodes the output as a JSON string.
	 */
	public function encodeOutput() {
		// Gets the response
		$response = $this->app->response();
		
		// Sets the response's content type
		$response->headers->set(HTTP_HEADER_CONTENT_TYPE, HTTP_CONTENT_TYPE_JSON);
		
		// Encodes the output
		$output = json_encode($response->getBody()); // TODO: deberia hacerse algo en caso de error? (el servidor es responsable del error)
		
		// Updates the output with the encoded version
		$response->setBody($output);
	}
	
}
