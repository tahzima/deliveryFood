<?php
require_once "connection.php";

class LignCommande
{
	public $idLigneCommande;
	public $prixTT;
	public $confirmation;
	public $idUser;
	public $dateCmd;
	public $idCommande;
	static private $table="ligncommande";

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
		
		return $this->db->insert(self::$table,["prixTT","confirmation","idUser","idCommande"], [$this->prixTT,$this->confirmation,$this->idUser,$this->idCommande]);
	}

	function save()
	{
		
		return $this->db->update(self::$table,["idLigneCommande","prixTT","confirmation","idUser","idCommande"], [$this->idCommande,$this->dateCmd,$this->idRestaurant] ,$this->idCommande,'idCommande');
	}

	function delete()
	{
		
		return $this->db->delete(self::$table,'idCommande', $this->idCommande);
	}

}