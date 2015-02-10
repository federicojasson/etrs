<?php

class EditUserTest extends Test {
	
	private $output;
	
	public function call() {
		$output = [];
		
		$output[0] = $this->postRequest('server/account/edit', [
			'credentials' => [
				'id' => 'john.doe',
				'password' => '0passWORD'
			],
			
			'password' => '1passWORD',
			'firstName' => 'Johnny',
			'lastName' => 'Doe',
			'gender' => 'm',
			'emailAddress' => 'johnny.doe@mailinator.com'
		]);
		
		$output[1] = $this->postRequest('server/account/sign-out');
		
		$output[2] = $this->postRequest('server/account/sign-in', [
			'credentials' => [
				'id' => 'john.doe',
				'password' => '1passWORD'
			]
		]);
		
		$output[3] = $this->postRequest('server/account/get');
		
		$output[4] = $this->postRequest('server/user/get', [
			'id' => 'john.doe'
		]);
		
		$this->output = $output;
	}
	
	public function getExpectedOutput() {
		return [
			0 => [
				'authenticated' => true
			],
			
			1 => NULL,
			
			2 => [
				'authenticated' => true
			],
			
			3 => [
				
			],
			
			4 => [
			],
		];
	}
	
	public function getName() {
		return 'Edit user test';
	}
	
	public function getOutput() {
		return $this->output;
	}
	
}
