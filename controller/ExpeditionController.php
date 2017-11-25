<?php

class ExpeditionController extends Controller
{
    public function handle($parameters)
    {
        // Nastavení proměnných pro šablonu
        $this->header['title'] = "IIS Expeditions";
        $this->header['description'] = "Site for managing expeditions.";
        $this->header['keywords'] = ["iis", "expedition", "kill", "mammoths"];

        if (!isLoggedIn()) {
	       $this->redirect('iis/error');
        } else {
            if (isset($parameters[0]) && $parameters[0] == 'create') {
                $this->create();
            }
        }
    }

    // Vytvaranie expedicie
    public function create() {
        
        if (isset($_POST['report'])) {
            $user = new User($_SESSION['user']);


            if (isset($_POST['pitId']) && isset($_POST['hunterId'])) {
                $expedition = new Expedition($user->getId());
                $expedition->setHunters($_POST['hunterId']);
                $expedition->setReport($_POST['report']);
                $expedition->setPit($_POST['pitId']);
                $expedition->setStatus('In progress');
                $expedition->setSuccess(0);
                $expedition->setFinishTime(Report::getReportById($_POST['report'])['mammothCount']);
                $expedition->insertToDb();

                $this->redirect('iis/home');
            }

            $this->data['report'] = Report::getReportById($_POST['report']);
            $this->data['hunters'] = $user->getMyHunters();
            $this->data['pits'] = $user->getMyPits();

        } else {
            $this->redirect('iis/home');
        }
        $this->view = 'expeditionCreate';
    }
}