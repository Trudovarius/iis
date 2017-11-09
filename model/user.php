<?php

class User {
	private $id;
	private $name;
	private $level;

	public function __construct ($name) {
		$this->name = $name;
		$this->level = 0;
	}

	// Nastaví ID používateľa
	public function setId() {
		$this->id = Db::querySingle('SELECT id FROM user WHERE name = ?', [$this->name]);
	}

	// Vráti ID používateľa
	public function getId() {
		return $this->id;
	}

	// Vloží užívateľa do DB
	// Používa sa len pri registrácí nového užívateľa
	public function insertToDb() {
		Db::query('INSERT INTO user (name, level) VALUES (?, ?)', [$this->name, $this->level]);
	}

	// Nastaví heslo
	public function setPassword($password) {
		$hash = sha1($password);
		Db::query('UPDATE user SET password = ? WHERE name = ?', [$hash, $this->name] );
	}

	// Vytiahne heslo z DB
	// Používa sa len pri prihlasovaní 
	public function getPassword() {
		return Db::querySingle('SELECT password FROM user WHERE name = ?', [$this->name]);
	}

	// Vráti meno
	public function getName() {
		return $this->name;
	}

	// Vráti všetkých lovcov, ktorý patria akutálnemu užívateľovi
	public function getMyHunters() {
		return Db::queryAll('SELECT * FROM hunter WHERE user = ?', [$this->id]);
	}

	public function getMyOutposts() {
		return Db::queryAll('SELECT * FROM outpost WHERE user = ?', [$this->id]);
	}

	// Vráti meno používateľa podľa zadaného ID, STATIC
	public static function getUserNameById($id) {
		return Db::querySingle('SELECT name FROM user WHERE id = ?', [$id]);
	}

	// Inicializuje prvé 3 stanovištia
	public function initOutposts() {
		for ($i = 0; $i < 3; $i++) {
			$outpost = new Outpost("Outpost".$i, $this->id);
			$outpost->insertToDb();
		}
	}
}