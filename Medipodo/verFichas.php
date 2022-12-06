<?php include("conexion/db.php");?>
<?php
include 'funciones/rol_admin.php';

if(isset($_GET['rut']) && isset($_GET['dv']) ){
  $rut = $_GET['rut'];
  $d_ver = $_GET['dv'];
}else{
  header('Location:podologo.php#about');
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
          <li><a class="nav-link scrollto active" href="podologo.php#about">Buscador</a></li>
          <li><a class="nav-link scrollto" href="inventario.php">Insumos de atención</a></li>
          <li><a class="nav-link scrollto" href="estado_financiero.php">Estado Financiero</a></li>         
            <li><a id="aus" class="nav-link scrollto" href="diasAusentes.php">Ausentarse por motivo</a></li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header><!-- End Header -->
<?php

  $query_NP = $con->query("SELECT nombre, apellido, id_paciente, correo, telefono, direccion, edad FROM atencionpodologica.paciente 
  left join atencionpodologica.ficha on ficha.id_paciente=paciente.id where rut = '$rut' and d_verificador = '$d_ver'");
  while ($raw = $query_NP->fetch_assoc()) {
      $nombre_paciente =  $raw['nombre'];
      $apellido_paciente =  $raw['apellido'];
      $id_paciente = $raw['id'];
      $correo = $raw['correo'];
      $celular = $raw['telefono'];
      $direccion = $raw['direccion'];
      $edad = $raw['edad'];
  }
  $query_select_option_fechas = $con->query("SELECT fecha, hora, costo FROM atencionpodologica.ficha
                                             WHERE ficha.id_paciente = '$id_paciente' order by fecha desc");        
?>

<!-- ======= Appointment Section ======= -->
<section id="appointment" class="appointment section-bg"  style="padding: 230px 0 120px  0 !important;">
      <div class="container">   

      <style>
        .alertwrong{
            background: #ffdb9b;
            padding: 15px 49px !important;
            width: 360px;
            border-radius: 4px;
            border-left: 8px solid #ffa502 !important;
            overflow:hidden;
            margin: auto;
            margin-bottom: 60px;
        }

        .alertwrong.show{
            animation: show_slide 1s ease forwards;
        }

        @keyframes show_slide {
            0%{
                transform: translateX(100%);
            }
            40%{
                transform: translateX(-10%);
            }
            80%{
                transform: translateX(0%);
            }
            100%{
                transform: translateX(0%);
            }
        }

        .alertwrong .fa-exclamation-circle{
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%) !important;
            color: #ffa502;
            font-size: 30px;
        }

        .alertwrong .msgalert{
            font-size: 14px;
            color: #342407;

        }

        .alertwrong .close-btn-alertwrong{
            background: #ffa502;
            position: absolute;
            right: 0px;
            top: 50%;
            transform: translateY(-50%);
            padding: 20px 18px;
            cursor:pointer;
        }

        .close-btn-alertwrong:hover{
            background: #f8c977;
        }

        .close-btn-alertwrong .fa-times{
            color: #ffdb9b;
            font-size: 22px;
            line-height: 40px;
        }
      </style>

      <?php
        $noti = 'none';
        if(isset($_GET['fallo'])){
            if($_GET['fallo'] == 'T'){
                $noti = 'block';
            }
        }
      ?>
      <div id="alertagenda" class="alertwrong show" style="display:<?php echo $noti?>">
          <span class="fas fa-exclamation-circle"></span>
          <span class="msgalert">Hubo un error en los datos ingresados</span>
          <span class="close-btn-alertwrong">
              <span class="fas fa-times"></span>
          </span>
      </div>
      <script>
        $('.close-btn-alertwrong').click(function(){
          document.getElementById("alertagenda").style.display = "none";
        });
      </script>


        <div class="section-title">
          <h2>Ficha de <?php echo ($nombre_paciente. ' '.$apellido_paciente);?></h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>


        <form action="conexion/calAdminConnect.php?rut=<?php echo $rut?>&dv=<?php echo $d_ver?>" method="post">

          <div class="row">
            <div class="col-md-4 form-group">
              Nombre:<input type="text" name="nombre" class="form-control" id="name" value = "<?php echo $nombre_paciente?>" data-rule="minlen:4"  readonly>
            </div>

            <div class="col-md-4 form-group mt-3 mt-md-0">
              Apellido:<input type="text" class="form-control" name="apellido" id="apellido" value = "<?php echo $apellido_paciente ?>" data-rule="email"  readonly>
            </div>

            <div class="col-md-4 form-group mt-3 mt-md-0">
              Rut:<input type="text" class="form-control" name="rut" id="rut" value = "<?php echo $rut.'-'.$d_ver ?>" data-rule="minlen:4"  readonly>
            </div>

            <div class="col-md-4 form-group mt-3 mt-md-0">
              Correo:<input type="text" class="form-control" name="correo" id="correo" value = "<?php echo $correo ?>" data-rule="minlen:4" readonly>
            </div>

            <div class="col-md-4 form-group mt-3 mt-md-0">
              Telefono:<input type="tel" class="form-control" name="telefono" id="phone" value = "+56<?php echo $celular ?>" data-rule="minlen:4"  readonly>
            </div>

            <div class="col-md-4 form-group mt-3 mt-md-0">
              Direccion:<input type="tel" class="form-control" name="direccion" id="direccion" value = "<?php echo $direccion ?>" data-rule="minlen:4"  readonly>
            </div>

            <div class="col-md-4 form-group mt-3 mt-md-0">
              edad:<input type="tel" class="form-control" name="edad" id="edad" value = "<?php echo $edad ?>" data-rule="minlen:4"  readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 form-group mt-3">
              Elegir fecha
              <select name="selectFechas" id="selectFechas" class="form-select" onchange=fetchfecha(this.value)>
              <option>Elige una hora</option>
              <?php
                while ($select_option_fechas = $query_select_option_fechas->fetch_assoc()) {
                  echo ('<option value="'.$select_option_fechas['fecha'].' '.$id_paciente.'">'.$select_option_fechas['fecha'].'</option>');
                }                
              ?>         
              </select>
            </div>


            <div class="col-md-4 form-group mt-3">
              Precio<input type="number" name="precio" class="form-control datepicker" id="precio">
            </div>

            <div class="col-md-4 form-group mt-3">
              Tipo visita<input type="datetime" name="tipo_visita" class="form-control datepicker" id="tipovisita" readonly>
            </div>

          </div>

          <div class="form-group mt-3">
            <textarea id ="idcomentariotext" class="form-control" name="comentario" rows="5"></textarea>            
          </div>
          
          <!-- <div class="mb-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
          </div> -->
          <fieldset>
            <button name="guardarficha" type="submit" id="contact-submit">Guardar Datos</button>
          </fieldset>
          <!-- <div class="text-center"><button name="guardarficha" type="submit">Guardar Datos</button></div> -->
        </form>
        <fieldset>
            <button id="contact-submit" onclick="myFunction()">Mostrar Historial</button>
        </fieldset>
      </div>
</section><!-- End Appointment Section -->

<section>
  <table id="tablaHistorial" class="content-table" style="display:none;">
    <thead>
        <tr class="bg-primary">
          <td>Dia</td>
          <td>Mes</td>
          <td>Año</td>
          <td>Hora</td>
          <td>¿Ha sido atendido?</td>
        </tr>
    </thead>
    <?php
      $queryhistorial = $con->query("SELECT fecha, hora, costo FROM atencionpodologica.ficha
                                     WHERE ficha.id_paciente = '$id_paciente' order by fecha desc");
      while($filafecha= $queryhistorial->fetch_assoc()){
        // echo $filafecha['fecha'];
        $year = substr($filafecha['fecha'],0,4);
        $mes = substr($filafecha['fecha'],5,2);
        $dia = substr($filafecha['fecha'],8,2);
        $hora = $filafecha['hora'];
        $costo = $filafecha['costo'];
        if($costo == 0){
          $resp = "Aun no";
        }else{
          $resp = "Si";
        }
        echo '<tbody>
                <tr>
                <td>'.$dia.'</td>
                <td>'.$mes.'</td>
                <td>'.$year.'</td>
                <td>'.$hora.'</td>     
                <td>'.$resp.'</td>                       
                </tr>
              </tbody>';
      }
    ?>
  </table>
</section>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  
  <script>
    function fetchfecha(fecha) {
      // alert(id);
      // return false;
      $('#precio').html('');
      $('#tipovisita').html('');
      $('#idcomentariotext').html('');
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php', //Aqui va tu ruta php
        data: {fecha_id: fecha}, //Aqui tus variables javascript que asignaste arriba
        success:function(data){
          //$('#precio').html(data);
          //alert(typeof data);
          data = $.parseJSON(data);
          $('#precio').val(data.costo);
          $('#tipovisita').val(data.tipo);
          $('#idcomentariotext').val(data.comentario);
        },
        
      });
    }

    function myFunction() {
      if(document.getElementById("tablaHistorial").style.display == 'none'){
        document.getElementById("tablaHistorial").style.display = "table";
      }else{
        document.getElementById("tablaHistorial").style.display = "none";
      }
      
    }
  </script>             
  <script src="assets/js/main.js"></script>
  

</body>

</html>