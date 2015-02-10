<?php

class SignUpTest extends Test {
	
	private $output;
	
	public function call() {
		$output = [];
		
		$output[0] = $this->postRequest('server/authentication/get-state');
		
		$output[1] = $this->postRequest('server/user/exists', [
			'credentials' => [
				'id' => '00000000000000000000000000000000',
				'password' => '10000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000'
			],
			
			'id' => 'nombre.de.usuario'
		]);
		
		$output[2] = $this->postRequest('server/user/exists', [
			'credentials' => [
				'id' => '00000000000000000000000000000000',
				'password' => '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000'
			],
			
			'id' => 'john.doe'
		]);
		
		$output[3] = $this->postRequest('server/account/sign-up', [
			'credentials' => [
				'id' => '00000000000000000000000000000000',
				'password' => '10000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000'
			],
			
			'id' => 'john.doe',
			'password' => '0passWORD',
			'firstName' => 'John',
			'lastName' => 'Doe',
			'gender' => 'm',
			'emailAddress' => 'john.doe@mailinator.com'
		]);
		
		$output[4] = $this->postRequest('server/account/sign-up', [
			'credentials' => [
				'id' => '00000000000000000000000000000000',
				'password' => '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000'
			],
			
			'id' => 'john.doe',
			'password' => '0passWORD',
			'firstName' => 'John',
			'lastName' => 'Doe',
			'gender' => 'm',
			'emailAddress' => 'john.doe@mailinator.com'
		]);
		
		$output[5] = $this->postRequest('server/authentication/get-state');
		
		$output[6] = $this->postRequest('server/account/sign-out');
		
		$output[7] = $this->postRequest('server/user/exists', [
			'credentials' => [
				'id' => '00000000000000000000000000000000',
				'password' => '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000'
			],
			
			'id' => 'john.doe'
		]);
		
		$output[8] = $this->postRequest('server/account/sign-in', [
			'credentials' => [
				'id' => 'john.doe',
				'password' => 'passWORD'
			]
		]);
		
		$output[9] = $this->postRequest('server/account/sign-in', [
			'credentials' => [
				'id' => 'john.doe',
				'password' => '0passWORD'
			]
		]);
		
		$this->output = $output;
	}
	
	public function getExpectedOutput() {
		return [
			0 => [
				'signedIn' => false
			],
			
			1 => [
				'authenticated' => false
			],
			
			2 => [
				'authenticated' => true,
				'exists' => false
			],
			
			3 => [
				'authenticated' => false
			],
			
			4 => [
				'authenticated' => true
			],
			
			5 => [
				'signedIn' => true,
				'user' => 'john.doe'
			],
			
			6 => NULL,
			
			7 => [
				'authenticated' => false
			],
			
			8 => [
				'authenticated' => false
			],
			
			9 => [
				'authenticated' => true
			]
		];
	}
	
	public function getName() {
		return 'Sign up test';
	}
	
	public function getOutput() {
		return $this->output;
	}
	
}
