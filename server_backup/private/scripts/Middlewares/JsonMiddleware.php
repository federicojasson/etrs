<?php

/*
 * This middleware automatically decodes and encodes the application input and
 * output respectively, assuming that the JSON format is used. It should be used
 * only if all data exchange is expected to be done through JSON.
 * 
 * Be aware that if the input data is not a valid JSON string, the middleware
 * will halt the execution and respond with an HTTP error.
 */
class JsonMiddleware extends \Slim\Middleware {
	
	/*
	 * Executes the middleware's logic.
	 */
	public function call() {
		$app = $this->app;
		
		// Hooks some functionality before the dispatch
		$app->hook('slim.before.dispatch', [ $this, 'decodeInput' ]);
		
		// Replaces the response object with an extension that handles the JSON
		// encoding
		$app->container->singleton('response', function() {
			return new JsonResponse();
		});
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Attempts to decode the input, assuming it is a JSON string.
	 * 
	 * If the request's content type is not JSON or if it is, but the input
	 * can't be decoded, it halts the execution and responds with an HTTP error.
	 */
	public function decodeInput() {
		$app = $this->app;
		$environment = $app->environment();
		
		if ($app->request()->getMediaType() !== HTTP_CONTENT_TYPE_JSON) {
			// The request's content type is not JSON
			$app->halt(HTTP_STATUS_UNSUPPORTED_MEDIA_TYPE);
		}
		
		// Gets the input
		$input = $environment['slim.input'];
		
		if (strlen($input) === 0) {
			// The input is empty
			return;
		}
		
		// Attempts to decode the input
		$decodedInput = json_decode($input, true);
		
		if ($decodedInput === null) {
			// The input could not be decoded
			$app->halt(HTTP_STATUS_BAD_REQUEST);
		}
		
		// Updates the input with the decoded version
		$environment['slim.input'] = $decodedInput;
	}
	
}
