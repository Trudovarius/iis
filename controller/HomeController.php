<?php

class HomeController extends Controller
{
    public function handle($parameters)
    {
		// Nastavení proměnných pro šablonu
		$this->header['title'] = "IIS Home";
		$this->header['description'] = "Homepage of IIS project.";
		$this->header['keywords'] = ["iis", "home"];

		if (isset($_POST['type'])) {
			$type = array_shift($_POST);
			if ($type == 'login') {
				$this->login();
			} elseif ($type == 'register') {
				$this->register();
			}
		}

		// Nastavení hlavní šablony
		if (isset($_SESSION['user']))
			$this->view = 'home';
		else
			$this->view = 'start';
    }

    public function login() {
    	$user = new User($_POST['name']);
    	if ($_POST['password'] == $user->getPassword())
    		$_SESSION['user'] = $user->getName();
    }

    public function register() {
    	$user = new User($_POST['name']);
    	$user->insertToDb();
    	$user->setPassword($_POST['password']);
    }
}