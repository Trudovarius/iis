<?php

class HomeController extends Controller
{
    public function handle($parameters)
    {
		// Nastavení proměnných pro šablonu
		$this->header['title'] = "IIS Home";
		$this->header['description'] = "Homepage of IIS project.";
		$this->header['keywords'] = ["iis", "home"];
		
		// Nastavení hlavní šablony
		$this->view = 'home';
    }
}