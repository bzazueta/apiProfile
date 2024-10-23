<?php

require_once 'vendor/autoload.php';

use Firebase\JWT\JWT;

$time = time();
$key = 'my_secret_key';

$token = array(
    'iat' => $time, // Tiempo que inició el token
    'exp' => $time + (60*60), // Tiempo que expirará eTl token (+1 hora)
    'data' => [ // información del usuario
        'id' => 1,
        'name' => 'Benjamin'
    ]
);

$jwt = JWT::encode($token, $key);

$data = JWT::decode($jwt, $key, array('HS256'));

var_dump($data);


?>