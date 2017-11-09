<?php

class OutpostController extends Controller
{
    public function handle($parameters)
    {
        if (isLoggedIn()) {
            $user = new User($_SESSION['user']);
            $user->setId();

            // Nastavení proměnných pro šablonu
            $this->header['title'] = "IIS Outpost";
            $this->header['description'] = "Site for managing outposts and hunters.";
            $this->header['keywords'] = ["iis", "outpost"];

            if (isset($parameters[0])) {
                if ($parameters[0] == 'detail') {

                    $outpost = Outpost::getOutpostById($parameters[1]);
                    $this->data['outpost'] = $outpost;

                    $this->data['myHunters'] = $user->getMyHunters();
                    $this->data['outpostHunters'] = Outpost::getHuntersByOutpostId($outpost['id']);

                    // Spracovanie formulára
                    // Overenie či je v stanovišti dostatok miesta
                    // Lovec s daným ID prestane byť dostupný, uloží sa číslo stanovišťa, zvýši sa počet lovcov na stanovišti
                    if (isset($_POST['hunterId'])) {
                        if ($outpost['capacity'] > $outpost['hunterCount']) {
                            Hunter::setOutpost($_POST['hunterId'], $outpost['id']);
                            $this->redirect('iis/outpost/detail/'.$parameters[1]);
                        }
                    }

                    if (isset($_POST['removeHunter'])) {
                        Hunter::unsetOutpost($_POST['removeHunter'], $outpost['id']);
                        $this->redirect('iis/outpost/detail/'.$parameters[1]);
                    }

                    $this->view = 'outpost';
                }
            }
        }
    }
}