<div class="container" style="margin-top: 150px;">
             
        <div class="weekdays col-lg-3 col-md-6">
            <?php
                $cont = date('W');
                $year = date("Y");
                $año_siguiente = (date("Y") + 1);
            ?>
            <h2>Ingresa fecha para ver la semana</h2>
            <input type="week" id="start" name="trip_start" value="<?php echo $year.'-W'.$cont ?>" min="2021-W01" max="<?php echo $año_siguiente.'-W01' ?>" onchange=fetchweek(this.value)>
        </div>
          
       


        <div id="semanacont" class="semana_cont row">
          <?php

            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $fecha_inicio = date("Y-m-d", strtotime($year.'-W'.$cont));
            $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+ 6 days"));
            $contador = 1;
            
            for($i = $fecha_inicio; $i <= $fecha_final; $i = date("Y-m-d",strtotime($i."+ 1 days"))){
              $dia = date('w', strtotime("Sunday + $contador Days")); 
              ?>   
              <div class="col-sm" style="padding-top: 20px;">
                <h4><?php echo $dias[$dia] ?></h4>
              <?php
              $consulta = $con->query("SELECT * FROM atencionpodologica.ficha WHERE fecha='$i' order by hora");
              while($row = $consulta->fetch_assoc()){
                ?>
                  <div class="row">
                    <div class="hora col" style="padding: unset;">
                      <p><?php echo substr($row['hora'],0,5) ?></p>
                    </div>
                <?php
                  $id_paciente = $row['id_paciente'];
                  $consulta2 = $con->query("SELECT * FROM atencionpodologica.paciente WHERE id='$id_paciente'");
                  if($row2= $consulta2->fetch_assoc()){
                    $nombre = $row2['nombre'];
                    $apellido = $row2['apellido'];
                    $correo = $row2['correo'];
                    ?>
                        <div class="nombre col" style="padding: unset;">
                          <p><?php echo $nombre.' '.$apellido ?></p>
                        </div>
                      </div>
                    <?php
                  }
              }
              ?></div><?php       
              $contador = intval($contador) + 1;
            }
          ?>
        </div>

        <!--<div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Why Choose Medilab?</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus optio ad corporis.
              </p>
              <div class="text-center">
                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-receipt"></i>
                    <h4>Corporis voluptates sit</h4>
                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Ullamco laboris ladore pan</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>Labore consequatur</h4>
                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>-->

      </div>