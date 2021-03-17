const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

// Cerrar sesión
$('.btn-logout').on('click', function (e){
  e.preventDefault();

  swal({
    title: "¿Estás seguro de salir?",   
    text: "La sesión se cerrará",   
    type: "Alert",   
    showCancelButton: true,     
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar"
  }).then(function(){
    window.location.href="index.php"
  });
});