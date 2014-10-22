<?php

/*
 * TODO
 */
class JsonMiddleware extends \Slim\Middleware {
	
	/*
	 * TODO
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
	 * TODO
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
		
		// Tries to decode the input
		$input = json_decode($environment['slim.input'], true);
		
		if ($input === null) {
			// The input could not be decoded
			$app->halt(HTTP_STATUS_BAD_REQUEST);
		}
		
		// Updates the input with the decoded version
		$environment['slim.input'] = $input;
	}
	
	/*
	 * TODO
	 */
	public function encodeOutput() {
		// Gets the response
		$response = $this->app->response();
		
		// Sets the response's content type
		$response->headers->set(HTTP_HEADER_CONTENT_TYPE, HTTP_CONTENT_TYPE_JSON);
		
		// Encodes the output
		$output = json_encode($response->getBody());
		
		// Updates the output with the encoded version
		$response->setBody($output);
	}
	
}
