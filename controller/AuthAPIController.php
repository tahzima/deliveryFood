<?php
require_once "model/Admin.php";
require_once "model/Client.php";
require_once "model/Livreur.php";
class AuthAPIController
{

	function index()
	{
        $data = json_decode(file_get_contents("php://input"));

        $myAdmin=new Admin();
        $myClient=new Client();
        $myLivreur=new Livreur();

        if(!empty($data->email) && !empty($data->password)){
            $myAdmin->email=$data->email;
			$myAdmin->password=$data->password;
            $rets=$myAdmin->connectUsers();
            foreach($rets as $rows)
                $admin[]=$rows;
                
            if($admin == null){
                $myClient->email=$data->email;
                $myClient->password=$data->password;
                $rets=$myClient->connectUsers();
                foreach($rets as $rows)
                    $client[]=$rows;

                if($client == null){
                    $myLivreur->email=$data->email;
                    $myLivreur->password=$data->password;
                    $rets=$myLivreur->connectUsers();
                    foreach($rets as $rows)
                        $livreur[]=$rows;
                    if($livreur == null){
                        echo "introuvable";
                    }else{
                        // On encode en json et on envoie
                        echo json_encode($livreur);
                    }
                }else{
                    // On encode en json et on envoie
                    echo json_encode($client);
                }
            }else{
                // On encode en json et on envoie
                echo json_encode($admin);
            }
        }
	}

}