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
 * This class offers email-related functionalities.
 */
class Emails {
	
	/**
	 * Sends a reset-password email.
	 * 
	 * Receives the recipient and the reset-password permission's ID and
	 * password.
	 */
	public function sendResetPasswordEmail($recipient, $id, $password) {
		global $app;
		
		// Gets the server parameters
		$server = $app->parameters->server;
		
		// Builds the email's subject
		$subject = $server['name'] . ' - Restablecer contraseña';
		
		// Builds a URL to reset the password
		$url = '';
		$url .= $server['domain'];
		$url .= '/reset-password';
		$url .= '/' . bin2hex($id);
		$url .= '/' . bin2hex($password);
		
		// Defines a placeholder mapping
		$mapping = [
			':url' => $url
		];
		
		// Builds the email's body
		$path = DIRECTORY_EMAILS . '/reset-password-email.html';
		$body = readTemplateFile($path, $mapping);
		
		// Builds the email's alternative body
		$alternativePath = DIRECTORY_EMAILS . '/reset-password-email.txt';
		$alternativeBody = readTemplateFile($alternativePath, $mapping);
		
		// Creates the email
		$email = $this->createEmailFromServer($recipient, $subject, $body, $alternativeBody);
		
		// Sends the email
		$this->sendEmail($email);
	}
	
	/**
	 * Sends a sign-up email.
	 * 
	 * Receives the recipient and the sign-up permission's ID and password.
	 */
	public function sendSignUpEmail($recipient, $id, $password) {
		global $app;
		
		// Gets the server parameters
		$server = $app->parameters->server;
		
		// Builds the email's subject
		$subject = $server['name'] . ' - Invitación';
		
		// Builds a URL to sign up
		$url = '';
		$url .= $server['domain'];
		$url .= '/sign-up';
		$url .= '/' . bin2hex($id);
		$url .= '/' . bin2hex($password);
		
		// Defines a placeholder mapping
		$mapping = [
			':url' => $url
		];
		
		// Builds the email's body
		$path = DIRECTORY_EMAILS . '/sign-up-email.html';
		$body = readTemplateFile($path, $mapping);
		
		// Builds the email's alternative body
		$alternativePath = DIRECTORY_EMAILS . '/sign-up-email.txt';
		$alternativeBody = readTemplateFile($alternativePath, $mapping);
		
		// Creates the email
		$email = $this->createEmailFromServer($recipient, $subject, $body, $alternativeBody);
		
		// Sends the email
		$this->sendEmail($email);
	}
	
	/**
	 * Creates an email.
	 * 
	 * Receives the sender, the recipient, the subject, the body in HTML and an
	 * alternative body in plain-text.
	 */
	private function createEmail($sender, $recipient, $subject, $body, $alternativeBody) {
		global $app;
		
		// Gets the SMTP parameters
		$smtp = $app->parameters->smtp;
		
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
		$email->From = $sender['emailAddress'];
		$email->FromName = $sender['name'];
		$email->addAddress($recipient['emailAddress'], $recipient['name']);
		$email->Subject = $subject;
		$email->isHTML();
		$email->CharSet = 'UTF-8';
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
	private function createEmailFromServer($recipient, $subject, $body, $alternativeBody) {
		global $app;
		
		// Gets the server parameters
		$server = $app->parameters->server;
		
		// Initializes the sender of the email
		$sender = [
			'name' => $server['name'],
			'emailAddress' => $server['emailAddress']
		];
		
		// Creates the email
		return $this->createEmail($sender, $recipient, $subject, $body, $alternativeBody);
	}
	
	/**
	 * Sends an email.
	 * 
	 * Receives the email.
	 */
	private function sendEmail($email) {
		global $app;
		
		try {
			// Sends the email
			$email->send();
		} catch (\phpmailerException $exception) {
			// The email could not be delivered.
			
			// Logs the event
			$app->log->error('Undelivered email. Message: ' . $exception->getMessage());
			
			// Halts the execution
			$app->server->haltExecution(HTTP_STATUS_INTERNAL_SERVER_ERROR, CODE_UNDELIVERED_EMAIL);
		}
	}
	
}
