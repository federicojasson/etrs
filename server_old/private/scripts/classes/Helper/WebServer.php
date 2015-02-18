<?php

namespace App\Helper;

/*
 * This helper offers low-level functionalities.
 */
class WebServer extends Helper {
	
	/*
	 * Executes a command line. The operation is carried out in a certain
	 * working directory. The caller is responsible for preparing the context so
	 * that the execution takes place correctly.
	 * 
	 * It receives the working directory and the command line to execute.
	 */
	public function executeCommandLine($workingDirectory, $commandLine) {
		// Saves the current working directory
		$currentWorkingDirectory = getcwd();
		
		// Changes the working directory
		chdir($workingDirectory);
		
		// Executes the command line
		exec($commandLine);
		
		// Restores the previous working directory
		chdir($currentWorkingDirectory);
	}
	
	/*
	 * Extends the timeout limit for the delivery of an email.
	 */
	public function extendTimeoutLimitForEmailDelivery() {
		$this->extendTimeoutLimit(EXTENSION_TIME_EMAIL_DELIVERY);
	}
	
	/*
	 * Extends the timeout limit for the hashing of a file.
	 */
	public function extendTimeoutLimitForFileHashing() {
		$this->extendTimeoutLimit(EXTENSION_TIME_FILE_HASHING);
	}
	
	/*
	 * Extends the timeout limit for the hashing of a password.
	 */
	public function extendTimeoutLimitForPasswordHashing() {
		$this->extendTimeoutLimit(EXTENSION_TIME_PASSWORD_HASHING);
	}
	
	/*
	 * Returns the client's IP address.
	 */
	public function getClientIpAddress() {
		// Gets the IP address
		$ipAddress = $_SERVER['REMOTE_ADDR'];

		// Converts the IP address to binary
		$ipAddress = inet_pton($ipAddress);
		
		if ($ipAddress === false) {
			// The IP address is invalid
			return 'unknown';
		}

		// Initializes the IPv4-mapped IPv6 address prefix and its length
		$prefix = hex2bin('00000000000000000000ffff');
		$length = strlen($prefix);
		
		if ($prefix === substr($ipAddress, 0, $length)) {
			// The IP address is an IPv4-mapped IPv6 address

			// Removes the prefix
			$ipAddress = substr($ipAddress, strlen($prefix));
		}

		// Converts the IP address back to its human readable format
		$ipAddress = inet_ntop($ipAddress);

		return $ipAddress;
	}
	
	/*
	 * Returns the domain of the web server.
	 */
	public function getDomain() {
		$app = $this->app;
		
		// Gets and returns the domain
		return $app->parameters->webServer['domain'];
	}
	
	/*
	 * Extends the timeout limit. This is the maximum time that the current
	 * request is allowed to be served.
	 * 
	 * It receives the amount of time by which the limit is extended (in
	 * seconds).
	 */
	private function extendTimeoutLimit($extensionTime) {
		set_time_limit($extensionTime);
	}
	
}
