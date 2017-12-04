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
	       $this->redirect('error');
        } else {
            if (isset($parameters[0]) && $parameters[0] == 'create') {
                $this->create();
            } elseif (isset($parameters[0]) && $parameters[0] == 'detail') {
                $this->detail($parameters[1]);
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

                $this->redirect('home');
            }

            $this->data['report'] = Report::getReportById($_POST['report']);
            $this->data['hunters'] = $user->getMyHunters();
            $this->data['pits'] = $user->getMyPits();

        } else {
            $this->redirect('home');
        }
        $this->view = 'expeditionCreate';
    }

    // Detaily ohľadom expedicie
    public function detail($expId) {
        $expedition = Db::queryOne('SELECT * FROM expedition WHERE id = ?', [$expId]);
        $report = Db::queryOne('SELECT * FROM report WHERE id = ?', [$expedition['report']]);
        $mammoths = Db::queryAll('SELECT * FROM mammoth JOIN record ON mammoth.id=record.mammothId WHERE record.reportId = ?',[$report['id']]);
        $hunters = Db::queryAll('SELECT * FROM hunter JOIN expedition_member ON hunter.id=expedition_member.hunterId WHERE expeditionId = ?', [$expId]);

        $murders = Db::queryAll('SELECT * FROM murder LEFT JOIN mammoth ON murder.mammothId=mammoth.id LEFT JOIN hunter ON murder.hunterId=hunter.id WHERE date = ?', [$expedition['finishTime']]);



        $this->data['expedition'] = $expedition;
        $this->data['report'] = $report;
        $this->data['mammoths'] = $mammoths;
        $this->data['hunters'] = $hunters;
        $this->data['murders'] = $murders;

        $this->view = 'expeditionDetail';
    }
}