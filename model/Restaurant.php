<?php
require_once "connection.php";

class Restaurant
{
	public $idRestaurant;
	public $nom;
	public $adresse;
	public $telephone;
	public $idAdmin;
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
		
		return $this->db->insert(self::$table,["nom","adresse","telephone","idAdmin"], [$this->nom,$this->adresse,$this->telephone,$this->idAdmin]);
	}

	function save()
	{
		
		return $this->db->update(self::$table,["nom","adresse","telephone","idAdmin"], [$this->nom,$this->adresse,$this->telephone,$this->idAdmin] ,$this->idRestaurant,'idRestaurant');
	}

	function delete()
	{
		
		return $this->db->delete(self::$table,'idRestaurant', $this->idRestaurant);
	}

}