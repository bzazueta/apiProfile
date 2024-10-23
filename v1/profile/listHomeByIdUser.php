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
    $json=array('Respuesta'=>'Error','Msg'=>$tokenDecoded,'code'=>201,'last_id'=>0,'error'=>'Error al autenticar con token');
    echo json_encode($json);
   // die();
}
else
{

    $id_user = $_POST['id_user'];
  
    $sql = "SELECT * FROM homes WHERE id_user=:id_user";

    $query = $connect -> prepare($sql); 
    $query -> bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $query -> execute(); 
    $results = $query -> fetchAll(PDO::FETCH_OBJ); 
    if($query -> rowCount() > 0)   { 
        foreach($results as $result) { 
             $json['result'][]=array('Respuesta'=>'Ok','id_usuario'=>$result->id_user,'title'=>$result->title,
             'adress'=>$result->adress,'price'=>$result->price,'image'=>$result->image_home,'Msg'=>'','id_home'=>$result->id_home);
        }

       // echo json_encode($json);
    }
    else
    {
        $json['result'][]=array('Respuesta'=>'Error','Msg'=>'No cuentas con ninguna casa agregada');

    }

 echo json_encode($json);
}
?>