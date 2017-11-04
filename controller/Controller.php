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
 *	Tento zdrojový kód je součástí tutoriálů na programátorské 
 *	sociální síti WWW.DEVBOOK.CZ	
 *	
 *	Kód můžete upravovat jak chcete, jen zmiňte odkaz 
 *	na www.devbook.cz :-) 
 */

// Výchozí kontroler pro DevbookMVC
abstract class Controller
{

	// Pole, jehož indexy jsou poté viditelné v šabloně jako běžné proměnné
    protected $data = array();
	// Název šablony bez přípony
    protected $view = "";
	// Hlavička HTML stránky
	protected $header = array('title' => '', 'keywords' => '', 'description' => '');

	// Ošetří proměnnou pro výpis do HTML stránky
	private function parse($x = null)
	{
		if (!isset($x))
			return null;
		elseif (is_string($x))
			return htmlspecialchars($x, ENT_QUOTES);
		elseif (is_array($x))
		{
			foreach($x as $k => $v)
			{
				$x[$k] = $this->parse($v);
			}
			return $x;
		}
		else 
			return $x;
	}
	
	// Vyrenderuje pohled
    public function writeView()
    {
        if ($this->view)
        {
            extract($this->parse($this->data));
			extract($this->data, EXTR_PREFIX_ALL, "");
            require("view/" . $this->view . ".phtml");
        }
    }
	
	// Přesměruje na dané URL
	public function redirect($url)
	{
		header("Location: /$url");
		header("Connection: close");
        exit;
	}

	// Hlavní metoda controlleru
    abstract function handle($parameters);

}