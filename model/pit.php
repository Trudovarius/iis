<?php

class Pit {
	private $user;
	private $deadMammoths;
	private $available;

	// Vygeneruje 3 jamy pro uzivatela s ID userId a vlozi do DB
	public static function generatePits($userId) {
		for ($i = 0; $i < 3; $i++) {
			$pit = new Pit();
			$pit->user = $userId;
			$pit->deadMammoths = 0;
			$pit->available = 1;

			$pit->insertToDb();
		}
	}

	// Vlozi do DB
	public function insertToDb() {
		Db::query('INSERT INTO pit (user, deadMammoths, available) VALUES (?, ?, ?)', [$this->user, $this->deadMammoths, $this->available]);
	}
	// Incrementuje pocet mrtvych mamutov
	public static function setDeadMammoths($pitId, $deadMammoths) {
		Db::query('UPDATE pit SET deadMammoths = ? WHERE id = ?',[$deadMammoths+1, $pitId]);
	}

	// Nastavi hodnotu available na 1
	public static function setAvailable($pitId) {
		Db::query('UPDATE pit SET available = ? WHERE id = ?', [1, $pitId]);
	}
}