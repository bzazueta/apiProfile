<?php

//require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../conexion_.php';
require_once __DIR__ . '/../auth/Auth.php';

require '../../vendor/autoload.php';
// echo 'entro';
use Google\Auth\Credentials\ServiceAccountCredentials;

echo 'entro';
// use google\auth\src\Credentials\ServiceAccountCredentials;
// use google\src\OAuth2;

// Ruta al archivo JSON de la cuenta de servicio
$pathToServiceAccountJson = './pagosproumm-firebase-adminsdk-ev8oe-cf69dd3a3c.json';

if (file_exists($pathToServiceAccountJson)) {
    echo "El archivo existe.";
} else {
    echo "El archivo no existe.";
}
// Configura las credenciales de la cuenta de servicio y los alcances
$scopes = ['https://www.googleapis.com/auth/cloud-platform'];;

$credentials = new ServiceAccountCredentials($scopes, $pathToServiceAccountJson);
var_dump($credentials);
echo 'entro';
// Generar el token de acceso
$accessToken = $credentials->fetchAuthToken();
var_dump($accessToken);
$token = $accessToken['access_token'];

echo "Token de acceso: " . $token;
?>