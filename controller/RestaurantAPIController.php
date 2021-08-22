<?php
require_once "model/Restaurant.php";
class RestaurantAPIController
{

	function index()
	{
		$restaurants=Restaurant::getAll();
		// On envoie le code réponse 200 OK
        http_response_code(200);
		foreach($restaurants as $rows)
		$restaurant[]=$rows;

        // On encode en json et on envoie
        echo json_encode($restaurant);
		
	}

	function add()
	{
		// On récupère les informations envoyées
    	$data = json_decode(file_get_contents("php://input"));

    	$restaurant=new Restaurant();

		if(!empty($data->nom) && !empty($data->telephone) && !empty($data->adresse) && !empty($data->menu))
		{
			$restaurant->nom=$data->nom;
			$restaurant->telephone=$data->telephone;
			$restaurant->adresse=$data->adresse;
			$restaurant->menu=$data->menu;
			$value=$restaurant->create();
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

    	$restaurant=new Restaurant();

		if((!empty($data->idRestaurant)) && (!empty($data->nom) || !empty($data->telephone) || !empty($data->adresse) || !empty($data->menu)))
		{
			$restaurant->idRestaurant=$data->idRestaurant;
			$restaurant->nom=$data->nom;
			$restaurant->telephone=$data->telephone;
			$restaurant->adresse=$data->adresse;
			$restaurant->menu=$data->menu;
			$value=$restaurant->save();
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

    	$restaurant=new Restaurant();

		if(!empty($data->idRestaurant))
		{
			$restaurant->idRestaurant=$data->idRestaurant;
			$value=$restaurant->delete();
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