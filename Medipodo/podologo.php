<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
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
  <!-- ======= Top Bar ======= -->

  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-box-arrow-in-left"></i><a href="index.php?admin=admin">ir a pag. publica</a>
        <i class="bi bi-person-circle"></i> Bienvenida Patricia.
        <i class="bi bi-box-arrow-left"></i> <a href="login.php?cerrar_sesion=true">Cerrar Sesión</a>
        <i class="bi bi-bag-dash"></i> <a style="cursor: pointer;" onclick="changepass()">Cambiar contraseña</a>
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
     <?php 
      // $consulta = $con->query("SELECT atiende FROM atencionpodologica.doctor");
      // if ($atiende = $consulta->fetch_assoc()) {
      //   if($atiende['atiende'] == 1){
      //     //significa que SI esta atendiendo
      //     $idbutton = "1";
      //     $msj="No Quiero atender";
      //   }else if($atiende['atiende'] == 0){
      //     //significa que NO esta atendiendo
      //     $idbutton = "0";
      //     $msj="voy a atender";
      //   }              
      // }
    ?>
     <!-- <button id="<?php //echo $idbutton ?>" onclick="DeshabilitarCalendarioPublico(this.id)" class="buttondes"><?php //echo $msj ?></button> -->
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


  <!-- ======= Hero Section ======= -->
  <!--<section id="hero" class="d-flex align-items-center">
     <div class="container">
      <h1>Bienvenidos a MediPOD</h1>
      <h2>Patricia Irigoin Figueroa, "comentario sobre el trabajo que hace"</h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div> 
  </section>--><!-- End Hero -->

  <main id="main">
    <?php
      $noti = 'none';
      $npass = 'none';
      if(isset($_GET['noti'])){
          if($_GET['noti'] == 'T' ){
            $noti = 'block';
          }elseif($_GET['noti'] == 'T0' ){
            $npass = 'block';
          }
      }
    ?>
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <form action="conexion/calAdminConnect.php" method="post">      
          
          <label for="">Nueva contraseña</label>
          <input id="npass" name="npass" type="password" value="" required>

          <button name="cambiarpass" type="submit" id="contact-submit">Guardar</button>              
        </form>
      </div>
    </div>   
    <!-- ======= Why Us Section ======= -->
    <section id="week" class="why-us">
      <div id="alertapass" class="alert show password" style="display:<?php echo $npass?>">
        <span class="fas fa-check-circle password"></span>
        <span class="msgalert password">Se cambio contraseña correctamente</span>
        <span class="close-btn-alert">
            <span class="fas fa-times"></span>
        </span>
      </div>
      <?php include 'semanaAdmin.php' ?>
    </section><!-- End Why Us Section -->

    <!-- ======= Calendar Section======= -->
    <section id="calendar_secP" class="calendar_sec">
      <?php //include 'funciones/alerta.php' ?>
      
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
          document.getElementById("alertapass").style.display = "none";
        });
      </script>
      <?php include 'calendarAdmin.php' ?>
    </section><!-- End Calendar Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

        <div class="row">
          <div id="buscador" class="buscador col-xl-10 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h3>FICHA PACIENTE, BUSCADOR</h3>
            <div class="search_bar">
              <!--<a href="#" class="icon-search"><img src="assets/img/icon_buscar_clientes.png" alt="icon-search"></a>-->
              <input type="text" id="busqueda" name="busqueda"  placeholder="¿A quién buscas?">    
            </div>
            <section id="tabla_resultado"></section>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    


    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-heartbeat"></i></div>
              <h4><a href="">Lorem Ipsum</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-pills"></i></div>
              <h4><a href="">Sed ut perspiciatis</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-hospital-user"></i></div>
              <h4><a href="">Magni Dolores</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-dna"></i></div>
              <h4><a href="">Nemo Enim</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-wheelchair"></i></div>
              <h4><a href="">Dele cardo</a></h4>
              <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-notes-medical"></i></div>
              <h4><a href="">Divera don</a></h4>
              <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Medilab</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Medilab</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script>
    function DeshabilitarCalendarioPublico(idbutton) { //1->0
      //alert(idbutton)//1
      $('.buttondes').html('');
      if(idbutton == '1'){
            //esta atendiendo, pero no quiere atender
            $('.buttondes').html('Voy a atender');            
        }else if(idbutton == '0'){
            //no esta atendiendo, pero quiere atender
            $('.buttondes').html('No quiero atender');
        }
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php', //Aqui va tu ruta php
        data: {idbutton: idbutton}, //Aqui tus variables javascript que asignaste arriba
        success:function(data){
          //$('#precio').html(data);
          //alert(data);
          data = $.parseJSON(data);
          document.getElementById(idbutton).id = data.atencionresult;
        },
        
      });
    }

    function fetchweek(week){
      //alert(week);
      $.ajax({
        url : 'conexion/extensionFicha.php',
        type : 'POST',
        dataType : 'html',
        data : { week: week },
        })

      .done(function(resultado){
        $("#semanacont").html(resultado);
      })
      .fail(function(){
          console.log("error");
      });
    }

    function changepass(){
      document.getElementById("myModal").style.display = "block";
      var span = document.getElementsByClassName("close")[0];
      span.onclick = function() {
        document.getElementById("myModal").style.display = "none";
      }
    }
  </script>

  <script src="assets/js/jscript_calendar.js"></script> 
  <script src="assets/js/js_menu_buscador.js"></script>
  <script src="assets/js/main.js"></script>
  

</body>

</html>