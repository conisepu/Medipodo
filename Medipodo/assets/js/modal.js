/*const btnAbrirModal = document.querySelector("#btn-abrir-modal");
const btnCerrarModal = document.querySelector("#btn-cerrar-modal");
const modal = document.querySelector("#modal");

btnAbrirModal.addEventListener("click", function (){
  modal.showModal();
})

btnCerrarModal.addEventListener("click", ()=>{
    modal.close();
})
*/


// Modal Button


// Get modal element
const modal = document.getElementById('modal');
// All page modals
var modals = document.querySelectorAll('.modal');
// Get open modal button
const modalBtn = document.querySelectorAll('.btn');
// Get close button
const closeBtn = document.getElementsByClassName('closeBtn')[0];

// Listen 	for OPEN Click
modalBtn.forEach(function(e) {
e.addEventListener('click', openModal);
})
// Listen for CLOSE Click
closeBtn.addEventListener('click', closeModal);
// Listen for OUTSIDE Click
window.addEventListener('click', outsideClick);

// Function to OPEN modal
function openModal() {
  modal.style.display = "block";
}

// Function to CLOSE modal
function closeModal() {
  modal.style.display = "none";
}
// Function to CLOSE modal
function outsideClick(e) {
  if(e.target == modal) {
    modal.style.display = "none";    
  }
}

///////////////////////////////////////////////////////////

// const modalCalendar = document.getElementById('modalCalendar');
// All page modals
var modals = document.querySelectorAll('.modalCalendar');
// Get open modal button
const modalBtnCalendar = document.querySelectorAll('.date');
// Get close button
const closeBtnCalendar = document.getElementsByClassName('closeBtnCalendar')[0];

// Listen 	for OPEN Click
modalBtnCalendar.forEach(function(e) {
e.addEventListener('click', openModal);
})
// Listen for CLOSE Click
closeBtnCalendar.addEventListener('click', closeModalCalendar);
// Listen for OUTSIDE Click
window.addEventListener('click', outsideClickCalendar);

// Function to OPEN modal
// function openModal() {
//   modalCalendar.style.display = "block";
// }

// Function to CLOSE modal
function closeModalCalendar() {
  modalCalendar.style.display = "none";
}
// Function to CLOSE modal
function outsideClickCalendar(e) {
  if(e.target == modalCalendar) {
    
    modalCalendar.style.display = "none";
  }
}
