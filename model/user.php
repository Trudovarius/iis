<?php

class User {
	private $id;
	private $name;
	private $level;
	private $food;
	private $experience;

	public function __construct ($name) {
		$user = Db::queryOne('SELECT * FROM user WHERE name = ?',[$name]);
		if (empty($user)) {
			$this->name = $name;
			$this->level = 1;
			$this->food = 0;
			$this->experience = 0;
		} else {
			$this->id = $user['id'];
			$this->name = $user['name'];
			$this->level = $user['level'];
			$this->food =  $user['food'];
			$this->experience =  $user['experience'];
		}
	}

	// Nastaví ID používateľa
	public function setId() {
		$this->id = Db::querySingle('SELECT id FROM user WHERE name = ?', [$this->name]);
	}

	// Vráti ID používateľa
	public function getId() {
		if (isset($this->id))
			return $this->id;
		else
			return $this->id = Db::querySingle('SELECT id FROM user WHERE name = ?', [$this->name]);
	}

	// Vloží užívateľa do DB
	// Používa sa len pri registrácí nového užívateľa
	public function insertToDb() {
		Db::query('INSERT INTO user (name, level, food, experience) VALUES (?, ?, ?, ?)', [$this->name, $this->level, $this->food, $this->experience]);
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

	// Vráti level
	public function getLevel() {
		return $this->level;
	}

	// Vráti všetkých lovcov, ktorý patria akutálnemu užívateľovi
	public function getMyHunters() {
		return Db::queryAll('SELECT * FROM hunter WHERE user = ? ORDER BY health DESC', [$this->id]);
	}

	// Vráti všetky stanovištia patriace aktuálnemi uživateľovi
	public function getMyOutposts() {
		return Db::queryAll('SELECT * FROM outpost WHERE user = ?', [$this->id]);
	}

	// Vráti všetky jamy patriace aktuálnemi uživateľovi
	public function getMyPits() {
		return Db::queryAll('SELECT * FROM pit WHERE user = ?', [$this->id]);
	}

	// Vráti všetky stanovištia patriace aktuálnemi uživateľovi
	public function getMyReports() {
		return Db::queryAll('SELECT * FROM report WHERE user = ? ORDER BY date DESC', [$this->id]);
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

	// Vráti počet lovcov patriacich aktuálnemu užívateľovi
	public function getMyHuntersCount() {
		return Db::query('SELECT * FROM hunter WHERE user = ? AND health > ?', [$this->id,0]);		
	}

	// Prepočíta level pouzivatela
	public function computeLevel() {
		if ($this->experience > $this->level * 100) {
			$this->level++;
			$this->experience -= $this->level * 100;
		}
		Db::query('UPDATE user SET food = ?, experience = ? WHERE id = ?',[$this->food, $this->experience, $this->id]);
	}
}