<?php

class Outpost {
	private $id;
	private $outpost;
	private $user;
	private $capacity;
	private $hunterCount;

	public function __construct($outpost, $user) {
		$this->outpost = $outpost;
		$this->user = $user;
		$this->capacity = 3;
		$this->hunterCount = 0;
	}

	// Vlozi do DB
	public function insertToDb() {
		Db::query('INSERT INTO outpost (outpost, user, capacity, hunterCount) VALUES (?, ?, ?, ?)', [$this->outpost, $this->user, $this->capacity, $this->hunterCount]);
	}

	// Vrati stanoviste podle ID
	public function getOutpostById($id) {
		return Db::queryOne('SELECT * FROM outpost WHERE id = ?', [$id]);
	}

	// Zvysi pocet lovcu na stanovisti o 1 a aktualizuje DB
	public static function increaseHunterCount ($outpostId) {
		$outpost = Db::queryOne('SELECT * FROM outpost WHERE id = ?', [$outpostId]);
		$outpost['hunterCount']++;
		Db::query('UPDATE outpost SET hunterCount = ? WHERE id = ?', [$outpost['hunterCount'], $outpostId]);
	}

	// Znizi pocet lovcu na stanovisti o 1 a aktualizuje DB
	public static function decreaseHunterCount ($outpostId) {
		$outpost = Db::queryOne('SELECT * FROM outpost WHERE id = ?', [$outpostId]);
		$outpost['hunterCount']--;
		Db::query('UPDATE outpost SET hunterCount = ? WHERE id = ?', [$outpost['hunterCount'], $outpostId]);
	}

	// Vrati lovcov ktory su na tomto stanovisti
	public static function getHuntersByOutpostId($outpostId) {
		return Db::queryAll('SELECT * FROM hunter WHERE outpost =?',[$outpostId]);
	}
}