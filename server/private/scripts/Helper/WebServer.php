<?php

namespace App\Helper;

/*
 * TODO: comments
 */
class WebServer extends Helper {
	
	/*
	 * TODO: comments
	 */
	public function getDomain() {
		$app = $this->app;
		
		// TODO: comment
		return $app->parameters->webServer['domain']; // TODO: check
	}
	
}
