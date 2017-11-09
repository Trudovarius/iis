<?php

// Je v DB lovec ktorý patrí užívateľovi s daným ID?
function hasHunter($id) {
	if (Db::query('SELECT * FROM hunter WHERE user = ?', [$id]) == 0)
		return false;
	else
		return true;
}

function hasOutpost($id) {
	if (Db::query('SELECT * FROM outpost WHERE user = ?', [$id]) == 0)
		return false;
	else
		return true;
}

// Je prihlásený nejaký používateľ
function isLoggedIn() {
	if (isset($_SESSION['user']))
		return true;
	else
		return false;
}

function getUserIdByName($username) {
	return Db::querySingle('SELECT id FROM user WHERE name = ?', [$username]);
}