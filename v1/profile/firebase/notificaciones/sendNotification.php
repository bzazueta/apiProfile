<?php

$title = $_POST['title'];
$message = $_POST['message'];
$tkn=$_POST['tkn'];

//$message = 'hola desde php';
//$tkn= 'eLGcFEDeSFSrgpkl-ISjl-:APA91bFmjNrTjlAFGB-K01bziDKbsB-nX9FJpSJIDbFumdiR_4pIIWoWt34iLHkY8GSf96zmpEM6ZSgCdEsKqbmQpiH4_yENRx5tf2uVEDEjHqT4d4wugZMAcj64aeoRFkAHMOrdi4SK';

$url = 'https://fcm.googleapis.com/fcm/send';

$fields = array (
        'registration_ids' => array (
                $tkn
        ),
        'data' => array (
                "message" => $message
        ),
        'notification' => array (
            "body" => $message,
            "title"=> $title
    )
);


$fields = json_encode ( $fields );

$headers = array (
        'Authorization: key=' . 'AAAAgzEUuzA:APA91bEYItPik6a7SfEJM3QG3L1fLASyOk7p69rGUFHZX2jXMus03CeM3TPaQkCPBMEmL-8np8wZdKQPJY4erbWYHSkN5gpt06Jfgs98KdKLZkrFa9vHhI0BmTY6bUij9HQWAXOUmYhG',
        'Content-Type: application/json'
);

$ch = curl_init ();
curl_setopt ( $ch, CURLOPT_URL, $url );
curl_setopt ( $ch, CURLOPT_POST, true );
curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

$result = curl_exec ( $ch );
echo $result;
curl_close ( $ch );

?>