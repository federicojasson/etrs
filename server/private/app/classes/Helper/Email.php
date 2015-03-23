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
		
		// Builds a placeholder mapping
		$placeholderMapping = [
			'id' => bin2hex($id),
			'password' => bin2hex($password)
		];
		
		// Builds the body
		$path = DIRECTORY_EMAILS . '/password-reset.html';
		$body = readTemplateFile($path, $placeholderMapping);
		
		// Builds the alternative body
		$path = DIRECTORY_EMAILS . '/password-reset.txt';
		$alternativeBody = readTemplateFile($path, $placeholderMapping);
		
		// Creates the email
		$email = $this->createOnServerBehalf($recipient, $subject, $body, $alternativeBody);
		
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
		
		// Builds a placeholder mapping
		$placeholderMapping = [
			'id' => bin2hex($id),
			'password' => bin2hex($password)
		];
		
		// Builds the body
		$path = DIRECTORY_EMAILS . '/sign-up.html';
		$body = readTemplateFile($path, $placeholderMapping);
		
		// Builds the alternative body
		$path = DIRECTORY_EMAILS . '/sign-up.txt';
		$alternativeBody = readTemplateFile($path, $placeholderMapping);
		
		// Creates the email
		$email = $this->createOnServerBehalf($recipient, $subject, $body, $alternativeBody);
		
		// Sends the email
		return $this->send($email);
	}
	
	/**
	 * Creates an email.
	 * 
	 * Receives the sender, the recipient, the subject, the body in HTML and an
	 * alternative body in plain-text.
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
	 * Receives the recipient, the subject, the body in HTML and an alternative
	 * body in plain-text.
	 */
	private function createOnServerBehalf($recipient, $subject, $body, $alternativeBody) {
		// Builds the sender
		$sender = [
			'fullName' => 'ETRS',
			'emailAddress' => '' // TODO
		];
		
		// Creates the email
		$email = $this->create($sender, $recipient, $subject, $body, $alternativeBody);
		
		// TODO: embed logo image?
		
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
