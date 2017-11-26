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
		Db::query('INSERT INTO outpost_member (hunterId, outpostId, since, until) VALUES (?, ?, ?, ?)',[$hunterId, $outpostId, date('Y-m-d H:i:s'), ""]);
		Db::query('UPDATE hunter SET available = ? WHERE id = ?',[0, $hunterId]);
		Outpost::increaseHunterCount($outpostId);
	}

	// Vynuluje stanoviste
	public static function unsetOutpost($hunterId, $outpostId) {
		Db::query('UPDATE outpost_member SET until = ? WHERE hunterId = ? AND outpostId = ?',[date('Y-m-d H:i:s'), $hunterId, $outpostId]);
		Db::query('UPDATE hunter SET available = ? WHERE id = ?',[1, $hunterId]);
		Outpost::decreaseHunterCount($outpostId);
	}

	// Vlozi zaznam o vrazde do DB
	public static function kill($hunterId, $mammothId, $pitId, $finishTime) {
		// Murder.Type == 0 znamená že lovca zabil mamut
		Db::query('INSERT INTO murder (hunterId, mammothId, date, type, pitId) VALUES (?, ?, ?, ?, ?)', [$hunterId, $mammothId, $finishTime, 0, $pitId]);
	}

	// Aktualizovanie udajov o lovcovi
	public static function update($hunter) {
		Db::query('UPDATE hunter SET health = ?, available = ? WHERE id = ?', [$hunter['health'], $hunter['available'], $hunter['id']]);
	}
}