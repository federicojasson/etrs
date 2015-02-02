<?php

namespace App\Helpers;

/*
 * This helper represents a specialized database and offers convenient
 * operations to communicate with it.
 * 
 * Subclasses must implement the necessary queries.
 */
abstract class SpecializedDatabase extends \App\Helpers\Database {
	
	/*
	 * Returns the number of rows found in the last query.
	 */
	public function getFoundRows() {
		// Defines the statement
		$statement = 'SELECT FOUND_ROWS() AS foundRows';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		// Returns the result
		return $results[0]['foundRows'];
	}
	
	/*
	 * Deletes an entity.
	 * 
	 * It receives the entity's table and its ID.
	 */
	protected function deleteEntity($table, $id) {
		// Defines the statement
		$statement = '
			DELETE
			FROM ' . $table . '
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Determines whether an entity exists.
	 * 
	 * It receives the entity's table and its ID.
	 */
	protected function entityExists($table, $id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM ' . $table . '
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Returns an entity. If it doesn't exist, null is returned.
	 * 
	 * It receives the entity's table, the columns to select and its ID.
	 */
	protected function getEntity($table, $columnsToSelect, $id) {
		// Gets the SELECT clause
		$selectClause = $this->getColumnList($columnsToSelect);
		
		// Defines the statement
		$statement = '
			SELECT ' . $selectClause . '
			FROM ' . $table . '
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Performs a search that includes all entities of a certain type and
	 * returns the results.
	 * 
	 * It receives the entities' table, the columns to select, a sorting, the
	 * limit of rows to return and an offset.
	 */
	protected function searchAllEntities($table, $columnsToSelect, $sorting, $limit, $offset) {
		// Gets the SELECT clause
		$selectClause = $this->getColumnList($columnsToSelect);
		
		// Gets the ORDER BY clause
		$orderByClause = $this->getOrderByClause($sorting);
		
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS ' . $selectClause . '
			FROM ' . $table . '
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Performs a search that includes specific entities of a certain type and
	 * returns the results.
	 * 
	 * It receives entities' table, the columns to select, the columns to match
	 * against, a sorting, an expression, the limit of rows to return and an
	 * offset.
	 */
	protected function searchSpecificEntities($table, $columnsToSelect, $columnsToMatch, $sorting, $expression, $limit, $offset) {
		// Gets the SELECT clause
		$selectClause = $this->getColumnList($columnsToSelect);
		
		// Gets the MATCH clause
		$matchClause = $this->getColumnList($columnsToMatch);
		
		// Gets the ORDER BY clause
		$orderByClause = $this->getOrderByClause($sorting);
		
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS ' . $selectClause . '
			FROM ' . $table . '
			WHERE
				MATCH(' . $matchClause . ')
				AGAINST(:booleanExpression IN BOOLEAN MODE)
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Gets a boolean expression
		$booleanExpression = $this->getBooleanExpression($expression);
		
		// Sets the parameters
		$parameters = [
			':booleanExpression' => $booleanExpression,
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Returns a boolean expression from a natural one.
	 * 
	 * The returned boolean expression is a sanitized version with wildcards.
	 * 
	 * It receives the expression.
	 */
	private function getBooleanExpression($expression) {
		// Sanitizes the expression
		$expression = iconv(CHARACTER_ENCODING_UTF8, 'ASCII//TRANSLIT//IGNORE', $expression);
		$expression = preg_replace('/[^ 0-9A-Za-z]/', '', $expression);
		$expression = trimString($expression);

		if (isStringEmpty($expression)) {
			// The expression is an empty string
			return '';
		}

		// Gets the words of the expression
		$expressionWords = explode(' ', $expression);

		// Computes the words of the boolean expression
		$booleanExpressionWords = [];
		foreach ($expressionWords as $expressionWord) {
			// Adds a wildcard to the end of the word
			$booleanExpressionWords[] = $expressionWord . '*';
		}

		// Builds the boolean expression gluing the computed words
		$booleanExpression = implode(' ', $booleanExpressionWords);

		return $booleanExpression;
	}
	
	/*
	 * Returns a comma-separated list of columns.
	 * 
	 * It receives the columns.
	 */
	private function getColumnList($columns) {
		return implode(', ', $columns);
	}

	/*
	 * Returns an ORDER BY clause from a sorting.
	 * 
	 * It receives the sorting.
	 */
	private function getOrderByClause($sorting) {
		// Gets the sorting's field and order
		$field = $sorting['field'];
		$order = $sorting['order'];

		// Initializes the clause
		$clause = '';

		// Appends the field and the order in which the results should be sorted
		$clause .= camelCaseToSnakeCase($field);
		$clause .= ' ';
		$clause .= ($order === SORTING_ORDER_ASCENDING)? 'ASC' : 'DESC';

		return $clause;
	}
	
}
