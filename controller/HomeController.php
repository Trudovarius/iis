<?php

class HomeController extends Controller
{
    public function handle($parameters)
    {
		// Nastavení proměnných pro šablonu
		$this->header['title'] = "IIS Home";
		$this->header['description'] = "Homepage of IIS project.";
		$this->header['keywords'] = ["iis", "home"];

		// Spracovanie odoslanych formularov na registraciu a prihlasenie
		if (isset($_POST['type'])) {
			$type = array_shift($_POST);
			if ($type == 'login') {
				$this->login();
			} elseif ($type == 'register') {
				$this->register();
			}
		}

		// Ak je prihlaseny pouzivatel, vytvor instanci tridy USER
		if (isLoggedIn()) {
			$user = new User($_SESSION['user']);
			$user->setId();
			
			// V prípade, že užívateľ nemá žiadneho lovca, presmerovanie a vytvorenie nového lovca
	    	if (!hasHunter($user->getId())) {
	    		$this->redirect('iis/hunter/create');
	    	}

	    	// V prípade, že užívateľ nemá žiadne stanovište,
	    	if (!hasOutpost($user->getId())) {
	    		$user->initOutposts();
	    		$this->redirect('iis/home');
	    	// Vykreslenie stanoviští
	    	} else {
	    		$outposts = $user->getMyOutposts();
	    		$this->data['outposts'] = $outposts;
	    	}
		}

		// Nastavení hlavní šablony
		if (isLoggedIn())
			$this->view = 'home';
		else
			$this->view = 'start';
    }

    public function login() {
    	$user = new User($_POST['name']);
    	$hash = sha1($_POST['password']);
    	if ($hash == $user->getPassword())
    		$_SESSION['user'] = $user->getName();
    	$user->setId();
    }

    public function register() {
    	$user = new User($_POST['name']);
    	$user->insertToDb();
    	$user->setPassword($_POST['password']);
    }
}