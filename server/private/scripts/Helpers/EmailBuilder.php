<?php

/*
 * This helper acts as a builder of Email objects.
 * 
 * Since it's a helper (singleton), the newEmail function should be used to
 * reset its state before starting to build a new object.
 */
class EmailBuilder extends Helper {
	
	/*
	 * Keeps the state of the email being built.
	 */
	private $state;
	
	/*
	 * Builds and returns the email.
	 */
	public function build() {
		$state = $this->state;
		
		// Gets the basic information of the email
		$to = $state[EMAIL_BUILDER_TO];
		$subject = $state[EMAIL_BUILDER_SUBJECT];
		$message = $state[EMAIL_BUILDER_MESSAGE];
		
		// Initializes the additional headers
		$additionalHeaders = '';
		$additionalHeaders .= 'From: ' . $state[EMAIL_BUILDER_FROM] . CRLF;
		// TODO: test and complete with additional headers
		
		// Creates and returns an Email instance
		return new Email($to, $subject, $message, $additionalHeaders);
	}
	
	/*
	 * Sets the sender's email address and returns this builder.
	 * 
	 * It receives the email address of the sender.
	 */
	public function from($from) {
		// Saves the property in the state array
		$this->state[EMAIL_BUILDER_FROM] = $from;
		
		return $this;
	}
	
	/*
	 * Sets the email's message and returns this builder.
	 * 
	 * It receives the message.
	 */
	public function message($message) {
		// Saves the property in the state array
		$this->state[EMAIL_BUILDER_MESSAGE] = $message;
		
		return $this;
	}
	
	/*
	 * Resets the state of this builder in order to start creating a new email,
	 * and returns it.
	 */
	public function newEmail() {
		// Initializes a new array to keep the state of the email
		$this->state = [];
		
		return $this;
	}
	
	/*
	 * Sets the email's subject and returns this builder.
	 * 
	 * It receives the subject.
	 */
	public function subject($subject) {
		// Saves the property in the state array
		$this->state[EMAIL_BUILDER_SUBJECT] = $subject;
		
		return $this;
	}
	
	/*
	 * Sets the receiver's email address and returns this builder.
	 * 
	 * It receives the email address of the receiver.
	 */
	public function to($to) {
		// Saves the property in the state array
		$this->state[EMAIL_BUILDER_TO] = $to;
		
		return $this;
	}
	
}
