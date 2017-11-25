<?php

class Mammoth {
	private $id;
	private $sign;
	private $properties;
	private $gender;

	private static $signs = ['broken fang', 'white fur', 'baby mammoth', 'huge', 'tiny', '3-legged', 'injured'];
	private static $genders = ['male','female'];
	private static $allProperties = ['angry', 'defensive', 'passive', 'neutral', 'agresive', 'fast', 'slow', 'agile'];

	// Generuje zadany pocet mamutov podla spravy, nahodne inicializuje hodnoty, RNGesus, 
	public static function generate($reportId, $mammothCount) {
		for ($i = 0; $i < $mammothCount; $i++) {
			$mammoth = new Mammoth();
			$mammoth->id = uniqid();
			$mammoth->sign = self::$signs[rand(0,6)];
			$mammoth->properties = self::$allProperties[rand(0,7)];
			$mammoth->gender = self::$genders[rand(0,1)];

			$mammoth->insertToDb($reportId);
		}
	}

	// Vlozi mamuta do DB
	public function insertToDb($reportId) {
		Db::query('INSERT INTO mammoth (id, sign, properties, gender) VALUES (?, ?, ?, ?)', [$this->id, $this->sign, $this->properties, $this->gender]);
		Db::query('INSERT INTO record (mammothId, reportId) VALUES (?, ?)',[$this->id, $reportId]);
	}

	// Vlozi zaznam o vrazde mamuta do DB
	public static function kill($mammothId, $pitId, $hunterId) {
		// Pri hodnote Murder.Type == 1 sa jedna o vrazdu typu "lovec zabil mamuta"
		Db::query('INSERT INTO murder (hunterId, mammothId, date, type, pitId) VALUES (?, ?, ?, ?, ?)', [$hunterId, $mammothId, date('Y-m-d H:i:s'), 1, $pitId]);
	}
}