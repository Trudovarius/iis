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

	public function insertIntoDb() {
		Db::query('INSERT INTO hunter (user, name, health, ability, available) VALUES (?, ?, ?, ?, ?)', [$this->user, $this->name, $this->health, $this->ability, $this->available]);
	}

	public static function getAllHunters() {
		return Db::queryAll('SELECT * FROM hunter');
	}

}