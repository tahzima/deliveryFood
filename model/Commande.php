<?php
require_once "connection.php";

class Commande
{
	public $idCommande;
	public $dateCommande;
	public $confirmation;
	public $idClient;
	public $idLivreur;
	static private $table="commande";

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
		
		return $this->db->insert(self::$table,["dateCommande","confirmation","idClient","idLivreur"], [$this->dateCommande,$this->confirmation,$this->idClient,$this->idLivreur]);
	}

	function save()
	{
		
		return $this->db->update(self::$table,["dateCommande","confirmation","idClient","idLivreur"], [$this->dateCommande,$this->confirmation,$this->idClient,$this->idLivreur] ,$this->idCommande,'idCommande');
	}

	function delete()
	{
		
		return $this->db->delete(self::$table,'idCommande', $this->idCommande);
	}

}