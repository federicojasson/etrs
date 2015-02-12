<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage laboratory tests.
 */
class LaboratoryTestModel extends EntityModel {
	
	/*
	 * Creates a laboratory test.
	 * 
	 * It receives the laboratory test's data.
	 */
	public function create($id, $creator, $name, $dataTypeDescriptor) {
		$app = $this->app;
		
		// Creates the laboratory test
		$app->businessLogicDatabase->createLaboratoryTest($id, $creator, $name, $dataTypeDescriptor);
	}
	
	/*
	 * Deletes a laboratory test.
	 * 
	 * It receives the laboratory test's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the laboratory test
		$app->businessLogicDatabase->deleteLaboratoryTest($id);
	}
	
	/*
	 * Edits a laboratory test.
	 * 
	 * It receives the laboratory test's data.
	 */
	public function edit($id, $lastEditor, $name, $dataTypeDescriptor) {
		$app = $this->app;
		
		// Edits the laboratory test
		$app->businessLogicDatabase->editLaboratoryTest($id, $lastEditor, $name, $dataTypeDescriptor);
	}
	
	/*
	 * Determines whether a laboratory test exists.
	 * 
	 * It receives the laboratory test's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the laboratory test exists
		return $app->businessLogicDatabase->nonDeletedLaboratoryTestExists($id);
	}
	
	/*
	 * Filters a laboratory test for presentation and returns the result.
	 * 
	 * It receives the laboratory test.
	 */
	public function filter($laboratoryTest) {
		$app = $this->app;
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields(ENTITY_MODEL_LABORATORY_TEST);
		
		// Filters the laboratory test's fields
		$newLaboratoryTest = filterArray($laboratoryTest, $accessibleFields);
		
		// Applies conversions
		
		if (isset($newLaboratoryTest['id'])) {
			$newLaboratoryTest['id'] = bin2hex($laboratoryTest['id']);
		}
		
		return $newLaboratoryTest;
	}
	
	/*
	 * Returns a laboratory test. If it doesn't exist, null is returned.
	 * 
	 * It receives the laboratory test's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the laboratory test
		return $app->businessLogicDatabase->getNonDeletedLaboratoryTest($id);
	}
	
	/*
	 * Searches laboratory tests. It returns an array containing the total
	 * number of results and the results found in the page, ready for
	 * presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all laboratory tests
			$laboratoryTests = $app->businessLogicDatabase->searchAllNonDeletedLaboratoryTests($page, $sorting);
		} else {
			// Searches specific laboratory tests
			$laboratoryTests = $app->businessLogicDatabase->searchSpecificNonDeletedLaboratoryTests($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$laboratoryTests = arrayIdsToHexadecimal($laboratoryTests);
		
		// Gets the IDs
		$ids = array_column($laboratoryTests, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
