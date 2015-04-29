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

namespace App\Service;

/**
 * Represents an external service.
 */
abstract class External extends Service {
	
	/**
	 * Prepares and executes the service.
	 */
	public function __invoke() {
		global $app;
		
		// Initializes the input
		$input = $app->request->getBody();
		
		// Sets the input
		$this->setInput($input);
		
		// Invokes the homonym method in the parent
		parent::__invoke();
	}
	
	/**
	 * Determines whether the request is a form-data request.
	 * 
	 * If it is a form-data request and no error has occurred, the information
	 * about the file is set as the input.
	 */
	protected function isFormDataRequest() {
		global $app;
		
		// Gets the request's media type
		$mediaType = $app->request->getMediaType();
		
		if ($mediaType !== 'multipart/form-data') {
			// It is not a form-data request
			return false;
		}
		
		// Defines the name of the uploaded file's input
		$uploadedFileInputName = FILE_UPLOADED_INPUT_NAME;
		
		if (! isset($_FILES[$uploadedFileInputName])) {
			// The file has not been received
			return false;
		}
		
		// Gets the information about the file
		$file = $_FILES[$uploadedFileInputName];
		
		if ($file['error'] !== UPLOAD_ERR_OK) {
			// An error has occurred
			return false;
		}
		
		// Sets the input
		$this->setInput([
			'name' => $file['name'],
			'temporaryPath' => $file['tmp_name']
		]);
		
		return true;
	}
	
	/**
	 * Determines whether the request is a JSON request.
	 * 
	 * If it is a JSON request, the input is decoded.
	 */
	protected function isJsonRequest() {
		global $app;
		
		// Gets the request's media type
		$mediaType = $app->request->getMediaType();
		
		if ($mediaType !== 'application/json') {
			// It is not a JSON request
			return false;
		}
		
		// Decodes the input
		$input = json_decode($this->getInput(), true);
		
		// Sets the input
		$this->setInput($input);
		
		return true;
	}
	
	/**
	 * Determines whether the request is an x-www-form-urlencoded request.
	 * 
	 * If it is an x-www-form-urlencoded request, the input is decoded.
	 */
	protected function isXWwwFormUrlencodedRequest() {
		global $app;
		
		// Gets the request's media type
		$mediaType = $app->request->getMediaType();
		
		if ($mediaType !== 'application/x-www-form-urlencoded') {
			// It is not an x-www-form-urlencoded request
			return false;
		}
		
		// Decodes the input
		$input = $app->request->params();
		
		// Sets the input
		$this->setInput($input);
		
		return true;
	}
	
}
