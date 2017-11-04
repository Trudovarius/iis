<?php

/*
 *	       __          __                __            
 *	  ____/ /__ _   __/ /_  ____  ____  / /__ _________
 *	 / __  / _ \ | / / __ \/ __ \/ __ \/ //_// ___/_  /
 *	/ /_/ /  __/ |/ / /_/ / /_/ / /_/ / ,< _/ /__  / /_
 *	\__,_/\___/|___/_.___/\____/\____/_/|_(_)___/ /___/
 *                                                   
 *                                                           
 *      TUTORIÁLY  <>  DISKUZE  <>  KOMUNITA  <>  SOFTWARE
 * 
 *	Tento zdrojový kód je souèástí tutoriálù na programátorské 
 *	sociální síti WWW.DEVBOOK.CZ	
 *	
 *	Kód mùžete upravovat jak chcete, jen zmiòte odkaz 
 *	na www.devbook.cz :-) 
 */

// Controller pro zpracování èlánku

class ErrorController extends Controller
{
    public function handle($parameters)
    {
		// Hlavièka požadavku
		header("HTTP/1.0 404 Not Found");
		// Hlavièka stránky
		$this->header['title'] = 'Chyba 404';
		// Nastavení šablony
		$this->view = 'chyba';
    }
}