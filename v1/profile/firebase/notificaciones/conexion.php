<?php
/*Datos de conexion a la base de datos*/
$db_host = "localhost";
$db_user = "monitode_myacceso";
$db_pass = "Benj@123";
$db_name = "monitode_myacceso";

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

//$conn = "host=ec2-44-205-41-76.compute-1.amazonaws.com port=5432 dbname=d3e2jj7kefqfq7 user=wifnrrkvpwnnjp password=e8068a0cc4c0f80619f5532491d1fc06d989095e169e55ffc635d8deb7ee2642";
//$con = pg_connect($conn);

if($con){
	//echo 'Se conecto a Base de Datos: ';
}

if(mysqli_connect_errno()){
	echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
}

// if (!mysqli_set_charset($con, "utf8")) 
//     {
//       printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($link));
//       exit();
//     }
?>

