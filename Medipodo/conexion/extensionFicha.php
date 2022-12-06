<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include("db.php");
///////////////////////////verFicha.php///////////////////////////////////////////////////
    if(isset($_POST['fecha_id'])){

        $option=$_POST['fecha_id'];
        $arr = explode(" ", $option);
        $sql6 = $con->query( "SELECT comentario, costo, tipo  FROM atencionpodologica.ficha 
                              left join agenda on ficha.id = agenda.id_ficha
                              left join tipo_visita on agenda.id_tipo = tipo_visita.id
                              where ficha.id_paciente = '$arr[1]' and ficha.fecha = '$arr[0]'");
        $fila = mysqli_fetch_row($sql6);
        
        $arr = array('costo'=> $fila[1], 'tipo'=>$fila[2], 'comentario'=>$fila[0] );
        echo json_encode($arr);
    }


////////////////////////////ESTADO_FINANCIERO.PHP//////////////////////////////////////////////////
    if(isset($_POST['id_paciente'])){

        $id_paciente=$_POST['id_paciente'];
        
        
        // $arr = explode(" ", $option);
        $sql6 = $con->query( "SELECT sum(costo) as 'montoTotalporPersona'
                              FROM ficha
                              WHERE id_paciente = '$id_paciente'");
        $fila = $sql6->fetch_assoc();
        if($fila['montoTotalporPersona'] > 0){
            echo $fila['montoTotalporPersona'];
        }else{
            echo "0";
        }
        
    }
/////////////////////////////ESTADO_FINANCIERO.PHP/////////////////////////////////////////////////

    if(isset($_POST['mes']) && isset($_POST['year']) ){
        //echo $_POST['mes'].'//////'.$_POST['year'];
        $mes=$_POST['mes']; //12
        $year=$_POST['year']; //2022
        $mes_year=$year.'-'.$mes.'-01'; //2022-12-01

        if(intval($mes) == 12){ //
            $mes_year_2 = $year.'-12-31';
        }else{
            $mes_int= intval($mes) + 1; //12
            $mes_str= strval($mes_int);//12
            $mes_year_2=$year.'-'.$mes_str.'-00';//2022-12-00
        }
        
        $sql6 = $con->query( "SELECT sum(costo) as 'montoTotalMensual'
                                FROM ficha
                                WHERE fecha BETWEEN '$mes_year' AND '$mes_year_2'");
        $fila = $sql6->fetch_assoc();
        if($fila['montoTotalMensual'] > 0){
            echo $fila['montoTotalMensual'];
        }else{
            echo "0";
        }
    
    }
//////////////////////////////ESTADO_FINANCIERO.PHP////////////////////////////////////////////////
    if(isset($_POST['year_pure0'])){

        $year=$_POST['year_pure0'];
        //echo $year;
        $yeas_mes_dia1 = $year.'-01-01';
        $yeas_mes_dia31 = $year.'-12-31';
        //echo $yeas_mes_dia31;
            
        $sql6 = $con->query( "SELECT sum(costo) as 'montoAnual'
                            FROM atencionpodologica.ficha
                            WHERE fecha BETWEEN '$yeas_mes_dia1' AND '$yeas_mes_dia31'");
        
              
        $fila = $sql6->fetch_assoc();
        //echo $fila['montoAnual'];
        if($fila['montoAnual'] > 0){
            echo $fila['montoAnual'];
        }else{
            echo "0";
        }
    
    }

////////////////////////////////PODOLOGO.PHP//////////////////////////////////////////////
    if(isset($_POST['idbutton'])){

        $atencion=$_POST['idbutton'];
        //echo $atencion;
        if($atencion == '1'){
            //esta atendiendo, pero no quiere atender
            $atencion = '0';
        }else if($atencion == '0'){
            //no esta atendiendo, pero quiere atender
            $atencion = '1';
        }   
        $sql6 = $con->query( "UPDATE `atencionpodologica`.`doctor` SET `atiende` = '$atencion' WHERE (`id` = '1')");
        $arr = array('atencionresult'=> $atencion);
        echo json_encode($arr);
  
    
    }


////////////////////////////////DIASAUSENTES.PHP//////////////////////////////////////////////
if(isset($_POST['agendar_diasausente'])){

    $fecha_inicio = $_POST['trip_start'];
    $fecha_final = $_POST['trip_finish'];
    //echo $trip_start;
    if ($fecha_inicio > $fecha_final ){
        //echo 'se manda error';
        header('Location:../diasAusentes.php?fallo=true');
    }else{
        
        $array_correo_desagendar_paciente = array(); 

        for($i = $fecha_inicio; $i <= $fecha_final ; $i = date("Y-m-d",strtotime($i."+ 1 days")) ){  //
            
            $consulta = $con->query("SELECT id, id_paciente, fecha, hora FROM atencionpodologica.ficha WHERE fecha='$i'");// busca fichas del dia i
            
            if (mysqli_num_rows($consulta)==0){
                //echo 'no hay fecha';
                $consulta2 = $con->query("INSERT INTO atencionpodologica.ficha(id_paciente,fecha,hora,comentario,costo) VALUES (3,'$i','09:00:00','Reservado para Patricia Irigoin',0)");
                $consulta3 = $con->query("INSERT INTO atencionpodologica.ficha(id_paciente,fecha,hora,comentario,costo) VALUES (3,'$i','10:30:00','Reservado para Patricia Irigoin',0)");
                $consulta4 = $con->query("INSERT INTO atencionpodologica.ficha(id_paciente,fecha,hora,comentario,costo) VALUES (3,'$i','12:00:00','Reservado para Patricia Irigoin',0)");
                $consulta5 = $con->query("INSERT INTO atencionpodologica.ficha(id_paciente,fecha,hora,comentario,costo) VALUES (3,'$i','13:30:00','Reservado para Patricia Irigoin',0)");
                $consulta6 = $con->query("INSERT INTO atencionpodologica.ficha(id_paciente,fecha,hora,comentario,costo) VALUES (3,'$i','17:30:00','Reservado para Patricia Irigoin',0)");
                $consulta7 = $con->query("INSERT INTO atencionpodologica.ficha(id_paciente,fecha,hora,comentario,costo) VALUES (3,'$i','19:00:00','Reservado para Patricia Irigoin',0)");
                $consulta8 = $con->query("INSERT INTO atencionpodologica.ficha(id_paciente,fecha,hora,comentario,costo) VALUES (3,'$i','20:30:00','Reservado para Patricia Irigoin',0)");
                
                    
            }else{
                $array_horas = array('09:00:00','10:30:00','12:00:00','13:30:00','17:30:00','19:00:00','20:30:00');

                while($row = $consulta->fetch_assoc()){ //es para cuando HAY fechas

                    $hora = $row['hora'];
                    if (($clave = array_search($hora, $array_horas)) !== false) {
                        unset($array_horas[$clave]);
                    }

                    $id_paciente = $row['id_paciente'];
                    $fecha = $row['fecha'];
                    $id_ficha = $row['id'];

                    $consulta2 = $con->query("SELECT * FROM atencionpodologica.paciente WHERE id='$id_paciente'"); // busca paciente de la ficha con dia i
                    if($row2= $consulta2->fetch_assoc()){ // ve si hay pacientes
                        //echo 'hay paciente';
                        $nombre = $row2['nombre'];
                        $apellido = $row2['apellido'];
                        $correo = $row2['correo'];
                        
                        if($nombre == 'patricia' && $apellido == 'irigoin' ){
                            //no enviar correo
                            //echo 'no se envia correo';
                        }else{
                            
                            //hay que borrar ficha, agenda.
                            $consulta4 = $con->query("DELETE FROM atencionpodologica.agenda WHERE (id_ficha = '$id_ficha')");
                            $consulta3 = $con->query("DELETE FROM atencionpodologica.ficha WHERE (id = '$id_ficha')");
                            
                            //hay que agregar ficha patricia.
                            $consulta5 = $con->query("INSERT INTO atencionpodologica.ficha(id_paciente,fecha,hora,comentario,costo) VALUES (3,'$fecha','$hora','Reservado para Patricia Irigoin',0)");
                            if($consulta3 && $consulta4 && $consulta5){
                                //echo 'se enviara correo';
                                $array = array($correo, $fecha, $hora);
                                array_push($array_correo_desagendar_paciente, $array);
                                //header('Location: ../enviar_correo/enviar_cita.php?correo='.$correo.'&fecha='.$fecha.'&hora='.$hora.'&tipo=&p=desagendar');  
                            }
                            
    
                        }
                    }             
                }
                //print_r($array_horas);
                foreach($array_horas as $h){
                    $consulta6 = $con->query("INSERT INTO atencionpodologica.ficha(id_paciente,fecha,hora,comentario,costo) VALUES (3,'$i','$h','Reservado para Patricia Irigoin',0)");
                }


            } 
        }
        //print_r($array_correo_desagendar_paciente);
        foreach($array_correo_desagendar_paciente as $p){

            $url = 'http://www.medipodologia.store/enviar_correo/enviar_cita.php?correo='.$p[0].'&fecha='.$p[1].'&hora='.$p[2].'&tipo=&p=desagendar';
            //echo $url;
            // use key 'http' even if you send the request to https://...
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => ''
                )
            );
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            if ($result === FALSE) { /* Handle error */ }

            //var_dump($result);
        }
        header('Location:../diasAusentes.php?vacaciones=T');
    }


}

if(isset($_POST['desagendar_diasausente'])){//desagendar vacaciones, es decir, vuelve a trabajar.
    $fecha_inicio = $_POST['trip_start'];
    $fecha_final = $_POST['trip_finish'];
    if ($fecha_inicio > $fecha_final ){
        //echo 'se manda error';
        header('Location:../diasAusentes.php?fallo=true');
    }else{
        for($i = $fecha_inicio; $i <= $fecha_final ; $i = date("Y-m-d",strtotime($i."+ 1 days")) ){
            $consulta = $con->query("DELETE FROM atencionpodologica.ficha WHERE id_paciente = 3 AND fecha = '$i'");
        }
        header('Location:../diasAusentes.php?vacaciones=T');
    }

}
////////////////////////////////PODOLOGO.PHP//////SEMANA////////////////////////////////////////
if(isset($_POST['week'])){
    //setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish'); //no funciono en miservidor
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $week = $_POST['week'];
    $fecha_inicio = date("Y-m-d", strtotime($week));
    $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+ 6 days"));
    $html = '';
    $contador = 1;
    for($i = $fecha_inicio; $i <= $fecha_final; $i = date("Y-m-d",strtotime($i."+ 1 days"))){
        $dia = date('w', strtotime("Sunday + $contador Days"));        
        $html .= '<div class="col-sm" style="padding-top: 20px;">
                    <h4>'.$dias[$dia].'</h4>';

        $consulta = $con->query("SELECT * FROM atencionpodologica.ficha WHERE fecha='$i' order by hora");
        while($row = $consulta->fetch_assoc()){
            
            $html .='<div class="row">
                      <div class="hora col" style="padding: unset;">
                        <p>'.substr($row['hora'],0,5).'</p>
                      </div>';

            $id_paciente = $row['id_paciente'];
            $consulta2 = $con->query("SELECT * FROM atencionpodologica.paciente WHERE id='$id_paciente'");
            
            if($row2= $consulta2->fetch_assoc()){
                $nombre = $row2['nombre'];
                $apellido = $row2['apellido'];
                $correo = $row2['correo'];

                $html .='<div class="nombre col" style="padding: unset;">
                            <p>'.$nombre.' '.$apellido.'</p>
                        </div>
                    </div>';
            }
            
        }
        $html .= '</div>';        
        $contador = intval($contador) + 1;
    }

    echo $html;
}



////////////////////////////////inventario.PHP//////////////////////////////////////////////
if(isset($_POST['sort']) && isset($_POST['orden'])){
    if($_POST['sort'] == 'nombre'){
        if($_POST['orden'] == 'asc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by nombre asc");

        }elseif($_POST['orden'] == 'desc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by nombre desc");
        }
    }elseif($_POST['sort'] == 'stock'){
        if($_POST['orden'] == 'asc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by cantidad asc");

        }elseif($_POST['orden'] == 'desc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by cantidad desc");
        }
    }elseif($_POST['sort'] == 'PXunidad'){
        if($_POST['orden'] == 'asc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by precioxunidad asc");

        }elseif($_POST['orden'] == 'desc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by precioxunidad desc");
        }
    }elseif($_POST['sort'] == 'PIHistorico'){
        if($_POST['orden'] == 'asc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by precioTotal asc");

        }elseif($_POST['orden'] == 'desc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by precioTotal desc");
        }
    }elseif($_POST['sort'] == 'CTHistorico'){
        if($_POST['orden'] == 'asc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by CantidadTotalHistorica asc");

        }elseif($_POST['orden'] == 'desc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by CantidadTotalHistorica desc");
        }
    }elseif($_POST['sort'] == 'GTHistorico'){
        if($_POST['orden'] == 'asc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by GastoTotalHistorico asc");

        }elseif($_POST['orden'] == 'desc'){
            $consulta = $con->query("SELECT * from 
                                    (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                                    from(
                                    select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                    left join inventario as t2
                                    on t2.id=t1.id_producto) t3
                                    group by id) as t4 right join inventario on t4.id=inventario.id
                                    order by GastoTotalHistorico desc");
        }
    }       
    
    $html = '';
    while ($inventario = $consulta->fetch_assoc()) {
        $precioTotal = (intval( $inventario['precioxunidad']  ))*( intval( $inventario['cantidad']  ));
        $html .= ('<tr>                
        <td>'.$inventario['nombre'].'</td>    
        <td>'.$inventario['cantidad'].'</td>

        <td>'.$inventario['precioxunidad'].'</td> 

        <td>'.$precioTotal.'</td>
        
        <td>'.$inventario['CantidadTotalHistorica'].'</td>
        <td>'.$inventario['GastoTotalHistorico'].'</td>
        <td><p class="btninv" id="'.$inventario['id'].'" onclick="modificar(this.id)">Modificar</p></td>
        
      </tr>');
    }
    echo $html;
    
}

if(isset($_POST['mes_inv']) && isset($_POST['year_inv']) && isset($_POST['id_inventario'])){
    $mes=$_POST['mes_inv']; //12
    $year=$_POST['year_inv']; //2022
    $mes_year=$year.'-'.$mes.'-01'; //2022-12-01
    $id_inventario = $_POST['id_inventario'];

    if(intval($mes) == 12){ //
        $mes_year_2 = $year.'-12-31';
    }else{
        $mes_int= intval($mes) + 1; //12
        $mes_str= strval($mes_int);//12
        $mes_year_2=$year.'-'.$mes_str.'-00';//2022-12-00
    }

    //echo $mes_year;
    $sql6 = $con->query( "  select t3.id,t3.nombre,t3.fecha,sum(cantidad) as 'cantidadMensual',sum(t3.cantidad*t3.precioxunidad) as 'gastoMensual'
                            from( select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                                left join inventario as t2
                                on t2.id=t1.id_producto
                                WHERE t1.fecha between '$mes_year' and '$mes_year_2'
                                and t2.id='$id_inventario' ) t3
                            group by id");
    $fila = $sql6->fetch_assoc();
    if($fila){
        if($fila['gastoMensual'] > 0){
            echo $fila['gastoMensual'];
        }else{
            echo "0";
        } 
    }else{
        echo "0";
    }
      
}

if(isset($_POST['id_inv'])){
    $id_inventario=$_POST['id_inv'];
    $consulta = $con->query( "SELECT * FROM atencionpodologica.inventario WHERE id = '$id_inventario'");
    $fila = $consulta->fetch_assoc();
    $arr = array('nombre'=> $fila['nombre'], 'cantidad'=>$fila['cantidad'], 'precioxunidad'=>$fila['precioxunidad'] );
    echo json_encode($arr);
    
}


?>