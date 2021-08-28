<?php
require_once "model/Preparer.php";
class PreparerAPIController
{

	function index()
	{
		$preparers=Preparer::getAll();
		// On envoie le code réponse 200 OK
        http_response_code(200);
		foreach($preparers as $rows)
		$preparer[]=$rows;

        // On encode en json et on envoie
        echo json_encode($preparer);
		
	}

	function add()
	{
		// On récupère les informations envoyées
    	$data = json_decode(file_get_contents("php://input"));

    	$preparer=new Preparer();

		if(!empty($data->prix) && !empty($data->idRestaurant) && !empty($data->idPlat))
		{
			$preparer->prix=$data->prix;
			$preparer->idRestaurant=$data->idRestaurant;
			$preparer->idPlat=$data->idPlat;
			$value=$preparer->create();
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

    	$preparer=new Preparer();

		if((!empty($data->idPreparer)) && (!empty($data->prix) || !empty($data->idRestaurant) || !empty($data->idPlat)))
		{
			$preparer->idPreparer=$data->idPreparer;
			$preparer->prix=$data->prix;
			$preparer->idRestaurant=$data->idRestaurant;
			$preparer->idPlat=$data->idPlat;
			$value=$preparer->save();
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

    	$preparer=new Preparer();

		if(!empty($data->idPreparer))
		{
			$preparer->idPreparer=$data->idPreparer;
			$value=$preparer->delete();
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