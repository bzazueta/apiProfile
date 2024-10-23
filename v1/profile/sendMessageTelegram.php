<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../conexion_.php';
require_once __DIR__ . '/../auth/Auth.php';
$headers = apache_request_headers();

try
{
    $botApiToken = '7489825902:AAFKo6V6AbiZbWWysX5pC2MNrLjK4LbkqKk';
    $channelId ='@profilemonosoftbot';
    $text = $_POST['message'];

    $query = http_build_query([
        'chat_id' => $channelId,
        'text' => $text,
    ]);
    $url = "https://api.telegram.org/bot{$botApiToken}/sendMessage?{$query}";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    curl_exec($curl);
    $result = curl_exec($curl);
    if($result === FALSE){
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($curl);
    $json=array('response'=>'Ok','Msg'=>'Mensage enviado','message'=>$text);
    echo json_encode($json);
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>