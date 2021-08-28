<?php
require_once "connection.php";

class Preparer
{
	public $idPreparer;
	public $prix;
	public $idRestaurant;
	public $idPlat;
	static private $table="preparer";

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
		
		return $this->db->insert(self::$table,["prix","idRestaurant","idPlat"], [$this->prix,$this->idRestaurant,$this->idPlat]);
	}

	function save()
	{
		
		return $this->db->update(self::$table,["prix","idRestaurant","idPlat"], [$this->prix,$this->idRestaurant,$this->idPlat] ,$this->idPreparer,'idPreparer');
	}

	function delete()
	{
		
		return $this->db->delete(self::$table,'idPreparer', $this->idPreparer);
	}

}