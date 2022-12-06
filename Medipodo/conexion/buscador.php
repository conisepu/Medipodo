<?php
/////// CONEXIÓN A LA BASE DE DATOS /////////
include 'db.php';
//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$query="SELECT  paciente.rut as rut, paciente.d_verificador as dv, concat(paciente.nombre,' ',paciente.apellido) as 'nombreApellido', concat(ficha.fecha,' (',ficha.hora,')') as 'ultimaAtencion',concat(ficha2.fecha,' (',ficha2.hora,')') 'proximaAtencion'
        FROM    paciente
        left join(
            select id_paciente,hora,max(fecha) fecha
            from ficha
            where costo !=0
            group by id_paciente
        )ficha
        on(ficha.id_paciente=paciente.id)
        left join(
            select id_paciente,hora,min(fecha) fecha
            from ficha
            where costo =0
            group by id_paciente
        )ficha2
        on(ficha2.id_paciente=paciente.id)
        ORDER BY case when proximaAtencion is null then 1 else 0 end,proximaAtencion";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['busqueda']))
{
	$q=trim($_POST['busqueda']);
	$query="SELECT  paciente.rut as rut, paciente.d_verificador as dv, concat(paciente.nombre,' ',paciente.apellido) as 'nombreApellido', concat(ficha.fecha,' (',ficha.hora,')') as 'ultimaAtencion',concat(ficha2.fecha,' (',ficha2.hora,')') 'proximaAtencion'
            FROM    paciente
            left join(
                select id_paciente,hora,max(fecha) fecha
                from ficha
                where costo !=0
                group by id_paciente
            )ficha
            on(ficha.id_paciente=paciente.id)
            left join(
                select id_paciente,hora,min(fecha) fecha
                from ficha
                where costo =0
                group by id_paciente
            )ficha2
            on(ficha2.id_paciente=paciente.id)
    	    WHERE   concat(paciente.nombre,' ',paciente.apellido) LIKE '%".$q."%' OR
                    rut LIKE '%".$q."%' OR
                    edad LIKE '%".$q."%' OR
                    telefono LIKE '%".$q."%' OR
                    (correo LIKE '%".$q."%')
            ORDER BY case when proximaAtencion is null then 1 else 0 end,proximaAtencion";
}

$buscarCliente=mysqli_query($con,$query);
$filas=mysqli_num_rows($buscarCliente);
if ($filas> 0)
{
	$tabla.= 
    '<br>
    <table class="content-table">
        <thead>
            <tr class="bg-primary">
                <td>Rut</td>
                <td>Nombre Paciente</td>
                <td>Proxima fecha de atencion</td>
                <td>ultima fecha de atencion</td>
                <td>Mas links</td>
            </tr>
        </thead>';

	while($filaCliente= $buscarCliente->fetch_assoc())
	{   
        if($filaCliente['nombreApellido'] != 'patricia irigoin'){
            if ($filaCliente['proximaAtencion'] == NULL ){
                $proxA="No tiene";
            }else{
                $proxA=$filaCliente['proximaAtencion'];
            }
            if ($filaCliente['ultimaAtencion'] == NULL ){
                $ultimaA="No tiene";
            }else{
                $ultimaA=$filaCliente['ultimaAtencion'];
            }
            $tabla.=
            '<tbody>
                <tr>
                    <td>'.$filaCliente['rut'].'-'.$filaCliente['dv'].'</td>
                    <td>'.$filaCliente['nombreApellido'].'</td>
                    <td>'.$proxA.'</td>
                    <td>'.$ultimaA.'</td>
                    <td> 
                        <button id="btn-abrir-modal"  type="button" class="btn btn-primary" onclick="location.href=\'verFichas.php?rut='.$filaCliente['rut'].'&dv='.$filaCliente['dv'].'\'">
                        Ver ficha
                        </button>
                    </td>
                
                </tr>
            </tbody>';
        }
	}

	$tabla.='</table>';
} else
	{
		$tabla.='<h4 class="tabla_buscador">No se encontraron coincidencias con sus criterios de búsqueda.</h4>';
	}


echo $tabla;
?>