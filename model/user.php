<?php

class User {
	private $name;
	private $level;

	public function __construct ($name, $level = null) {
		$this->name = $name;
		if (isset($level)) {
			$this->level = $level;
		} else {
			$this->level = 0;
		}
	}

	public function insertToDb() {
		Db::query('INSERT INTO user (name, level) VALUES (?, ?)', [$this->name, $this->level]);
	}

	public function setPassword($password) {
		Db::query('UPDATE user SET password = ? WHERE name = ?', [$password, $this->name] );
	}

	public function getPassword() {
		return Db::querySingle('SELECT password FROM user WHERE name = ?', [$this->name]);
	}

	public function getName() {
		return $this->name;
	}
}