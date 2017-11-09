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

                $this->data['abilities'] = Ability::getAllAbilities();

    			// Spracovanie formulara, vytvorenie lovca a vlozenie do DB
    			if (isset($_POST['hunterName'])) {

                    // Overenie, ci ma uzivatel spravny pocet lovcov
                    if (!($user->getMyHuntersCount() > $user->getLevel() )) {
        				$hunter = new Hunter($_POST['hunterName'], 1); // ability bude zatial 1,  TO DO ability
        				$hunter->insertIntoDb();
                    }

                    // Na začiatku si každý vytvorí 2 lovcov
                    if ($user->getMyHuntersCount() == $user->getLevel()+1)
    				    $this->redirect('iis/hunter/overview');
                    else
                        $this->redirect('iis/hunter/create');
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