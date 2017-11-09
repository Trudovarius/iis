<?php

class Hunter {
	private $user;
	private $name;
	private $health;
	private $ability;
	private $available;

	public function __construct($name, $ability) {
		$this->user = getUserIdByName($_SESSION['user']);
		$this->name = $name;
		$this->ability = $ability;
		$this->health = 100;
		$this->available = 1;
	}

	// Vlozi lovca do databazy
	public function insertIntoDb() {
		Db::query('INSERT INTO hunter (user, name, health, ability, available) VALUES (?, ?, ?, ?, ?)', [$this->user, $this->name, $this->health, $this->ability, $this->available]);
	}

	// Vrati vsetkych lovcov
	public static function getAllHunters() {
		return Db::queryAll('SELECT * FROM hunter');
	}

	// Nastavi stanoviste
	public static function setOutpost($hunterId, $outpostId) {
		Db::query('UPDATE hunter SET outpost = ?, available = ? WHERE id = ?',[$outpostId, 0, $hunterId]);
		Outpost::increaseHunterCount($outpostId);
	}

	// Vynuluje stanoviste
	public static function unsetOutpost($hunterId, $outpostId) {
		Db::query('UPDATE hunter SET outpost = ?, available = ? WHERE id = ?',[ 0, 1, $hunterId]);
		Outpost::decreaseHunterCount($outpostId);
	}
}