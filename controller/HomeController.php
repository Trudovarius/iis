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

			// V prípade, že užívateľ nemá žiadneho živého lovca lovca, presmerovanie a vytvorenie nového lovca
	    	if ($user->getMyHuntersCount() == 0) {
	    		if (sizeof($user->getMyHunters()) != 0)
					$this->redirect('hunter/create');
    			else {
	    			$this->redirect('hunter/create/init');
    			}
	    	}

	    	// Ziskanie informacii o stanovistiach z db
    		$outposts = $user->getMyOutposts();
    		$this->data['outposts'] = $outposts;

    		// Ziskanie informacii o jamach z DB
    		$pits = $user->getMyPits();
    		$this->data['pits'] = $pits;

    		// Overenie ci uz nejaka expedicia skoncila
    		Expedition::check($user);

    		$expInProgress = Db::queryAll('SELECT * FROM expedition WHERE user = ? AND status = ?', [$user->getId(), "In progress"]);
    		$this->data['expInProgress'] = $expInProgress;

	    	// Generovanie hlaseni o mamutoch
	    	// Vzdy budu aspon 2 nevybavene hlasenia
	    	if (activeOutposts($outposts)) {
	    		$i = hasReport($user->getId());
	    		if (!$i) {
	    			for (; $i < 2 + floor($user->getLevel()/5); $i++)
	    				Report::createNew($user->getId());
	    		}
	    	}

	    	// Vrati vsetky hlasenia z DB
	    	if (isset($_GET['page']))
	    		$this->data['reports'] = $user->getMyReports($_GET['page']);
	    	else {
	    		$_GET['page'] = 1;
	    		$this->data['reports'] = $user->getMyReports(1);
	    	}
		}

		// Nastavení hlavní šablony
		if (isLoggedIn())
			$this->view = 'home';
		else
			$this->view = 'start';
    }

    // Overenie hesla, a nastavenie SESSION['user']
    public function login() {
    	$user = new User($_POST['name']);
    	$hash = sha1($_POST['password']);
    	if ($hash == $user->getPassword()) {
    		$_SESSION['user'] = $user->getName();
    		$user->setId();
    	} else {
    		// TO DO error msg
    	}
    }

    // Vlozenie udajov o uzivatelovi do DB
    public function register() {
    	$user = new User($_POST['name']);
    	$user->insertToDb();
    	$user->setPassword($_POST['password']);

	    // Generovanie jám
    	Pit::generatePits($user->getId());
	    
	    // Generovanie stanovosti
	    $user->initOutposts();

        $this->data['error'] = $_POST['name'] . " has been registered successfully!";
    }
}