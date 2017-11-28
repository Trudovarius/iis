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
        Expedition::check($user);

    	if (isset($parameters)) {
    		// VYTVORENIE NOVEHO LOVCA
    		if ($parameters[0] == 'create') {
				$this->create($parameters, $user);
    		// PREHLAD LOVCOV
    		} else if ($parameters[0] == 'overview') {
				$this->overview($parameters,$user);
    		} else if ($parameters[0] == 'detail') {
                $this->detail($parameters,$user);
            }
    	}
    }

    public function detail($parameters, $user) {
        // Nastavení proměnných pro šablonu
        $this->header['title'] = "IIS Hunter Detail";
        $this->header['description'] = "Hunter Details";
        $this->header['keywords'] = ["iis", "detail", "hunter", "info"];


        if (isset($_GET['page']))
            $page = $_GET['page'];
        else
            $_GET['page'] = $page = 1;

        $this->data['hunter'] = Hunter::getHunterById($parameters[1]);
        $this->data['kills'] = Hunter::getKills($parameters[1], $page);
        $this->data['outpost'] = Hunter::getOutpost($parameters[1]);
        $this->data['expedition'] = Hunter::getExpedition($parameters[1]);
        $this->data['expeditions'] = Hunter::getExpeditions($parameters[1]);


        $this->view = 'hunterDetail';
    }

    public function create($parameters, $user) {
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
    }

    public function overview($parameters,$user) {
        // Nastavení proměnných pro šablonu
        $this->header['title'] = "IIS Hunters";
        $this->header['description'] = "User overview of all hunters";
        $this->header['keywords'] = ["iis", "overview", "hunter", "hunters"];

        if (isset($_POST['reviveId'])) {
            if ($user->costFood(1000))
                Hunter::revive($_POST['reviveId']);
            else
                $this->data['error'] = "Not enough food for revive!";
        }

        if (isset($_POST['heal']) && isset($_POST['hunterId'])) {
            if ($_POST['heal'] < 0)
                $this->data['error'] = "Nice try...";
            else {
                if ($user->costFood($_POST['heal']))
                    Hunter::heal($_POST['heal'], $_POST['hunterId']);
                else
                    $this->data['error'] = "Not enough food for healing!";
            }
        }

        $myHunters = $user->getMyHunters();
        $this->data['myHunters'] = $myHunters;

        if (isset($_GET['page']))
            $page = $_GET['page'];
        else
            $_GET['page'] = $page = 1;

        $allHunters = Db::queryAll('SELECT COUNT(murder.hunterId) as kills, hunter.user, hunter.id, hunter.name, hunter.ability
            FROM murder
            LEFT JOIN hunter  ON murder.hunterId=hunter.id
            WHERE murder.type = "1"
            GROUP BY hunter.user, hunter.id, hunter.name, hunter.ability
            ORDER BY kills DESC LIMIT ?, 8', [($page-1)*8]);
        $this->data['allHunters'] = $allHunters;

        $this->view = 'hunterOverview';
    }
}