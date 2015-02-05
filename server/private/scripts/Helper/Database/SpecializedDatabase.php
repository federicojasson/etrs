<?php

namespace App\Helper\Database;

/*
 * This helper represents a database and offers specialized operations to
 * communicate with it.
 */
abstract class SpecializedDatabase extends Database {
	
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
	 * It receives the entity's table and ID.
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
	 * It receives the entity's table and ID.
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
		$selectClause = $this->getSelectClause($columnsToSelect);
		
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
	 * Searches all entities of a certain type and returns the results.
	 * 
	 * It receives the entities' table, the columns to select, the page and a
	 * sorting.
	 */
	protected function searchAllEntities($table, $columnsToSelect, $page, $sorting) {
		// Gets the SELECT clause
		$selectClause = $this->getSelectClause($columnsToSelect);
		
		// Gets the ORDER BY clause
		$orderByClause = $this->getOrderByClause($sorting);
		
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS ' . $selectClause . '
			FROM ' . $table . '
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Gets the limit and the offset
		list($limit, $offset) = $this->getLimitAndOffset($page);
		
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
	 * Searches specific entities of a certain type and returns the results.
	 * 
	 * It receives entities' table, the columns to select, the columns to match
	 * against, an expression, the page and a sorting.
	 */
	protected function searchSpecificEntities($table, $columnsToSelect, $columnsToMatch, $expression, $page, $sorting) {
		// Gets the SELECT clause
		$selectClause = $this->getSelectClause($columnsToSelect);
		
		// Gets the MATCH clause
		$matchClause = $this->getMatchClause($columnsToMatch);
		
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
		
		// Gets the limit and the offset
		list($limit, $offset) = $this->getLimitAndOffset($page);
		
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
	 * Returns a boolean expression from a natural one. The returned boolean
	 * expression is a sanitized version with wildcards.
	 * 
	 * It receives the expression.
	 */
	private function getBooleanExpression($expression) {
		// Sanitizes the expression
		$expression = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $expression);
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
			// Adds a wildcard at the end of the word
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
	 * Given a page, it returns the limit of rows that should be returned and
	 * the corresponding offset.
	 * 
	 * It receives the page.
	 */
	private function getLimitAndOffset($page) {
		// Calculates the limit and the offset, in function of the page
		$limit = SEARCH_RESULTS_PER_PAGE;
		$offset = $limit * ($page - 1);
		
		return [
			$limit,
			$offset
		];
	}
	
	/*
	 * Returns a MATCH clause from a set of columns.
	 * 
	 * It receives the columns.
	 */
	private function getMatchClause($columns) {
		return $this->getColumnList($columns);
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

		// Builds the clause
		$clause = '';
		$clause .= camelCaseToSnakeCase($field);
		$clause .= ' ';
		$clause .= ($order === SORTING_ORDER_ASCENDING)? 'ASC' : 'DESC';

		return $clause;
	}
	
	/*
	 * Returns a SELECT clause from a set of columns.
	 * 
	 * It receives the columns.
	 */
	private function getSelectClause($columns) {
		// Appends aliases to the columns
		foreach ($columns as &$column) {
			$alias = snakeCaseToCamelCase($column);
			$column = $column . ' AS ' . $alias;
		}
		
		// Gets and returns a comma-separated list of the columns
		return $this->getColumnList($columns);
	}
	
}
