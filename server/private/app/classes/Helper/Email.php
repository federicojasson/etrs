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
		// TODO: create $email
		
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
		
		// TODO
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
			$app->log->error('Email undelivered. Message: ' . $message);
			
			return false;
		}
	}
	
}
