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
    // Cuando el token no es válido...
    // $json=array('Respuesta'=>'Error','Msg'=>$tokenDecoded,'code'=>201,'last_id'=>0,'error'=>'Error al autenticar con token');
    // echo json_encode($json);
   // die();
// }
// else
// {

    $json_contact_me= [];
    $json_work_experience= [];
    $json_frameworks_and_tecnology= [];

    $sql = "SELECT id,name,last_name,phone,email,years_experience,image FROM user_profile";
   
    $query = $connect -> prepare($sql); 
    
    $query -> execute(); 
    $results = $query -> fetchAll(PDO::FETCH_OBJ); 
    if($query -> rowCount() > 0)   { 
        foreach($results as $result) { 
            //echo $result->image;
            
                $sql_contact_me = "SELECT * FROM contactme_profile";
                $query_contact_me = $connect -> prepare($sql_contact_me); 
                $query_contact_me -> execute(); 
                $results_contact_me = $query_contact_me -> fetchAll(PDO::FETCH_OBJ); 
                if($query_contact_me -> rowCount() > 0)   { 
                    foreach($results_contact_me as $contact_me) { 
                        $json_contact_me[]=array('id_contact_me'=>$contact_me->id,'tecnology'=>$contact_me->tecnology,
                        'image'=>$contact_me->image);   
                }

                /**about me */
                $text1 ="";
                $text2 ="";
                $text3 ="";
                $sql_about_me = "SELECT * FROM about_me";
                $query_about_me = $connect -> prepare($sql_about_me); 
                $query_about_me -> execute(); 
                $results_about_me = $query_about_me -> fetchAll(PDO::FETCH_OBJ); 
                if($query_about_me -> rowCount() > 0)   { 
                    foreach($results_about_me as $about_me) { 
                        $text1 = $about_me->text1;  
                        $text2 = $about_me->text2; 
                        $text3 = $about_me->text3;  
                    }
                }

                /**work experience */
                $sql_work_experience = "SELECT * FROM work_experience_profile";
                $query_work_experience = $connect -> prepare($sql_work_experience); 
                $query_work_experience -> execute(); 
                $results_work_experience = $query_work_experience -> fetchAll(PDO::FETCH_OBJ); 
                if($query_work_experience -> rowCount() > 0)   { 
                    foreach($results_work_experience as $work_experience) { 
                     $json_work_experience [] = array('id'=>$work_experience->id,'text1'=>$work_experience->text1,
                     'company'=>$work_experience->company,'years'=>$work_experience->years,'dates'=>$work_experience->dates,
                     'position'=>$work_experience->position,'image'=>$work_experience->image);   
                    }
                }

                /**frameworks language */
                $sql_frameworks_and_tecnology = "SELECT * FROM frameworks_and_tecnology";
                $query_frameworks_and_tecnology = $connect -> prepare($sql_frameworks_and_tecnology); 
                $query_frameworks_and_tecnology -> execute(); 
                $results_frameworks_and_tecnology = $query_frameworks_and_tecnology -> fetchAll(PDO::FETCH_OBJ); 
                if($query_frameworks_and_tecnology -> rowCount() > 0)   { 
                    foreach($results_frameworks_and_tecnology as $frameworks_and_tecnology) { 
                     $json_frameworks_and_tecnology [] = array('id'=>$frameworks_and_tecnology->id,'technology'=>$frameworks_and_tecnology->tecnology,
                     'years'=>$frameworks_and_tecnology->years,'image'=>$frameworks_and_tecnology->image,'language'=>$frameworks_and_tecnology->language,
                     'text1'=>$frameworks_and_tecnology->text1,'text1'=>$frameworks_and_tecnology->text1,'text2'=>$frameworks_and_tecnology->text2,
                     'text3'=>$frameworks_and_tecnology->text3,'text4'=>$frameworks_and_tecnology->text4,'text5'=>$frameworks_and_tecnology->text5,
                     'text6'=>$frameworks_and_tecnology->text6,'text7'=>$frameworks_and_tecnology->text7);   
                    }
                }
            }

            /**token jwt */

            $Auth = new Auth();

            $token = $Auth->getToken([
                'id' => $id_cliente,
                'name' => $celular
                
            ]);

            $json=array('Respuesta'=>'Ok','id'=>$result->id,'name'=>$result->name,'phone'=>$result->phone,
             'last_name'=>$result->last_name,'email'=>$result->email,'image'=>$result->image,
             'years_experience'=>$result->years_experience,'contact_me'=>$json_contact_me,'about_me'=>$text1,
             'text2'=>$text2,'text3'=>$text3,'token'=>$token,
             'work_experience'=>$json_work_experience,'frameworks_and_tecnology'=>$json_frameworks_and_tecnology);
        }
    }
    else
    {
        $json=array('Respuesta'=>'Errorx','Msg'=>'No cuentas con ningun dato agregado');

    }

 echo json_encode($json);
//}
?>