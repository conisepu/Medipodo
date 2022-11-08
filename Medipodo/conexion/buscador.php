<?php
/////// CONEXIÓN A LA BASE DE DATOS /////////
include 'db.php';
//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$query="SELECT *  FROM atencionpodologica.paciente";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['busqueda']))
{
	$q=trim($_POST['busqueda']);
	$query="SELECT  *  
            FROM    atencionpodologica.paciente
    	    WHERE   nombre LIKE '%".$q."%' OR
                    apellido LIKE '%".$q."%' OR
                    rut LIKE '%".$q."%' OR
                    edad LIKE '%".$q."%' OR
                    telefono LIKE '%".$q."%' OR
                    correo LIKE '%".$q."%'";
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
		$tabla.=
        '<tbody>
            <tr>
			    <td>'.$filaCliente['rut'].'-'.$filaCliente['d_verificador'].'</td>
			    <td>'.$filaCliente['nombre'].' '.$filaCliente['apellido'].'</td>
			    <td>aca juntar tablas</td>
                <td>aca juntar tablas</td>
                <td> 
                    <button id="btn-abrir-modal"  type="button" class="btn btn-primary" onclick="location.href=\'verFichas.php?rut='.$filaCliente['rut'].'&dv='.$filaCliente['d_verificador'].'\'">
                      Ver ficha
                    </button>
                </td>
			
		    </tr>
        </tbody>';
	}

	$tabla.='</table>';
} else
	{
		$tabla.='<h4 class="tabla_buscador">No se encontraron coincidencias con sus criterios de búsqueda.</h4>';
	}


echo $tabla;
?>
