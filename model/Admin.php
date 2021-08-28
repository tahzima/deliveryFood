<?php
require_once "connection.php";

class Admin
{
	public $idAdmin;
	public $nom;
	public $prenom;
	public $cin;
	public $telephone;
	public $email;
	public $password;
	static private $table="admin";

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
		
		return $this->db->insert(self::$table,["nom","prenom","cin","telephone","email","password"], [$this->nom,$this->prenom,$this->cin,$this->telephone,$this->email,$this->password]);
	}

	function save()
	{
		
		return $this->db->update(self::$table,["nom","prenom","cin","telephone","email","password"], [$this->nom,$this->prenom,$this->cin,$this->telephone,$this->email,$this->password],$this->idAdmin,'idAdmin');
	}

	function delete()
	{
		
		return $this->db->delete(self::$table,'idAdmin', $this->idAdmin);
	}

}