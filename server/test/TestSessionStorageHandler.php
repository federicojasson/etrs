<?php

// TODO: remove before release

class TestSessionStorageHandler implements SessionStorageHandler {
	
	private $file;
	
	public function onClose() {
		return fclose($this->file);
	}

	public function onDestroy($sessionId) {
		return true;
	}

	public function onGc($lifetime) {
		return true;
	}

	public function onOpen($savePath, $sessionName) {
		echo 'entre';
		$file = fopen(__DIR__ . '/test/session.txt', 'r+');
		
		if ($file) {
			$this->file = $file;
			return true;
		} else
			return false;
	}

	public function onRead($sessionId) {
		return fread($this->file, filesize($this->file));
	}

	public function onWrite($sessionId, $data) {
		if (fwrite($this->file, $data))
			return true;
		else
			return false;
	}

}
