<?php
require_once "model/Users.php";
class UsersAPIController
{

	function index()
	{
		$users=Users::getAll();
		// On envoie le code réponse 200 OK
        http_response_code(200);
		foreach($users as $rows)
		$user[]=$rows;

        // On encode en json et on envoie
        echo json_encode($user);
		
	}

	function add()
	{
		// On récupère les informations envoyées
    	$data = json_decode(file_get_contents("php://input"));

    	$user=new Users();

		if(!empty($data->nom) && !empty($data->prenom) && !empty($data->role) && !empty($data->adresse) && !empty($data->telephone) && !empty($data->email) && !empty($data->password))
		{
			$user->nom=$data->nom;
			$user->prenom=$data->prenom;
			$user->role=$data->role;
			$user->adresse=$data->adresse;
			$user->telephone=$data->telephone;
			$user->email=$data->email;
			$user->password=$data->password;
			$value=$user->create();
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

    	$user=new Users();

		if((!empty($data->idUser)) && (!empty($data->nom) || !empty($data->prenom) || !empty($data->role) || !empty($data->adresse) || !empty($data->telephone) || !empty($data->email) || !empty($data->password)))
		{
			$user->idUser=$data->idUser;
			$user->nom=$data->nom;
			$user->prenom=$data->prenom;
			$user->role=$data->role;
			$user->adresse=$data->adresse;
			$user->telephone=$data->telephone;
			$user->email=$data->email;
			$user->password=$data->password;
			$value=$user->save();
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

    	$user=new Users();

		if(!empty($data->idUser))
		{
			$user->idUser=$data->idUser;
			$value=$user->delete();
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