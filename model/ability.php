<?php

class Ability {
	private $id;
	private $ability;

	// Vrati vsetky schopnosti
	public static function getAllAbilities() {
		return Db::queryAll('SELECT * FROM ability');
	}

	// Vráti nazov schopnosti
	public static function getAbilityName($id) {
		return Db::querySingle('SELECT name FROM ability WHERE id = ?', [$id]);
	}
}