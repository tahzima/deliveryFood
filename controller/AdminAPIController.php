<?php
require_once "model/Admin.php";
class AdminAPIController
{

	function index()
	{
		$admins=Admin::getAll();
		// On envoie le code réponse 200 OK
        http_response_code(200);
		foreach($admins as $rows)
		$admin[]=$rows;

        // On encode en json et on envoie
        echo json_encode($admin);
		
	}

	function add()
	{
		// On récupère les informations envoyées
    	$data = json_decode(file_get_contents("php://input"));

    	$admin=new Admin();

		if(!empty($data->nom) && !empty($data->prenom) && !empty($data->cin) && !empty($data->telephone) && !empty($data->email) && !empty($data->password))
		{
			$admin->nom=$data->nom;
			$admin->prenom=$data->prenom;
			$admin->cin=$data->cin;
			$admin->telephone=$data->telephone;
			$admin->email=$data->email;
			$admin->password=$data->password;
			$value=$admin->create();
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

    	$admin=new Admin();

		if((!empty($data->idAdmin)) && (!empty($data->nom) || !empty($data->prenom) || !empty($data->role) || !empty($data->adresse) || !empty($data->telephone) || !empty($data->email) || !empty($data->password)))
		{
			$admin->idAdmin=$data->idAdmin;
			$admin->nom=$data->nom;
			$admin->prenom=$data->prenom;
			$admin->cin=$data->cin;
			$admin->telephone=$data->telephone;
			$admin->email=$data->email;
			$admin->password=$data->password;
			$value=$admin->save();
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

    	$admin=new Admin();

		if(!empty($data->idAdmin))
		{
			$admin->idAdmin=$data->idAdmin;
			$value=$admin->delete();
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
	// function connect()
	// {
	// 	// On récupère les informations envoyées
    // 	$data = json_decode(file_get_contents("php://input"));

    // 	$admin=new Admin();

	// 	if(!empty($data->email) && !empty($data->password))
	// 	{
	// 		$admin->email=$data->email;
	// 		$admin->password=$data->password;

	// 		$values=$admin->auth();
	// 		// foreach($values as $rows)
	// 		// 	$admins[]=$rows;
			
	// 		echo json_encode($values);
	// 		// if($value)
	// 		// {
    //         // // Ici la création a fonctionné
    //         // // On envoie un code 201
    //         // http_response_code(201);
    //         // echo json_encode(["message" => $value]);
	//         // }else
	//         // {
	//         //     // Ici la création n'a pas fonctionné
	//         //     // On envoie un code 503
	//         //     http_response_code(503);
	//         //     echo json_encode(["message" => $value]);         
	//         // }
	// 	}else
	// 	{
	// 		// On gère l'erreur
	// 	    http_response_code(405);
	// 	    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
	// 	}
	// }
}