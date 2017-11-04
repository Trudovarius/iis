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

// Wrapper pro snadnější práci s databází s použitím PDO a automatickýmail
// zabezpečením parametrů (proměnných) v dotazech.

class Db {

	// Databázové spojení
    private static $connection;

	// Výchozí nastavení ovladače
    private static $settings = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_EMULATE_PREPARES => false,
	);

	// Připojí se k databázi pomocí daných údajů
    public static function connect($host, $user, $password, $database) {
		if (!isset(self::$connection)) {
			self::$connection = @new PDO(
				"mysql:host=$host;dbname=$database",
				$user,
				$password,
				self::$settings
			);
		}
	}
	
	// Spustí dotaz a vrátí z něj první řádek
    public static function queryOne($query, $parameters = array()) {
		$result = self::$connection->prepare($query);
		$result->execute($parameters);
		return $result->fetch();
	}

	// Spustí dotaz a vrátí všechny jeho řádky jako pole asociativních polí
    public static function queryAll($query, $parameters = array()) {
		$result = self::$connection->prepare($query);
		$result->execute($parameters);
		return $result->fetchAll();
	}
	
	// Spustí dotaz a vrátí z něj první sloupec prvního řádku
    public static function querySingle($query, $parameters = array()) {
		$result = self::queryOne($query, $parameters);
		return $result[0];
	}
	
	// Spustí dotaz a vrátí počet ovlivněných řádků
	public static function query($query, $parameters = array()) {
		$result = self::$connection->prepare($query);
		$result->execute($parameters);
		return $result->rowCount();
	}
	
}