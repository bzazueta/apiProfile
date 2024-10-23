<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../conexion_.php';
require_once __DIR__ . '/../auth/Auth.php';
$headers = apache_request_headers();


$id  = $_POST['id'];
/**eliminar el regsitro de participante */
$sql = "DELETE FROM crud_api_profile WHERE id =:id ";
$sql = $connect->prepare($sql);

$sql->bindParam(':id',$id ,PDO::PARAM_INT, 25);
$sql->execute();
$lastInsertId = $connect->lastInsertId();

if($sql->rowCount() > 0)
{
    $json=array('response'=>'Ok','Msg'=>'Usuario Eliminado','message'=>$lastInsertId);
}
else{
    $json=array('response'=>'Error','Msg'=>'Ocurrio un Error al Eliminar la Cita','message'=>'');
}
echo json_encode($json);
$conn->close();
?>