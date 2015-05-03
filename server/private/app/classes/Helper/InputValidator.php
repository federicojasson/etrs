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
 * Provides input-validation methods.
 */
class InputValidator {
	
	/**
	 * Determines whether a set of sorting criteria are valid.
	 * 
	 * Receives the sorting criteria.
	 */
	public function areSortingCriteriaValid($sortingCriteria) {
		// Gets the fields
		$fields = array_column($sortingCriteria, 'field');
		
		// Determines whether the fields are unique
		return ! containsDuplicates($fields);
	}
	
	/**
	 * Determines whether a set of test results is valid.
	 * 
	 * Receives the test results and the type of the test entity.
	 */
	public function areTestResultsValid($testResults, $type) {
		global $app;
		
		// Gets the test field
		$testField = pascalToCamelCase($type);
		
		// Gets the tests
		$tests = array_column($testResults, $testField);
		
		if (containsDuplicates($tests)) {
			// The tests are not unique
			return false;
		}
		
		// Validates the values
		foreach ($testResults as $testResult) {
			$test = hex2bin($testResult[$testField]);
			$value = $testResult['value'];
			
			// Gets the test
			$test = $app->data->getRepository('Entity:' . $type)->findNonDeleted($test);
			
			// Asserts conditions
			$app->assertion->entityExists($test);
			
			// Creates a data-type input validator
			$dataTypeInputValidator = \App\InputValidator\DataType\Factory::create($test->getDataTypeDefinition());
			
			if (! $dataTypeInputValidator->isInputValid($value)) {
				// The value is invalid
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Determines whether an input is a command line.
	 * 
	 * Receives the input.
	 */
	public function isCommandLine($input) {
		if (! $this->isValidLine($input, 0, 512)) {
			// The input is not a valid line
			return false;
		}
		
		// Determines whether the input contains the "input" placeholder
		return strpos($input, ':input') !== false;
	}
	
	/**
	 * Determines whether an input is a data-type definition.
	 * 
	 * Receives the input.
	 */
	public function isDataTypeDefinition($input) {
		if (! $this->isValidLine($input, 0, 1024)) {
			// The input is not a valid line
			return false;
		}
		
		try {
			// Creates a data-type input validator
			\App\InputValidator\DataType\Factory::create($input);
			
			return true;
		} catch (\App\InputValidator\DataType\InvalidDefinitionException $exception) {
			// The definition is invalid
			return false;
		}
	}
	
	/**
	 * Determines whether an input is a date.
	 * 
	 * Receives the input.
	 */
	public function isDate($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		$matches = [];
		if (! preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $input, $matches)) {
			// The input doesn't match the regular expression
			return false;
		}
		
		// Gets the year, the month and the day
		$year = $matches[1];
		$month = $matches[2];
		$day = $matches[3];
		
		// Determines whether the date is valid according to the calendar
		return checkdate($month, $day, $year);
	}
	
	/**
	 * Determines whether an input is an email address.
	 * 
	 * Receives the input.
	 */
	public function isEmailAddress($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Determines whether the input matches a regular expression
		return preg_match('/(?!.*[\x{0000}-\x{001f}])(?!.* )(?!.*@.*@)(?=.{0,254}$)^.+@.+$/', $input);
	}
	
	/**
	 * Determines whether an input is a file name.
	 * 
	 * Receives the input.
	 */
	public function isFileName($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		if (preg_match('/[\x{0000}-\x{001f}]/', $input)) {
			// The input contains control characters
			return false;
		}
		
		if (preg_match('/["*\/:<>?\\\|]/', $input)) {
			// The input contains forbidden characters
			return false;
		}
		
		// Trims the input
		$input = trim($input);
		
		// Gets the input's length
		$length = getStringLength($input);
		
		// Determines whether the length is in the specified range
		return inRange($length, 1, 128);
	}
	
	/**
	 * Determines whether an input is a gender.
	 * 
	 * Receives the input.
	 */
	public function isGender($input) {
		return inArray($input, [
			GENDER_FEMALE,
			GENDER_MALE
		]);
	}
	
	/**
	 * Determines whether an input is valid.
	 * 
	 * Receives the input and an input validator.
	 */
	public function isInputValid($input, $inputValidator) {
		if (is_null($input)) {
			// The input could not be decoded
			return false;
		}
		
		// Validates the input
		return $inputValidator->isInputValid($input);
	}
	
	/**
	 * Determines whether an input is a password.
	 * 
	 * Receives the input.
	 */
	public function isPassword($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Determines whether the input matches a regular expression
		return preg_match('/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])^.{8,}$/', $input);
	}
	
	/**
	 * Determines whether an input is a random ID.
	 * 
	 * Receives the input.
	 */
	public function isRandomId($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Determines whether the input matches a regular expression
		return preg_match('/^[0-9A-Fa-f]{' . 2 * RANDOM_ID_LENGTH . '}$/', $input);
	}
	
	/**
	 * Determines whether an input is a random password.
	 * 
	 * Receives the input.
	 */
	public function isRandomPassword($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Determines whether the input matches a regular expression
		return preg_match('/^[0-9A-Fa-f]{' . 2 * RANDOM_PASSWORD_LENGTH . '}$/', $input);
	}
	
	/**
	 * Determines whether a search offset is valid.
	 * 
	 * Receives the page and the results per page.
	 */
	public function isSearchOffsetValid($page, $resultsPerPage) {
		// Calculates the offset
		$offset = calculateSearchOffset($page, $resultsPerPage);
		
		// Determines whether the offset is a valid integer
		return $this->isValidInteger($offset, 0);
	}
	
	/**
	 * Determines whether an input is a sorting direction.
	 * 
	 * Receives the input.
	 */
	public function isSortingDirection($input) {
		return inArray($input, [
			SORTING_DIRECTION_ASCENDING,
			SORTING_DIRECTION_DESCENDING
		]);
	}
	
	/**
	 * Determines whether an input is a user ID.
	 * 
	 * Receives the input.
	 */
	public function isUserId($input) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Determines whether the input matches a regular expression
		return preg_match('/(?!.*\.{2})(?!\.)(?!.*\.$)^[.0-9A-Za-z]{3,32}$/', $input);
	}
	
	/**
	 * Determines whether an input is a user role.
	 * 
	 * Receives the input.
	 */
	public function isUserRole($input) {
		return inArray($input, [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		]);
	}
	
	/**
	 * Determines whether an input is a valid integer.
	 * 
	 * Receives the input, the minimum value allowed and, optionally, the
	 * maximum.
	 */
	public function isValidInteger($input, $minimumValue, $maximumValue = null) {
		if (! is_integer($input)) {
			// The input is not an integer
			return false;
		}
		
		// Determines whether the input is in the specified range
		return inRange($input, $minimumValue, $maximumValue);
	}
	
	/**
	 * Determines whether an input is a valid line.
	 * 
	 * An input is considered a valid line if it doesn't contain control
	 * characters and is a valid string after trimming it and shrinking it.
	 * 
	 * Receives the input, the minimum length allowed and, optionally, the
	 * maximum.
	 */
	public function isValidLine($input, $minimumLength, $maximumLength = null) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		if (preg_match('/[\x{0000}-\x{001f}]/', $input)) {
			// The input contains control characters
			return false;
		}
		
		// Trims and shrinks the input
		$input = trimAndShrink($input);
		
		// Gets the input's length
		$length = getStringLength($input);
		
		// Determines whether the length is in the specified range
		return inRange($length, $minimumLength, $maximumLength);
	}
	
	/**
	 * Determines whether an input is a valid string.
	 * 
	 * Receives the input, the minimum length allowed and, optionally, the
	 * maximum.
	 */
	public function isValidString($input, $minimumLength, $maximumLength = null) {
		if (! is_string($input)) {
			// The input is not a string
			return false;
		}
		
		// Gets the input's length
		$length = getStringLength($input);
		
		// Determines whether the length is in the specified range
		return inRange($length, $minimumLength, $maximumLength);
	}
	
}
