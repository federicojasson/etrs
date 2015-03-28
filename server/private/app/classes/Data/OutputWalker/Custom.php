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

namespace App\Data\OutputWalker;

/**
 * Responsible for generating SQL statements from DQL ASTs.
 */
class Custom extends \Doctrine\ORM\Query\SqlWalker {

	/**
	 * Returns the SQL corresponding to a certain delete statement.
	 * 
	 * Receives the delete statement.
	 */
	public function walkDeleteStatement(\Doctrine\ORM\Query\AST\DeleteStatement $deleteStatement) {
		// Invokes the homonym method in the parent
		$sql = parent::walkDeleteStatement($deleteStatement);
		
		// Gets the query
		$query = $this->getQuery();
		
		// Gets the limit
		$limit = $query->getMaxResults();

		if (! is_null($limit)) {
			// Gets the platform
			$platform = $this->getConnection()->getDatabasePlatform();
			
			// Adds the limit clause
			$sql = $platform->modifyLimitQuery($sql, $limit, null);
		}
		
		return $sql;
	}
	
	/**
	 * Returns the SQL fragment corresponding to a certain select clause.
	 * 
	 * Receives the select clause.
	 */
	public function walkSelectClause($selectClause) {
		// Invokes the homonym method in the parent
		$sql = parent::walkSelectClause($selectClause);
		
		// Gets the query
		$query = $this->getQuery();
		
		if ($query->getHint('hint.sqlCalcFoundRows') === true) {
			// Appends the SQL_CALC_FOUND_ROWS modifier to the SELECT statement
			$sql = str_replace('SELECT', 'SELECT SQL_CALC_FOUND_ROWS', $sql);
		}
		
		return $sql;
	}

}
