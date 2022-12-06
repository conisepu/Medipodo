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





  <!-- ======= dias ausentes ======= -->
    <section id="ausentes" class="counts" >
      <div class="container" style="padding: 150px 0 !important;">
      <style>
          .alertwrong{
              background: #ffdb9b;
              padding: 15px 49px !important;
              width: 360px;
              border-radius: 4px;
              border-left: 8px solid #ffa502 !important;
              overflow:hidden;
              margin: auto;
              margin-bottom: 56px;
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
            $notiwrong = 'none';
            if(isset($_GET['fallo'])){
                if($_GET['fallo'] == 'true'){
                  $notiwrong = 'block';
                }
            }elseif(isset($_GET['vacaciones'])){
                if($_GET['vacaciones'] == 'T'){
                    $noti = 'block';
                }
            }
        ?>  
       
        <div id="alertwrong" class="alertwrong show" style="display:<?php echo $notiwrong?>">
            <span class="fas fa-exclamation-circle"></span>
            <span class="msgalert">Ingrese correctamente lo datos</span>
            <span class="close-btn-alertwrong">
                <span class="fas fa-times"></span>
            </span>
        </div>

        
        <div id="alertagenda" class="alert show" style="display:<?php echo $noti?>">
            <span class="fas fa-check-circle"></span>
            <span class="msgalert">Funciono correctamente</span>
            <span class="close-btn-alert">
                <span class="fas fa-times"></span>
            </span>
        </div>
        <script>
            $('.close-btn-alert').click(function(){
                document.getElementById("alertagenda").style.display = "none";
            });
             
            $('.close-btn-alertwrong').click(function(){
            document.getElementById("alertwrong").style.display = "none";
            });
        </script>



        <div class="row" >

            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <form action="conexion/extensionFicha.php" method="post">
                        
                        <?php
                            $cont = date('Y-m-d');
                            $año_siguiente = (date("Y") + 2);
                        ?>
                        <label for="start">Inicio para agendar</label>
                        <input type="date" id="start" name="trip_start" value="<?php echo $cont?>" min="<?php echo $cont?>" max="<?php echo $año_siguiente.'-01-01' ?>">
                        
                        
                        <label for="start">Término para agendar</label>
                        <input type="date" id="finish" name="trip_finish" value="<?php echo $cont?>" min="<?php echo $cont?>" max="<?php echo $año_siguiente.'-01-01' ?>">
                        
                        <input type="submit" class="fadeIn fourth" name="agendar_diasausente" value="Agendar">
                    </form>
                
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <form action="conexion/extensionFicha.php" method="post">
                        
                        <?php
                            $cont = date('Y-m-d');
                            $año_siguiente = (date("Y") + 2);
                        ?>
                        <label for="start">Inicio para desagendar</label>
                        <input type="date" id="start" name="trip_start" value="<?php echo $cont?>" min="2021-01-01" max="<?php echo $año_siguiente.'-01-01' ?>">
                    
                    
                        <?php
                            $cont = date('Y-m-d');
                            $año_siguiente = (date("Y") + 2);
                        ?>
                        <label for="start">Término para desagendar</label>
                        <input type="date" id="finish" name="trip_finish" value="<?php echo $cont?>" min="2021-01-01" max="<?php echo $año_siguiente.'-01-01' ?>">
                        
                        <input type="submit" class="fadeIn fourth" name="desagendar_diasausente" value="Desagendar">
                    </form>
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
            document.getElementById("aus").classList.add('active');
        </script>
    <script src="assets/js/main.js"></script>
  

</body>

</html>