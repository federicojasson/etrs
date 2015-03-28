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
		// Gets the entity manager
		$this->entityManager = $this->getEntityManager();
		
		// Adds custom types
		\Doctrine\DBAL\Types\Type::addType('binary_data', 'App\Data\Type\BinaryData');
		\Doctrine\DBAL\Types\Type::addType('utc_datetime', 'App\Data\Type\UtcDateTime');
	}
	
	/**
	 * Invokes a method in the entity manager if it is still open.
	 * 
	 * Receives the method and, optionally, the arguments.
	 */
	public function __call($method, $arguments = []) {
		if (! $this->entityManager->isOpen()) {
			// The entity manager is closed
			return null;
		}
		
		// Invokes the method in the entity manager
		return call_user_func_array([ $this->entityManager, $method ], $arguments);
	}
	
	/**
	 * Returns the total number of rows found in the last executed query.
	 */
	public function getFoundRows() {
		// Prepares and executes a statement
		$statement = $this->__call('getConnection')->prepare('SELECT FOUND_ROWS() AS foundRows');
		$statement->execute();
		
		// Fetches the results
		return $statement->fetch()['foundRows'];
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
	 * Receives a closure to be executed.
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
		
		if ($app->getMode() === OPERATION_MODE_DEVELOPMENT) {
			// The system is under development
			
			// Initializes the cache
			$cache = new \Doctrine\Common\Cache\ArrayCache();
			
			// Initializes the proxy-generation mode
			$proxyGenerationMode = \Doctrine\Common\Proxy\AbstractProxyFactory::AUTOGENERATE_ALWAYS;
		} else {
			// The system is not under development
			
			// Initializes the cache
			$cache = new \Doctrine\Common\Cache\ApcCache();
			
			// Initializes the proxy-generation mode
			$proxyGenerationMode = \Doctrine\Common\Proxy\AbstractProxyFactory::AUTOGENERATE_NEVER;
		}
		
		// Initializes the configuration
		$configuration = new \Doctrine\ORM\Configuration();
		
		// Applies entity-related settings
		$configuration->addEntityNamespace('Entity', 'App\Data\Entity');
		
		// Applies metadata-related settings
		$directory = DIRECTORY_APP . '/classes/Data/Entity';
		$metadataDriver = $configuration->newDefaultAnnotationDriver($directory);
		$configuration->setMetadataCacheImpl($cache);
		$configuration->setMetadataDriverImpl($metadataDriver);
		
		// Applies proxy-related settings
		$directory = DIRECTORY_APP . '/classes/Data/Proxy';
		$configuration->setAutoGenerateProxyClasses($proxyGenerationMode);
		$configuration->setProxyDir($directory);
		$configuration->setProxyNamespace('App\Data\Proxy');
		
		// Applies query-related settings
		$configuration->setQueryCacheImpl($cache);
		
		// Adds custom functions
		$configuration->addCustomDatetimeFunction('DATEADD', 'DoctrineExtensions\Query\Mysql\DateAdd');
		$configuration->addCustomNumericFunction('MATCH', 'DoctrineExtensions\Query\Mysql\MatchAgainst');
		
		return $configuration;
	}
	
	/**
	 * Returns the connection.
	 */
	private function getConnection() {
		global $app;
		
		// Gets the DBMS parameters
		$dbms = $app->parameters->dbms;
		
		return [
			'host' => $dbms['host'],
			'port' => $dbms['port'],
			'dbname' => $dbms['database'],
			'charset' => $dbms['charset'],
			'user' => $dbms['username'],
			'password' => $dbms['password'],
			'driver' => 'pdo_mysql'
		];
	}
	
	/**
	 * Returns the entity manager.
	 */
	private function getEntityManager() {
		// Gets the connection
		$connection = $this->getConnection();
		
		// Gets the configuration
		$configuration = $this->getConfiguration();
		
		// Initializes the entity manager
		$entityManager = \Doctrine\ORM\EntityManager::create($connection, $configuration);
		
		// Sets the transaction-isolation level
		$entityManager->getConnection()->setTransactionIsolation(\Doctrine\DBAL\Connection::TRANSACTION_SERIALIZABLE);
		
		return $entityManager;
	}
	
}
