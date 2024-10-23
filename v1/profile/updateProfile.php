<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../conexion_.php';
require_once __DIR__ . '/../auth/Auth.php';
$headers = apache_request_headers();
$token = str_replace('Bearer ', '', $headers['Authorization']);
// echo $token;

$Auth = new Auth();

$tokenDecoded = $Auth->decodeToken($token);

if ($tokenDecoded !== true) {
    // Cuando el token no es válido...
    //$response = array('Respuesta' => 'Error', 'Msg' => $tokenDecoded);
    //echo json_encode($response);
    $json=array('Respuesta'=>'Error','Msg'=>$tokenDecoded,'code'=>201,'last_id'=>0,'error'=>'Error al autenticar con token');
    echo json_encode($json);
   // die();
}
else
{

    $timestamp = time();
    $date_time = date("Y-m-d H:i:s", $timestamp);

    $id_user = $_POST['id_user'];
    $password = $_POST['pss'];
  
    
    

    if(empty($_FILES['image']['name']))
    {
    // echo 'entro';
        $imagen = 'not image';
    }
    else
    {
        $imagen = $_FILES['image']['name'];
        if(move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$imagen))
        {
             $imagen = 'https://monitodevs.com/apiHomart/v1/homart/uploads/'.$_FILES['image']['name'];
            $success=true;
        }
    }

    $sql="UPDATE users SET password=:password,image=:imagen WHERE id_user=:id_user";
   
    $sql = $connect->prepare($sql);
  
    $sql->bindParam(':id_user',$id_user,PDO::PARAM_INT, 25);
    $sql->bindParam(':imagen',$imagen,PDO::PARAM_STR,255);
    $sql->bindParam(':password',$password,PDO::PARAM_STR,255);
    
    $sql->execute();
    //echo 'entro'; exit();
    $cuenta = $sql->rowCount();
    if($sql->rowCount() > 0){

         $json=array('Respuesta'=>'Ok','Msg'=>'Registro Exitoso','code'=>200,'last_id'=>$lastInsertId,'error'=>'false');
    }
    else{

        $json=array('Respuesta'=>'Error','Msg'=>'Ocurrio un error al crear su cuenta','code'=>202,'last_id'=>0,'error'=>$sql->errorInfo());

    

    }// Cierra envio de guardado
    //echo json_encode($json);

    

    echo json_encode($json);
}
   
?>