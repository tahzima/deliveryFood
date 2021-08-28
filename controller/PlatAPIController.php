<?php
require_once "model/Plat.php";
class PlatAPIController
{

	function index()
	{
		$plats=Plat::getAll();
		// On envoie le code réponse 200 OK
        http_response_code(200);
		foreach($plats as $rows)
		$plat[]=$rows;

        // On encode en json et on envoie
        echo json_encode($plat);
		
	}

	function add()
	{
		// On récupère les informations envoyées
    	$data = json_decode(file_get_contents("php://input"));

    	$plat=new Plat();

		if(!empty($data->nom) && !empty($data->image) && !empty($data->categorie))
		{
			$plat->nom=$data->nom;
			$plat->image=$data->image;
			$plat->categorie=$data->categorie;
			$value=$plat->create();
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

    	$plat=new Plat();

		if((!empty($data->idPlat)) && (!empty($data->nom) || !empty($data->image) || !empty($data->categorie)))
		{
			$plat->idPlat=$data->idPlat;
			$plat->nom=$data->nom;
			$plat->image=$data->image;
			$plat->categorie=$data->categorie;
			$value=$plat->save();
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

    	$plat=new Plat();

		if(!empty($data->idPlat))
		{
			$plat->idPlat=$data->idPlat;
			$value=$plat->delete();
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