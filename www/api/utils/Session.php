<?php

namespace Utils;

class Session {
	static public function init() {
		session_start();
	}

	static public function destroy() {
		session_destroy();
	}

	static public function write($key, $value) {
		$_SESSION[$key] = $value;
	}

	static public function read($key) {
		return $_SESSION[$key];
	}

	static public function remove($key) {
		unset($_SESSION[$key]);
	}

	static public function isLoggedIn() {
		return !!self::user('roleId');
	}

	static public function user($key) {
		if (self::read('User') && isset(self::read('User')[$key])) {
			return self::read('User')[$key];
		}

		return null;
	}

}
