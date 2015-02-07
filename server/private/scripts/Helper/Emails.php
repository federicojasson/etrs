<?php

namespace App\Helper;

/*
 * This helper offers email-related functionalities.
 */
class Emails extends Helper {
	
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
		$email = new \PHPMailer();
		
		// Sets the SMTP parameters
		$email->isSMTP();
		$email->Host = $smtp['host'];
		$email->Port = $smtp['port'];
		$email->SMTPSecure = $smtp['protocol'];
		$email->SMTPAuth = true;
		$email->Username = $smtp['username'];
		$email->Password = $smtp['password'];
		
		// Sets the data of the email
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
		$this->createEmail($identity, $recipient, $subject, $body, $alternativeBody);
	}
	
}
