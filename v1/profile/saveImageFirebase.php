<?php
echo 'entro';
header('Content-Type: application/json');
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../conexion_.php';
require_once __DIR__ . '/../auth/Auth.php';

    echo 'entro';
    $timestamp = time();
    $date_time = date("Y-m-d H:i:s", $timestamp);

    $id_user = $_POST['id_user'];
    $url = $_POST['url'];
   
     echo $id_user;
    
    $sql="UPDATE user_profile SET image=:imagen WHERE id=:id_user";
   
    $sql = $connect->prepare($sql);
  
    $sql->bindParam(':id_user',$id_user,PDO::PARAM_INT, 25);
    $sql->bindParam(':imagen',$imagen,PDO::PARAM_STR,255);
   
    
    $sql->execute();
    //echo 'entro'; exit();
    $cuenta = $sql->rowCount();
    if($sql->rowCount() > 0){
        $json=array('Respuesta'=>'Ok','Msg'=>'Actualización Exitosa');
    }
    else{

        $json=array('Respuesta'=>'Error','Msg'=>'Ocurrio un error al crear su cuenta','code'=>200,'last_id'=>0,'error'=>$sql->errorInfo());

    }// Cierra envio de guardado
    //echo json_encode($json);

    echo json_encode($json);

   
?>