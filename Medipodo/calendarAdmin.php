<?php 
include 'conexion/db.php';

?>
  
<div class="calendar">
  <div class="headerCalendar">
    <button class="lastYear">&lt;&lt;</button>
    <button class="lastMonth">&lt;</button>
    <div class="currentDate"></div>
    <button class="nextMonth">&gt;</button>
    <button class="nextYear">&gt;&gt;</button>
  </div>
  <div class="days">
    <div class="day">Lu</div>
    <div class="day">Ma</div>
    <div class="day">Mi</div>
    <div class="day">Ju</div>
    <div class="day">Vi</div>
    <div class="day">Sa</div>
    <div class="day">Do</div>
  </div>
  <div class="dates">
    <button class="date">1</button>
    <button class="date">2</button>
    <button class="date">3</button>
    <button class="date">4</button>
    <button class="date">5</button>
    <button class="date">6</button>
    <button class="date">7</button>
    <button class="date">8</button>
    <button class="date">9</button>
    <button class="date">10</button>
    <button class="date">11</button>
    <button class="date">12</button>
    <button class="date">13</button>
    <button class="date">14</button>
    <button class="date">15</button>
    <button class="date">16</button>
    <button class="date">17</button>
    <button class="date">18</button>
    <button class="date">19</button>
    <button class="date">20</button>
    <button class="date">21</button>
    <button class="date">22</button>
    <button class="date">23</button>
    <button class="date">24</button>
    <button class="date">25</button>
    <button class="date">26</button>
    <button class="date">27</button>
    <button class="date">28</button>
    <button class="date">29</button>
    <button class="date">30</button>
    <button class="date">31</button>
    <button class="date">32</button>
    <button class="date">33</button>
    <button class="date">34</button>
    <button class="date">35</button>
    <button class="date">36</button>
    <button class="date">37</button>
    <button class="date">38</button>
    <button class="date">39</button>
    <button class="date">40</button>
    <button class="date">41</button>
    <button class="date">42</button>
  </div>
</div>


  
<dialog id="modalCalendar" class="modalCalendar">
    <div class="container-modal">
    
      <form id="contact" action="/" method="post">
        <h3>Colorlib Contact Form</h3>
        <h4>Contact us for custom quote</h4>
        <select name="tipo_visita" id="lang">
          <option value="presencial" >En clinica</option>
          <option value="domicilio" >A domicilio</option>
        </select>
        <fieldset>
          <input placeholder="Nombre" type="text" name="nombre"  autofocus>
        </fieldset>
        <fieldset>
          <input placeholder="Apellido" type="text" name="apellido" tabindex="1"  autofocus>
        </fieldset>
        <fieldset>
          <input placeholder="Correo" type="email" name="correo" tabindex="2" >
        </fieldset>
        <fieldset>
          <input placeholder="Celular" type="tel" name="celular" tabindex="3" >
        </fieldset>
        <fieldset>
          <input placeholder="Rut" type="text" name="rutcdv" tabindex="4" >
        </fieldset>
        <fieldset>
          <input placeholder="Edad" type="text" name="edad" tabindex="5" >
        </fieldset>                
        <fieldset>
          <button name="submitSave" type="submit" id="contact-submit">Guardar</button>
        </fieldset>                  
      </form>
      <fieldset>
        <button id="closeBtnCalendar" class="closeBtnCalendar" >Cancelar</button>
      </fieldset>
    </div>           
</dialog>

