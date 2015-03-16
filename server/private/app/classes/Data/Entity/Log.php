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

namespace App\Data\Entity;

/**
 * Represents a log from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name = "logs")
 * @HasLifecycleCallbacks
 */
class Log {
	
	/**
	 * The ID.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * @GeneratedValue(strategy = "CUSTOM")
	 * @CustomIdGenerator(class = "App\Data\IdGenerator\Random")
	 * 
	 * @Column(
	 *		name = "id",
	 *		type = "binary_data",
	 *		length = 16,
	 *		nullable = false,
	 *		
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $id;
	
	// TODO
}
