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

        // Overenie ci uz nejaka expedicia skoncila
        Expedition::check($user->getId());
        $user->computeLevel();

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
                    if (!($user->getMyHuntersCount() > ($user->getLevel() + 2) )) {
        				$hunter = new Hunter($_POST['hunterName'], $_POST['hunterAbility']);
        				$hunter->insertIntoDb();
                    }

                    // Na začiatku si každý vytvorí 4 lovcov
                    if ($user->getMyHuntersCount() == $user->getLevel()+3)
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

				$allHunters = Db::queryAll('SELECT COUNT(murder.hunterId) as kills, hunter.user, hunter.id, hunter.name, hunter.ability
                    FROM murder
                    LEFT JOIN hunter  ON murder.hunterId=hunter.id
                    WHERE murder.type = "1"
                    GROUP BY hunter.user, hunter.id, hunter.name, hunter.ability
                    ORDER BY kills DESC');
				$this->data['allHunters'] = $allHunters;


    			$this->view = 'hunterOverview';
    		}
    	}

    }
}