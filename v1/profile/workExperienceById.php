<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../conexion_.php';
require_once __DIR__ . '/../auth/Auth.php';
$headers = apache_request_headers();
// $token = str_replace('Bearer ', '', $headers['Authorization']);
// // echo $token;

// $Auth = new Auth();

// $tokenDecoded = $Auth->decodeToken($token);

// if ($tokenDecoded !== true) {
//     //Cuando el token no es válido...
//     $json=array('Respuesta'=>'Error','Msg'=>$tokenDecoded,'code'=>201,'last_id'=>0,'error'=>'Error al autenticar con token');
//     echo json_encode($json);
//    die();
// }
// else
// {
    $id = $_POST['id'];
     /**work experience */
     $sql_work_experience = "SELECT * FROM work_experience_profile where id=:id";
     $query_work_experience = $connect -> prepare($sql_work_experience); 
     $query_work_experience->bindParam(':id',$id,PDO::PARAM_INT, 25);
     $query_work_experience -> execute(); 
     $results_work_experience = $query_work_experience -> fetchAll(PDO::FETCH_OBJ); 
     if($query_work_experience -> rowCount() > 0)   { 
         foreach($results_work_experience as $work_experience) { 

            ///***skills */
            $sql_work_experience_skills = "SELECT * FROM skills_workexperience_profile where id_work_experience=:id_work_experience";
            $query_work_experience_skills = $connect -> prepare($sql_work_experience_skills); 
            $query_work_experience_skills->bindParam(':id_work_experience',$id,PDO::PARAM_INT, 25);
            $query_work_experience_skills -> execute(); 
            $results_work_experience_skills = $query_work_experience_skills -> fetchAll(PDO::FETCH_OBJ); 
            if($query_work_experience_skills -> rowCount() > 0)   { 
                foreach($results_work_experience_skills as $work_experience_skills) {
                    $json_work_experience_skills[] = 
                    array('Respuesta'=>'Ok','id' => $work_experience_skills->id,
                    'id_work_experience'=> $work_experience_skills->id_work_experience,'image' =>$work_experience_skills->image,
                    'skill' => $work_experience_skills->skill,'description' =>$work_experience_skills->description);
                }
            }
            ///
          $json_work_experience = array('Respuesta'=>'Ok','id'=>$work_experience->id,'text1'=>$work_experience->text1,
          'company'=>$work_experience->company,'years'=>$work_experience->years,'dates'=>$work_experience->dates,
          'position'=>$work_experience->position,'image'=>$work_experience->image,'skills' => $json_work_experience_skills);   
         }

        echo json_encode($json_work_experience);
     }


//}

?>