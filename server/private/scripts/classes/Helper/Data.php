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
	 * TODO: comment
	 */
	private $entityManager;
	
	/**
	 * Creates an instance of the class.
	 */
	public function __construct() {
		// TODO: clean code
		$this->entityManager = $this->initialize();
	}
	
	/**
	 * TODO: comment
	 */
	public function __call($name, $arguments) {
		if (! $this->entityManager->isOpen()) {
			return;
		}
		
		// TODO: order and comment
		return call_user_func_array([ $this->entityManager, $name ], $arguments);
	}
	
	/**
	 * TODO: comment
	 */
	public function transactional($closure) {
		// TODO: order and comment
		$return = null;
		
		$this->__call('transactional', [ function($entityManager) use ($closure, &$return) {
			$return = call_user_func($closure, $entityManager);
		} ]);
		
		return $return;
	}
	
	/**
	 * TODO: comment
	 */
	private function initialize() {
		global $app;
		
		// TODO: clean code: use operation mode
		$applicationMode = 'development';
		if ($applicationMode === 'development') {
			$cache = new \Doctrine\Common\Cache\ArrayCache;
		} else {
			$cache = new \Doctrine\Common\Cache\ApcCache;
		}
		
		\Doctrine\DBAL\Types\Type::addType('binary_string', 'App\Data\Type\BinaryString');
		
		$config = new \Doctrine\ORM\Configuration;
		$config->setMetadataCacheImpl($cache);
		$driverImpl = $config->newDefaultAnnotationDriver(DIRECTORY_SCRIPTS . '/classes/Data/Entity');
		$config->setMetadataDriverImpl($driverImpl);
		$config->setQueryCacheImpl($cache);
		$config->setProxyDir(DIRECTORY_SCRIPTS . '/classes/Data/Proxy');
		$config->setProxyNamespace('App\Data\Proxy');

		if ($applicationMode === 'development') {
			$config->setAutoGenerateProxyClasses(true);
		} else {
			$config->setAutoGenerateProxyClasses(false);
		}

		$parameters = $app->parameters->dbms;
		$connectionOptions = array(
			'driver' => 'pdo_mysql',
			'host' => $parameters['host'],
			'port' => $parameters['port'],
			'dbname' => $parameters['database'],
			'charset' => $parameters['charset'],
			'user' => $parameters['username'],
			'password' => $parameters['password']
		);

		$entityManager = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);
		$connection = $entityManager->getConnection();
		$connection->setTransactionIsolation(\Doctrine\DBAL\Connection::TRANSACTION_SERIALIZABLE);
		
		return $entityManager;
	}
	
}
