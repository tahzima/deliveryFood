<?php
require_once "model/Client.php";
class ClientAPIController
{

	function index()
	{
		$clients=Client::getAll();
		// On envoie le code réponse 200 OK
        http_response_code(200);
		foreach($clients as $rows)
		$client[]=$rows;

        // On encode en json et on envoie
        echo json_encode($client);
		
	}

	function add()
	{
		// On récupère les informations envoyées
    	$data = json_decode(file_get_contents("php://input"));

    	$clinet=new Client();

		if(!empty($data->nom) && !empty($data->prenom) && !empty($data->cin) && !empty($data->telephone) && !empty($data->email) && !empty($data->password))
		{
			$clinet->nom=$data->nom;
			$clinet->prenom=$data->prenom;
			$clinet->cin=$data->cin;
			$clinet->telephone=$data->telephone;
			$clinet->email=$data->email;
			$clinet->password=$data->password;
			$value=$clinet->create();
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

    	$client=new Client();

		if((!empty($data->idClient)) && (!empty($data->nom) || !empty($data->prenom) || !empty($data->role) || !empty($data->adresse) || !empty($data->telephone) || !empty($data->email) || !empty($data->password)))
		{
			$client->idClient=$data->idClient;
			$client->nom=$data->nom;
			$client->prenom=$data->prenom;
			$client->cin=$data->cin;
			$client->telephone=$data->telephone;
			$client->email=$data->email;
			$client->password=$data->password;
			$value=$client->save();
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

    	$client=new Client();

		if(!empty($data->idClient))
		{
			$client->idClient=$data->idClient;
			$value=$client->delete();
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