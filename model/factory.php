<?php
namespace Croquemonster\Model;

class Factory {
	private static $collections = [
		'Contracts',
		'Monsters',
		'Agencies',
	];

	private static $instance = null;

	private function __construct() {
	}

	public static function create($uri, $className) {
		if (self::$instance === null) {
			self::$instance = new Factory();
		}

		if (!in_array($className, self::$collections)) {
			return self::$instance->createFromAttributes(new \SimpleXMLElement($uri), $className);
		}

		return self::$instance->createCollection(new \SimpleXMLElement($uri), $className);
	}

	private function createCollection(\SimpleXMLElement $simpleXml, string $className) {
		$collection = $this->createFromAttributes($simpleXml, $className);
		foreach ($simpleXml->children() as $key => $child) {
			$collection[] = $this->createFromAttributes($child, rtrim($className, 's'));
		}
		return $collection;
	}

	private function createFromAttributes(\SimpleXMLElement $simpleXml, string $className) {
		$properties = $this->getExistedPropertiesFromAttributes($simpleXml, $className);
		$parameters = $this->getConstructParameters($className);
		$args = [];

		// initialization constructor args
		foreach ($parameters as $key => $value) {
			echo $value->name . PHP_EOL;
			if (isset($properties[$value->name])) {
				$args[$key] = (string) $properties[$value->name];
			}
		}

		$reflectionClass = new \ReflectionClass(__NAMESPACE__ . '\\' . $className);
		return $reflectionClass->newInstanceArgs($args);
	}

	private function getConstructParameters(string $className) {
		$refMethod = new \ReflectionMethod(__NAMESPACE__ . '\\' . $className,  '__construct');
		return $refMethod->getParameters();
	}

	private function getExistedPropertiesFromAttributes(\SimpleXMLElement $simpleXml, string $className) : array {
		$properties = [];

		foreach($simpleXml->attributes() as $name => $value) {
			if (property_exists(__NAMESPACE__ . '\\' . $className, $name)) {
				$properties[$name] = $value;
			}
		}

		return $properties;
	}
}

/*$xml =<<<HEREDOC
<?xml version="1.0" encoding="UTF-8"?>
<agency
	id="ID agence"
	name="NOM agence"
	days="Nombre de jours de jeu"
	level="Niveau d'accréditation de l'agence"
	score="Score de l'agence"
	reputation="Réputation de l'agence"
	portails="Nombre de portails de l'agence"
	cities="Nombre de villes contrôlées par cette agence"
	monsters="Nombre de monstres dans cette agence"
	maxMonsters="Nombre de monstres maximum dans cette agence"
	scared="Nombre d'enfants effrayés par cette agence"
	devoured="Nombre d'enfants dévorés par cette agence"
	contractsA="Nombre de contrats abordables réussis"
	failedA="Nombre de contrats abordables ratés"
	contractsB="Nombre de contrats normaux réussis"
	failedB="Nombre de contrats normaux ratés"
	contractsC="Nombre de contrats difficiles réussis"
	failedC="Nombre de contrats difficiles ratés"
	contractsD="Nombre de contrats monstrueux réussis"
	failedD="Nombre de contrats monstrueux ratés"
	contractsE="Nombre de contrats infernaux réussis"
	failedE="Nombre de contrats infernaux ratés"
	syndicate="Nom de syndicat de l'agence si disponible"
	syndicateId="Identifiant du syndicat si disponible"

	gold="MonsterCrédits si PASS_API spécifié"
	mails="Nombre de messages privés non lus si PASS_API spécifié"
	fartBox="Emplacement de la fartBox si PASS_API spécifié"
	fartTotal="Niveau de la fartBox en cours de constitution si PASS_API spécifié"
>
<description><![CDATA[Présentation de l'agence en HTML brut (XHTML valide)]]></description>
</agency>
HEREDOC;*/
$xml =<<<HEREDOC
<monsters agency="NOM Agence" id="ID agence">
    <monster
        id="ID"
        name="Nom du monstre"

        sadism="Sadisme"
        ugliness="Laideur"
        power="Force"
        greediness="Gourmandise"
        control="Contrôle"
        fight="Combat"
        endurance="Endurance"
        bounty="Prime"

        successes="Statistique nombre de contrats réussis"
        failures="Statistique nombre de contrats ratés"
        devoured="Statistique nombre d'enfants dévorés"

        firePrize="Prix de revente du monstre"

        swfjs="Url script javascript permettant d'afficher le SWF du monstre"

        fatigue="Heures de fatigue"
        contract="ID contrat, n'apparaît pas si aucun contrat en cours"
        escort="ID contrat, n'apparaît pas si aucune escorte en cours"
        attack="ID attaque n'apparaît pas si aucune attaque en cours"
        racket="ID racket, n'apparaît pas si aucun racket en cours"
        propaganda="ID propagande, n'apparaît pas si aucune propagande en cours"
        match="ID match MBL, n'apparaît pas si aucun match en cours"

        permanentItems="Liste d'équipements permanents installés sur ce monstre
                        (identifiants équipement séparés par des virgules)"
        contractItems="Liste d'équipements temporaires installés sur ce monstre
                        (identifiants équipement séparés par des virgules)"

        watchSpas="Nombre de tickets SPAS autorisés pour la défense du tas,
                   n'apparaît pas si le monstre n'est pas d'astreinte."
    /> 	
</monsters>
HEREDOC;
require_once "monster.php";
require_once "collection.php";
require_once "monsters.php";
$class = Factory::create($xml, "Monsters");

var_dump($class);