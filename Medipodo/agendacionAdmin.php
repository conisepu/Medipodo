<?php 
  include 'funciones/rol_admin.php';
  include("conexion/db.php");
  
  if(isset($_GET['fecha'])){
    $fecha = $_GET['fecha'];
  }else{
    header('Location:podologo.php#calendar_secP');
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Medilab Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">  
  <link rel="stylesheet" href="assets/css/calendar_style.css">

  <!-- =======================================================
  * Template Name: Medilab - v4.8.1
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <script src="assets/js/jquery-3.1.1.min.js"></script> 
  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-box-arrow-in-left"></i><a href="index.php?admin=admin">ir a pag. publica</a>
        <i class="bi bi-person-circle"></i> Bienvenida Patricia.
        <i class="bi bi-box-arrow-left"></i> <a href="login.php?cerrar_sesion=true">Cerrar Sesión</a>
      </div>
      <!--<div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>-->
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
   <div class="container d-flex align-items-center">
     <h1 class="logo me-auto"><a href="podologo.php">MediPOD</a></h1>
     <!-- Uncomment below if you prefer to use an image logo -->
     <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
     <nav id="navbar" class="navbar order-last order-lg-0">
       <ul>
         <li><a class="nav-link scrollto" href="podologo.php#week">Home</a></li>
         <li><a class="nav-link scrollto" href="podologo.php#calendar_secP">Calendario</a></li>
         <li><a class="nav-link scrollto" href="podologo.php#about">Buscador</a></li>
         <li><a id="inv" class="nav-link scrollto" href="inventario.php">Insumos de atencion</a></li>
         <li><a id="fin" class="nav-link scrollto" href="estado_financiero.php">Estado Financiero</a></li>                  
         <li><a id="aus" class="nav-link scrollto" href="diasAusentes.php">Ausentarse por motivo</a></li>
       </ul>
       <i class="bi bi-list mobile-nav-toggle"></i>
     </nav><!-- .navbar
     <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a>  -->
   </div>
 </header><!-- End Header -->


<!-- ======= Appointment Section ======= -->
<div class="contenedor-form">
  <div class="row">

    <div class="col-sm">
    <section>
      <h2>Pacientes por atender hoy: <?php echo $fecha ;?></h2>

      <table id="tablaxdia" class="content-table">
        <thead>
            <tr class="bg-primary">
              <td>Nombre</td>
              <td>Hora</td>
              <td>Tipo visita</td>
              <td>Direccion</td>
            </tr>
        </thead>
        <?php
          $queryxdia = $con->query("SELECT paciente.nombre as 'nombre', paciente.apellido as 'apellido', ficha.hora as 'hora', tipo_visita.tipo as 'tipo_visita', ficha.direccion as 'direccion' 
                                        FROM atencionpodologica.paciente
                                        left join atencionpodologica.ficha on paciente.id = ficha.id_paciente
                                        left join atencionpodologica.agenda on agenda.id_ficha= ficha.id
                                        left join atencionpodologica.tipo_visita on  agenda.id_tipo = tipo_visita.id
                                        where ficha.fecha = '$fecha'
                                        order by hora");
          $bool=False;
          while($filaxdia = $queryxdia->fetch_assoc()){  
            $bool = True;          
            $nombreApellido = $filaxdia['nombre'].' '.$filaxdia['apellido'];
            $hora = $filaxdia['hora'];
            $tipo_visita = $filaxdia['tipo_visita'];
            
            if($tipo_visita == 'presencial'){
              $direccion = "En clinica";
            }else{
              $direccion = $filaxdia['direccion'];
            }
            echo '<tbody>
                    <tr>
                      <td>'.$nombreApellido.'</td>
                      <td>'.$hora.'</td>
                      <td>'.$tipo_visita.'</td>
                      <td>'.$direccion.'</td>                  
                    </tr>
                  </tbody>';
          }
          
        ?>
      </table>
      <?php 
        if(!$bool){
          ?>
            <h3>No hay citas para hoy</h3>
          <?php
        }
      ?>
    </section>
    </div>

    <?php
      $ocultar="block";
      $fechaactual = date("Y-m-d");
      $fecha2 = date("Y-m-d", strtotime($fecha));
      if($fecha2 < $fechaactual){
        $ocultar="none";
      }
    ?>
    <div class="col-sm" style="display:<?php echo $ocultar?>;">
      <div class="toggle">
          <span>Desagendar</span>
      </div>

      <div class="formulario1" >
        <?php $hayfechas='block';?>
        <h2>Agregar paciente <?php echo $fecha ;?></h2>

        <form action="conexion/calAdminConnect.php?F=<?php echo $fecha;?>" method="post">
          <label for="lang">HORARIOS</label> <!-- aca se podria hacer en un futuro el despliegue de pacientes ya existentes para no escribit todo denuevo-->
          
          <select name="hora">   
            <?php //acaa hay que crear una query en donde se vean los nombres y apellido de las personas agendadas en tal fecha  
              $query_H = $con->query("select hora
              from horas
              where hora not in(
              select ficha.hora
              from ficha 
              where ficha.fecha='$fecha')");
              if(mysqli_num_rows($query_H)==0){
                $hayfechas = 'none';
              }else{
                while ($horas = $query_H->fetch_assoc()) {
                  echo '<option value="'.$horas['hora'].'">'.$horas['hora'].'</option>';                  
                }
              }         
              
            ?>
          </select>

          <select name="tipo_visita" onchange="val()" id="select_id">
            <option value="presencial" >En clinica</option>
            <option value="domicilio" >A domicilio</option>
          </select>

          <fieldset style="display:<?php echo $hayfechas?>;">
            <input id="dircc" placeholder="direccion" type="text" name="direccion" tabindex="0" style="display:none;" >
          </fieldset> 
              
          <fieldset style="display:<?php echo $hayfechas?>;">
            <input placeholder="Nombre" type="text" name="nombre" tabindex="1" required minlength="2" pattern="([A-Za-zñÑ])\w+">
          </fieldset>

          <fieldset style="display:<?php echo $hayfechas?>;">
            <input placeholder="Apellido" type="text" name="apellido" tabindex="2" required minlength="3" pattern="([A-Za-zñÑ])\w+">
          </fieldset>

          <fieldset style="display:<?php echo $hayfechas?>;">
            <input placeholder="Correo" type="email" name="correo" tabindex="3" minlength="9" >
          </fieldset>

          <fieldset style="display:<?php echo $hayfechas?>;">            
            <input placeholder="Celular Ej: 9 77659987" type="text" name="celular" tabindex="4" required pattern="[9]{1}[0-9]{8}">
          </fieldset>

          <fieldset style="display:<?php echo $hayfechas?>;">
            <input placeholder="Rut" type="text" name="rutcdv" tabindex="5" required pattern="\b[0-9]{1,2}[0-9]{6}[0-9k]{1}">
          </fieldset>

          <fieldset style="display:<?php echo $hayfechas?>;">
            <input placeholder="Edad" type="text" name="edad" tabindex="6" required maxlength="2" pattern="([0-9])\w+">
          </fieldset> 

          <fieldset style="display:<?php echo $hayfechas?>;">
            <button name="submitSave" type="submit" id="contact-submit">Guardar</button>
          </fieldset>
        </form>
      </div>

      <div class="formulario2"> <!--Aca hay que usar la fecha para buscar los pacientes y eliminar el que se elija-->
        <h2>Desagendar paciente</h2>
        
        <form action="conexion/calAdminConnect.php?F=<?php echo $fecha;?>" method="post">
          <label for="lang">Pacientes</label>
          <select name="pacientes" id="lang">
            <option value="javascript">Elija paciente</option>
            <?php //acaa hay que crear una query en donde se vean los nombres y apellido de las personas agendadas en tal fecha  
              
              $query = $con->query("SELECT concat(paciente.nombre,' ',paciente.apellido) as 'Nombre Apellido', ficha.hora as 'hora'
                                    from agenda            
                                    left join( select id,id_paciente,fecha,comentario,costo, hora from ficha) 
                                    ficha on(ficha.id=agenda.id_ficha)
                                    left join(
                                    select id,rut,d_verificador,nombre,apellido,edad,telefono,correo
                                    from paciente
                                    )paciente
                                    on(paciente.id=ficha.id_paciente)
                                    where ficha.fecha='$fecha' 
                                    order by hora");          
              while ($valores = $query->fetch_assoc()) {
                echo '<option value="'.$valores['Nombre Apellido'].' '.$valores['hora'].'">'.$valores['Nombre Apellido'].'</option>';                  
              }
            ?>
          </select>

          <fieldset>
            <button name="desagendar" type="submit" id="contact-submit">Eliminar Reserva</button>
          </fieldset>
          
        </form>      
      </div>

    </div>
  </div>
</div>

  
  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script>
    $('.toggle').click(function(){

      $('.formulario1').animate({
          height:"toggle",
          'padding-top':'toggle',
          'padding-bottom': 'toggle',
          opacity: 'toggle'
      }, "slow")
      $('.formulario2').animate({
        height:"toggle",
        'padding-top':'toggle',
        'padding-bottom': 'toggle',
        opacity: 'toggle'
      }, "slow")
    });

    $('#select_id').change(function(){
      //alert($(this).val());
      if ($(this).val() == 'domicilio'){
        console.log($(this).val());
        const input_direccion = document.getElementById('dircc');
        input_direccion.style.display = "block";
      }else if ($(this).val() == 'presencial'){
        console.log($(this).val());
        const input_direccion = document.getElementById('dircc');
        input_direccion.style.display = "none";
      }
    });
    
  </script> 
  <script src="assets/js/main.js"></script>
  

</body>

</html>