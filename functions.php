<?php

// Je v DB lovec ktorý patrí užívateľovi s daným ID?
function hasHunter($id) {
	return Db::query('SELECT * FROM hunter WHERE user = ?', [$id]);
}

// Je v DB stanoviste patriacemu uzivatelovi s danym ID?
function hasOutpost($id) {
	if (Db::query('SELECT * FROM outpost WHERE user = ?', [$id]) == 0)
		return false;
	else
		return true;
}

// Je v DB hlasenie ktore patri uzivatelovi s danym ID a este nebolo splnene?
// Vracia sa pocet tychto hlaseni
function hasReport($id) {
	return Db::query('SELECT * FROM report WHERE user = ? AND completion = ?', [$id, 0]);
}

// Je prihlásený nejaký používateľ
function isLoggedIn() {
	if (isset($_SESSION['user']))
		return true;
	else
		return false;
}

// Vrati pouzivatela podla zadaneho mena
function getUserIdByName($username) {
	return Db::querySingle('SELECT id FROM user WHERE name = ?', [$username]);
}

// Ma uzivatel aspon 1 aktivne stanoviste (aktivne = aspon 1 lovec na stanovisti)
function activeOutposts($outposts) {
	foreach ($outposts as $outpost) {
		if (Outpost::isActive($outpost))
			return true;
	}
	return false;
}

function url($url) {
	return Controller::$url . $url;
}