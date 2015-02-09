<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage image tests.
 */
class ImageTestModel extends EntityModel {
	
	/*
	 * Creates an image test.
	 * 
	 * It receives the image test's data.
	 */
	public function create($id, $creator, $name, $dataTypeDescriptor) {
		$app = $this->app;
		
		// Creates the image test
		$app->businessLogicDatabase->createImageTest($id, $creator, $name, $dataTypeDescriptor);
	}
	
	/*
	 * Deletes an image test.
	 * 
	 * It receives the image test's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the image test
		$app->businessLogicDatabase->deleteImageTest($id);
	}
	
	/*
	 * Edits an image test.
	 * 
	 * It receives the image test's data.
	 */
	public function edit($id, $lastEditor, $name, $dataTypeDescriptor) {
		$app = $this->app;
		
		// Edits the image test
		$app->businessLogicDatabase->editImageTest($id, $lastEditor, $name, $dataTypeDescriptor);
	}
	
	/*
	 * Determines whether an image test exists.
	 * 
	 * It receives the image test's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the image test exists
		return $app->businessLogicDatabase->nonDeletedImageTestExists($id);
	}
	
	/*
	 * Filters an image test for presentation and returns the result.
	 * 
	 * It receives the image test.
	 */
	public function filter($imageTest) {
		$app = $this->app;
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields('imageTest');
		
		// Filters the image test's fields
		$newImageTest = filterArray($imageTest, $accessibleFields);
		
		// Applies conversions
		
		if (isset($newImageTest['id'])) {
			$newImageTest['id'] = bin2hex($imageTest['id']);
		}
		
		return $newImageTest;
	}
	
	/*
	 * Returns an image test. If it doesn't exist, null is returned.
	 * 
	 * It receives the image test's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the image test
		return $app->businessLogicDatabase->getNonDeletedImageTest($id);
	}
	
	/*
	 * Searches image tests. It returns an array containing the total number of
	 * results and the results found in the page, ready for presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all image tests
			$imageTests = $app->businessLogicDatabase->searchAllNonDeletedImageTests($page, $sorting);
		} else {
			// Searches specific image tests
			$imageTests = $app->businessLogicDatabase->searchSpecificNonDeletedImageTests($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$imageTests = arrayIdsToHexadecimal($imageTests);
		
		// Gets the IDs
		$ids = array_column($imageTests, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
