<?php

class HunterController extends Controller
{
    public function handle($parameters)
    {
    	// Pokud neni prihlaseny uzivatel, nema pristup k zadnemu z lovcu
    	if (!isLoggedIn()) {
    		$this->redirect('iis/error');
    	} else {
			$user = new User($_SESSION['user']);
			$user->setId();
		}

    	if (isset($parameters)) {
    		// VYTVORENIE NOVEHO LOVCA
    		if ($parameters[0] == 'create') {
				// Nastavení proměnných pro šablonu
				$this->header['title'] = "IIS Create Hunter";
				$this->header['description'] = "Create your hunter";
				$this->header['keywords'] = ["iis", "create", "hunter", "start"];

    			$this->view = 'hunterCreate';

    			// Spracovanie formulara, vytvorenie lovca a vlozenie do DB
    			if (isset($_POST['hunterName'])) {
    				$hunter = new Hunter($_POST['hunterName'], 1); // ability bude zatial 1,  TO DO ability
    				$hunter->insertIntoDb();

    				$this->redirect('iis/hunter/overview');
    			}
    		// PREHLAD LOVCOV
    		} else if ($parameters[0] == 'overview') {
				// Nastavení proměnných pro šablonu
				$this->header['title'] = "IIS Hunters";
				$this->header['description'] = "User overview of all hunters";
				$this->header['keywords'] = ["iis", "overview", "hunter", "hunters"];

				$myHunters = $user->getMyHunters();
				$this->data['myHunters'] = $myHunters;

				$allHunters = Hunter::getAllHunters();
				$this->data['allHunters'] = $allHunters;


    			$this->view = 'hunterOverview';
    		}
    	}

    }
}