<?php

/*
 * TODO: comments
 */
class EmailBuilder extends Helper {
	
	/*
	 * TODO
	 */
	private $properties;
	
	/*
	 * TODO: comments
	 */
	public function build() {
		// TODO
		
		return new Email($to, $subject, $message, $additionalHeaders);
	}
	
	/*
	 * TODO: comments
	 */
	public function from($from) {
		$this->properties[EMAIL_BUILDER_FROM] = $from;
		return $this;
	}
	
	/*
	 * TODO: comments
	 */
	public function message($message) {
		$this->properties[EMAIL_BUILDER_MESSAGE] = $message;
		return $this;
	}
	
	/*
	 * TODO: comments
	 */
	public function reset() {
		$this->properties = [];
		return $this;
	}
	
	/*
	 * TODO: comments
	 */
	public function subject($subject) {
		$this->properties[EMAIL_BUILDER_SUBJECT] = $subject;
		return $this;
	}
	
	/*
	 * TODO: comments
	 */
	public function to($to) {
		$this->properties[EMAIL_BUILDER_TO] = $to;
		return $this;
	}
	
}
