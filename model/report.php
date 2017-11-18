<?php

class Report {
	private $user;
	private $date;
	private $outpost;
	private $mammothCount;
	private $completion;

	// TO DO
	public static function createNew($user) {
		$report = new Report();
		$report->user = $user;
		$report->outpost = Outpost::getActiveOutpost($user)['id'];
		$report->date = date('Y-m-d H:i:s');
		$report->completion = 0;
		$report->mammothCount = rand(1,3);

		$report->insertToDb();
	}

	public function insertToDb() {
		Db::query('INSERT INTO report (user, date, outpost, mammothCount, completion) VALUES (?, ?, ?, ?, ?)', [$this->user, $this->date, $this->outpost, $this->mammothCount, $this->completion]);
	}


}