<?php

class UserController extends Controller
{
	 public function handle($parameters)
	 {
		// Nastavení proměnných pro šablonu
		$this->header['title'] = "IIS Users";
		$this->header['description'] = "User information";
		$this->header['keywords'] = ["iis", "user", "users"];

		if (isLoggedIn()) {
			$user = new User($_SESSION['user']);
			$user->setId();

			$this->data['detailUser'] = new User(User::getUserNameById($parameters[1]));

			$this->view = 'userDetail';
		}
	 }
}