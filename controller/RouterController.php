<?php

// Router je speciální typ controlleru, který podle URL adresy zavolá
// správný controller a jím vytvořený pohled vloží do šablony stránky

class RouterController extends Controller
{
	// Instance controlleru
	protected $controller;
	
	// Metoda převede pomlčkovou variantu controlleru na název třídy
	private function dashToCamelCase($text) 
	{
		$word = str_replace('-', ' ', $text);
		$word = ucwords($word);
		$word = str_replace(' ', '', $word);
		return $word;
	}
	
	// Naparsuje URL adresu podle lomítek a vrátí pole parametrů
	private function parseURL($url)
	{
		// Naparsuje jednotlivé části URL adresy do asociativního pole
        $parsedURL = parse_url($url);
		// Odstranění počátečního lomítka
		$parsedURL["path"] = ltrim($parsedURL["path"], "/");
		// Odstranění bílých znaků kolem adresy
		$parsedURL["path"] = trim($parsedURL["path"]);
		// Rozbití řetězce podle lomítek
		$splitPath = explode("/", $parsedURL["path"]);
		return $splitPath;
	}

    // Naparsování URL adresy a vytvoření příslušného controlleru
    public function handle($parameters)
    {
		$parsedURL = $this->parseURL($parameters[0]);
				

		if (empty($parsedURL[1]))		
			$this->redirect('iis/home');

		$iis = array_shift($parsedURL);
		// kontroler je 1. parametr URL
		$controllerClass = $this->dashToCamelCase(array_shift($parsedURL)) . 'Controller';
		
		if (file_exists('controller/' . $controllerClass . '.php'))
			$this->controller = new $controllerClass;
		else
			$this->redirect('iis/error');
		
		// Volání controlleru
        $this->controller->handle($parsedURL);
		
		// Nastavení proměnných pro šablonu
		$this->data['title'] = $this->controller->header['title'];
		$this->data['decsription'] = $this->controller->header['description'];
		$this->data['keywords'] = $this->controller->header['keywords'];
		
		// Nastavení hlavní šablony
		$this->view = 'template';
    }

}