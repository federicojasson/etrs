<?php

namespace App\Helper;

/*
 * This helper offers email-related functionalities.
 */
class Emails extends Helper {
	
	/*
	 * Sends a recover password email.
	 * 
	 * It receives the recipient and the recover password permission's ID and
	 * password.
	 */
	public function sendRecoverPasswordEmail($recipient, $id, $password) {
		$app = $this->app;
		
		// Gets the email's parameters
		$parameters = $app->parameters->emails['recoverPasswordEmail'];
		$subject = $parameters['subject'];
		$path = $parameters['path'];
		$alternativePath = $parameters['alternativePath'];
		
		// Builds a URL to recover the password
		$url = '';
		$url .= $app->webServer->getDomain();
		$url .= '/recover-password/'; // TODO: hardcoded here?
		$url .= bin2hex($id) . '/' . bin2hex($password);
		
		// Defines a placeholder mapping
		$mapping = [
			':url' => $url
		];
		
		// Builds the email's body and alternative body
		$body = readTemplateFile($path, $mapping);
		$alternativeBody = readTemplateFile($alternativePath, $mapping);
		
		// Creates the email
		$email = $this->createEmailFromWebServer($recipient, $subject, $body, $alternativeBody);
		
		// Sends the email
		$this->sendEmail($email);
	}
	
	/*
	 * Sends a sign up email.
	 * 
	 * It receives the recipient and the sign up permission's ID and password.
	 */
	public function sendSignUpEmail($recipient, $id, $password) {
		$app = $this->app;
		
		// Gets the email's parameters
		$parameters = $app->parameters->emails['signUpEmail'];
		$subject = $parameters['subject'];
		$path = $parameters['path'];
		$alternativePath = $parameters['alternativePath'];
		
		// Builds a URL to sign up
		$url = '';
		$url .= $app->webServer->getDomain();
		$url .= '/sign-up/'; // TODO: hardcoded here?
		$url .= bin2hex($id) . '/' . bin2hex($password);
		
		// Defines a placeholder mapping
		$mapping = [
			':url' => $url
		];
		
		// Builds the email's body and alternative body
		$body = readTemplateFile($path, $mapping);
		$alternativeBody = readTemplateFile($alternativePath, $mapping);
		
		// Creates the email
		$email = $this->createEmailFromWebServer($recipient, $subject, $body, $alternativeBody);
		
		// Sends the email
		$this->sendEmail($email);
	}
	
	/*
	 * Creates and returns an email.
	 * 
	 * It receives the sender, the recipient, the subject, the body in HTML and
	 * an alternative body in plain text in case the client doesn't support
	 * HTML.
	 */
	private function createEmail($sender, $recipient, $subject, $body, $alternativeBody) {
		$app = $this->app;
		
		// Gets the SMTP parameters
		$smtp = $app->parameters->emails['smtp'];
		
		// Initializes the email
		$email = new \PHPMailer(true);
		
		// Sets the SMTP parameters
		$email->isSMTP();
		$email->Host = $smtp['host'];
		$email->Port = $smtp['port'];
		$email->SMTPSecure = $smtp['protocol'];
		$email->SMTPAuth = true;
		$email->Username = $smtp['username'];
		$email->Password = $smtp['password'];
		
		// Sets the data of the email
		$email->CharSet = 'UTF-8';
		$email->From = $sender['emailAddress'];
		$email->FromName = $sender['name'];
		$email->addAddress($recipient['emailAddress'], $recipient['name']);
		$email->Subject = $subject;
		$email->isHTML();
		$email->Body = $body;
		$email->AltBody = $alternativeBody;
		
		return $email;
	}
	
	/*
	 * Creates and returns an email that will be sent on behalf of the web
	 * server.
	 * 
	 * It receives the recipient, the subject, the body in HTML and an
	 * alternative body in plain text in case the client doesn't support HTML.
	 */
	private function createEmailFromWebServer($recipient, $subject, $body, $alternativeBody) {
		$app = $this->app;
		
		// Gets the web server identity
		$identity = $app->parameters->emails['identity'];
		
		// Creates and returns the email
		return $this->createEmail($identity, $recipient, $subject, $body, $alternativeBody);
	}
	
	/*
	 * Sends an email. If it is not delivered, the execution is halted.
	 * 
	 * It receives the email.
	 */
	private function sendEmail($email) {
		$app = $this->app;
		
		try {
			// Sends the email
			$email->send();
		} catch (\phpmailerException $exception) {
			// The operation failed
			
			// Logs the event
			$app->log->error('An email failed to be delivered. Message: ' . $exception->getMessage());
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_UNDELIVERED_EMAIL
			]);
		}
	}
	
}
