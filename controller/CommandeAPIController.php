<?php
require_once "model/Commande.php";
class CommandeAPIController
{

	function index()
	{
		$commandes=Commande::getAll();
		// On envoie le code réponse 200 OK
        http_response_code(200);
		foreach($commandes as $rows)
		$commande[]=$rows;

        // On encode en json et on envoie
        echo json_encode($commande);
		
	}

	function add()
	{
		// On récupère les informations envoyées
    	$data = json_decode(file_get_contents("php://input"));

    	$commande=new Commande();

		if(!empty($data->dateCommande) && !empty($data->confirmation) && !empty($data->idClient) && !empty($data->idLivreur))
		{
			$commande->dateCommande=$data->dateCommande;
			$commande->confirmation=$data->confirmation;
			$commande->idClient=$data->idClient;
			$commande->idLivreur=$data->idLivreur;
			$value=$commande->create();
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

    	$commande=new Commande();

		if((!empty($data->idCommande)) && (!empty($data->dateCommande) || !empty($data->confirmation) || !empty($data->idClient) || !empty($data->idLivreur)))
		{
			$commande->idCommande=$data->idCommande;
            $commande->dateCommande=$data->dateCommande;
			$commande->confirmation=$data->confirmation;
			$commande->idClient=$data->idClient;
			$commande->idLivreur=$data->idLivreur;
			$value=$commande->save();
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

    	$commande=new Commande();

		if(!empty($data->idCommande))
		{
			$commande->idCommande=$data->idCommande;
			$value=$commande->delete();
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