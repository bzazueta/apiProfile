<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../conexion_.php';
require_once __DIR__ . '/../auth/Auth.php';
// $headers = apache_request_headers();
// $token = str_replace('Bearer ', '', $headers['Authorization']);
// // echo $token;

// $Auth = new Auth();

// $tokenDecoded = $Auth->decodeToken($token);

// if ($tokenDecoded !== true) {
//     // Cuando el token no es válido...
//     //$response = array('Respuesta' => 'Error', 'Msg' => $tokenDecoded);
//     //echo json_encode($response);
//     $json=array('Respuesta'=>'Error','Msg'=>$tokenDecoded,'code'=>201,'last_id'=>0,'error'=>'Error al autenticar con token');
//     echo json_encode($json);
//    // die();
// }
// else
// {

    $timestamp = time();
    $date_time = date("Y-m-d H:i:s", $timestamp);

    //$id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $option_user = $_POST['option_user'];
    $password = $_POST['password'];
    $version = $_POST['version'];
    
    

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



    ////////////// este archivo sirve para guardar los datos de las viviendas que se van a mostrar en la app /////////
    //$sql="insert into tbl_personal(nombres,apellidos,profesion,estado,fregis) values(:nombres,:apellidos,:profesion,:estado,:fregis)";

    $sql="INSERT INTO  users (name, last_name, phone, email ,tkn_firebase,tkn_jwt ,version,enable,password, rol_user,created, image, politica_accepted) 
                      VALUES (:name,:last_name,:phone,:email, null,null,:version,'true',:password,:option_user,:fecha_creacion,:imagen,'true')";
   
    $sql = $connect->prepare($sql);

    //$sql->bindParam(':id_user',$id_user,PDO::PARAM_INT, 25);
    $sql->bindParam(':name',$name,PDO::PARAM_STR, 255);
    $sql->bindParam(':last_name',$last_name,PDO::PARAM_STR,255);
    $sql->bindParam(':email',$email,PDO::PARAM_STR,255);
    $sql->bindParam(':phone',$phone,PDO::PARAM_STR,255);
    $sql->bindParam(':fecha_creacion',$date_time,PDO::PARAM_STR);
    $sql->bindParam(':option_user',$option_user,PDO::PARAM_STR);
    $sql->bindParam(':imagen',$imagen,PDO::PARAM_STR,255);
    $sql->bindParam(':password',$password,PDO::PARAM_STR,255);
    $sql->bindParam(':version',$version,PDO::PARAM_STR,255);
    
    $sql->execute();

    $lastInsertId = $connect->lastInsertId();
    if($lastInsertId>0){

        $json=array('Respuesta'=>'Ok','Msg'=>'Registro Exitoso','code'=>200,'last_id'=>$lastInsertId,'error'=>'false');
    }
    else{

        $json=array('Respuesta'=>'Error','Msg'=>'Ocurrio un error al crear su cuenta','code'=>200,'last_id'=>0,'error'=>$sql->errorInfo());

    

    }// Cierra envio de guardado
    //echo json_encode($json);

    
    $conn->close();
    echo json_encode($json);
//}
   
?>