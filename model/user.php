<?php

class User {
	private $id;
	private $name;
	private $level;
	private $food;
	private $experience;
	private $role;

	public function __construct ($name) {
		$user = Db::queryOne('SELECT * FROM user WHERE name = ?',[$name]);
		if (empty($user)) {
			$this->name = $name;
			$this->level = 1;
			$this->food = 100;
			$this->experience = 0;
			$this->role = 'user';
		} else {
			$this->id = $user['id'];
			$this->name = $user['name'];
			$this->level = $user['level'];
			$this->food =  $user['food'];
			$this->experience =  $user['experience'];
			$this->role = $user['role'];
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
		Db::query('INSERT INTO user (name, level, food, experience, role) VALUES (?, ?, ?, ?, ?)', [$this->name, $this->level, $this->food, $this->experience, $this->role]);
	}

	public function costFood($food) {
		if (($this->food - $food) >= 0) {
			$this->food -= $food;
			Db::query('UPDATE user SET food = ? WHERE id = ?',[$this->food, $this->id]);
			return true;
		} else {
			return false;
		}
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

	// Vráti hodnotu jedla
	public function getFood() {
		return $this->food;
	}

	// Vráti pocet skusenosti
	public function getExp() {
		return $this->experience;
	}


	// Vráti rolu
	public function getRole() {
		return $this->role;
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
	public function getMyReports($page) {
		return Db::queryAll('SELECT * FROM report WHERE user = ? ORDER BY date DESC LIMIT ?, 5', [$this->id, ($page-1)*5]);
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

	public function reward($food, $experience) {
		$this->food += $food;
		$this->experience += $experience;
		Db::query('UPDATE user SET food = ?, experience = ? WHERE name = ?',[$this->food, $this->experience, $this->name]);
	}

	// Prepočíta level pouzivatela
	public function computeLevel() {
		if ($this->experience > $this->level * 100) {
			$this->experience -= $this->level * 100;
			$this->level++;
		}
		Db::query('UPDATE user SET level = ?, food = ?, experience = ? WHERE id = ?',[$this->level, $this->food, $this->experience, $this->id]);
	}
}