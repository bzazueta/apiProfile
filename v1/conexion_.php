<?php
// DB CREDENCIALES DE USUARIO.
// define('DB_HOST','142.93.82.72');
// define('DB_USER','root');
// define('DB_PASS','XsUSDfE2vedtJbVEjJBJS4RtF3uPkM4m');
// define('DB_NAME','tandas');

define('DB_HOST','localhost:3306');
define('DB_USER','monitode_myacceso');
define('DB_PASS','Benj@123');
define('DB_NAME','monitode_homart');


try
{
// Ejecutamos las variables y aplicamos UTF8
$connect = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
//echo 'entrofghfh';
}
catch (PDOException $e)
{
    echo "Error: " . $e->getMessage();
    //exit("Error: " . $e->getMessage());
}

// DB CREDENCIALES DE USUARIO.
// $db_host = "localhost";
// $db_user = "root";
// $db_pass = "XsUSDfE2vedtJbVEjJBJS4RtF3uPkM4m";
// $db_name = "sys";

// $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name,3306);
// mysqli_select_db($con,$db_name);
// if(mysqli_connect_errno()){
// 	echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
// }
// else
// {
//     echo 'entro';
// }
?>