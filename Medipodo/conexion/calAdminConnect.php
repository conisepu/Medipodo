<?php 

include("db.php");

if (isset($_POST['submitSave'])) { //AGENDAR PACIENTE   
    $fecha = $_GET['F'];
    $nombre = strtolower(trim($_POST['nombre']));
    $apellido = strtolower(trim($_POST['apellido']));
	$correo = strtolower(trim($_POST['correo']));
    $celular = strtolower(trim($_POST['celular']));
    $rutcdv = strtolower(trim($_POST['rutcdv']));
    $edad = strtolower(trim($_POST['edad']));
    $hora = strtolower(trim($_POST['hora']));
    $direccion = strtolower(trim($_POST['direccion']));
    $tipo_visita = strtolower(trim($_POST['tipo_visita']));
    //////////////////////////////////////////
	$rut = substr($rutcdv,-0, -1);
    $d_verificador = substr($rutcdv, -1);
    // echo($fecha);
    // echo($hora);
    // echo($direccion);
    $query_idP = $con->query("SELECT id FROM atencionpodologica.paciente where rut = '$rut'");
    $query_ficha = $con->query("SELECT count(*) as 'count' FROM atencionpodologica.ficha where fecha = '$fecha' and hora = '$hora'");
    $id_paciente = $query_idP->fetch_assoc();
    $count_ficha = $query_ficha->fetch_assoc();
    if($count_ficha['count'] == 0){
        if($id_paciente != NULL){ //es porque hay datos
            //echo "hay datos, no se puede agregar en paciente, se agrega ficha nueva";
            $id_paciente = $id_paciente['id'];
            
            $consulta2 = $con->query("INSERT INTO `atencionpodologica`.`ficha` (`id_paciente`, `fecha`,`hora`, `direccion`, `costo`) VALUES ('$id_paciente', '$fecha', '$hora', '$direccion', '0');");//esta consulta agrega ficha por defecto sin costo y sin comentario.
            $query2_idF = $con->query("SELECT id FROM atencionpodologica.ficha where id_paciente = '$id_paciente' and fecha = '$fecha' and hora = '$hora'");
            $query2_idT = $con->query("SELECT id FROM atencionpodologica.tipo_visita where tipo = '$tipo_visita';");
            
            $id_ficha = $query2_idF->fetch_assoc()['id'];        
            $id_tipo_visita = $query2_idT->fetch_assoc()['id'];
            
            $consulta3 = $con->query("INSERT INTO `atencionpodologica`.`agenda` (`id_ficha`, `id_tipo`) VALUES ('$id_ficha', '$id_tipo_visita');");//esta consulta sirve para verificar si existe el usuario en la base de datos
            
        }else{
            $consulta = $con->query ("INSERT INTO `atencionpodologica`.`paciente` (`rut`, `d_verificador`, `nombre`, `apellido`, `edad`, `telefono`, `correo`) VALUES ('$rut', '$d_verificador', '$nombre', '$apellido' , '$edad', '$celular', '$correo');");
            $query_idP = $con->query("SELECT id FROM atencionpodologica.paciente where rut = '$rut'");
            $id_paciente = $query_idP->fetch_assoc()['id'];
    
            $consulta2 = $con->query("INSERT INTO `atencionpodologica`.`ficha` (`id_paciente`, `fecha`,`hora`, `direccion`, `costo`) VALUES ('$id_paciente', '$fecha', '$hora', '$direccion', '0');");//esta consulta agrega ficha por defecto sin costo y sin comentario.
            $query2_idF = $con->query("SELECT id FROM atencionpodologica.ficha where id_paciente = '$id_paciente' and fecha = '$fecha'");
            $query2_idT = $con->query("SELECT id FROM atencionpodologica.tipo_visita where tipo = '$tipo_visita';");
            $id_ficha = $query2_idF->fetch_assoc()['id'];
            $id_tipo_visita = $query2_idT->fetch_assoc()['id'];
            $consulta3 = $con->query("INSERT INTO `atencionpodologica`.`agenda` (`id_ficha`, `id_tipo`) VALUES ('$id_ficha', '$id_tipo_visita');");//esta consulta sirve para verificar si existe el usuario en la base de datos
            //echo "no hay datos, se puede agregar";
        }
        
        //echo ($id_paciente);    
        if ($consulta3) {
            // $url = 'http://localhost/medipodo/enviar_wsp/whatsapp.php?number='.$celular.'&nombre='.$nombre;

            // // use key 'http' even if you send the request to https://...
            // $options = array(
            //     'http' => array(
            //         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            //         'method'  => 'POST',
            //         'content' => ''
            //     )
            // );
            // $context  = stream_context_create($options);
            // $result = file_get_contents($url, false, $context);
            // if ($result === FALSE) { /* Handle error */ }

            // var_dump($result);
            
            header('Location: ../enviar_correo/enviar_cita.php?correo='.$correo.'&fecha='.$fecha.'&hora='.$hora.'&tipo='.$tipo_visita.'&p='.$_GET['p']);  
            //header('Location: ../podologo.php#calendar_sec');  
            
        } else {
            ?> 
            <h3 class="bad">¡Ups ha ocurrido un error!</h3>
            
           <?php
        }
        
    }else{
        ?> 
            <h3 class="bad">fecha y hora ocupada</h3>
            
        <?php
    }
    
}

if (isset($_POST['desagendar'])) { //DESAGENDAR PACIENTE  desde podologo.php
    $fecha = $_GET['F'];
    $value = trim($_POST['pacientes']);
    $arr = explode(" ", $value);

    $consulta = $con->query("SELECT ficha.id as id_ficha, paciente.correo as correo
                             FROM atencionpodologica.paciente
                             left join atencionpodologica.ficha on fecha = '$fecha'  and ficha.id_paciente = paciente.id
                             where nombre = '$arr[0]' and apellido = '$arr[1]' and hora = '$arr[2]'");
    if(mysqli_num_rows($consulta)!=0){
        if($row = $consulta->fetch_assoc()){
            $id_ficha = $row['id_ficha'];
            $correo =$row['correo'];
        }
        $hora = $arr[2];
        
        $consulta2 = $con->query("DELETE FROM atencionpodologica.agenda WHERE  id_ficha = '$id_ficha'");
        $consulta3 = $con->query("DELETE FROM atencionpodologica.ficha WHERE  id = '$id_ficha'");
        if ($consulta3) {
            header('Location: ../enviar_correo/enviar_cita.php?correo='.$correo.'&fecha='.$fecha.'&hora='.$hora.'&tipo=&p=desNormal');
            //header('Location: ../podologo.php#calendar_secP');  
            
        } else {
            ?> 
            <h3 class="bad">¡Ups ha ocurrido un error!</h3>
            
        <?php
        }  
    }
}

if (isset($_POST['cambiarpass'])){ //cambiar cantidad de producto desde inventario.php
    $npass=$_POST['npass'];
    $hash = password_hash($npass, PASSWORD_BCRYPT);
	$consulta = "UPDATE atencionpodologica.doctor SET password = '$hash' WHERE correo ='conisepulvedairigoin@gmail.com'"; 
	$resultado = mysqli_query($con,$consulta);   

    if ($resultado) {
        
        header('Location: ../podologo.php?noti=T0'); 
             
        
    } else {
        ?> 
            <h3 class="bad">¡Ups ha ocurrido un error!</h3>        
        <?php
    }
}

//////////////////////////////////VERFICHAS.PHP//////////////////////////////////////////////////77


if (isset($_POST['guardarficha'])){
    $rut = $_GET['rut'];
    $d_ver = $_GET['dv'];
    $fecha_idpaciente = trim($_POST['selectFechas']);
    $arr = explode(" ", $fecha_idpaciente); //$arr[0] muestra fecha $arr[1] muestra id_paciente
    $costo = trim($_POST['precio']);
    $tipo_visita = trim($_POST['tipo_visita']);
    $comentario = strtolower(trim($_POST['comentario']));
    //echo $fecha_idpaciente;
    $consulta = $con->query("UPDATE atencionpodologica.ficha SET comentario = '$comentario', costo = '$costo' WHERE id_paciente = '$arr[1]' AND fecha = '$arr[0]'");
    if ($consulta) {
        
        header('Location: ../verFichas.php?rut='.$rut.'&dv='.$d_ver.'&fallo=F');  
        
    } else {
        header('Location: ../verFichas.php?rut='.$rut.'&dv='.$d_ver.'&fallo=T');  
    }  

}

if (isset($_POST['desagendar_P'])){ //desagenda desde index.php
    $fecha = $_GET['F'];
    $desadmin= $_GET['admin'];
    $nombre = strtolower(trim($_POST['nombre']));
    $apellido = strtolower(trim($_POST['apellido']));	
    $celular = trim($_POST['celular']);
    $rutcdv = strtolower(trim($_POST['rutcdv']));
    $hora = trim($_POST['hora']);
    $rut = substr($rutcdv,-0, -1);
    $d_verificador = substr($rutcdv, -1);
    if($desadmin == 0){
        $p="desNormalP";
        $admin="";
    }elseif($desadmin == 1){
        $p="desNormalPadmin";
        $admin="&admin=admin";
    }

    $consulta = $con->query("SELECT ficha.id as 'id_ficha', paciente.correo as 'correo' FROM atencionpodologica.paciente
                             left join atencionpodologica.ficha on ficha.fecha = '$fecha' and ficha.id_paciente = paciente.id
                             where paciente.nombre='$nombre'  and paciente.apellido = '$apellido' and ficha.hora = '$hora' 
                             and paciente.rut = '$rut' and paciente.d_verificador = '$d_verificador' and paciente.telefono = '$celular'");
    if(mysqli_num_rows($consulta)!=0){
        if($row = $consulta->fetch_assoc()){
            $id_ficha = $row['id_ficha'];
            $correo =$row['correo'];
        }

        $consulta2 = $con->query("DELETE FROM atencionpodologica.agenda WHERE  id_ficha = '$id_ficha'");
        $consulta3 = $con->query("DELETE FROM atencionpodologica.ficha WHERE  id = '$id_ficha'");
        if ($consulta3){
            
            header('Location: ../enviar_correo/enviar_cita.php?correo='.$correo.'&fecha='.$fecha.'&hora='.$hora.'&tipo=&p='.$p);
            //header('Location: ../index.php#calendar_sec');  
            
        } else {
            ?> 
            <h3 class="bad">¡Ups ha ocurrido un error!</h3>
            
        <?php
        }
    }else{
        header('Location: ../agendacionPublico.php?fecha='.$fecha.'&fallo=T'.$admin);
    }
}
//////////////////////INVENTARIO.PHP////////////////////////////////////////////
if (isset($_POST['guardarinventario'])){ //cambiar cantidad de producto desde inventario.php
    $nombre_new = $_POST['nomb_inv'];
    $cantidad_new = $_POST['cant_inv']; //15
    $precioxunidad_new = $_POST['precioxunidad_inv']; //
    $precioTotal = intval($precioxunidad_new) * intval($cantidad_new);
    $id_inventario= $_GET['idinv'];
    $fecha = date("Y-m-d");
    //echo $cantidad_new;
    //echo $precioxunidad_new;


    $consulta = $con->query("SELECT * FROM atencionpodologica.inventario WHERE id = '$id_inventario'");
    if($inventario = $consulta->fetch_assoc()){
        $cantidad_old = $inventario['cantidad'];
        $precioxunidad_old = $inventario['precioxunidad'];
        //echo $cantidad_old;
        if($cantidad_new > $cantidad_old){//se agrega stock
            $cantidad_final = $cantidad_new - $cantidad_old;
            //echo $cantidad_final;
            $consulta2 = $con->query("INSERT INTO historial(id_producto,fecha, cantidad, precioxunidad) VALUES ('$id_inventario','$fecha', '$cantidad_final', '$precioxunidad_new')");
            $consulta3 = $con->query("UPDATE atencionpodologica.inventario SET cantidad = '$cantidad_new' WHERE (id = '$id_inventario')");
            $consulta4 = $con->query("UPDATE atencionpodologica.inventario SET precioxunidad = '$precioxunidad_new' WHERE (id = '$id_inventario')");
            $consulta5 = $con->query("UPDATE atencionpodologica.inventario SET precioTotal = '$precioTotal' WHERE (id = '$id_inventario') ");
            $consulta6 = $con->query("UPDATE atencionpodologica.inventario SET nombre = '$nombre_new' WHERE (id = '$id_inventario')");
            //me falta la consulta de precio total.
        }else if($cantidad_new <= $cantidad_old){//se quita stock
            $consulta2 = $con->query("UPDATE atencionpodologica.inventario SET nombre = '$nombre_new' WHERE (id = '$id_inventario')");
            $consulta3 = $con->query("UPDATE atencionpodologica.inventario SET cantidad = '$cantidad_new' WHERE (id = '$id_inventario')");
            $consulta4 =$con->query("UPDATE atencionpodologica.inventario SET precioxunidad = '$precioxunidad_old' WHERE (id = '$id_inventario')");
            $consulta5 = $con->query("UPDATE atencionpodologica.inventario SET precioTotal = '$precioTotal' WHERE (id = '$id_inventario')");
        }
    }



    //echo $cantidad;
    // $consulta = $con->query("UPDATE `atencionpodologica`.`inventario` SET `cantidad` = '$cantidad' WHERE (`id` = '$id_inventario')");  
    // $consulta2 =$con->query("UPDATE `atencionpodologica`.`inventario` SET `precioxunidad` = '$precioxunidad' WHERE (`id` = '$id_inventario')");
    // $consulta3 = $con->query("UPDATE `atencionpodologica`.`inventario` SET `precioTotal` = '$precioTotal' WHERE (`id` = '$id_inventario') ");
    

    //echo $cantidad;
    if ($consulta && $consulta2 && $consulta3 && $consulta4 && $consulta4) {

        header('Location: ../inventario.php?b=T');  
        
    } else {
        ?> 
        <h3 class="bad">¡Ups ha ocurrido un error!</h3>
        
       <?php
    }
}

if (isset($_POST['Agregarinventario'])){ //cambiar cantidad de producto desde inventario.php
    $cantidad = trim($_POST['cant_inv']);
    $nombre = strtolower(trim($_POST['nombre_inv']));
    $precioxunidad = trim($_POST['precioxunidad_inv']);
    $precioTotal = intval($precioxunidad) * intval($cantidad);
    $fecha = date("Y-m-d");
    // echo $cantidad;
    // echo $nombre;
    $verificar = $con->query("SELECT * FROM atencionpodologica.inventario where nombre = '$nombre'");
    if(mysqli_num_rows($verificar)==0){
        $consulta = $con->query("INSERT INTO atencionpodologica.inventario(nombre,cantidad, precioTotal, precioxunidad) VALUES ('$nombre','$cantidad', '$precioTotal','$precioxunidad')");
        
        if ($consulta) {
            $consulta2 = $con->query("SELECT id FROM inventario WHERE nombre='$nombre'");
            $id_inventario = $consulta2->fetch_assoc()['id'];
            //echo $id_inventario;
            $consulta3 = $con->query("INSERT INTO atencionpodologica.historial(id_producto,fecha, cantidad,precioxunidad) VALUES ('$id_inventario','$fecha', '$cantidad','$precioxunidad')");
            if($consulta3){
                header('Location: ../inventario.php?b=T'); 
            }else {
                ?> 
                    <h3 class="bad">¡Ups ha ocurrido un error!1</h3>            
                <?php
            }     
            
        } else {
            ?> 
                <h3 class="bad">¡Ups ha ocurrido un error!2</h3>        
            <?php
        }
    }else{
        //eesto es porque ya existe el producto
        header('Location: ../inventario.php?b=F'); 
    }
}


?>