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

namespace App\Middleware;

/**
 * TODO: comment
 */
class Database extends \Slim\Middleware {
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		// TODO: comment
		$this->doSomething();

		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * TODO: comment
	 */
	private function doSomething() { // TODO: rename
		global $app;
		
		// TODO: it would be good to postpone the initialization to after
		// route match (dispatch?) to avoid unnecessary connections
		
		// TODO: clean code: use operation mode
		$applicationMode = 'development';
		if ($applicationMode == 'development') {
			$cache = new \Doctrine\Common\Cache\ArrayCache;
		} else {
			$cache = new \Doctrine\Common\Cache\ApcCache;
		}

		$config = new \Doctrine\ORM\Configuration;
		$config->setMetadataCacheImpl($cache);
		$driverImpl = $config->newDefaultAnnotationDriver(DIRECTORY_SCRIPTS . '/classes/Database/Entity');
		$config->setMetadataDriverImpl($driverImpl);
		$config->setQueryCacheImpl($cache);
		$config->setProxyDir(DIRECTORY_SCRIPTS . '/classes/Database/Proxy');
		$config->setProxyNamespace('App\Database\Proxy');

		if ($applicationMode == 'development') {
			$config->setAutoGenerateProxyClasses(true);
		} else {
			$config->setAutoGenerateProxyClasses(false);
		}

		$connectionOptions = array(
			'driver' => 'pdo_mysql',
			'user' => 'etrs_admin',
			'password' => 'password',
			'host' => 'localhost',
			'port' => '3306',
			'dbname' => 'etrs',
			'charset' => 'utf8'
		);

		$entityManager = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);
		$connection = $entityManager->getConnection();
		$connection->setTransactionIsolation(\Doctrine\DBAL\Connection::TRANSACTION_SERIALIZABLE);
		
		// Sets the entity manager
		$app->database->setEntityManager($entityManager);
		
		// TODO: order
		$app->hook('slim.after.router', function() {
			global $app;
			
			// Commits the changes in the database
			$app->database->flush();
		});
	}
	
}
