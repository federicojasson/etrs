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

namespace App\Service\Medication;

/**
 * TODO: comment
 */
class Create extends \App\Service\Service {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		// TODO: implement
		
		$applicationMode = 'development';
		if ($applicationMode == 'development') {
			$cache = new \Doctrine\Common\Cache\ArrayCache;
		} else {
			$cache = new \Doctrine\Common\Cache\ApcCache;
		}

		$config = new \Doctrine\ORM\Configuration;
		$config->setMetadataCacheImpl($cache);
		$driverImpl = $config->newDefaultAnnotationDriver(DIRECTORY_SCRIPTS . '/classes/Data/Entity');
		$config->setMetadataDriverImpl($driverImpl);
		$config->setQueryCacheImpl($cache);
		$config->setProxyDir(DIRECTORY_SCRIPTS . '/classes/Data/Proxy');
		$config->setProxyNamespace('App\Data\Proxy');
		// TODO: set isolation level
		//$namingStrategy = new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy();
		//$config->setNamingStrategy($namingStrategy);

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

		$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

		$id;
		
		$em->transactional(function($em) use (&$id) {
			$user = new \App\Data\Entity\User();
			$user->setId('usuario');
			$user->setEmailAddress('user@user.com');
			$user->setFirstName('Nombre');
			$user->setLastName('Apellido');
			$user->setGender('m');
			$user->setKeyStretchingIterations(64000);
			$user->setPasswordHash('0');
			$user->setSalt('0');
			$user->setRole('ad');

			$medication = new \App\Data\Entity\Medication();
			$medication->setCreator($user);
			$medication->setLastEditor($user);
			$medication->setName('Medicacion');

			$em->persist($medication);
			$em->persist($user);
			
			$id = $medication->getId();
		});
		
		$em->transactional(function($em) use ($id) {
			$medication = $em->getRepository('\App\Data\Entity\Medication')->find($id);
			$medication->setName('Nombre cambiado');
		});
	}
	
	/**
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// TODO: implement
		return true;
	}
	
	/**
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		// TODO: implement
		return true;
	}
	
}
