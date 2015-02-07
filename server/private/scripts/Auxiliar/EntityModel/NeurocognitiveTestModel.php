<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage neurocognitive tests.
 */
class NeurocognitiveTestModel extends EntityModel {
	
	/*
	 * Creates a neurocognitive test.
	 * 
	 * It receives the neurocognitive test's data.
	 */
	public function create($id, $creator, $name, $dataTypeDescriptor) {
		$app = $this->app;
		
		// Creates the neurocognitive test
		$app->businessLogicDatabase->createNeurocognitiveTest($id, $creator, $name, $dataTypeDescriptor);
	}
	
	/*
	 * Deletes a neurocognitive test.
	 * 
	 * It receives the neurocognitive test's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the neurocognitive test
		$app->businessLogicDatabase->deleteNeurocognitiveTest($id);
	}
	
	/*
	 * Edits a neurocognitive test.
	 * 
	 * It receives the neurocognitive test's data.
	 */
	public function edit($id, $lastEditor, $name, $dataTypeDescriptor) {
		$app = $this->app;
		
		// Edits the neurocognitive test
		$app->businessLogicDatabase->editNeurocognitiveTest($id, $lastEditor, $name, $dataTypeDescriptor);
	}
	
	/*
	 * Determines whether a neurocognitive test exists.
	 * 
	 * It receives the neurocognitive test's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the neurocognitive test exists
		return $app->businessLogicDatabase->nonDeletedNeurocognitiveTestExists($id);
	}
	
	/*
	 * Filters a neurocognitive test for presentation and returns the result.
	 * 
	 * It receives the neurocognitive test.
	 */
	public function filter($neurocognitiveTest) {
		// TODO: implement
		return $neurocognitiveTest;
	}
	
	/*
	 * Returns a neurocognitive test. If it doesn't exist, null is returned.
	 * 
	 * It receives the neurocognitive test's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the neurocognitive test
		return $app->businessLogicDatabase->getNonDeletedNeurocognitiveTest($id);
	}
	
	/*
	 * Searches neurocognitive tests. It returns an array containing the total
	 * number of results and the results found in the page, ready for
	 * presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all neurocognitive tests
			$neurocognitiveTests = $app->businessLogicDatabase->searchAllNonDeletedNeurocognitiveTests($page, $sorting);
		} else {
			// Searches specific neurocognitive tests
			$neurocognitiveTests = $app->businessLogicDatabase->searchSpecificNonDeletedNeurocognitiveTests($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$neurocognitiveTests = objectIdsToHexadecimal($neurocognitiveTests);
		
		// Gets the IDs
		$ids = array_column($neurocognitiveTests, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
