<?php
require_once "connection.php";

class Restaurant
{
	public $idRestaurant;
	public $nom;
	public $telephone;
	public $adresse;
	public $menu;
	static private $table="restaurant";

	function __construct()
	{
		$this->db = new Connection();
	}

	static function getAll()
	{
		$db = new Connection();
		return $db->select(self::$table);
	}

	function create()
	{
		
		return $this->db->insert(self::$table,["nom","telephone","adresse","menu"], [$this->nom,$this->telephone,$this->adresse,$this->menu]);
	}

	function save()
	{
		
		return $this->db->update(self::$table,["nom","telephone","adresse","menu"], [$this->nom,$this->telephone,$this->adresse,$this->menu] ,$this->idRestaurant,'idRestaurant');
	}

	function delete()
	{
		
		return $this->db->delete(self::$table,'idRestaurant', $this->idRestaurant);
	}

}