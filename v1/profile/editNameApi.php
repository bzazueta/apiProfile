<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../conexion_.php';
require_once __DIR__ . '/../auth/Auth.php';
$headers = apache_request_headers();

    $id = $_POST['id'];
    $name = $_POST['name'];


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
             $imagen = 'https://monitodevs.com/apiProfile/v1/profile/uploads/'.$_FILES['image']['name'];
            $success=true;
        }
    }


    $sql="UPDATE crud_api_profile SET name=:name_,image=:imagen WHERE id=:id";
   
    $sql = $connect->prepare($sql);
  
    $sql->bindParam(':id',$id,PDO::PARAM_INT, 25);
    $sql->bindParam(':imagen',$imagen,PDO::PARAM_STR,255);
    $sql->bindParam(':name_',$name,PDO::PARAM_STR,255);
    
    $sql->execute();
    //echo 'entro'; exit();
    $cuenta = $sql->rowCount();
    if($sql->rowCount() > 0)
    {
         $json=array('response'=>'Ok','Msg'=>'Usuario actualizado','message'=>$lastInsertId);
    }
    else{

        $json=array('response'=>'Error','Msg'=>'Ocurrio un Error al actualizar','message'=>'');
    }
    
    echo json_encode($json);
    $conn->close();
?>