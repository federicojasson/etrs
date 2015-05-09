/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.fileUploader').controller('FileUploaderController', [
		'$scope',
		'fileUploader',
		'FileUploader',
		'utility',
		FileUploaderController
	]);
	
	/**
	 * Implements the logic of a file-uploader.
	 */
	function FileUploaderController($scope, fileUploader, FileUploader, utility) {
		var _this = this;
		
		/**
		 * The uploader.
		 */
		_this.uploader = null;
		
		/**
		 * Removes a file item.
		 * 
		 * Receives the file item.
		 */
		_this.removeFileItem = function(fileItem) {
			// Removes the file's ID
			utility.removeFromArray(fileItem.file.id, $scope.files);
			
			// Removes the file item
			fileItem.remove();
		};
		
		/**
		 * Filters a file item by the maximum number of files allowed.
		 */
		function filterByLimit() {
			var count = 0;
			
			// Gets the file queue
			var queue = _this.uploader.queue;
			
			// Counts the number of files that are queued or have been uploaded
			for (var i = 0; i < queue.length; i++) {
				var fileItem = queue[i];
				
				if (fileItem.isCancel || fileItem.isError) {
					// The upload has failed or has been canceled
					continue;
				}
				
				// Increments the count
				count++;
			}
			
			// Determines whether the count is lower than the limit
			return count < $scope.limit;
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Initializes the uploader
			initializeUploader($scope.limit);
		}
		
		/**
		 * Initializes the uploader.
		 * 
		 * Receives, optionally, the maximum number of files allowed.
		 */
		function initializeUploader(limit) {
			// Gets the saved uploader (if any)
			_this.uploader = fileUploader.getSavedUploader();
			
			if (_this.uploader !== null) {
				// The previous uploader has been restored
				return;
			}
			
			// Initializes the uploader
			_this.uploader = new FileUploader({
				url: '/server/file/upload',
				alias: 'file',
				method: 'POST'
			});
			
			// Sets the current uploader
			fileUploader.setUploader(_this.uploader);
			
			if (angular.isDefined(limit)) {
				// Registers a filter
				_this.uploader.filters.push({
					name: 'limit',
					fn: filterByLimit
				});
			}
			
			// Registers callbacks
			
			_this.uploader.onAfterAddingFile = function(fileItem) {
				// Uploads the file
				fileItem.upload();
			};
			
			_this.uploader.onBeforeUploadItem = function() {
				$scope.uploading = true;
			};
			
			_this.uploader.onCompleteItem = function() {
				$scope.uploading = false;
			};
			
			_this.uploader.onSuccessItem = function(fileItem, output) {
				// Adds the file's ID
				$scope.files.push(output.id);
				
				// Stores the file's ID in the file item
				fileItem.file.id = output.id;
			};
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
