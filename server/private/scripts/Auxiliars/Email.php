<?php

/*
 * TODO: comments
 */
class Email {
	
	/*
	 * TODO: comments
	 */
	private $additionalHeaders;
	
	/*
	 * TODO: comments
	 */
	private $message;
	
	/*
	 * TODO: comments
	 */
	private $subject;
	
	/*
	 * TODO: comments
	 */
	private $to;
	
	/*
	 * TODO: comments
	 */
	public function __construct($to, $subject, $message, $additionalHeaders) {
		$this->to = $to;
		$this->subject = $subject;
		$this->message = $message;
		$this->additionalHeaders = $additionalHeaders;
	}
	
	/*
	 * Sends the email.
	 */
	public function send() {
		mail($this->to, $this->subject, $this->message, $this->additionalHeaders);
	}
	
}
