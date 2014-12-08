<?php

/*
 * TODO: comments
 */
class Authentication extends Helper {
	
	/*
	 * TODO: comments
	 */
	public function getLoggedInUser() {
		// TODO: get user ID
		$userId = 'id de usuario';
		return $this->app->data->getUser($userId, ['mainData']);
	}
	
	/*
	 * TODO: comments
	 */
	public function isUserLoggedIn() {
		// TODO
	}
	
}
