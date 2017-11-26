<?php

class Expedition {
	private $id;
	private $user;
	private $date;
	private $status;
	private $success;
	private $report;
	private $hunters;
	private $pit;
	private $finishTime;
	private $food;
	private $experience;

	// Nastavenie prvych udajov
	public function __construct($userId, $data = null) {
		if (isset($data)) {
			$this->id = $data['id'];
			$this->user = $data['user'];
			$this->date = $data['date'];
			$this->status = $data['status'];
			$this->success = $data['success'];
			$this->report = $data['report'];
			$this->finishTime = $data['finishTime'];
			$this->food = $data['food'];
			$this->experience = $data['experience'];
		} else {
			$this->id = uniqid();
			$this->user = $userId;
			$this->hunters = array();
			$this->date = date('Y-m-d H:i:s');
			$this->food = 0;
			$this->experience = 0;
		}
	}

	// Vlozenie do DB
	public function insertToDb() {
		Db::query('INSERT INTO expedition (id, user, date, status, success, report, finishTime, food, experience) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$this->id, $this->user, $this->date, $this->status, $this->success, $this->report, $this->finishTime, $this->food, $this->experience]);
		Db::query('UPDATE pit SET available = ? WHERE id = ?',[0, $this->pit]);		
		Db::query('INSERT INTO expedition_pit (pitId, expeditionId, since, until) VALUES (?, ?, ?, ?)', [$this->pit, $this->id, $this->date, $this->finishTime]);

		foreach ($this->hunters as $hunter) {
			Db::query('INSERT INTO expedition_member (hunterId, expeditionId, since, until) VALUES (?, ?, ?, ?)', [$hunter, $this->id, $this->date, $this->finishTime]);
			Db::query('UPDATE hunter SET available = ? WHERE id = ?',[0, $hunter]);
		}
	}

	// Overovanie ci uz nejaka z expedici skoncila
	public static function check($userId) {
		$expeditions = Db::queryAll('SELECT * FROM expedition WHERE user = ?', [$userId]);

		foreach($expeditions as $expedition) {
			if ( ($expedition['finishTime'] < date('Y-m-d H:i:s')) && ($expedition['status'] != "Finished")) {
				$expObj = new Expedition(0,$expedition);
				$expObj->finish();
			}
		}
	}

	// Spracuje ukoncenie vypravy
	public function finish() {
		$report = Db::queryOne('SELECT * FROM report WHERE id = ?', [$this->report]);
		$mammoths = Db::queryAll('SELECT * FROM mammoth JOIN record ON mammoth.id=record.mammothId WHERE reportId = ?', [$report['id']]);
		$pit = Db::queryOne('SELECT * FROM pit JOIN expedition_pit ON pit.id=expedition_pit.pitId WHERE expeditionId = ?', [$this->id]);
		$hunters = Db::queryAll('SELECT * FROM hunter JOIN expedition_member ON hunter.id=expedition_member.hunterId WHERE expedition_member.expeditionId = ?', [$this->id]);

		$success = 0;
		$food = 0;
		$experience = 0;
		// Simulacia suboja
		// Ak zomrie aspoň 1 mamut, expedicia je uspesna
		foreach ($mammoths as $mammoth) { // Simulacia mamutov
			$rngesus = rand(0,100);
			if ($rngesus > 25) { // Smrť mamuta
				$success = 1;
				$food += 100;
				$experience += 50;
				// Urcenie ktory lovec zabil mamuta
				Mammoth::kill($mammoth['id'], $pit['id'], $hunters[rand(0,sizeof($hunters)-1)]['id'], $this->finishTime);
				Pit::setDeadMammoths($pit['id'], $pit['deadMammoths']);
			} // Mamut prežil
		}

		foreach ($hunters as $hunter) {
			$rngesus = rand(0,125);
			$hunter['health'] -= $rngesus;
			$experience += $rngesus;
			if ($hunter['health'] <= 0) { // Smrť lovca
				$hunter['available'] = 0;
				Hunter::kill($hunter['id'], $mammoths[rand(0,sizeof($mammoths)-1)]['id'], $pit['id'], $this->finishTime);
			} else {
				$hunter['available'] = 1;
			}
			Hunter::update($hunter);
		}

		Pit::setAvailable($pit['id']);
		Db::query('UPDATE report SET completion = ? WHERE id = ?', [1, $this->report]);
		Db::query('UPDATE user SET food = ?, experience = ? WHERE name = ?',[$food, $experience, $_SESSION['user']]);
		echo $food . $experience;
		$this->status = "Finished";
		$this->success = $success;
		$this->update();
	}

	// Aktualizacia zaznamu v DB
	public function update() {
		Db::query('UPDATE expedition SET user = ?, date = ?, status = ?, success = ?, report = ?, finishTime = ?, food = ?, experience = ? WHERE id = ?', [$this->user, $this->date, $this->status, $this->success, $this->report, $this->finishTime, $this->food, $this->experience, $this->id]);
	}

	// Vrati id lovcov
	public function getHunters() {
		return $this->hunters;
	}

	// Nastavi premennu lovci
	public function setHunters($hunters) {
		$this->hunters = $hunters;
	}

	// Nachadza sa lovec s danym id v poli lovcov?
	public function contains($hunterId) {
		foreach ($this->hunters as $hunter) {
			if ($hunter == $hunterId)
				return true;
		}
		return false;
	}

	// Nastavi premennu status
	public function setStatus($status) {
		$this->status = $status;
	}

	// Nastavi premennu finishTime
	public function setFinishTime($mammothCount) {
		$this->finishTime = date('Y-m-d H:i:s', time() + ($mammothCount * 600));
	}

	// Nastavi premennu success
	public function setSuccess($success) {
		$this->success = $success;
	}

	// Nastavi premennu pit
	public function setPit($pitId) {
		$this->pit = $pitId;
	}

	// Nastavi premennu report
	public function setReport($reportId) {
		$this->report = $reportId;
	}

	// Vrati premennu report
	public function getReport() {
		return $this->report;
	}
}