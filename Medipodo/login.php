<?php 

    
    session_start();

    if(isset($_GET['cerrar_sesion'])){
        session_unset(); 
        // destroy the session 
        session_destroy();
        header('location: index.php');
    }
    
    if(isset($_SESSION['ID_Usuario'])){
        switch($_SESSION['ID_Usuario']){
            case 1:
                header('location: podologo.php');
            break;            
            // default:
            // header('location: menu_estudiante.php');
            // break;
        }
    }

    
?>

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
  <link href="assets/css/style-login.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab - v4.8.1
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



<!------ Include the above in your HEAD tag ---------->

<style>
    .alert{
        background: #ffdb9b;
        padding: 15px 49px !important;
        width: 360px;
        border-radius: 4px;
        border-left: 8px solid #ffa502 !important;
        overflow:hidden;
        margin-bottom: 60px;
    }

    .alert.show{
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

    .alert .fa-exclamation-circle{
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%) !important;
        color: #ffa502;
        font-size: 30px;
    }

    .alert .msgalert{
        font-size: 14px;
        color: #342407;
    }

    .alert .close-btn-alert{
        background: #ffa502;
        position: absolute;
        right: 0px;
        top: 50%;
        transform: translateY(-50%);
        padding: 20px 18px;
        cursor:pointer;
    }

    .close-btn-alert:hover{
        background: #ffdb9b;
    }

    .close-btn-alert .fa-times{
        color: #ffdb9b;
        font-size: 22px;
        line-height: 40px;
    }

    .alertapass{
        background-color: #afff9b;
        border-radius: 10px;
    }
</style>
<?php
      $noti = 'none';
      $npass = 'none';
      if(isset($_GET['fallo'])){
          if($_GET['fallo'] == 'true'){
              $noti = 'block';
          }
      }
      if(isset($_GET['noti'])){
        if($_GET['noti'] == 'T'){
            $npass = 'block';
        }
    }

?>  


<div id="formFooter">
      <a class="underlineHover" href="index.php">Volver atras</a>
</div>   
   
<div class="wrapper fadeInDown">
    <div id="alertagenda" class="alert show" style="display:<?php echo $noti?>">
      <span class="fas fa-exclamation-circle"></span>
      <span class="msgalert">Hubo un error en los datos ingresados</span>
      <span class="close-btn-alert">
          <span class="fas fa-times"></span>
      </span>
    </div>
    
    

    <div id="alertapass" class="alertapass" style="display:<?php echo $npass?>">
        <span class="msgalert">Se envio correctamente a su correo</span>
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
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="46" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
          </svg>
      </div>

      <!-- Login Form -->
      <form action="conexion/verificar_admin.php" method="post">
        <input type="email" id="login" class="fadeIn second" name="correo" placeholder="login">
        <input type="password" id="password" class="fadeIn third" name="pass" placeholder="password">
        <input type="submit" class="fadeIn fourth" name="login" value="Log In">
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="enviar_correo/enviar_cita.php?correo=conisepulvedairigoin@gmail.com&fecha=&hora=&tipo=&p=password">Olvide mi contraseña?</a>
      </div>

    </div>
</div>


