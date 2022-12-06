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
      $consulta = $con->query("SELECT * from 
                              (select t3.id,sum(cantidad) as 'CantidadTotalHistorica',sum(t3.cantidad*t3.precioxunidad) as 'GastoTotalHistorico'
                              from(
                              select t2.id,t2.nombre,t1.cantidad,t1.precioxunidad,t1.fecha from historial as t1
                              left join inventario as t2
                              on t2.id=t1.id_producto) t3
                              group by id) as t4 right join inventario on t4.id=inventario.id
                              order by cantidad desc");
      $consulta2 = $con->query("SELECT * FROM atencionpodologica.inventario");
    ?>

    <section id="counts" class="counts" style="padding: 190px 0 !important;">
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
          if(isset($_GET['b'])){
              if($_GET['b'] == 'F'){
                $notiwrong = 'block';
              }elseif($_GET['b'] == 'T'){
                $noti = 'block';
            }
          }
      ?>  
      <div id="alertwrong" class="alertwrong show" style="display:<?php echo $notiwrong?>">
          <span class="fas fa-exclamation-circle"></span>
          <span class="msgalert">El producto ya existe</span>
          <span class="close-btn-alertwrong">
              <span class="fas fa-times"></span>
          </span>
      </div>
      <script>
        $('.close-btn-alertwrong').click(function(){
          document.getElementById("alertwrong").style.display = "none";
        });
      </script>                        
      <div class="container">
        <div class="row">

          <div class="col-lg-3" style="margin: auto;">
            <div class="count-box">
              <i class="far fa-hospital"></i>
              <?php
                $cont = date('Y');
              ?>
              <select name="Anio" id="Anio" class="Anio form-select" >
                <option>Elige año</option>
                <?php while ($cont >= 2021) { ?>
                  <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                <?php $cont = ($cont-1); } ?>
              </select>


              <select name="Mes" id="Mes" class="Mes form-select">
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

              <select name="producto" id="producto" class="producto form-select" >
                <option>Elige producto</option>
                <?php
                  while ($inventario2 = $consulta2->fetch_assoc()){
                    ?><option value="<?php echo $inventario2['id']?>"><?php echo $inventario2['nombre']?></option><?php
                  }
                ?>
              </select>

              <span id="purecounter_1">0</span>
              <p>Monto por mes</p>

              <button onclick="fetchproducto()">Consultar</button>
            </div>
          </div>

          <form action="conexion/calAdminConnect.php" method="post">

            <label for="nombre_inv">Nombre:</label><input name="nombre_inv" type="text" required>

            <label for="cant_inv">Stock:</label><input name="cant_inv" type="text" required pattern="([0-9])+">   

            <label for="precioxunidad_inv">Precio por unidad:</label><input name="precioxunidad_inv" type="text" required pattern="([0-9])+">

            </label><button name="Agregarinventario" type="submit" id="contact-submit">Agregar</button> 

          </form>



          
          <div id="alertagenda" class="alert show" style="display:<?php echo $noti?> ">
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
          </script>




          <table class="content-table" style="margin-top: 50px;">
            <thead >
              <tr class="bg-primary">
                  <th>Nombre <i id="orN" class="fa fa-sort-desc" aria-hidden="true" onclick="ordenar_nombre()"></i></th>
                  <th>Stock Actual<i id="orS" class="fa fa-sort-desc" aria-hidden="true" onclick="ordenar_stock()"></i></th>
                  <th>Precio x unidad Actual <i id="orPXU" class="fa fa-sort-desc" aria-hidden="true" onclick="ordenar_PXUnidad()"></i></th>
                  <th>Inversion actual de stock <i id="orPI" class="fa fa-sort-desc" aria-hidden="true" onclick="ordenar_PIHistorico()"></i></th>
                  <th>Cantidad Total Historica <i id="orCT" class="fa fa-sort-desc" aria-hidden="true" onclick="ordenar_CTHistorico()"></i></th>
                  <th>Gasto Total Historico <i id="orGT" class="fa fa-sort-desc" aria-hidden="true" onclick="ordenar_GTHistorico()"></i></th>
                  <th>Opciones</th>
              </tr>
            </thead>
            <tbody id="contenedor-orden">              
              <?php
                while ($inventario = $consulta->fetch_assoc()) {
                  $precioTotal = (intval( $inventario['precioxunidad']  ))*( intval( $inventario['cantidad']  ));
                  echo ('<tr>                
                  <td>'.$inventario['nombre'].'</td>    
                  <td>'.$inventario['cantidad'].'</td>
      
                  <td>'.$inventario['precioxunidad'].'</td> 
  
                  <td>'.$precioTotal.'</td>
                  
                  <td>'.$inventario['CantidadTotalHistorica'].'</td>
                  <td>'.$inventario['GastoTotalHistorico'].'</td>

                  <td><p class="btninv" id="'.$inventario['id'].'" onclick="modificar(this.id)">Modificar</p></td>
                  
                </tr>');
                }  
              ?>
              
            </tbody>  
          </table>
        </div>

        

        <!-- The Modal -->
        <div id="myModalinv" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span id="closeinv" class="close">&times;</span>
            <form id="formmodificar" action="" method="post">      
              
              <label for="">Nombre</label>
              <input id="nomb_inv" name="nomb_inv" type="text" value="" required>

              <label for="">Cantidad del producto</label>
              <input id="cant_inv" name="cant_inv" type="text" value="" required pattern="([0-9])+">

              <label for="">Precio por unidad</label>
              <input id="precioxunidad_inv" name="precioxunidad_inv" type="text" value="" required pattern="([0-9])+">

              <button name="guardarinventario" type="submit" id="contact-submit">Guardar</button>              
            </form>
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
    document.getElementById("inv").classList.add('active');

    function ordenar_nombre(){
      // alert('id');
      // return false;
      if(document.getElementById("orN").classList == 'fa fa-sort-desc'){
        document.getElementById("orN").classList = 'fa fa-sort-asc';
        var orden = 'asc';
      }else{
        document.getElementById("orN").classList = 'fa fa-sort-desc';
        var orden = 'desc';
      }
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php', 
        dataType : 'html',
        data: {sort: 'nombre', orden: orden }, 
        success:function(data){          
          $('#contenedor-orden').html(data);
        },
        
      });
    }


    function ordenar_stock() {
      if(document.getElementById("orS").classList == 'fa fa-sort-desc'){
        document.getElementById("orS").classList = 'fa fa-sort-asc';
        var orden = 'asc';
      }else{
        document.getElementById("orS").classList = 'fa fa-sort-desc';
        var orden = 'desc';
      }
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php',        
        dataType : 'html',
        data: {sort: 'stock', orden: orden },
        success:function(data){ 
          $('#contenedor-orden').html(data);
        },
        
      });
    }


    function ordenar_PXUnidad() {
      if(document.getElementById("orPXU").classList == 'fa fa-sort-desc'){
        document.getElementById("orPXU").classList = 'fa fa-sort-asc';
        var orden = 'asc';
      }else{
        document.getElementById("orPXU").classList = 'fa fa-sort-desc';
        var orden = 'desc';
      }
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php',
        dataType : 'html',
        data: {sort: 'PXunidad', orden: orden },
        success:function(data){ 
          $('#contenedor-orden').html(data);
        },
        
      });
    }


    function ordenar_PIHistorico() {
      if(document.getElementById("orPI").classList == 'fa fa-sort-desc'){
        document.getElementById("orPI").classList = 'fa fa-sort-asc';
        var orden = 'asc';
      }else{
        document.getElementById("orPI").classList = 'fa fa-sort-desc';
        var orden = 'desc';
      }
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php',
        dataType : 'html',
        data: {sort: 'PIHistorico', orden: orden },
        success:function(data){ 
          $('#contenedor-orden').html(data);
        },
        
      });
    }

    function ordenar_CTHistorico(){
      if(document.getElementById("orCT").classList == 'fa fa-sort-desc'){
        document.getElementById("orCT").classList = 'fa fa-sort-asc';
        var orden = 'asc';
      }else{
        document.getElementById("orCT").classList = 'fa fa-sort-desc';
        var orden = 'desc';
      }
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php',
        dataType : 'html',
        data: {sort: 'CTHistorico', orden: orden },
        success:function(data){ 
          $('#contenedor-orden').html(data);
        },
        
      });
    }

    function ordenar_GTHistorico(){
      if(document.getElementById("orGT").classList == 'fa fa-sort-desc'){
        document.getElementById("orGT").classList = 'fa fa-sort-asc';
        var orden = 'asc';
      }else{
        document.getElementById("orGT").classList = 'fa fa-sort-desc';
        var orden = 'desc';
      }
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php',
        dataType : 'html',
        data: {sort: 'GTHistorico', orden: orden },
        success:function(data){ 
          $('#contenedor-orden').html(data);
        },
        
      });
    }



    function modificar(id) { 
      //alert(id);
      //return false;
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php',
        dataType : 'html',
        data: {id_inv: id},
        success:function(data){ 
          data = $.parseJSON(data);
          document.getElementById("nomb_inv").value = data.nombre;
          document.getElementById("cant_inv").value = data.cantidad;
          document.getElementById("precioxunidad_inv").value = data.precioxunidad;
        },
        
      });

      document.getElementById("formmodificar").action = 'conexion/calAdminConnect.php?idinv='+id;
      document.getElementById("myModalinv").style.display = "block";
      //var span = document.getElementsByClassName("close")[0];
      var span = document.getElementById("closeinv");
      span.onclick = function() {
        document.getElementById("myModalinv").style.display = "none";
      }
    }


    function fetchproducto() {
      let year_inv = $("#Anio").children("option:selected").val();
      let mes_inv = $("#Mes").children("option:selected").val();
      let producto = $("#producto").children("option:selected").val();
      // alert("You have selected the name - " + year_inv + mes_inv + producto);
      // return false;
      //$('#purecounter_1').html('');
      $.ajax({
        type: 'post',
        url: 'conexion/extensionFicha.php', //Aqui va tu ruta php
        data: {mes_inv: mes_inv, year_inv: year_inv, id_inventario: producto}, //Aqui tus variables javascript que asignaste arriba
        success:function(data){          
          $('#purecounter_1').html(data);
        },
        
      });
    }

  </script>
  <script src="assets/js/main.js"></script>
  

</body>

</html>