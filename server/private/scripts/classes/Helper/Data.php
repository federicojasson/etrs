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
 * This class offers data-related functionalities.
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
		
		// Registers a custom type
		\Doctrine\DBAL\Types\Type::addType('automatic_binary', 'App\Data\Type\AutomaticBinary');
	}
	
	/**
	 * Invokes a method in the entity manager.
	 * 
	 * Receives the name of the method and the arguments to be passed to it.
	 */
	public function __call($name, $arguments) {
		if (! $this->entityManager->isOpen()) {
			// The entity manager has been closed
			return;
		}
		
		// Invokes the method in the entity manager
		return call_user_func_array([ $this->entityManager, $name ], $arguments);
	}
	
	/**
	 * Executes a command.
	 * 
	 * Receives the command and the input and output settings.
	 */
	public function executeCommand($command, $inputSettings, $outputSettings) {
		// Initializes the helper set
		$helperSet = \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($this->entityManager);
		
		// Sets the helper set
		$command->setHelperSet($helperSet);
		
		// Executes the command
		$command->run($inputSettings, $outputSettings);
	}
	
	/**
	 * Executes a transaction.
	 * 
	 * Receives a closure to be executed transactionally.
	 */
	public function transactional($closure) {
		// Initializes the result
		$result = null;
		
		// Initializes the transaction
		$transaction = function($entityManager) use ($closure, &$result) {
			// Invokes the closure
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
		$entityDirectory = DIRECTORY_SCRIPTS . '/classes/Data/Entity';
		$proxyDirectory = DIRECTORY_SCRIPTS . '/classes/Data/Proxy';
		
		// Initializes the configuration
		$configuration = new \Doctrine\ORM\Configuration();
		
		// Initializes the metadata driver
		$metadataDriver = $configuration->newDefaultAnnotationDriver($entityDirectory);
		
		// Applies different settings according to the operation mode
		if ($app->getMode() === OPERATION_MODE_DEVELOPMENT) {
			// The system is in development
			
			// Defines the proxy-generation mode
			$proxyGenerationMode = \Doctrine\Common\Proxy\AbstractProxyFactory::AUTOGENERATE_ALWAYS;
			
			// Initializes the cache
			$cache = new \Doctrine\Common\Cache\ArrayCache();
		} else {
			// The system is not in development
			
			// Defines the proxy-generation mode
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
		
		// Defines the connection parameters
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
		
		// Sets the transaction isolation level
		$entityManager->getConnection()->setTransactionIsolation(\Doctrine\DBAL\Connection::TRANSACTION_SERIALIZABLE);
		
		return $entityManager;
	}
	
}
