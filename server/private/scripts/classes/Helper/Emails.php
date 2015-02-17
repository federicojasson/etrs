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
		$relativeUri = $parameters['relativeUri'];
		
		// Builds a URI to recover the password
		$uri = '';
		$uri .= $app->webServer->getDomain();
		$uri .= $relativeUri;
		$uri .= '/' . bin2hex($id);
		$uri .= '/' . bin2hex($password);
		
		// Defines a placeholder mapping
		$mapping = [
			':uri' => $uri
		];
		
		// Builds the email's body and alternative body
		$path = ROOT_DIRECTORY . '/private/emails/recover-password-email.html';
		$body = readTemplateFile($path, $mapping);
		$alternativePath = ROOT_DIRECTORY . '/private/emails/recover-password-email.txt';
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
		$relativeUri = $parameters['relativeUri'];
		
		// Builds a URI to sign up
		$uri = '';
		$uri .= $app->webServer->getDomain();
		$uri .= $relativeUri;
		$uri .= '/' . bin2hex($id);
		$uri .= '/' . bin2hex($password);
		
		// Defines a placeholder mapping
		$mapping = [
			':uri' => $uri
		];
		
		// Builds the email's body and alternative body
		$path = ROOT_DIRECTORY . '/private/emails/sign-up-email.html';
		$body = readTemplateFile($path, $mapping);
		$alternativePath = ROOT_DIRECTORY . '/private/emails/sign-up-email.txt';
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
		
		// Since the delivery of an email can take some time, the timeout limit
		// is extended
		$app->webServer->extendTimeoutLimitForEmailDelivery();
		
		try {
			// Sends the email
			$email->send();
		} catch (\phpmailerException $exception) {
			// The operation failed
			
			// Logs the event
			$app->log->error('Email failed to be delivered. Message: ' . $exception->getMessage());
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_UNDELIVERED_EMAIL
			]);
		}
	}
	
}
