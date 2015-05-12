<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Helper;

/**
 * Provides email-related functionalities.
 */
class Email {
	
	/**
	 * Sends a password-reset email.
	 * 
	 * Receives the recipient and the password-reset permission's ID and
	 * password.
	 */
	public function sendPasswordReset($recipient, $id, $password) {
		// Defines the subject
		$subject = 'Restablecimiento de contraseña';
		
		// Creates the email
		$email = $this->createOnServerBehalf('passwordReset', $recipient, $subject, [
			'id' => bin2hex($id),
			'password' => bin2hex($password)
		]);
		
		// Sends the email
		return $this->send($email);
	}
	
	/**
	 * Sends a sign-up email.
	 * 
	 * Receives the recipient and the sign-up permission's ID and password.
	 */
	public function sendSignUp($recipient, $id, $password) {
		// Defines the subject
		$subject = 'Invitación';
		
		// Creates the email
		$email = $this->createOnServerBehalf('signUp', $recipient, $subject, [
			'id' => bin2hex($id),
			'password' => bin2hex($password)
		]);
		
		// Sends the email
		return $this->send($email);
	}
	
	/**
	 * Sends a welcome email.
	 * 
	 * Receives the recipient.
	 */
	public function sendWelcome($recipient) {
		// Defines the subject
		$subject = 'Bienvenido';
		
		// Creates the email
		$email = $this->createOnServerBehalf('welcome', $recipient, $subject);
		
		// Sends the email
		return $this->send($email);
	}
	
	/**
	 * Creates an email.
	 * 
	 * Receives the sender, the recipient, the subject, the body in HTML and an
	 * alternative body in plain text.
	 */
	private function create($sender, $recipient, $subject, $body, $alternativeBody) {
		global $app;
		
		// Gets the SMTP parameters
		$smtp = $app->parameters->smtp;
		
		// Initializes the email
		$email = new \PHPMailer(true);
		
		// Applies connection-related settings
		$email->isSMTP();
		$email->SMTPSecure = $smtp['protocol'];
		$email->Host = $smtp['host'];
		$email->Port = $smtp['port'];
		$email->SMTPAuth = true;
		$email->Username = $smtp['username'];
		$email->Password = $smtp['password'];
		
		// Applies email-related settings
		$email->FromName = $sender['fullName'];
		$email->From = $sender['emailAddress'];
		$email->addAddress($recipient['emailAddress'], $recipient['fullName']);
		$email->Subject = $subject;
		$email->CharSet = 'UTF-8';
		$email->isHTML();
		$email->Body = $body;
		$email->AltBody = $alternativeBody;
		
		return $email;
	}
	
	/**
	 * Creates an email to be sent on behalf of the server.
	 * 
	 * Receives the type, the recipient, the subject and, optionally, a mapping
	 * containing placeholders as keys and replacements as values, used to build
	 * the body and the alternative body.
	 */
	private function createOnServerBehalf($type, $recipient, $subject, $mapping = []) {
		global $app;
		
		// Gets the server parameters
		$server = $app->parameters->server;
		
		// Builds the sender
		$sender = [
			'fullName' => $server['acronym'],
			'emailAddress' => $server['emailAddress']
		];
		
		// Converts the type from camelCase to spinal-case
		$type = camelToSpinalCase($type);
		
		// Adds placeholders to the mapping
		$mapping['name'] = $server['name'];
		$mapping['acronym'] = $server['acronym'];
		$mapping['domain'] = $server['domain'];
		$mapping['emailAddress'] = $server['emailAddress'];
		
		// Builds the body
		$path = buildPath(DIRECTORY_EMAILS, $type . '.html');
		$body = readTemplateFile($path, $mapping);
		
		// Builds the alternative body
		$path = buildPath(DIRECTORY_EMAILS, $type . '.txt');
		$alternativeBody = readTemplateFile($path, $mapping);
		
		// Creates the email
		$email = $this->create($sender, $recipient, $subject, $body, $alternativeBody);
		
		// Embeds the logo
		$path = buildPath(DIRECTORY_EMAILS, 'images', 'logo.png');
		$logo = file_get_contents($path);
		$email->addStringEmbeddedImage($logo, 'logo');
		
		return $email;
	}
	
	/**
	 * Sends an email.
	 * 
	 * Receives the email.
	 */
	private function send($email) {
		global $app;
		
		try {
			// Sends the email
			$email->send();
			
			return true;
		} catch (\phpmailerException $exception) {
			// The email could not be delivered
			
			// Gets the exception's message
			$message = $exception->getMessage();
			
			// Logs the event
			$app->log->error('Undelivered email. Message: ' . $message);
			
			return false;
		}
	}
	
}
