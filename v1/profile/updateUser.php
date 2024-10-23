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
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
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


    ////////////// este archivo sirve para guardar los datos de las viviendas que se van a mostrar en la app /////////
    //$sql="insert into tbl_personal(nombres,apellidos,profesion,estado,fregis) values(:nombres,:apellidos,:profesion,:estado,:fregis)";

    $sql="UPDATE users SET name=:name,last_name=:last_name,phone=:phone,email=:email,password=:password,image=:imagen WHERE id_user=:id_user";
   
    $sql = $connect->prepare($sql);
  
    $sql->bindParam(':id_user',$id_user,PDO::PARAM_INT, 25);
    $sql->bindParam(':name',$name,PDO::PARAM_STR, 255);
    $sql->bindParam(':last_name',$last_name,PDO::PARAM_STR,255);
    $sql->bindParam(':email',$email,PDO::PARAM_STR,255);
    $sql->bindParam(':phone',$phone,PDO::PARAM_STR,255);
    $sql->bindParam(':imagen',$imagen,PDO::PARAM_STR,255);
    $sql->bindParam(':password',$password,PDO::PARAM_STR,255);
    
    $sql->execute();
    //echo 'entro'; exit();
    $cuenta = $sql->rowCount();
    if($sql->rowCount() > 0){


        //**  */
        $query = "SELECT  id_user,name,last_name,phone,email,version as version_, enable as enable_,rol_user,created,image,
        politica_accepted,password as pss
        FROM users  WHERE id_user=:id_user";
    
        $querys =$connect -> prepare($query); 
        $querys -> bindParam(':id_user',$id_user,PDO::PARAM_INT, 25);
        $querys -> execute(); 
        $results_s = $querys -> fetchAll(PDO::FETCH_OBJ); 

        if($querys -> rowCount() > 0)  
        { 
            foreach($results_s as $result_s) 
            {
                $json=array('Respuesta'=>'Ok','Msg'=>'Actualización Exitosa','nombre'=> $result_s->name,'celular'=>$result_s->phone,
                'id_usuario'=>$result_s->id_user,'rol_user'=>$result_s->rol_user,'fecha_creacion'=>$result_s->created,
                'imagen'=>$result_s->image,'correo'=>$result_s->email,'tkn'=>$token,'politica_aceptada'=>$result_s->politica_accepted,
                 'apellidos'=>$result_s->last_name,'pss'=>$result_s->pss);
            }
        }
    

        /**  */
       // $json=array('Respuesta'=>'Ok','Msg'=>'Registro Exitoso','code'=>200,'last_id'=>$lastInsertId,'error'=>'false');
    }
    else{

        $json=array('Respuesta'=>'Error','Msg'=>'Ocurrio un error al crear su cuenta','code'=>200,'last_id'=>0,'error'=>$sql->errorInfo());

    

    }// Cierra envio de guardado
    //echo json_encode($json);

    

    echo json_encode($json);
}
   
?>