<?php

namespace App\Helpers;

/*
 * This helper offers email-related functions.
 */
class EmailFactory extends \App\Helpers\Helper {
	
	/*
	 * Creates and returns a password recovery email.
	 * 
	 * It receives the recipient and the password recovery URL to be included in
	 * the email.
	 */
	public function createPasswordRecoveryEmail($recipient, $url) {
		$app = $this->app;
		
		// Gets the email's parameters
		$parameters = $app->parameters->get(PARAMETERS_EMAILS);
		$passwordRecoveryEmail = $parameters['passwordRecoveryEmail'];
		$subject = $passwordRecoveryEmail['subject'];
		$templatePath = $passwordRecoveryEmail['templatePath'];
		$alternativeTemplatePath = $passwordRecoveryEmail['alternativeTemplatePath'];
		
		// Defines a placeholder mapping
		$mapping = [
			':url' => $url
		];
		
		// Computes the email's body and alternative body
		$body = readTemplate($templatePath, $mapping);
		$alternativeBody = readTemplate($alternativeTemplatePath, $mapping);
		
		// Creates and returns the email
		return $this->createEmail($recipient, $subject, $body, $alternativeBody);
	}
	
	/*
	 * Creates and returns a user creation email.
	 * 
	 * It receives the recipient and the user creation URL to be included in the
	 * email.
	 */
	public function createUserCreationEmail($recipient, $url) {
		$app = $this->app;
		
		// Gets the email's parameters
		$parameters = $app->parameters->get(PARAMETERS_EMAILS);
		$userCreationEmail = $parameters['userCreationEmail'];
		$subject = $userCreationEmail['subject'];
		$templatePath = $userCreationEmail['templatePath'];
		$alternativeTemplatePath = $userCreationEmail['alternativeTemplatePath'];
		
		// Defines a placeholder mapping
		$mapping = [
			':url' => $url
		];
		
		// Computes the email's body and alternative body
		$body = readTemplate($templatePath, $mapping);
		$alternativeBody = readTemplate($alternativeTemplatePath, $mapping);
		
		// Creates and returns the email
		return $this->createEmail($recipient, $subject, $body, $alternativeBody);
	}
	
	/*
	 * Creates and returns an email.
	 * 
	 * It receives the recipient, the subject, the body (in HTML) and an
	 * alternative body (in plain text) in case the client doesn't support HTML.
	 */
	private function createEmail($recipient, $subject, $body, $alternativeBody) {
		$app = $this->app;
		
		// Gets the SMTP and sender's parameters
		$parameters = $app->parameters->get(PARAMETERS_EMAILS);
		$smtp = $parameters['smtp'];
		$sender = $parameters['sender'];
		
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
		
		// Sets the email's information
		$email->From = $sender['emailAddress'];
		$email->FromName = $sender['name'];
		$email->addAddress($recipient['emailAddress'], (isset($recipient['name']))? $recipient['name'] : '');
		$email->Subject = $subject;
		$email->isHTML();
		$email->Body = $body;
		$email->AltBody = $alternativeBody;
		
		return $email;
	}
	
}
