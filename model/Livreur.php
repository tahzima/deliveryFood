<?php
require_once "connection.php";

class Livreur
{
	public $idLivreur;
	public $nom;
	public $prenom;
	public $cin;
	public $telephone;
	public $email;
	public $password;
	public $idAdmin;
	static private $table="livreur";

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
		
		return $this->db->insert(self::$table,["nom","prenom","cin","telephone","email","password","idAdmin"], [$this->nom,$this->prenom,$this->cin,$this->telephone,$this->email,$this->password,$this->idAdmin]);
	}

	function save()
	{
		
		return $this->db->update(self::$table,["nom","prenom","cin","telephone","email","password","idAdmin"], [$this->nom,$this->prenom,$this->cin,$this->telephone,$this->email,$this->password,$this->idAdmin],$this->idLivreur,'idLivreur');
	}

	function delete()
	{
		
		return $this->db->delete(self::$table,'idLivreur', $this->idLivreur);
	}

}