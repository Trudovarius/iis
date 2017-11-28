<?php
session_start();
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
 *	Tento zdrojový kód je součástí tutoriálů na programátorské 
 *	sociální síti WWW.DEVBOOK.CZ	
 *	
 *	Kód můžete upravovat jak chcete, jen zmiňte odkaz 
 *	na www.devbook.cz :-) 
 */

// Automatické odhlásenie o 30 minútach
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['admin']) && (time() - $_SESSION['admin'] > 360)) {
    session_unset($_SESSION['admin']);
}
$_SESSION['admin'] = time();

// Nastavení interního kódování pro funkce pro práci s řetězci
mb_internal_encoding("UTF-8");

// Pripojenie suboru s pomocnymi funkciami
require_once('functions.php');

// Callback pro automatické načítání tříd controllerů a modelů
function autoloadFunction($class)
{
	// Končí název třídy řetězcem "Kontroler" ?
    if (preg_match('/Controller$/', $class))	
        require("controller/" . $class . ".php");
    else
        require("model/" . $class . ".php");
}

// Registrace callbacku (Pod starým PHP 5.2 je nutné nahradit fcí __autoload())
spl_autoload_register("autoloadFunction");

// Připojení k databázi
Db::connect("127.0.0.1", "root", "", "iis");


// Vytvoření routeru a zpracování parametrů od uživatele z URL
$router = new RouterController();
$router->handle(array($_SERVER['REQUEST_URI']));
// Vyrenderování šablony
$router->writeView();