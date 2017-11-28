<?php

class AdminController extends Controller
{

	 public function handle($parameters)
	 {

		// Nastavení proměnných pro šablonu
		$this->header['title'] = "IIS Admin";
		$this->header['description'] = "Admin control panel";
		$this->header['keywords'] = ["iis", "admin", "users"];

		switch ($parameters[0]) {
			case "login":
				$this->login();
				break;
			case "controlPanel";
				$this->controlPanel();
				break;
		}
	 }

	 public function login() {
	 	$this->view = 'adminLogin';

	 	if (!empty($_POST)) {
	 		if ($_POST['name'] == 'admin' && $_POST['password'] == 'admin') {
	 			$_SESSION['admin'] = time();
 				$this->redirect('iis/admin/controlPanel');
	 		}
	 	}
	}

	public function controlPanel() {
	 	$this->view = 'controlPanel';

	 	if (isLoggedIn()) {
			$user = new User($_SESSION['user']);
			if ($user->getRole() != 'admin')
	 			$this->redirect('iis/home');
	 	}

	 	if (!isset($_SESSION['admin']))
	 		$this->redirect('iis/home');

	 	if (isset($_POST['change'])) {
	 		Db::query('UPDATE user SET id = ?, name = ?, level = ?, food = ?, experience = ?, role = ? WHERE id = ?',[$_POST['id'], $_POST['name'], $_POST['level'], $_POST['food'], $_POST['experience'], $_POST['role'], $_POST['id']]);
	 	}

	 	if (isset($_POST['delete'])) {
	 		Db::query('DELETE FROM user WHERE id = ?',[$_POST['delete']]);
	 		Db::query('DELETE FROM hunter WHERE user = ?',[$_POST['delete']]);
	 		Db::query('DELETE FROM expedition WHERE user = ?',[$_POST['delete']]);
	 		Db::query('DELETE FROM outpost WHERE user = ?',[$_POST['delete']]);
	 		Db::query('DELETE FROM pit WHERE user = ?',[$_POST['delete']]);
	 	}

	 	$this->data['users'] = Db::queryAll('SELECT * FROM user');

	}
}
