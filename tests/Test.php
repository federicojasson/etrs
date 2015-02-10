<?php

abstract class Test {
	
	private $curl;
	
	public function __construct() {
		$this->curl = curl_init();
	}
	
	public abstract function call();
	
	public function execute() {
		$this->call();
		
		$expectedOutput = $this->getExpectedOutput();
		$output = $this->getOutput();
		
		if ($expectedOutput === $output) {
			$this->onPass();
		} else {
			$this->onFail();
		}
	}
	
	public abstract function getExpectedOutput();
	
	public abstract function getName();
	
	public abstract function getOutput();
	
	public function onFail() {
		$name = $this->getName();
		$expectedOutput = $this->getExpectedOutput();
		$output = $this->getOutput();
		
		echo $name . ' failed.<br>';
		echo '<br><br>';
		echo 'Expected output:<br>';
		echo '<br>';
		print_r($expectedOutput); echo '<br>';
		echo '<br><br>';
		echo 'Output:<br>';
		echo '<br>';
		print_r($output); echo '<br>';
		echo '<br><br>';
		
		exit();
	}
	
	public function onPass() {
		$name = $this->getName();
		
		echo $name . ' passed.<br>';
	}
	
	protected function postRequest($service, $input = null) {
		$url = 'localhost/etrs/' . $service;

		curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->curl, CURLOPT_URL, $url);
		curl_setopt($this->curl, CURLOPT_POST, true);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($input));
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json' ]);
		curl_setopt($this->curl, CURLOPT_COOKIEFILE, 'cookie');
		curl_setopt($this->curl, CURLOPT_COOKIEJAR, 'cookie');
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

		return json_decode(curl_exec($this->curl), true);
	}
	
}
