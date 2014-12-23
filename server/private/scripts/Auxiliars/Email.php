<?php

/*
 * This class represents an email.
 */
class Email {
	
	/*
	 * The additional headers.
	 */
	private $additionalHeaders;
	
	/*
	 * The message.
	 */
	private $message;
	
	/*
	 * The subject.
	 */
	private $subject;
	
	/*
	 * The receiver's email address.
	 */
	private $to;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the receiver's email address, the subject, the message and
	 * additional headers. The latter can be used to add extra parameters (e.g.
	 * From, Cc or Bcc). Multiple extra headers should be separated with a CRLF
	 * (\r\n).
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
