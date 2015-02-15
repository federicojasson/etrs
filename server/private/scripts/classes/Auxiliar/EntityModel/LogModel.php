<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage logs.
 */
class LogModel extends EntityModel {
	
	/*
	 * Creates a log.
	 * 
	 * It receives the log's data.
	 */
	public function create($id, $level, $message) {
		$app = $this->app;
		
		// Creates the log
		$app->webServerDatabase->createLog($id, $level, $message);
	}
	
	/*
	 * Deletes the old logs.
	 * 
	 * It receives the maximum age of a log (in months).
	 */
	public function deleteOld($maximumAge) {
		$app = $this->app;
		
		// Deletes the old logs
		$app->webServerDatabase->deleteOldLogs($maximumAge);
	}
	
	/*
	 * Filters a log for presentation and returns the result.
	 * 
	 * It receives the log.
	 */
	public function filter($log) {
		$app = $this->app;
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields(ENTITY_MODEL_LOG);
		
		// Filters the log's fields
		$newLog = filterArray($log, $accessibleFields);
		
		// Applies conversions
		
		if (isset($newLog['id'])) {
			$newLog['id'] = bin2hex($log['id']);
		}
		
		return $newLog;
	}
	
	/*
	 * Returns a log. If it doesn't exist, null is returned.
	 * 
	 * It receives the log's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the log
		return $app->webServerDatabase->getLog($id);
	}
	
	/*
	 * Searches logs. It returns an array containing the total number of results
	 * and the results found in the page, ready for presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all logs
			$logs = $app->webServerDatabase->searchAllLogs($page, $sorting);
		} else {
			// Searches specific logs
			$logs = $app->webServerDatabase->searchSpecificLogs($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->webServerDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$logs = arrayIdsToHexadecimal($logs);
		
		// Gets the IDs
		$ids = array_column($logs, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
