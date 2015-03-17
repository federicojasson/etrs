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
 * Provides data-related functionalities.
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
	 * Receives the method and the arguments.
	 */
	public function __call($method, $arguments) {
		if (! $this->entityManager->isOpen()) {
			// The entity manager is closed
			return null;
		}
		
		// Invokes the method in the entity manager
		return call_user_func_array([ $this->entityManager, $method ], $arguments);
	}
	
	/**
	 * Runs a command.
	 * 
	 * Receives the command and the input and output settings.
	 */
	public function runCommand($command, $inputSettings, $outputSettings) {
		// Initializes the helper set
		$helperSet = \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($this->entityManager);
		
		// Sets the helper set
		$command->setHelperSet($helperSet);
		
		// Runs the command
		$command->run($inputSettings, $outputSettings);
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
	 * Returns the configuration.
	 */
	private function getConfiguration() {
		global $app;
		
		// Defines the necessary directories
		$entityDirectory = DIRECTORY_APP . '/classes/Data/Entity';
		$proxyDirectory = DIRECTORY_APP . '/classes/Data/Proxy';
		
		// Initializes the configuration
		$configuration = new \Doctrine\ORM\Configuration();
		
		// Initializes the metadata driver
		$metadataDriver = $configuration->newDefaultAnnotationDriver($entityDirectory);
		
		if ($app->getMode() === OPERATION_MODE_DEVELOPMENT) {
			// The system is under development
			
			// Initializes the proxy-generation mode
			$proxyGenerationMode = \Doctrine\Common\Proxy\AbstractProxyFactory::AUTOGENERATE_ALWAYS;
			
			// Initializes the cache
			$cache = new \Doctrine\Common\Cache\ArrayCache();
		} else {
			// The system is not under development
			
			// Initializes the proxy-generation mode
			$proxyGenerationMode = \Doctrine\Common\Proxy\AbstractProxyFactory::AUTOGENERATE_NEVER;
			
			// Initializes the cache
			$cache = new \Doctrine\Common\Cache\ApcCache();
		}
		
		// Applies different settings
		$configuration->setAutoGenerateProxyClasses($proxyGenerationMode);
		$configuration->setMetadataCacheImpl($cache);
		$configuration->setMetadataDriverImpl($metadataDriver);
		$configuration->setProxyDir($proxyDirectory);
		$configuration->setProxyNamespace('App\Data\Proxy');
		$configuration->setQueryCacheImpl($cache);
		
		return $configuration;
	}
	
	/**
	 * Returns the entity manager.
	 */
	private function getEntityManager() {
		global $app;
		
		// Gets the DBMS parameters
		$dbms = $app->parameters->dbms;
		
		// Builds the connection
		$connection = [
			'driver' => 'pdo_mysql',
			'host' => $dbms['host'],
			'port' => $dbms['port'],
			'dbname' => $dbms['database'],
			'charset' => $dbms['charset'],
			'user' => $dbms['username'],
			'password' => $dbms['password']
		];
		
		// Gets the configuration
		$configuration = $this->getConfiguration();
		
		// Initializes the entity manager
		$entityManager = \Doctrine\ORM\EntityManager::create($connection, $configuration);
		
		// Sets the transaction-isolation level
		$entityManager->getConnection()->setTransactionIsolation(\Doctrine\DBAL\Connection::TRANSACTION_SERIALIZABLE);
		
		return $entityManager;
	}
	
}
