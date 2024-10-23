<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../conexion_.php';
require_once __DIR__ . '/../auth/Auth.php';
$headers = apache_request_headers();

$sql_crud_api = "SELECT * FROM url_ecommerce";
     $query_crud_api = $connect -> prepare($sql_crud_api); 
     $query_crud_api -> execute(); 
     $results_crud_api = $query_crud_api -> fetchAll(PDO::FETCH_OBJ); 
     if($query_crud_api -> rowCount() > 0)   
     { 
         foreach($results_crud_api as $crud_api) 
         { 
            $json_crud[]=array('id'=>$crud_api->id,'url'=>$crud_api->url);
        }

        $json=$json_crud;
     }
     else{
        $json=array('Respuesta'=>'Error','api_crud'=>[]);
    }
    echo json_encode($json);
    $conn->close();


?>