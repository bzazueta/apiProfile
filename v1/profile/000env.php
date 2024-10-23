<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



// Cargamos el autoload dentro del archivo donde usaremos las bibliotecas de composer
// Considerar el nivel donde nos encontramos para ver cuántas carpetas nos regresaremos
echo $autoload =  __DIR__ . '/../../vendor/vendor/autoload.php';
require_once($autoload);

// Instanciamos .env
// centro de createImmutable() hay que mandar como parámetro el path donde se encuentre
// el archivo .env
// Nuevamente, hay que considerar en qué carpeta nos encontramos para regresarnos los niveles
// necesarios.
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->load();

// Imprimimos las variables
echo $_ENV['S3_BUCKET'];
echo "<br>";
echo $_ENV['SECRET_KEY'];
