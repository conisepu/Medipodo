<?php
            $noti = 'none';
            if(isset($_GET['b'])){
                if($_GET['b'] == 'T'){
                    $noti = 'block';
                }
            }
          ?>
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