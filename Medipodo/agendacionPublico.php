<?php include("conexion/db.php");?>
<?php 
  session_start();
  if(isset($_GET['fecha'])){
    $fecha = $_GET['fecha'];
  }else{
    header('Location:index.php#calendar_sec');
  }
  $desadmin=0;
  $p="publico";
  if(isset($_GET['admin'])){
    $admin = '<i class="bi bi-person-circle"></i> <a href="podologo.php">volver a pagina principal</a>';
    $name_calendar = "admin";
    $href = 'index.php?admin=admin';
    $desadmin=1;
    $p="publicoadmin";
  }else{
    session_unset(); 
      // destroy the session 
    session_destroy();
    $admin = '<i class="bi bi-person-circle"></i> <a href="login.php">Admin</a>';
    $name_calendar = "";
    $href = 'index.php';
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
        <i class="bi bi-envelope"></i> <a href="mailto:patyirigoin@yahoo.es">patyirigoin@yahoo.es</a>
        <i class="bi bi-phone"></i> +569 72125596
        <?php
          echo $admin;
        ?>
        
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="<?php echo $href ?>">MediPOD</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="<?php echo $href ?>#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="<?php echo $href ?>#calendar_sec">Calendario</a></li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header><!-- End Header -->

<!-- ======= Appointment Section ======= -->

<div class="contenedor-form" style="max-width: 500px;">
    <style>
        .alertwrong{
            background: #ffdb9b;
            padding: 15px 49px !important;
            width: 360px;
            border-radius: 4px;
            border-left: 8px solid #ffa502 !important;
            overflow:hidden;
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

    <?php
      $ocultar="block";
      $fechaactual = date("Y-m-d");
      $fecha2 = date("Y-m-d", strtotime($fecha));
      $html ='';
      if($fecha2 < $fechaactual){
        $ocultar="none";
        $html='<h2>Ups... no puedes agendar en días pasados.</h2>
        <a href="'.$href.'">
          <button>Volver a calendario</button>
        </a>';
      }
      echo $html;
    ?>
    
    <div class="toggle" style="display:<?php echo $ocultar ?>;">
        <span>Desagendar</span>
    </div>

    <div class="formulario1" style="display:<?php echo $ocultar ?>;">
      <?php $hayfechas='block';?>
      <h1>Agregar cita Podogologica </h1>
      <h3>Dia: <?php echo $fecha ;?></h3>
      <form action="conexion/calAdminConnect.php?F=<?php echo $fecha?>&p=<?php echo $p?>" method="post">
        <label for="lang">HORARIOS</label> <!-- aca se podria hacer en un futuro el despliegue de pacientes ya existentes para no escribit todo denuevo-->
        
        <select name="hora">   
          <?php //acaa hay que crear una query en donde se vean los nombres y apellido de las personas agendadas en tal fecha  
            $query_H = $con->query("select hora
            from horas
            where hora not in(
            select ficha.hora
            from ficha 
            where ficha.fecha='$fecha')");   
            $html2='';       
            if(mysqli_num_rows($query_H)==0){
              $hayfechas = 'none';
              $html='<h2>Ups... no hay fechas disponibles.</h2>
              <a href="'.$href.'">
                <button>Volver a calendario</button>
              </a>';
            }else{
              while ($horas = $query_H->fetch_assoc()) {
                echo '<option value="'.$horas['hora'].'">'.$horas['hora'].'</option>';                  
              }
            }
            
          ?>
        </select>
        <?php echo $html2; ?>    
        <select name="tipo_visita" onchange="val()" id="select_id">
          <option value="presencial" >En clinica</option>
          <option value="domicilio" >A domicilio</option>
        </select>

        <fieldset style="display:<?php echo $hayfechas?>;">
          <input id="dircc" placeholder="direccion" type="text" name="direccion" tabindex="0" style="display:none;">
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
          <input placeholder="Celular" type="tel" name="celular" tabindex="4" required pattern="[9]{1}[0-9]{8}">
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
      <h2>Desagendar Cita</h2>
      
      <form action="conexion/calAdminConnect.php?F=<?php echo $fecha;?>&admin=<?php echo $desadmin?>" method="post">
        <fieldset>
          <input placeholder="Nombre" type="text" name="nombre" tabindex="1" required minlength="2">
        </fieldset>

        <fieldset>
          <input placeholder="Apellido" type="text" name="apellido" tabindex="2"  required minlength="3">
        </fieldset>

        <fieldset>
          <input placeholder="Celular" type="tel" name="celular" tabindex="4" required pattern="[9]{1}[0-9]{8}">
        </fieldset>

        <fieldset>
          <input placeholder="Rut" type="text" name="rutcdv" tabindex="5" required pattern="\b[0-9]{1,2}[0-9]{6}[0-9k]{1}">
        </fieldset>

        <select name="hora">   
          <?php //acaa hay que crear una query en donde se vean los nombres y apellido de las personas agendadas en tal fecha  
            $query_H = $con->query("SELECT * FROM atencionpodologica.horas");          
            while ($horas = $query_H->fetch_assoc()) {
              echo '<option value="'.$horas['hora'].'">'.$horas['hora'].'</option>';                  
            }
          ?>
        </select>

        <fieldset>
          <button name="desagendar_P" type="submit" id="contact-submit">Desagendar</button>
        </fieldset>        
      </form>      
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
        'padding-top':'60px',
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