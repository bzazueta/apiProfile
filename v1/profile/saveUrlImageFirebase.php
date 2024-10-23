<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../conexion_.php';
require_once __DIR__ . '/../auth/Auth.php';

try{

    $timestamp = time();
    $date_time = date("Y-m-d H:i:s", $timestamp);

    $id_user = $_POST['id_user'];
    $url = $_POST['url'];
   

    
    $sql="UPDATE user_profile SET image=:imagen WHERE id=:id_user";
   
    $sql = $connect->prepare($sql);
  
    $sql->bindParam(':id_user',$id_user,PDO::PARAM_INT, 25);
    $sql->bindParam(':imagen',$url,PDO::PARAM_STR,255);
   
    
    $sql->execute();
    //echo 'entro'; exit();
    $cuenta = $sql->rowCount();
    if($sql->rowCount() > 0){
        $json=array('Respuesta'=>'Ok','Msg'=>'Se ha guardado la imagen','code'=>200,'last_id'=>0,'error'=>'');
    }
    else{

        $json=array('Respuesta'=>'Error','Msg'=>'Ocurrio un error al realizar la actualización','code'=>200,'last_id'=>0,'error'=>'Ocurrio un error al realizar la actualización');

    }// Cierra envio de guardado
    
}catch (MySQLDuplicateKeyException $e) {
    // duplicate entry exception
   //echo $e->getMessage();
   $json=array('Respuesta'=>'Error','Msg'=>'Ocurrio un error al crear su cuenta','code'=>500,'last_id'=>0,'error'=>$e->getMessage());

}
catch (MySQLException $e) {
    // other mysql exception (not duplicate key entry)
  // echo $e->getMessage();
   $json=array('Respuesta'=>'Error','Msg'=>'Ocurrio un error al crear su cuenta','code'=>500,'last_id'=>0,'error'=>$e->getMessage());

}
catch (Exception $e) {
    // not a MySQL exception
  //echo  $e->getMessage();
  $json=array('Respuesta'=>'Error','Msg'=>'Ocurrio un error al crear su cuenta','code'=>500,'last_id'=>0,'error'=>$e->getMessage());

}

    echo json_encode($json);

   
?>