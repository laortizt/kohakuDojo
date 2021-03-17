
<script>

$(document).ready(function(){
    $('.btn-logout').on('click', function (e){
    e.preventDefault();
      //se guerda el token en una variable
      var token=$(this).attr('href');
  swal({

    title: "¿Estás seguro?",   
    text: "La sesión actual se cerrará y tendrás que  iniciar sesión nuevamente",   
    type: "warning",   
    showCancelButton: true, 
    confirmButtonColor: '#03A9F4',
    cancelButtonColor: '#F44336',  
    confirmButtonText:'<i class="fas fa-check-circle"></i> Aceptar',
    cancelButtonText: '<i class="far fa-times-circle"></i> Cancelar',
    }).then(function(){
        $.ajax({
          url:'<?php echo SERVERURL; ?>ajax/loginAjax.php?token='
            +token,
            success:function(data){
              if(data=="true"){
                window.location.href="<?php echo SERVERURL; ?> login/";
              }else{
                swal(
                  "Ocurrío un error", 
                  "No se pudo cerrar la sesión"
                );
              }
            }
        });
    });
     
});
})
</script>