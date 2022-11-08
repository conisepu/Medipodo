<?php include("conexion/db.php");?>


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
        <i class="bi bi-envelope"></i> <a href="mailto:patyirigoin@yahoo.es">patyirigoin@yahoo.es</a>
        <i class="bi bi-phone"></i> +569 72125596
        <i class="bi bi-person-circle"></i> Bienvenida Patricia.
        <i class="bi bi-box-arrow-left"></i> <a href="index.php">Cerrar Sesión</a>
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
          <li><a class="nav-link scrollto active" href="podologo.php#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="podologo.php#calendar_sec">Calendario</a></li>
          <li><a class="nav-link scrollto" href="podologo.php#about">Buscador</a></li>
          <li><a class="nav-link scrollto" href="inventario.php">Insumos de atencion</a></li>
          <li><a class="nav-link scrollto" href="estado_financiero.php">Estado Financiero</a></li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header><!-- End Header -->

<!-- ======= Appointment Section ======= -->
<section id="appointment" class="appointment section-bg"  style="padding: 230px 0 120px  0 !important;">
      <div class="container">

      <?php
        $rut = $_GET['rut'];
        $d_ver = $_GET['dv'];
        $query_NP = $con->query("SELECT * FROM atencionpodologica.paciente where rut = '$rut' and d_verificador = '$d_ver'");
        while ($raw = $query_NP->fetch_assoc()) {
            $nombre_paciente =  $raw['nombre'];
            $apellido_paciente =  $raw['apellido'];
            $id_paciente = $raw['id'];
        }
      ?>

        <div class="section-title">
          <h2>Ficha de <?php echo ($nombre_paciente. ' '.$apellido_paciente);?></h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>


        <form action="forms/appointment.php" method="post" role="form" class="php-email-form">
          <div class="row">
            <div class="col-md-4 form-group">
              Nombre:<input type="text" name="name" class="form-control" id="name" value = "<?php echo $nombre_paciente?>" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
              <div class="validate"></div>
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
              Apellido:<input type="email" class="form-control" name="email" id="email" value = "<?php echo $apellido_paciente ?>" data-rule="email" data-msg="Please enter a valid email" >
              <div class="validate"></div>
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
              Rut:<input type="tel" class="form-control" name="phone" id="phone" value = "<?php echo $rut.'-'.$d_ver ?>" data-rule="minlen:4" data-msg="Please enter at least 4 chars" readonly>
              <div class="validate"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 form-group mt-3">
              Elegir fecha
              <select name="department" id="department" class="form-select" >
              <?php
                $query = $con->query("SELECT * FROM SELECT * FROM atencionpodologica.ficha where id_paciente = '$id_paciente'");
                while ($valores = $query->fetch_assoc()) {
                  echo '<option value="'.$valores[id].'">'.$valores[paises].'</option>';
                }
              ?>              
              </select>
              <div class="validate"></div>
            </div>
            <div class="col-md-4 form-group mt-3">
              Precio<input type="datetime" name="date" class="form-control datepicker" id="date" value = "<?php echo '$costo' ?>" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
              <div class="validate"></div>
            </div>
            <div class="col-md-4 form-group mt-3">
              Tipo visita<input type="datetime" name="date" class="form-control datepicker" id="date" value = "<?php echo 'TIPO VISITA' ?>" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
              <div class="validate"></div>
            </div>
            
            <!-- <div class="col-md-4 form-group mt-3">
              <select name="doctor" id="doctor" class="form-select">
                <option value="">Select Doctor</option>
                <option value="Doctor 1">Doctor 1</option>
                <option value="Doctor 2">Doctor 2</option>
                <option value="Doctor 3">Doctor 3</option>
              </select>
              <div class="validate"></div>
            </div> -->
          
          </div>

          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
            <div class="validate"></div>
          </div>
          <div class="mb-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
          </div>
          <div class="text-center"><button type="submit">Make an Appointment</button></div>
        </form>

      </div>
    </section><!-- End Appointment Section -->





  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  

  <script src="assets/js/main.js"></script>
  

</body>

</html>