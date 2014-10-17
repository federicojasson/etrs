<?php

// TODO: remove before release

class TestSessionStorageHandler implements SessionStorageHandler {
	
	private $file;
	
	public function onClose() {
		return fclose($file);
	}

	public function onDestroy($sessionId) {
		// TODO
		return true;
	}

	public function onGc($lifetime) {
		// TODO
		return true;
	}

	public function onOpen($savePath, $sessionName) {
		$file = fopen(__DIR__ . '/test/session.txt', 'r+');
		
		if ($file)
			return true;
		
		$this->file = $file;
		return $file;
	}

	public function onRead($sessionId) {
		// TODO
		return true;
	}

	public function onWrite($sessionId, $data) {
		// TODO
		return true;
	}

}
