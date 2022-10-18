<?php 

//$conn= new mysqli('sistemavotacion.mysql.database.azure.com', 'admi@sistemavotacion', 'sistemavotacion123.', 'votaciones_db')or die("Could not connect to mysql".mysqli_error($con));
function conectar(){

    $user="root";
    $pass="1234";
    $server="localhost";
    $db="atencionpodologica";
    $con=mysqli_connect($server,$user,$pass,$db) or die ("Error al conectar a la bd ");
    return $con;
    echo "sillego";
}

$con=conectar();

?>