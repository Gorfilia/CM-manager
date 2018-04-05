<?php
namespace Croquemonster\Model;

class Monster {
	private $id="2";
    private $name="Nom du monstre";

    private $sadism="Sadisme";
    private $ugliness="Laideur";
    private $power="Force";
    private $greediness="Gourmandise";
    private $control="Contrôle";
    private $fight="Combat";
    private $endurance="Endurance";
    private $bounty="Prime";

    public function __construct($id) {
    	$this->id = $id;
    }
}