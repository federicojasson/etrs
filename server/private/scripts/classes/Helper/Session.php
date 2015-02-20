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
 * This class TODO: comment
 */
class Session {
	
	/**
	 * TODO: comment
	 */
	public function __construct() {
		// TODO: clean code
		ini_set('session.hash_function', 'sha256');
		ini_set('session.hash_bits_per_character', 4);
		session_set_save_handler(new \App\Utility\SessionHandler\DatabaseSessionHandler(), false);
		
		global $app;
		$app->hook('slim.after.router', function() {
			session_write_close();
		}, HOOK_PRIORITY_SESSION);
		
		session_start();
		
		// TODO: log IP address
	}
	
	/**
	 * TODO: comment
	 */
	public function getData($key) {
		return $_SESSION[$key];
	}
	
}
