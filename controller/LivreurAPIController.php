<?php
require_once "model/Livreur.php";
class LivreurAPIController
{

	function index()
	{
		$livreurs=Livreur::getAll();
		// On envoie le code réponse 200 OK
        http_response_code(200);
		foreach($livreurs as $rows)
		$livreur[]=$rows;

        // On encode en json et on envoie
        echo json_encode($livreur);
		
	}

	function add()
	{
		// On récupère les informations envoyées
    	$data = json_decode(file_get_contents("php://input"));

    	$livreur=new Livreur();

		if(!empty($data->nom) && !empty($data->prenom) && !empty($data->cin) && !empty($data->telephone) && !empty($data->email) && !empty($data->password) && !empty($data->idAdmin))
		{
			$livreur->nom=$data->nom;
			$livreur->prenom=$data->prenom;
			$livreur->cin=$data->cin;
			$livreur->telephone=$data->telephone;
			$livreur->email=$data->email;
			$livreur->password=$data->password;
			$livreur->idAdmin=$data->idAdmin;
			$value=$livreur->create();
			 if($value)
			{
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué --- ".$value]);
	        }else
	        {
	            // Ici la création n'a pas fonctionné
	            // On envoie un code 503
	            http_response_code(503);
	            echo json_encode(["message" => "L'ajout n'a pas été effectué --- ".$value]);         
	        }
		}else
		{
			// On gère l'erreur
		    http_response_code(405);
		    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
		}
	}

	function update()
	{
		// On récupère les informations envoyées
    	$data = json_decode(file_get_contents("php://input"));

    	$livreur=new Livreur();

		if((!empty($data->idLivreur)) && (!empty($data->dateCommande) || !empty($data->confirmation) || !empty($data->idClient) || !empty($data->idLivreur)))
		{
			$livreur->idLivreur=$data->idLivreur;
			$livreur->nom=$data->nom;
			$livreur->prenom=$data->prenom;
			$livreur->cin=$data->cin;
			$livreur->telephone=$data->telephone;
			$livreur->email=$data->email;
			$livreur->password=$data->password;
			$livreur->idAdmin=$data->idAdmin;
			$value=$livreur->save();
			 if($value)
			{
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "La modification a été effectué --- ".$value]);
	        }else
	        {
	            // Ici la création n'a pas fonctionné
	            // On envoie un code 503
	            http_response_code(503);
	            echo json_encode(["message" => "La modification n'a pas été effectué --- ".$value]);         
	        }
		}else
		{
			// On gère l'erreur
		    http_response_code(405);
		    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
		}
	}

	function delete()
	{
		// On récupère les informations envoyées
    	$data = json_decode(file_get_contents("php://input"));

    	$livreur=new Livreur();

		if(!empty($data->idLivreur))
		{
			$livreur->idLivreur=$data->idLivreur;
			$value=$livreur->delete();
			 if($value)
			{
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "La suppression a été effectué --- ".$value]);
	        }else
	        {
	            // Ici la création n'a pas fonctionné
	            // On envoie un code 503
	            http_response_code(503);
	            echo json_encode(["message" => "La suppression n'a pas été effectué --- ".$value]);         
	        }
		}else
		{
			// On gère l'erreur
		    http_response_code(405);
		    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
		}
	}
}