<?php

include("./conexion.php");

require_once __DIR__ . '/notification.php';
$notification = new Notification();

$id_colonia = htmlentities($_POST['id_colonia']);


if($con)
 {
    
    $consulta = mysqli_query($con,"SELECT * FROM usuarios where id_colonia = $id_colonia AND token_firebase is not null");//dWLzWqO_RGm0361YKArpe5:APA91bHs4VDnT92GpQTa39e02DGTzAVEovMsWtj3qYEJ-nEAsLu746ftDLWO-WDeNzqj2IZgi5JPf1uso-0Og24YZQqw52dmL2W6gLujdQA4D8UZgejey0ajI7iF2f12Kq1iNOuJTgpB
    while($resultados = mysqli_fetch_assoc($consulta)) 
    { 
        $firebase_token = $resultados['token_firebase'];

        //firebase
        try
        {
   
        
            // $row["id"].'<br>';
            $token="fdBaP0VOJ-A:APA91bHpcKspys01K0TfTS-1RrxXBFA5bgg9qghy6uOuBvuZdGzd-jtlYs9LbgINOdyDRslE5NJYfdq5tLGd2MA6OY56vdYa76_nUAh6lP0qlPZj7Wz87TbjufXd3pFAo_YMRDtSyOzc"; //$row["token"];
            $token ="eoReJts6iBg:APA91bHs2AKupkxrJAtsSpFE3K703f0Gx6zl6qmDyzzECmOq9OyMSEP-trNw1L0kPmS_a6v4PzHyy6FVaSKekxUDSckiNUQJwzS3c1-EMn3ifGGO-xcg3da9CCVP0R8b7ydOxD9Fkdyc";
            //$token="fuwO0AUbR16IJjaRZNUi2H:APA91bGGHfg5ZPbl8HilhXS5KQHR4RvYgfM5YUyaAomhfXdbmJfJvnrRQSkps9M4jnwvF4BeLMyX2EClpZvbMti4i_Q-mcb4sk0FcLOpxcnnmjS-sy9xjiYffWD5bhe2IO2LWrqqToDb";

            $server_apyKey ="AAAATaAAt-Q:APA91bGfgFju-b1J6xkSXpyRaSSdV12cqb6dn42V2erSS84uDYMQR3X-7LXzDIIHIwEqg-f_iA7RFYCQChlSvqcr4V5qCIi56HbAkbB8-U7N37d966y8ZRlXz43Y_ai9dRPqlh1zR2J2";//$row["server_apyKey"];
            $server_apyKey ="AAAAgzEUuzA:APA91bEYItPik6a7SfEJM3QG3L1fLASyOk7p69rGUFHZX2jXMus03CeM3TPaQkCPBMEmL-8np8wZdKQPJY4erbWYHSkN5gpt06Jfgs98KdKLZkrFa9vHhI0BmTY6bUij9HQWAXOUmYhG";
            $tokens[] ="fdBaP0VOJ-A:APA91bHpcKspys01K0TfTS-1RrxXBFA5bgg9qghy6uOuBvuZdGzd-jtlYs9LbgINOdyDRslE5NJYfdq5tLGd2MA6OY56vdYa76_nUAh6lP0qlPZj7Wz87TbjufXd3pFAo_YMRDtSyOzc"; //$row["token"];
            
            // token($token,$server_apyKey);
            $title = $_POST['title'];
            $message = isset($_POST['message'])?$_POST['message']:'';
            $imageUrl = isset($_POST['image_url'])?$_POST['image_url']:'';
            $action = isset($_POST['action'])?$_POST['action']:'';

            $actionDestination = isset($_POST['action_destination'])?$_POST['action_destination']:'';

            if($actionDestination =='')
            {
                        $action = '';
            }
        
            $notification->setTitle($title);
            $notification->setMessage($message);

           // $notification->setImage($imageUrl);
            //$notification->setAction($action);
           // $notification->setActionDestination($actionDestination);

           // $firebase_token = $_POST['firebase_token'];
            $firebase_api = $_POST['firebase_api'];
           // $token =  $_POST['firebase_token'];
            $token =  $firebase_token;
            $server_apyKey = "AAAAgzEUuzA:APA91bEYItPik6a7SfEJM3QG3L1fLASyOk7p69rGUFHZX2jXMus03CeM3TPaQkCPBMEmL-8np8wZdKQPJY4erbWYHSkN5gpt06Jfgs98KdKLZkrFa9vHhI0BmTY6bUij9HQWAXOUmYhG";

            $topic = $_POST['topic'];

            

            $requestData = $notification->getNotificatin();

                    if($_POST['send_to']=='topic')
                    {
                        $fields = array(
                            'to' => '/topics/' . $topic,
                            'data' => $requestData,
                                );

                    }
                    else
                    {

                        $fields = array(
                            'to' => $token,
                            'data' => $requestData,
                                );
                    }


                    // Set POST variables
                    $url = 'https://fcm.googleapis.com/fcm/send';

                    $headers = array(
                        'Authorization: key=' .$server_apyKey,
                        'Content-Type: application/json'
                    );

                    // Open connection
                    $ch = curl_init();

                        // Set the url, number of POST vars, POST data
                    curl_setopt($ch, CURLOPT_URL, $url);

                    curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    // Disabling SSL Certificate support temporarily
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

                    // Execute post
                    $result = curl_exec($ch);
                    if($result === FALSE){
                        //die('Curl failed: ' . curl_error($ch));
                        echo 'Curl failed: ' . curl_error($ch);
                            }

                    // Close connection
                    curl_close($ch);
            
                    // echo '<h2>Result</h2><hr/><h3>Request </h3><p><pre>';
                    // echo json_encode($fields,JSON_PRETTY_PRINT);
                    // echo '</pre></p><h3>Response </h3><p><pre>';
                    // echo $result;
                    // echo "Token".$token;
                    // echo '</pre></p>';

                 $json=array('Respuesta'=>'Ok','Msg'=>'Alerta Exitosa','token'=>$token);
               
            } catch(PDOException $error) {
                echo $sql. $error->getMessage();
        }
     
        //
    }
    echo json_encode($json);
 }

 ?>