<?php 
include 'funciones/rol_admin.php';
include("conexion/db.php");
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
         <li><a id="inv" class="nav-link scrollto" href="inventario.php">Insumos de atención</a></li>
         <li><a id="fin" class="nav-link scrollto" href="estado_financiero.php">Estado Financiero</a></li>         
         <li><a id="aus" class="nav-link scrollto" href="diasAusentes.php">Ausentarse por motivo</a></li>
         
       </ul>
       <i class="bi bi-list mobile-nav-toggle"></i>
     </nav><!-- .navbar
     <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a>  -->
   </div>
 </header><!-- End Header -->

<!-- ======= Appointment Section ======= -->
<?php
  $query = $con->query("SELECT count(*) as cantidad FROM paciente");
  $query2 = $con->query("SELECT sum(costo) as 'montoTotal' FROM ficha");

  while (($valores = $query->fetch_assoc()) && ($valores2 = $query2->fetch_assoc()) ) {  
    $cantidad_P = $valores['cantidad'];    
    $montoTotal = $valores2['montoTotal'];          
  }
?> 

<!-- ======= Counts Section ======= -->
<section id="counts" class="counts"  style="padding: 240px 0 !important;">
      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="fa-solid fa-sack-dollar"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $montoTotal?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Monto total hasta ahora</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="fa-solid fa-sack-dollar"></i>
              <?php
                $cont = date('Y');
              ?>
              <select name="montototalAnio" id="montototalAnio" class="montoAnio form-select" onchange=fetchYear(this.value) >
                <option>Elige año</option>
                <?php while ($cont >= 2021) { ?>
                  <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                <?php $cont = ($cont-1); } ?>
              </select>
              <span id="purecounter_0">0</span>
              <p>Monto total por año</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="far fa-hospital"></i>
              <?php
                $cont = date('Y');
              ?>
              <select name="montoAnio" id="montoAnio" class="montoAnio form-select" >
                <option>Elige año</option>
                <?php while ($cont >= 2021) { ?>
                  <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                <?php $cont = ($cont-1); } ?>
              </select>
              <select name="montoMes" id="montoMes" class="montoMes form-select" onchange=fetchMmes(this.value)>
                <option>Elige Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>

              <span id="purecounter_1">0</span>
              <p>Monto por mes</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fa-solid fa-sack-dollar"></i>
              <?php
                $consultaPaciente = $con->query("SELECT * FROM paciente");
              ?> 
              <select name="selectpaciente" id="selectpaciente" class="form-select" onchange=fetchprecio(this.value)>
                <option>Elige paciente</option>
                <?php
                  while (($val = $consultaPaciente->fetch_assoc()) ) {       
                    echo ('<option value="'.$val['id'].'">'.$val['nombre'].' '.$val['apellido'].'</option>');
                  }
                ?> 
              </select>
              <span id="purecounter_2">0</span>
              <p>Monto por persona</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fa-solid fa-sack-dollar"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $cantidad_P?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Cantidad de Pacientes</p>
            </div>
          </div>

        </div>
        

      </div>
</section><!-- End Counts Section -->



  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script>

    document.getElementById("fin").classList.add('active');

    function fetchprecio(id) {
      //alert(id);
      // return false;
      //$('#purecounter_2').html('');
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php', //Aqui va tu ruta php
        data: {id_paciente: id}, //Aqui tus variables javascript que asignaste arriba
        success:function(data){          
          $('#purecounter_2').html(data);
        },
        
      });
    }


    function fetchMmes(mes) {
      //alert(mes);
      let selectedItem = $("#montoAnio").children("option:selected").val();
      // alert("You have selected the name - " + selectedItem);
      // return false;
      //$('#purecounter_1').html('');
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php', //Aqui va tu ruta php
        data: {mes: mes, year: selectedItem}, //Aqui tus variables javascript que asignaste arriba
        success:function(data){          
          $('#purecounter_1').html(data);
        },
        
      });
    }

    function fetchYear(year) {
      //alert(year);
      //let selectedItem = $("select.montoAnio").children("option:selected").val();
      // alert("You have selected the name - " + selectedItem);
      // return false;
      //$('#purecounter_0').html('');
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php', //Aqui va tu ruta php
        data: {year_pure0: year}, //Aqui tus variables javascript que asignaste arriba
        success:function(data){          
          $('#purecounter_0').html(data);
        },
        
      });
    }


  </script>

  <script src="assets/js/main.js"></script>
  

</body>

</html>