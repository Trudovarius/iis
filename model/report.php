<?php

class Report {
	private $id;
	private $user;
	private $date;
	private $outpost;
	private $mammothCount;
	private $completion;

	// TO DO
	public static function createNew($user) {
		$report = new Report();
		$report->id = uniqid(); 
		$report->user = $user;
		$report->outpost = Outpost::getActiveOutpost($user)['id'];
		$report->date = date('Y-m-d H:i:s');
		$report->completion = 0;
		$report->mammothCount = rand(1,3);

		$report->insertToDb();

		Mammoth::generate($report->id, $report->mammothCount);
	}

	// Vlozi do DB
	public function insertToDb() {
		Db::query('INSERT INTO report (id, user, date, outpost, mammothCount, completion) VALUES (?, ?, ?, ?, ?, ?)', [$this->id, $this->user, $this->date, $this->outpost, $this->mammothCount, $this->completion]);
	}

	// Vrati hlasenie podle ID
	public static function getReportById($id) {
		return Db::queryOne("SELECT * FROM report WHERE id = ?", [$id]);
	}

	// Ak ziadna expedicia neexistuje, vrati nulu
	public static function hasExpedition($reportId) {
		return Db::queryAll('SELECT * FROM expedition WHERE report = ?', [$reportId]);
	}
}