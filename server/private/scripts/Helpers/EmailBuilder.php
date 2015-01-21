<?php

namespace App\Helpers;

/*
 * This helper acts as a builder of Email objects.
 */
class EmailBuilder extends \App\Helpers\Helper {
	
	/*
	 * Keeps the state of the email being built.
	 */
	private $state;
	
	/*
	 * Builds and returns the email.
	 */
	public function build() {
		// Gets the information of the email
		$from = $this->state[EMAIL_FROM];
		$to = $this->state[EMAIL_TO];
		$subject = $this->state[EMAIL_SUBJECT];
		$message = $this->state[EMAIL_MESSAGE];
		
		// Initializes the additional headers
		$additionalHeaders = '';
		$additionalHeaders .= 'From: ' . $from . CRLF;
		// TODO: test and complete with additional headers
		
		// Creates and returns the email
		return new Email($to, $subject, $message, $additionalHeaders);
	}
	
	/*
	 * Sets the sender's email address and returns the builder.
	 * 
	 * It receives the email address of the sender.
	 */
	public function from($from) {
		$this->state[EMAIL_FROM] = $from;
		
		return $this;
	}
	
	/*
	 * Sets the email's message and returns the builder.
	 * 
	 * It receives the message.
	 */
	public function message($message) {
		$this->state[EMAIL_MESSAGE] = $message;
		
		return $this;
	}
	
	/*
	 * Resets the state of the builder in order to create a new email and
	 * returns the builder.
	 */
	public function newEmail() {
		$this->state = [];
		
		return $this;
	}
	
	/*
	 * Sets the email's subject and returns the builder.
	 * 
	 * It receives the subject.
	 */
	public function subject($subject) {
		$this->state[EMAIL_SUBJECT] = $subject;
		
		return $this;
	}
	
	/*
	 * Sets the receiver's email address and returns the builder.
	 * 
	 * It receives the email address of the receiver.
	 */
	public function to($to) {
		$this->state[EMAIL_TO] = $to;
		
		return $this;
	}
	
}
