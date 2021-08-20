<?php
require_once "connection.php";

class Users
{
	public $idUser;
	public $nom;
	public $prenom;
	public $role;
	public $adresse;
	public $telephone;
	public $email;
	public $password;
	static private $table="users";

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
		
		return $this->db->insert(self::$table,["nom","prenom","role","adresse","telephone","email","password"], [$this->nom,$this->prenom,$this->role,$this->adresse,$this->telephone,$this->email,$this->password]);
	}

	function save()
	{
		
		return $this->db->update(self::$table,["nom","prenom","role","adresse","telephone","email","password"], [$this->nom,$this->prenom,$this->role,$this->adresse,$this->telephone,$this->email,$this->password],$this->idUser,'idUser');
	}

	function delete()
	{
		
		return $this->db->delete(self::$table,'idUser', $this->idUser);
	}

}