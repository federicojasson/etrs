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

namespace App\Service\Study;

/**
 * Provides functionalities shared by the /study/create and /study/edit
 * services.
 */
abstract class CreateEdit extends \App\Service\External {
	
	/**
	 * Sets a study's files.
	 * 
	 * Receives the study and the files.
	 */
	protected function setFiles($study, $files) {
		global $app;
		
		// Removes the files that have not been received
		foreach ($study->getFiles() as $file) {
			// Searches the file
			$index = searchInArray($file->getId(), $files);
			
			if ($index === false) {
				// The file has not been received
				// Removes the file
				$study->removeFile($file);
			} else {
				// The file has been received
				removeFromArray($files, $index);
			}
		}
		
		// Adds the files
		foreach ($files as $file) {
			// Gets the file
			$file = $app->data->getRepository('Entity:File')->findNonDeletedNonAssociated($file);
			
			// Asserts conditions
			$app->assertion->entityExists($file);
			
			// Adds the file
			$study->addFile($file);
		}
	}

}
