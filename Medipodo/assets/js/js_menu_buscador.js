// crear tabla dinamica para la busqueda/////////////////////////////

$(obtener_registros());

function obtener_registros(busqueda)
{
	$.ajax({
		url : './conexion/buscador.php',
		type : 'POST',
		dataType : 'html',
		data : { busqueda: busqueda },
		})

	.done(function(resultado){
		$("#tabla_resultado").html(resultado);
    })
    .fail(function(){
        console.log("error");
    });
}

$(document).on('keyup', '#busqueda', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_registros(valorBusqueda);
	}
	else
		{
			obtener_registros();
		}
});

