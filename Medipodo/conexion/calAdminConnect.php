<?php 

include("db.php");

if (isset($_POST['submitSave'])) {    

    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
	$correo = trim($_POST['correo']);
    $celular = trim($_POST['celular']);
    $rutcdv = trim($_POST['rutcdv']);
    $edad = trim($_POST['edad']);
    $fecha = $_GET['F'];
    $tipo_visita = trim($_POST['tipo_visita']);
    //////////////////////////////////////////
	$rut = substr($rutcdv,-0, -1);
    $d_verificador = substr($rutcdv, -1);
    





    //hay que usar filtros para que no se agregen repetidos/
	$consulta = $con->query ("INSERT INTO `atencionpodologica`.`paciente` (`rut`, `d_verificador`, `nombre`, `apellido`, `edad`, `telefono`, `correo`) VALUES ('$rut', '$d_verificador', '$nombre', '$apellido', '$edad', '$celular', '$correo');
    ");//esta consulta inserta al paciente crear un if para ver que no se repitan en la misma fecha o antes de la fecha
    $query_idP = $con->query("SELECT id FROM atencionpodologica.paciente where rut = '$rut'");
    $id_paciente = $query_idP->fetch_assoc()['id'];
    //echo ($id_paciente);
    

    $consulta2 = $con->query("INSERT INTO `atencionpodologica`.`ficha` (`id_paciente`, `fecha`, `costo`) VALUES ('$id_paciente', '$fecha', '0');");//esta consulta sirve para verificar si existe el usuario en la base de datos
    $query2_idF = $con->query("SELECT id FROM atencionpodologica.ficha where id_paciente = '$id_paciente' and fecha = '$fecha'");
    $query2_idT = $con->query("SELECT id FROM atencionpodologica.tipo_visita where tipo = '$tipo_visita';");
    $id_ficha = $query2_idF->fetch_assoc()['id'];
    $id_tipo_visita = $query2_idT->fetch_assoc()['id'];
    //echo ($id_ficha);
    //echo ($id_tipo_visita);
    
    $consulta3 = $con->query("INSERT INTO `atencionpodologica`.`agenda` (`id_ficha`, `id_tipo`) VALUES ('$id_ficha', '$id_tipo_visita');");//esta consulta sirve para verificar si existe el usuario en la base de datos
	
    header('Location: ../podologo.php#calendar_sec');    
    
}

?>