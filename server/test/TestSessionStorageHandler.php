<?php

// TODO: remove before release

class TestSessionStorageHandler implements SessionStorageHandler {
	
	private $file;
	
	public function onClose() {
		echo 'onClose<br>';
		return fclose($this->file);
	}

	public function onDestroy($sessionId) {
		echo 'onDestroy<br>';
		return true;
	}

	public function onGc($lifetime) {
		echo 'onGc<br>';
		return true;
	}

	public function onOpen($savePath, $sessionName) {
		echo 'onOpen<br>';
		$file = fopen(__DIR__ . '/session.txt', 'r+');
		
		if ($file) {
			$this->file = $file;
			return true;
		} else
			return false;
	}

	public function onRead($sessionId) {
		echo 'onRead<br>';
		
		$size = filesize(__DIR__ . '/session.txt');
		if ($size > 0)
			return fread($this->file, $size);
		else
			return '';
	}

	public function onWrite($sessionId, $data) {
		echo 'onWrite<br>';
		if (fwrite($this->file, $data))
			return true;
		else
			return false;
	}

}
