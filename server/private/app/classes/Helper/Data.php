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
 * Manages the data.
 */
class Data {
	
	/**
	 * The entity manager.
	 */
	private $entityManager;
	
	/**
	 * Initializes an instance of the class.
	 */
	public function __construct() {
		// Initializes the entity manager
		$this->entityManager = $this->getEntityManager();
		
		// Adds custom types
		\Doctrine\DBAL\Types\Type::addType('binary_data', 'App\Data\Type\BinaryData');
	}
	
	/**
	 * Invokes a method in the entity manager if it is still open.
	 * 
	 * Receives the method's name and the arguments to pass to it.
	 */
	public function __call($name, $arguments) {
		if (! $this->entityManager->isOpen()) {
			// The entity manager is closed
			return null;
		}
		
		// Invokes the method in the entity manager
		return call_user_func_array([ $this->entityManager, $name ], $arguments);
	}
	
	/**
	 * Executes a transaction.
	 * 
	 * Receives a closure to execute.
	 */
	public function transactional($closure) {
		// Initializes the result
		$result = null;
		
		// Builds the transaction
		$transaction = function($entityManager) use ($closure, &$result) {
			// Executes the closure
			$result = call_user_func($closure, $entityManager);
		};
		
		// Executes the transaction
		$this->__call('transactional', [ $transaction ]);
		
		return $result;
	}
	
	/**
	 * Returns the entity manager.
	 */
	private function getEntityManager() {
		// TODO: implement
	}
	
}
