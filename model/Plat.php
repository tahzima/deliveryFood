<?php
require_once "connection.php";

class Plat
{
	public $idPlat;
	public $nom;
	public $image;
	public $categorie;
	static private $table="plat";

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
		
		return $this->db->insert(self::$table,["nom","image","categorie"], [$this->nom,$this->image,$this->categorie]);
	}

	function save()
	{
		
		return $this->db->update(self::$table,["nom","image","categorie"], [$this->nom,$this->image,$this->categorie] ,$this->idPlat,'idPlat');
	}

	function delete()
	{
		
		return $this->db->delete(self::$table,'idPlat', $this->idPlat);
	}

}