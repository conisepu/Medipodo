<?php 

include("db.php");

if (isset($_POST['submitSave'])) {    

    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
	$correo = trim($_POST['correo']);
    $celular = trim($_POST['celular']);
    $rutcdv = trim($_POST['rutcdv']);
    $edad = trim($_POST['edad']);
    $fecha = trim($_POST['fecha']);
    echo $fecha[0];
	//substr("Hello world",-1,1)
	$consulta2 = "INSERT INTO `atencionpodologica`.`paciente` (`rut`, `d_verificador`, `nombre`, `apellido`, `edad`, `telefono`, `correo`) VALUES ('20122280', 'k', '$nombre', '$apellido', '$edad', '$celular', '$correo');
    ";//esta consulta sirve para verificar si existe el usuario en la base de datos
	//$resultado2 = mysqli_query($con,$consulta2);   
    //header('Location: ../podologo.php#calendar_sec');    
    
}

?>